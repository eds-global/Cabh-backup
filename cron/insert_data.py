import csv
import mysql.connector
from datetime import datetime

# Connect to MySQL
conn = mysql.connector.connect(

    host="139.59.34.149",
    user="neemdb",
    password="(#&pxJ&p7JvhA7<B",
    database="cabh_iaq_db"
)
cursor = conn.cursor()

# Path to your CSV file
csv_file_path = "reading_db1.csv"

# Open the CSV file and iterate over its rows
with open(csv_file_path, "r") as csv_file:
    csv_reader = csv.reader(csv_file)
    i = 1
    next(csv_reader)  # Skip header row if present
    for row in csv_reader:
        # Assuming the CSV file has three columns: col1, col2, col3
        col1, col2, col3, col4, col5, col6, col7,col8, col9, col10, col11 = row  # Adjust this line based on your CSV structure
        print(col1 + " " + col2 + " row: " + str(i))
        i = i+1
        # MySQL query to insert a row into your_table
        insert_query = "INSERT INTO reading_db (deviceID,	datetime,	pm25,	pm10,	aqi,	co2,	voc,	temp,	humidity,	battery,	viral_index)  VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s,%s, %s)"
        dt = datetime.strptime(col2, "%d-%m-%Y %H:%M")

        # Execute the query
        cursor.execute(insert_query, (col1, dt.strftime('%Y-%m-%d  %H:%M:%S'), col3, col4, col5, col6, col7,col8, col9, col10, col11))

# Commit changes to the database
conn.commit()

# Close cursor and connection
cursor.close()
conn.close()
