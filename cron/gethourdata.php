<?php
date_default_timezone_set('Asia/Kolkata');
#===============log function =============#
#this function log msg to file and print same msg on console
#==============================================#
function logMsg($logMessage){
    // Your log file path
    $logFilePath = "/home/uxjb3x180e71/public_html/cabh_iaq_dashboard/cron/hourlogfile.txt";
    file_put_contents($logFilePath, date('Y-m-d H:i:s') . ' - ' . $logMessage . "\n", FILE_APPEND);
    echo $logMessage."\n";
}

###################################
#logic to add data to mysql database
###################################

function getConnection(){    
    // Database credentials
    $servername = "139.59.34.149"; //"68.178.149.225";
    $username = "neemdb";
    $password = "(#&pxJ&p7JvhA7<B";
    $database = "cabh_iaq_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

#===============get device IDs function =============#
#this function returns all active device IDs
#=================================================#
function getActiveDeviceIDs(){
    $conn = getConnection();
    $select_query = " Select deviceID from device_details where active = 1 ";
    $result = $conn->query($select_query);
    $devices = array();
    if ($result) {
        while($row = $result->fetch_assoc()){
            array_push($devices,$row['deviceID']);
        }
    }
    $conn->close();
    return $devices;

}

#===============getData function =============#
#this function query data and aggregate it and insert it to reading_15min table
#==============================================#
function getData($deviceIDs, $startdt, $enddt){    
    $conn = getConnection();
    $devices = implode(', ', $deviceIDs);
    $select_query = " insert into reading_hour  Select b.deviceID, '$enddt' as datetime1, max(pm25) as max_pm25, max(pm10) as max_pm10, max(aqi) as max_aqi, max(co2) as max_co2, max(voc) as max_voc, max(temp) as max_temp, max(humidity) as max_hum, min(pm25) as min_pm25, min(pm10) as min_pm10, min(aqi) as min_aqi, min(co2) as min_co2, min(voc) as min_voc, min(temp) as min_temp, min(humidity) as min_hum,
    avg(pm25) as avg_pm25, avg(pm10) as avg_pm10, avg(aqi) as avg_aqi, avg(co2) as avg_co2, avg(voc) as avg_voc, avg(temp) as avg_temp, avg(humidity) as avg_hum  
     from device_details a join reading_db b on a.deviceID = b.deviceID 
     where active = 1  and (b.datetime between '$startdt' and '$enddt')  and a.deviceID in ($devices)
    group by a.deviceID, datetime1";
    //$result = $conn->query($select_query);
    if ($conn->query($select_query) === TRUE) {
        logMsg("$enddt : Data inserted")  ;
        $conn->close();
        return "success";
    }
    else{
        return null;
    }
    return null;

}



#===============get cpcb device IDs function =============#
#this function returns all active device IDs
#=================================================#
function getActiveCPCBDeviceIDs(){
    $conn = getConnection();
    $select_query = " Select deviceID from cpcb_monitors where active = 1 ";
    $result = $conn->query($select_query);
    $devices = array();
    if ($result) {
        while($row = $result->fetch_assoc()){
            array_push($devices,$row['deviceID']);
        }
    }
    $conn->close();
    return $devices;

}

#===============getCPCBData function =============#
#this function query data and aggregate it and insert it to reading_15min table
#==============================================#
function getCPCBData($deviceIDs, $startdt, $enddt){    
    $conn = getConnection();
    $devices = "'". implode("', '", $deviceIDs). "'";
    print $devices;
    $select_query = " insert into cpcb_hour  Select b.deviceID, '$enddt' as datetime1, max(pm25) as max_pm25, max(pm10) as max_pm10, max(aqi) as max_aqi, max(temp) as max_temp, max(humidity) as max_hum, min(pm25) as min_pm25, min(pm10) as min_pm10, min(aqi) as min_aqi, min(temp) as min_temp, min(humidity) as min_hum,
    avg(pm25) as avg_pm25, avg(pm10) as avg_pm10, avg(aqi) as avg_aqi,  avg(temp) as avg_temp, avg(humidity) as avg_hum  
     from cpcb_monitors a join cpcb_data b on a.deviceID = b.deviceID 
     where active = 1  and (b.datetime between '$startdt' and '$enddt')  and a.deviceID in ($devices)
    group by a.deviceID, datetime1";
    print ($select_query);
    //$result = $conn->query($select_query);
    if ($conn->query($select_query) === TRUE) {
        logMsg("$enddt : Data inserted")  ;
        $conn->close();
        return "success";
    }
    else{
        return null;
    }
    return null;

}



## main logic to call function
$deviceIDs = getActiveDeviceIDs();
$current_dt = new DateTime();
$start_dt = new DateTime();
$start_dt->modify("-1 hour");
//print ($start_dt->format('Y-m-d H:i:s'));
//print ($current_dt->format('Y-m-d H:i:s'));
$data = getData($deviceIDs,$start_dt->format('Y-m-d H:i:s') ,$current_dt->format('Y-m-d H:i:s') );
//print_r($data);

$deviceIDs = getActiveCPCBDeviceIDs();
$data = getCPCBData($deviceIDs,$start_dt->format('Y-m-d H:i:s') ,$current_dt->format('Y-m-d H:i:s') );

?>