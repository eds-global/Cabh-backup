<?php
    header("Content-Type: application/json; charset=UTF-8");
    include 'db.php';
    function get(){
        $condition = array();
        if(file_get_contents('php://input')){
            $json = file_get_contents('php://input'); //'["geeks", "for", "geeks"]';
            $data = json_decode($json,true);
            $orderBy = $data["orderBy"];
            $start_limit = $data["start_row"];
            $end_limit = $data["end_row"];
            $start_date = $data["start_date"];
            $end_date = $data["end_date"];
            
            foreach($data as $key => $value){
                $condition[$key] = $value;
            }  
            unset($condition["orderBy"]);         
            unset($condition["start_row"]);         
            unset($condition["end_row"]);  
            unset($condition["start_date"]);  
            unset($condition["end_date"]);  
                   
        }
        $conn = db_connect();
         // parameter - $table, $condition=array(), $columns=array()
        $query = generateSelectQuery("delhi", $condition);
        //check if any other filter is given
        if(count($condition) > 0){
            $query .= " and ";
        }
        else{
            $query .= " where ";
        }
        //check if start date and end date is mentioned
        if($start_date != null && $end_date != null)
        {
            $query .= " date_time between '". $start_date . "' and '" . $end_date . "'";

        }else if($start_date == null && $end_date != null){
            $query .= " date_time <= '" . $end_date . "'";
        }else if($start_date != null && $end_date == null){
            $query .= " date_time >= '" . $start_date . "'";
        }

        $query .= " order by date_time " . $orderBy . " LIMIT ". $start_limit . ", " . $end_limit;
        
        try{        
            $result = $conn->query($query);
            
            if ($result->num_rows > 0) {
                
                $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                return  json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Data' => $rows ] );
            } else {
                return json_encode ( [ 'ApiResponse' => 'Success', 'RowCount' => $result->num_rows, 'Message' => "No records found" , 'query' => $query]);
            }

        }
        catch(Exception $e){
            return json_encode ( [ 'ApiResponse' => 'Fail',  'Message' => $e.getMessage()]);
        }
    }

    //insert api not required
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
        $query = generateInsertQuery("delhi", $input);
        try{  
            if ($conn->query($query) === TRUE) {
                $last_id = $conn->insert_id;
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
            $dt = $data["datetime"];
            foreach($data as $key => $value){
                $input[$key] = "'".$value. "'";
            }           
            unset($input["datetime"]);
        }
        $conn = db_connect();
         // parameter - $table, $condition=array(), $columns=array()
        $query = generateUpdateQuery("delhi", $input, "deviceID");
        $query .= " and date_time ='" . $dt . "'";
        //return $query;        
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
            
            $start_date = $data["start_date"];
            $end_date = $data["end_date"];

            foreach($data as $key => $value){
                $input[$key] = "'".$value. "'";
            } 
            unset($input["start_date"]);
            unset($input["end_date"]);

        }
        $conn = db_connect();
         // parameter - $table, $condition=array(), $columns=array()
        $query = generateDeleteQuery("delhi", $input);
        if($start_date != null && $end_date != null)
        {
            $query .= "and date_time between '". $start_date . "' and '" . $end_date . "'";

        }else if($start_date == null && $end_date != null){
            $query .= "and date_time <= '" . $end_date . "'";
        }else if($start_date != null && $end_date == null){
            $query .= "and date_time >= '" . $start_date . "'";
        }
        //return $query;
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