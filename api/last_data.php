<?php
    header("Content-Type: application/json; charset=UTF-8");
    include 'db.php';
    function get(){
        $condition = array();
        if(file_get_contents('php://input')){
            $json = file_get_contents('php://input'); //'["geeks", "for", "geeks"]';
            $data = json_decode($json,true);
            foreach($data as $key => $value){
                $condition[$key] = $value;
            }           
        }
        $conn = db_connect();
         // parameter - $table, $condition=array(), $columns=array()
        $query = generateSelectQuery("last_data", $condition);
        try{        
            $result = $conn->query($query);
            if ($result->num_rows > 0) {
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Data' => $rows ] );
            } else {
                return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found" ] );;
            }

        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
        }
    }


    function insert(){
        $input = array();
        if(file_get_contents('php://input')){
            $json = file_get_contents('php://input'); //'["geeks", "for", "geeks"]';
            $data = json_decode($json,true);
            foreach($data as $key => $value){
                $input[$key] = "'".$value. "'";
            }           
        }
        $conn = db_connect();
         // parameter - $table, $condition=array(), $columns=array()
        $query = generateInsertQuery("last_data", $input);
        try{  
            if ($conn->query($query) === TRUE) {
                $last_id = $conn->insert_id;  //id is not showing correct
                return json_encode ( [ 'ApiResponse' => 'Success', 'ID' => $last_id, 'Message' => "New record created successfully" ] );
              } else {
                return json_encode ( [ 'ApiResponse' => 'Fail', 'Message' => "Error: ". $conn->error ] );
              }
        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail', "Query" => $query, 'Message' => $e->getMessage()]);
        }
    }

    function update(){
        $input = array();
        if(file_get_contents('php://input')){
            $json = file_get_contents('php://input'); //'["geeks", "for", "geeks"]';
            $data = json_decode($json,true);
            foreach($data as $key => $value){
                $input[$key] = "'".$value. "'";
            }           
        }
        $conn = db_connect();
         // parameter - $table, $condition=array(), $columns=array()
        $query = generateUpdateQuery("last_data", $input,"deviceID");
        
        try{  
            if ($conn->query($query) === TRUE) {
                
                return json_encode ( [ 'ApiResponse' => 'Success',  'Message' => "New record updated successfully" ] );
              } else {
                return json_encode ( [ 'ApiResponse' => 'Fail', 'Message' => "Error: ". $conn->error ] );
              }
        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail', "Query" => $query, 'Message' => $e->getMessage()]);
        }
    }

    function delete(){
        $input = array();
        if(file_get_contents('php://input')){
            $json = file_get_contents('php://input'); //'["geeks", "for", "geeks"]';
            $data = json_decode($json,true);
            
            foreach($data as $key => $value){
                $input[$key] = "'".$value. "'";
            }           
        }
        $conn = db_connect();
         // parameter - $table, $condition=array(), $columns=array()
        $query = generateDeleteQuery("last_data", $input);
        
        try{  
            if ($conn->query($query) === TRUE) {
                
                return json_encode ( [ 'ApiResponse' => 'Success',  'Message' => "Record deleted successfully" ] );
              } else {
                return json_encode ( [ 'ApiResponse' => 'Fail', 'Message' => "Error: ". $conn->error ] );
              }
        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail', "Query" => $query, 'Message' => $e->getMessage()]);
        }
    }
?>