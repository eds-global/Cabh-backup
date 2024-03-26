<?php
date_default_timezone_set('Asia/Kolkata');
#===============log function =============#
#this function log msg to file and print same msg on console
#==============================================#
function logMsg($logMessage){
    // Your log file path
    $logFilePath = "/home/uxjb3x180e71/public_html/cabh_iaq_dashboard/cron/logfile.txt";
    file_put_contents($logFilePath, date('Y-m-d H:i:s') . ' - ' . $logMessage . "\n", FILE_APPEND);
    echo $logMessage."\n";
}


#===============GetToken function =============#
#this function gives the token using airveda dashboard credentials
#==============================================#
function getToken(){    
    $url = 'https://dashboard.airveda.com/api/token/';
    $data = array(
        'email' => 'eds@airveda.com',
        'password' => 'Airveda@123'
    );

    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    );

    $ch = curl_init();
    curl_setopt_array($ch, $options);

    $response = curl_exec($ch);

    if ($response === false) {
        logMsg( 'cURL Error: ' . curl_error($ch));
    }
    logMsg("Token Generated: " . $response);
    curl_close($ch);
    return $response;
}


#===============Get Refresh function =============#
#this function regenerates the refresh token 
#=================================================#
function getRefreshToken($refreshToken){
    $url = 'https://dashboard.airveda.com/api/token/refresh/';
    $data = array(
        'refreshToken'=> $refreshToken
    );

    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        ),
    );

    $ch = curl_init();
    curl_setopt_array($ch, $options);

    $response = curl_exec($ch);

    if ($response === false) {
        logMsg( 'cURL Error: ' . curl_error($ch));
    }
    logMsg("Token Regenerated: " . $response);
    curl_close($ch);
    return json_decode($response);
}
    
###################################
#logic to add data to mysql database
###################################

function getConnection(){    
    // Database credentials
    $servername = "68.178.149.225";
    $username = "edsglobal";
    $password = "EdS!234";
    $database = "cabh_iaq_db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}



#===============Store token to Database function =============#
#this function check for last saved token time from database using select query
# if time is more than 50 minutes delete existing token and store the regenerated token
#=================================================#
function storeToken2DB(){
    $conn = getConnection();
    $idToken = '';

    #running select query to get existing token details
    $select_query = " Select * from token_details ";
    $result = $conn->query($select_query);
    if ($result) {
        $row = $result->fetch_assoc();
        $token = array(
            "idToken" => $row['id_token'],
            "refreshToken" => $row['refresh_token'],
            "datetime" => $row['datetime']
        );
        $result->free();
        
        $idToken = $token["idToken"];
        logMsg("select query executed. " );
        #calculate time difference in minutes
        $givenDateTime = new DateTime($token['datetime']);
        $current_dt = new DateTime();
        //echo $current_dt->format('Y-m-d H:i:s') . "\n";
        $timeDifference = $current_dt->diff($givenDateTime);
        $minutesDifference = $timeDifference->days * 24 * 60 + $timeDifference->h * 60 + $timeDifference->i;

        //echo $minutesDifference;
        if ($minutesDifference > 50){
            logMsg("Regenerating token after " . $minutesDifference . " minutes");

            #delete existing tokens
            $delete_query = " Delete from token_details ";
            // Execute the query
            if ($conn->query($delete_query) === TRUE)
             {
                logMsg ("Token Record deleted successfully");
                #regenerate new token
                $new_token = (getRefreshToken($token["refreshToken"]));
                //echo "...........\n";
                //print_r($new_token);
                $idToken = $new_token->idToken;
                
                #save new generated token to database
                $query1 = " INSERT INTO token_details  values( '" . $new_token->idToken . "', '" . $new_token->refreshToken . "', '" . $current_dt->format('Y-m-d H:i:s') ."')";
                if ($conn->query($query1) === TRUE) {
                    logMsg("Inserted new token details")  ;

                }
                else {
                    logMsg ("Error: " . $sql . "<br>" . $conn->error);
                }
            } else {
                logMsg ("Error deleting record: " . $conn->error);
            }

        }

    }
    else{
        logMsg("Error: " . $sql . "<br>" . $conn->error);
    }
    $conn->close();
    return $token["idToken"];
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

#===============get latest data function =============#
#this function read the latest data for all devices
#=================================================#
function getLatestData($devices, $idToken){
    $deviceIds = join(',',$devices);
    logMsg("Active device ids are : " . $deviceIds);

    $url = 'https://dashboard.airveda.com/api/data/latest/';
    $data = array(
        'deviceIds'=> $deviceIds
    );

    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer ' . $idToken,
            'Content-Type: application/json'
        ),
    );

    $ch = curl_init();
    curl_setopt_array($ch, $options);

    $response = curl_exec($ch);

    if ($response === false) {
        logMsg( 'cURL Error: ' . curl_error($ch));
    }
    logMsg("Sensor Data generated ");
    curl_close($ch);
    return json_decode($response);

}

#===============format  data function =============#
#this function read the latest data for all devices for format it
#=================================================#
function formatData($data, $devices){
    $final_dt = array();
    foreach ($devices as $id){
        logMsg("Reading data for meter id " . $id);
        $meterdata = $data->$id;
        $lastupdated = new DateTime($meterdata->lastUpdated, new DateTimeZone('UTC'));
        $lastupdated->setTimezone(new DateTimeZone('Asia/Kolkata'));
        $lastupdated = $lastupdated->format('Y-m-d H:i:s');
        $latestData = $meterdata->data;
        $value_pm25 = 0;
        $value_pm10=0;
        $value_aqi = 0;
        $value_co2 = 0;
        $value_voc = 0;
        $value_temp = 0;
        $value_hum =0;
        $value_battery = 0;
        $value_vi = 0;
        foreach($latestData as $data_dict){
            //str_contain work on php 8 version
            // if (str_contains( $data_dict->type, 'pm25')){
            //     $value_pm25 = $data_dict->value;
            // }
            // if (str_contains($data_dict->type, 'pm10'))
            //     $value_pm10 = $data_dict->value;
            // if (str_contains($data_dict->type, 'aqi'))
            //     $value_aqi = $data_dict->value;
            // if (str_contains($data_dict->type, 'co2'))
            //     $value_co2 = $data_dict->value;
            // if (str_contains($data_dict->type, 'voc'))
            //     $value_voc = $data_dict->value;
            // if (str_contains($data_dict->type, 'temperature'))
            //     $value_temp = $data_dict->value;
            // if (str_contains($data_dict->type, 'humidity'))
            //     $value_hum = $data_dict->value;
            // if (str_contains($data_dict->type, 'battery'))
            //     $value_battery = $data_dict->value;
            // if (str_contains($data_dict->type, 'viral_index'))
            //     $value_vi = $data_dict->value;
                
            //for php older version use this code
            if (strpos( $data_dict->type, 'pm25')!== false){
                $value_pm25 = $data_dict->value;
            }
            if (strpos($data_dict->type, 'pm10')!== false)
                $value_pm10 = $data_dict->value;
            if (strpos($data_dict->type, 'aqi')!== false)
                $value_aqi = $data_dict->value;
            if (strpos($data_dict->type, 'co2')!== false)
                $value_co2 = $data_dict->value;
            if (strpos($data_dict->type, 'voc')!== false)
                $value_voc = $data_dict->value;
            if (strpos($data_dict->type, 'temperature')!== false)
                $value_temp = $data_dict->value;
            if (strpos($data_dict->type, 'humidity')!== false)
                $value_hum = $data_dict->value;
            if (strpos($data_dict->type, 'battery')!== false)
                $value_battery = $data_dict->value;
            if (strpos($data_dict->type, 'viral_index')!== false)
                $value_vi = $data_dict->value;
        

        }
        $temp=array(
            "deviceID" => $id,
            "datetime" => $lastupdated,
            "pm25" => $value_pm25,
            "pm10" => $value_pm10,
            "aqi" =>$value_aqi,
            "co2" => $value_co2,
            "voc" => $value_voc,
            "temperature" => $value_temp,
            "humidity" => $value_hum,
            "battery" => $value_battery,
            "viral_index" => $value_vi
        );
        
        array_push($final_dt,$temp);        
    }
    return $final_dt;

}


#===============save data function =============#
#this function save the latest data for all devices to database
#=================================================#
function saveData2DB($data){
    $conn = getConnection();
    logMsg("saving data to database");
    $values = array();
    foreach ($data as $dt){
        $val = " ('" . $dt['deviceID'] . "', '" . $dt['datetime'] . "', '" . $dt['pm25'] . "', '" . $dt['pm10'] . "', '" . $dt['aqi'] . "', '" . $dt['co2']  . "', '" . $dt['voc'] . "', '" . $dt['temperature'] . "', '" . $dt['humidity'] . "', '" . $dt['battery'] . "', '" . $dt["viral_index"] . "')" ;
        array_push($values,$val);
    }

    $insert_query = " INSERT INTO reading_db (deviceID, datetime, pm25, pm10, aqi, co2, voc, temp, humidity, battery, viral_index) values ";
    $value_str = join(",", $values);
    $insert_query .= $value_str;

    if ($conn->query($insert_query) === TRUE) {
        logMsg("meter data inserted to database")  ;

    }
    else {
        logMsg ("Error: " . $sql . "<br>" . $conn->error);
    }
}
        





$idToken = storeToken2DB();
$devices = getActiveDeviceIDs();
$data = getLatestData($devices, $idToken);
$final_dt = formatData($data, $devices);
//print_r($final_dt);
saveData2DB($final_dt);







?>
