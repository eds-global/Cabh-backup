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

    function getSpaceType(){
        
        $conn = db_connect();
        $query = "select distinct spaceType from device_details";
        try{        
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $spaceType = array();

                // Loop through each row of the result set
                while($row = $result->fetch_assoc()) {
                    // Add the value of the column to the array
                    if($row['spaceType']!= ""){
                        $spaceType[] = $row['spaceType'];
                    }
                }
                
                //$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => count($spaceType), 'Data' => $spaceType ] );
            } else {
                return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found" ] );;
            }

        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
        }
    }

    function getSensorID(){
        
        $conn = db_connect();
        $query = "select distinct deviceID from device_details";
        try{        
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $sensorID = array();

                // Loop through each row of the result set
                while($row = $result->fetch_assoc()) {
                    // Add the value of the column to the array
                    if($row['deviceID']!= ""){
                        $sensorID[] = $row['deviceID'];
                    }
                }
                
                //$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => count($sensorID), 'Data' => $sensorID ] );
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

        // this query is for taking data from minute interval table
        // $query = "select b.deviceID,b.latitude, b.longitude,  max(a.pm25) as pm25, max(a.pm10) as pm10, max(a.aqi) as aqi, max(a.co2) as co2, max(a.voc) as voc, max(a.temp) as temp, max(a.humidity) as humidity, ".
        // " max(c.pm25) as outdoor_pm25, max(c.pm10) as outdoor_pm10, max(c.aqi) as outdoor_aqi,  max(c.temp) as outdoor_temp, max(c.humidity) as outdoor_humidity ".
        // " from reading_db a join device_details b on a.deviceID = b.deviceID ".
        // " join cpcb_data c on b.outdoor_deviceID = c.deviceID ".
        // " where b.active=1 and b.primary_sensor=1 and (a.datetime between '".$start_dt_string ."' and '". $current_dt_string ."') group by deviceID , latitude, longitude";
       
        
        $query = "select b.deviceID,b.latitude, b.longitude,  max(a.max_pm25) as pm25, max(a.max_pm10) as pm10, max(a.max_aqi) as aqi, max(a.max_co2) as co2, max(a.max_voc) as voc, max(a.max_temp) as temp, max(a.max_hum) as humidity, ".
        " max(c.pm25) as outdoor_pm25, max(c.pm10) as outdoor_pm10, max(c.aqi) as outdoor_aqi,  max(c.temp) as outdoor_temp, max(c.humidity) as outdoor_humidity ".
        " from reading_15min a join device_details b on a.deviceID = b.deviceID ".
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
                return  json_encode ( [ 'ApiResponse' => 'Success', 'Data' => $response, 'RowCount' => $result->num_rows ] );
            
            } else {
                return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found", 'Query'=> $query]);
            }

        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
        }
    }


    function getIndoorData(){
        $conn = db_connect();
        //set default parameters
        $duration = '24hour';
        $typology = 'All';
        $spaceType = 'All';
        $sensorID = 'All';
        $pollutant = "pm25";
        $spaceType_filter = "n";
        $sensorID_filter = "n";
        $typology_filter = 'n';
        //get input from api call
        if(file_get_contents('php://input')){
            $json = file_get_contents('php://input'); 
            $data = json_decode($json,true);
            $duration = $data["duration"];
            $typology = $data["typology"];
            $spaceType = $data["spaceType"];
            $sensorID = $data["sensorID"];
            $pollutant = $data["pollutant"];
                   
        }
        //convert duration to start and end date
        $start_dt = new DateTime();
        $end_dt = new DateTime();
        if($duration == 'week'){
            //set duration for week
            $start_dt->modify("-7 day")->format('Y-m-d H:i:s');
            $end_dt = $end_dt->format('Y-m-d H:i:s');
            $start_dt = $start_dt->format('Y-m-d H:i:s');

            $dt = $start_dt  . " - " . $end_dt ;

        }else if($duration == 'month'){
            //set duration for month
            $start_dt->modify("-1 month")->format('Y-m-d H:i:s');
            $end_dt = $end_dt->format('Y-m-d H:i:s');
            $start_dt = $start_dt->format('Y-m-d H:i:s');

            $dt = $start_dt  . " - " . $end_dt ;

        }else if($duration == 'ytd'){
            //set duration for ytd
            $start_dt = '2024-01-01 00:00:00';
            $end_dt = $end_dt->format('Y-m-d H:i:s');
            //$start_dt = $start_dt->format('Y-m-d H:i:s');

            $dt = $start_dt . " - " . $end_dt ;
        }else{
            //set duration for 24 hour
            $start_dt->modify("-24 hour")->format('Y-m-d H:i:s');
            $end_dt = $end_dt->format('Y-m-d H:i:s');
            $start_dt = $start_dt->format('Y-m-d H:i:s');
            $dt = $start_dt  . " - " . $end_dt ;
        }
        
        //get typology 
        if(strpos($typology, 'All') === false){
            $typology_filter = "y";
        } 
        $typology  =  "'" . str_replace(",","','", $typology ) . "'";

        //get spacetype
        if(strpos($spaceType, 'All') === false){   // if 'All' not found
            $spaceType_filter = "y";
        } 
        $spaceType  =  "'" . str_replace(",","','", $spaceType ) . "'";

        //get sensor id
        if(strpos($sensorID, 'All') === false){   // if 'All' not found
            $sensorID_filter = "y";
        } 
        $sensorID  =  "'" . str_replace(",","','", $sensorID ) . "'";


        $column_nm = "max_". $pollutant;

        $select_query = "select DATE_FORMAT(datetime, '%Y-%m-%d %H:%i:00') as datetime, round(avg($column_nm),2) as '$pollutant' from device_details a join reading_15min b on a.deviceID = b.deviceID where (datetime between '$start_dt' and '$end_dt') ";
        if($typology_filter == 'y'){
            $select_query .=  "  and typology in ($typology) ";
        }
        if($spaceType_filter == 'y'){
            $select_query .=  " and spacetype in ($spaceType) ";
        }
        if($sensorID_filter == 'y'){
            $select_query .=  " and a.deviceID in ($sensorID) ";
        }
        $select_query .=  " group by datetime order by datetime ";
        //return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => '10', 'Query' => $select_query  ] );

        try{        
            $result = $conn->query($select_query);
            
            if ($result->num_rows > 0) {
                
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Query' => $select_query ,'Data' => $rows ] );
            } else {
                return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found" , 'query' => $select_query]);
            }

        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
        }
    }

    function getBoxPlotIndoorData(){
        $conn = db_connect();
        //set default parameters
        $duration = '24hour';
        $typology = 'All';
        $spaceType = 'All';
        $sensorID = 'All';
        $pollutant = "pm25";
        $spaceType_filter = "n";
        $sensorID_filter = "n";
        $typology_filter = 'n';
        //get input from api call
        if(file_get_contents('php://input')){
            $json = file_get_contents('php://input'); 
            $data = json_decode($json,true);
            $duration = $data["duration"];
            $typology = $data["typology"];
            $spaceType = $data["spaceType"];
            $sensorID = $data["sensorID"];
            $pollutant = $data["pollutant"];
                   
        }
        //convert duration to start and end date
        $start_dt = new DateTime();
        $end_dt = new DateTime();
        if($duration == 'week'){
            //set duration for week
            $start_dt->modify("-7 day")->format('Y-m-d H:i:s');
            $end_dt = $end_dt->format('Y-m-d H:i:s');
            $start_dt = $start_dt->format('Y-m-d H:i:s');

            $dt = $start_dt  . " - " . $end_dt ;

        }else if($duration == 'month'){
            //set duration for month
            $start_dt->modify("-1 month")->format('Y-m-d H:i:s');
            $end_dt = $end_dt->format('Y-m-d H:i:s');
            $start_dt = $start_dt->format('Y-m-d H:i:s');

            $dt = $start_dt  . " - " . $end_dt ;

        }else if($duration == 'ytd'){
            //set duration for ytd
            $start_dt = '2024-01-01 00:00:00';
            $end_dt = $end_dt->format('Y-m-d H:i:s');
            //$start_dt = $start_dt->format('Y-m-d H:i:s');

            $dt = $start_dt . " - " . $end_dt ;
        }else{
            //set duration for 24 hour
            $start_dt->modify("-24 hour")->format('Y-m-d H:i:s');
            $end_dt = $end_dt->format('Y-m-d H:i:s');
            $start_dt = $start_dt->format('Y-m-d H:i:s');
            $dt = $start_dt  . " - " . $end_dt ;
        }
        
        //get typology 
        if(strpos($typology, 'All') === false){
            $typology_filter = "y";
        } 
        $typology  =  "'" . str_replace(",","','", $typology ) . "'";

        //get spacetype
        if(strpos($spaceType, 'All') === false){   // if 'All' not found
            $spaceType_filter = "y";
        } 
        $spaceType  =  "'" . str_replace(",","','", $spaceType ) . "'";

        //get sensor id
        if(strpos($sensorID, 'All') === false){   // if 'All' not found
            $sensorID_filter = "y";
        } 
        $sensorID  =  "'" . str_replace(",","','", $sensorID ) . "'";


        $column_nm = "max_". $pollutant;

        $select_query = "SELECT e.datetime as date_time1, min(abs(e.$column_nm)) as min_reading, max(abs(e.$column_nm)) as max_reading, avg(abs(e.$column_nm)) as avg_reading, substring_index(substring_index(group_concat(cast(abs(e.$column_nm) as decimal(10,2) ) order by abs(e.$column_nm) ASC separator ','
                        ),',',((0.25 * count(*)))         
                        ),',',-(1)
                ) AS `Q1`,
                substring_index(
                substring_index(
                    group_concat(cast(abs(e.max_pm25) as decimal(10,2) )
                                order by abs(e.max_pm25)
                ASC separator ','
                    ),',',((0.50 * count(*)))         
                            ),',',-(1)
                ) AS `median`,
                substring_index(
                substring_index(
                    group_concat(cast(abs(e.max_pm25) as decimal(10,2) )
                                order by abs(e.max_pm25)
                                ASC separator ','
                    ),',',((0.75 * count(*)) )         
                            ),',',-(1)
                ) AS `Q3`,

                sum(abs(e.max_pm25)) as cumulative_reading
                    FROM device_details a   LEFT OUTER JOIN reading_15min e 
                    ON (a.deviceID = e.deviceID) 
                    where (datetime between '$start_dt' and '$end_dt') ";
        
        if($typology_filter == 'y'){
            $select_query .=  "  and typology in ($typology) ";
        }
        if($spaceType_filter == 'y'){
            $select_query .=  " and spacetype in ($spaceType) ";
        }
        if($sensorID_filter == 'y'){
            $select_query .=  " and a.deviceID in ($sensorID) ";
        }
        $select_query .=  " group by datetime order by datetime ";
        //return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => '10', 'Query' => $select_query  ] );

        try{        
            $result = $conn->query($select_query);
            
            if ($result->num_rows > 0) {
                
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Query' => $select_query ,'Data' => $rows ] );
            } else {
                return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found" , 'query' => $select_query]);
            }

        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
        }
    }






   /*  SELECT e.datetime as date_time1, min(abs(e.max_pm25)) as min_reading, max(abs(e.max_pm25)) as max_reading, avg(abs(e.max_pm25)) as avg_reading, substring_index(substring_index(group_concat(cast(abs(e.max_pm25) as decimal(10,2) ) order by abs(e.max_pm25) ASC separator ','
                ),',',((0.25 * count(*)))         
                    ),',',-(1)
            ) AS `Q1`,
            substring_index(
            substring_index(
                group_concat(cast(abs(e.max_pm25) as decimal(10,2) )
                            order by abs(e.max_pm25)
                            ASC separator ','
                ),',',((0.50 * count(*)))         
                        ),',',-(1)
            ) AS `median`,
            substring_index(
            substring_index(
                group_concat(cast(abs(e.max_pm25) as decimal(10,2) )
                            order by abs(e.max_pm25)
                            ASC separator ','
                ),',',((0.75 * count(*)) )         
                        ),',',-(1)
            ) AS `Q3`,

            sum(abs(e.max_pm25)) as cumulative_reading
                 FROM device_details a   LEFT OUTER JOIN reading_15min e 
                 ON (a.deviceID = e.deviceID) 
         group by datetime order by datetime */
?>