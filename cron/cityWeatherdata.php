<?php

date_default_timezone_set('Asia/Kolkata');
#===============log function =============#
#this function log msg to file and print same msg on console
#==============================================#
function logMsg($logMessage){
    // Your log file path
    $logFilePath = "/home/uxjb3x180e71/public_html/cabh_iaq_dashboard/cron/weather_log.txt";
    file_put_contents($logFilePath, date('Y-m-d H:i:s') . ' - ' . $logMessage . "\n", FILE_APPEND);
    echo $logMessage."\n";
}



function db_connect() {
    $dbhost = "68.178.149.225";
    $dbuser = "edsglobal";
    $dbpass = "EdS!234";
    $db = "cabh_iaq_db"; 
    /*$dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";
    $db = "cabh_iaq_db";*/
    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n". $conn -> error);
    return $conn;
}

#===============log function =============#
#this function call the api and save the data
#==============================================#
function getWeatherData(){
    $conn = db_connect();
    //API parameter
    //units (	optional)	- standard, metric, imperial. When you do not use the units parameter, format is standard by default.
    //to get all unit details check https://openweathermap.org/weather-data
    //lang	(optional) -	You can use this parameter to get the output in your language.
    $url = 'https://api.openweathermap.org/data/2.5/weather?q=Delhi,IN&appid=2ca506bfa6f0f9cba1e189dc96ae9524&units=metric';

    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
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
    
    curl_close($ch);

    $output = json_decode($response);
    //get last updated data
    //$lastupdated = new DateTime(strtotime($output->dt), new DateTimeZone('UTC'));
    //$lastupdated->setTimezone(new DateTimeZone('Asia/Kolkata'));
    //$lastupdated = $lastupdated->format('Y-m-d H:i:s');

    $lastupdated = $output->dt;
    $lastupdated = date_create('@'.$lastupdated)->setTimeZone(new DateTimeZone("Asia/Kolkata"));
    echo $lastupdated->format('Y-m-d H:i:s');

    $temp = $output->main->temp;
    echo "\nTemperature: " . $temp;

    $pressure = $output->main->pressure;
    echo "\nPressure: " . $pressure;

    $humidity = $output->main->humidity;
    echo "\nHumidity: " . $humidity;

    $wind_speed = $output->wind->speed;
    echo "\nWind speed: ". $wind_speed;

    $wind_deg = $output->wind->deg;
    echo "\nWind deg: ". $wind_deg;

    $sun_rise = $output->sys->sunrise ;

    $sun_rise = date_create('@'.$sun_rise)->setTimeZone(new DateTimeZone("Asia/Kolkata"));
    //$sun_rise = $sun_rise->format('Y-m-d H:i:s');

    
    echo "\nSun Rise: ". $sun_rise->format('Y-m-d H:i:s');

  
    
    $sun_set = $output->sys->sunset;
    $sun_set = date_create('@'.$sun_set)->setTimeZone(new DateTimeZone("Asia/Kolkata"));
   // $sun_set = $sun_set->format('Y-m-d H:i:s');
    echo "\nSunset: ". $sun_set->format('Y-m-d H:i:s');
    

    $clouds = $output->clouds->all;
    echo "\nclouds(%): ". $clouds;

    $weather_condition = $output->weather[0]->main;
    echo "\nWeather condition: ". $weather_condition;

    $weather_description =$output->weather[0]->description;
    echo "\Weather description: ". $weather_description;

    $weather_icon = $output->weather[0]->icon;
    echo "\nicon: ". $weather_icon;

    $raw_data = $response;
    echo $raw_data;

    $insert_query = "Insert into delhi values (";
    $insert_query .= "'". $lastupdated->format('Y-m-d H:i:s') . "', ";
    $insert_query .= $temp . ", ";
    $insert_query .= $pressure . ", ";
    $insert_query .= $humidity . ", ";
    $insert_query .= $wind_speed . ", ";
    $insert_query .= $wind_deg . ", ";
    $insert_query .= "'" . $weather_condition . "', ";

    $insert_query .= "'" . $weather_description . "', ";
    $insert_query .= "'" . $sun_rise->format('Y-m-d H:i:s') . "', ";
    $insert_query .= "'" . $sun_set->format('Y-m-d H:i:s') . "', ";
    $insert_query .= "'" . $clouds . "', ";
    
    $insert_query .= "'" . $weather_icon . "', ";
    $insert_query .="'" .  $raw_data . "') ";
    
    logMsg("Generated data: ". $response);
    if ($conn->query($insert_query) === TRUE) {
        logMsg("Weather data inserted for  " .  $lastupdated->format('Y-m-d H:i:s') )  ;

    }
    else {
        logMsg ("Error: " . $insert_query . "<br>" . $conn->error);
    } 

}
getWeatherData();
?>

