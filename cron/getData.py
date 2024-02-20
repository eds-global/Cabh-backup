import requests
import time
from pandas.io import sql
import datetime
import mysql.connector
import pandas as pd
from sqlalchemy import create_engine, text,insert
import json

def log(msg):
    fo = open("log.txt", "a")
    fo.write( msg+"\n")
    # Close opend file
    fo.close()

#===============GetToken function =============#
#this function gives the token using airveda dashboard credentials
#==============================================#
def getToken():  
    url = 'https://dashboard.airveda.com/api/token/'
    payload = {
        'email': 'eds@airveda.com',
        'password': 'Airveda@123'
    }
    return (requests.post(url, payload).json())

#===============Get Refresh function =============#
#this function regenerates the refresh token 
#=================================================#
def getRefreshToken(refreshToken):
    url = 'https://dashboard.airveda.com/api/token/refresh/'
    payload = {'refreshToken': refreshToken}
    return (requests.post(url, payload).json())


###################################
#logic to add data to mysql database
###################################

def getConnection():
    #connecting to mysql server
    connectionConfig = 'mysql+mysqlconnector://edsglobal:EdS!234@68.178.149.225/cabh_iaq_db'
    #connectionConfig = 'mysql+mysqlconnector://root@localhost/iaq-dashboard'
    engine = create_engine(connectionConfig)
    connection = engine.connect()
    return connection

#===============Store token to Database function =============#
#this function check for last saved token time from database using select query
# if time is more than 50 minutes delete existing token and store the regenerated token
#=================================================#
def storeToken2DB():
    connection = getConnection()

    #running select query to get existing token details
    select_query = " Select * from token_details "
    result = connection.execute(text(select_query))
    connection.commit()
    
    token = {}
    for row in result:
        token['idToken']=row[0]
        token['refreshToken'] = row[1]
        token['datetime'] = row[2] 
    #print(token)
    idToken = token['idToken']
    print("select query executed at " + token['datetime'].strftime('%Y-%m-%d %H:%M:%S') )
    log("select query executed at " + token['datetime'].strftime('%Y-%m-%d %H:%M:%S') )

    #calculate time difference in minutes
    current_date = datetime.datetime.now() 
    date_diff = current_date - token['datetime']
    minutes = date_diff.total_seconds() / 60
    
    #if difference is more than 50 minutes 
    if( minutes >= 50):
        print("regenerating token after " + str(minutes) + " minutes")
        log("regenerating token after " + str(minutes) + " minutes")

        #delete existing tokens
        delete_query = " Delete from token_details "
        result = connection.execute(text(delete_query))
        connection.commit()
        print("delete query executed")
        log("delete query executed")

        #regenerate new token
        new_token = getRefreshToken(token['refreshToken'])
        idToken = new_token['idToken']
      
        #save new generated token to database
        query1 = " INSERT INTO token_details " + " values( '" + new_token['idToken'] + "', '"+ new_token['refreshToken'] + "', '" + current_date.strftime('%Y-%m-%d %H:%M:%S') +"')"
        result = connection.execute(text(query1))
        connection.commit()
        print("Inserted " + str(result.rowcount) + " token details")  
        log("Inserted " + str(result.rowcount) + " token details")  

    connection.close()
    return idToken


#===============get device IDs function =============#
#this function returns all active device IDs
#=================================================#
def getActiveDeviceIDs():
    connection = getConnection()

    #running select query to get all device IDs
    select_query = " Select deviceID from device_details where active = 1 "
    result = connection.execute(text(select_query))
    connection.commit()
    devices = []
    for row in result:
        devices.append(row[0]) 
    connection.close()
    return (devices)


#===============get latest data function =============#
#this function read the latest data for all devices
#=================================================#
def getLatestData(devices, idToken):
    deviceIds = ','.join(devices)
    print("Active device ids are : " + deviceIds)
    log("Active device ids are : " + deviceIds)
    url = 'https://dashboard.airveda.com/api/data/latest/'
    payload = {'deviceIds': deviceIds}
    id_token = idToken
    headers = {'Authorization': 'Bearer ' + id_token}
    data = requests.post(url, data = payload, headers = headers).json()
    return data

#===============format  data function =============#
#this function read the latest data for all devices for format it
#=================================================#
def formatData(data, devices):
    final_dt = []
    for id in devices:
        print("Reading data for meter id " + id)
        log("Reading data for meter id " + id)
        meterdata = data[id]
        lastupdated = meterdata['lastUpdated']
        latestData = meterdata['data']

        value_pm25 = 0
        value_pm10=0
        value_aqi = 0
        value_co2 = 0
        value_voc = 0
        value_temp = 0
        value_hum =0
        value_battery = 0
        value_vi = 0

        for data_dict in latestData:
            if 'pm25' in data_dict['type']:
                value_pm25 = data_dict['value']
            if 'pm10' in data_dict['type']:
                value_pm10 = data_dict['value']
            if 'aqi' in data_dict['type']:
                value_aqi = data_dict['value']
            if 'co2' in data_dict['type']:
                value_co2 = data_dict['value']
            if 'voc' in data_dict['type']:
                value_voc = data_dict['value']
            if 'temperature' in data_dict['type']:
                value_temp = data_dict['value']
            if 'humidity' in data_dict['type']:
                value_hum = data_dict['value']
            if 'battery' in data_dict['type']:
                value_battery = data_dict['value']
            if 'viral_index' in data_dict['type']:
                value_vi = data_dict['value']
        
        temp ={}
        temp['deviceID'] = id
        temp['datetime'] = lastupdated
        temp['pm25'] =value_pm25
        temp['pm10'] = value_pm10
        temp['aqi'] = value_aqi
        temp['co2'] = value_co2
        temp['voc'] = value_voc
        temp['temperature'] = value_temp
        temp['humidity'] = value_hum
        temp['battery'] = value_battery
        temp['viral_index'] = value_vi

        final_dt.append(temp)

    return final_dt


#===============save data function =============#
#this function save the latest data for all devices to database
#=================================================#
def saveData2DB(data):
    connection = getConnection()
    print("saving data to database")
    log("saving data to database")

    values = []
    for dt in data:
        values.append( " ('" + dt['deviceID'] + "', '"+ dt['datetime'] + "', '" +str(dt['pm25']) + "', '"+ str(dt['pm10']) + "', '"+ str(dt['aqi']) + "', '" + str(dt['co2'])  + "', '" + str(dt['voc']) + "', '" + str(dt['temperature'] )+ "', '" + str(dt['humidity']) + "', '" + str(dt['battery']) + "', '" + str(dt["viral_index"]) +"')" )

    #save new generated token to database
    insert_query = " INSERT INTO reading_db (deviceID, datetime, pm25, pm10, aqi, co2, voc, temp, humidity, battery, viral_index) values "
    value_str = ','.join(values)
    insert_query += value_str
    result = connection.execute(text(insert_query))
    connection.commit()
    print("Inserted " + str(result.rowcount) + " readings ")  
    log("Inserted " + str(result.rowcount) + " readings ")  


#main code
log("================================\n")
idToken = storeToken2DB()
devices = getActiveDeviceIDs()
data = getLatestData(devices, idToken)
final_dt = formatData(data, devices)
#print(final_dt)
saveData2DB(final_dt)
