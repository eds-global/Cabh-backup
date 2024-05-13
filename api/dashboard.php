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

?>