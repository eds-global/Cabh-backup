<?php
    ("Content-Type: application/json; charset=UTF-8");
    include 'db.php';
    function getTypology(){
        
        $conn = db_connect();
        $query = "select distinct typology from device_details";
        try{        
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $typology = array();

                // Loop through each row of the result set
                while($row = $result->fetch_assoc()) {
                    // Add the value of the column to the array
                    if($row['typology']!= ""){
                        $typology[] = $row['typology'];
                    }
                }
                
                //$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => count($typology), 'Data' => $typology ] );
            } else {
                return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found" ] );;
            }

        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
        }
    }

    function getLocation(){
        
        $conn = db_connect();
        $query = "select distinct nearby_AQI_station from device_details";
        try{        
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $location = array();

                // Loop through each row of the result set
                while($row = $result->fetch_assoc()) {
                    // Add the value of the column to the array
                    if($row['nearby_AQI_station']!= ""){
                        $location[] = $row['nearby_AQI_station'];
                    }
                }
                
                //$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => count($location), 'Data' => $location ] );
            } else {
                return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found" ] );;
            }

        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
        }
    }


    function getDialData(){
        $conn = db_connect();


        /* $condition = array();
        if(file_get_contents('php://input')){
            $json = file_get_contents('php://input'); //'["geeks", "for", "geeks"]';
            $data = json_decode($json,true);
            $orderBy = $data["duration"];
            $start_limit = $data["typology"];
            $end_limit = $data["location"];
            //$start_date = $data["start_date"];
            //$end_date = $data["end_date"];
            
            foreach($data as $key => $value){
                $condition[$key] = $value;
            }  
            unset($condition["orderBy"]);         
            unset($condition["start_row"]);         
            unset($condition["end_row"]);  
            unset($condition["start_date"]);  
            unset($condition["end_date"]);  
            unset($condition["device_IDs"]);
                   
        }  */

        $query = "select count(distinct b.deviceID) as totalsite, avg(pm25) as pm25, avg(pm10) as pm10, avg(aqi) as aqi, avg(co2) as co2, avg(voc) as voc, avg(temp) as temp, avg(humidity) as humidity from reading_db a join device_details b on a.deviceID = b.deviceID where b.active=1";
        try{        
            $result = $conn->query($query);
            if ($result->num_rows > 0) {

                // Loop through each row of the result set
                $row = $result->fetch_assoc();
                $total_site = $row['totalsite'];   
                $avg_pm25 = $row['pm25'];
                $avg_pm10 = $row['pm10'];
                $avg_aqi = $row['aqi'];
                $avg_co2 = $row['co2'];
                $avg_voc = $row['voc'];
                $avg_temp = $row['temp'];
                $avg_hum = $row['humidity'];
                $response = array("totalsite"=>$total_site, "avg_pm25"=> $avg_pm25, "avg_pm10"=> $avg_pm10, "avg_aqi"=> $avg_aqi, "avg_co2"=> $avg_co2, "avg_voc"=> $avg_voc, "avg_temp" => $avg_temp, "avg_humidity"=> $avg_hum);
                
                //$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return  json_encode ( [ 'ApiResponse' => 'Success', 'Data' => $response ] );
            } else {
                return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found" ] );;
            }

        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
        }
    }

    function getPinData(){
        $conn = db_connect();


        /* $condition = array();
        if(file_get_contents('php://input')){
            $json = file_get_contents('php://input'); //'["geeks", "for", "geeks"]';
            $data = json_decode($json,true);
            $orderBy = $data["duration"];
            $start_limit = $data["typology"];
            $end_limit = $data["location"];
            //$start_date = $data["start_date"];
            //$end_date = $data["end_date"];
            
            foreach($data as $key => $value){
                $condition[$key] = $value;
            }  
            unset($condition["orderBy"]);         
            unset($condition["start_row"]);         
            unset($condition["end_row"]);  
            unset($condition["start_date"]);  
            unset($condition["end_date"]);  
            unset($condition["device_IDs"]);
                   
        }  */
        $current_dt = new DateTime();
        $start_dt = clone $current_dt;
        $start_dt->modify('-1 hour');
        // Format datetimes as strings (optional)
        $current_dt_string = $current_dt->format('Y-m-d H:i:s');
        $start_dt_string = $start_dt->format('Y-m-d H:i:s');

        $query = "select b.deviceID,b.latitude, b.longitude,  max(a.pm25) as pm25, max(a.pm10) as pm10, max(a.aqi) as aqi, max(a.co2) as co2, max(a.voc) as voc, max(a.temp) as temp, max(a.humidity) as humidity, ".
        " max(c.pm25) as outdoor_pm25, max(c.pm10) as outdoor_pm10, max(c.aqi) as outdoor_aqi,  max(c.temp) as outdoor_temp, max(c.humidity) as outdoor_humidity ".
        " from reading_db a join device_details b on a.deviceID = b.deviceID ".
        " join cpcb_data c on b.outdoor_deviceID = c.deviceID ".
        " where b.active=1 and b.primary_sensor=1 and (a.datetime between '".$start_dt_string ."' and '". $current_dt_string ."') group by deviceID , latitude, longitude";
        try{        
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $response = array();
                // Loop through each row of the result set
                while($row = $result->fetch_assoc()){
                    $deviceID = $row['deviceID'];   
                    $latitude = $row['latitude'];
                    $longitude = $row['longitude'];
                    $max_pm25 = $row['pm25'];
                    $max_pm10 = $row['pm10'];
                    $max_aqi = $row['aqi'];
                    $max_co2 = $row['co2'];
                    $max_voc = $row['voc'];
                    $max_temp = $row['temp'];
                    $max_hum = $row['humidity'];
                    //outdoor data
                    $max_out_pm25 = $row['outdoor_pm25'];
                    $max_out_pm10 = $row['outdoor_pm10'];
                    $max_out_aqi = $row['outdoor_aqi'];
                    $max_out_temp = $row['outdoor_temp'];
                    $max_out_hum = $row['outdoor_humidity'];
                    $response[] = array("deviceID"=>$deviceID, "latitude"=>$latitude, "longitude"=>$longitude, "max_pm25"=> $max_pm25, "max_pm10"=> $max_pm10, "max_aqi"=> $max_aqi, "max_co2"=> $max_co2, "max_voc"=> $max_voc, "max_temp" => $max_temp, "max_humidity"=> $max_hum,"outdoor_pm25"=>$max_out_pm25, "outdoor_pm10"=>$max_out_pm10, "outdoor_aqi"=>$max_out_aqi, "outdoor_temp"=>$max_out_temp, "outdoor_humidity"=>$max_out_hum ,"start_date" => $start_dt_string, "end_date"=> $current_dt_string);
                }
                //$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return  json_encode ( [ 'ApiResponse' => 'Success', 'Data' => $response ] );
            
            } else {
                return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found", 'Query'=> $query]);
            }

        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
        }
    }
?>