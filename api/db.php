<?php
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

    function close_conn($conn) {
        $conn -> close();
    }

    function generateSelectQuery($table, $condition=array(), $columns=array()) {
        $column_str = "*";
        $condition_arr = array();
        $condition_str = "";
        if(count($columns) > 0){
            $column_str = implode( ", ", $columns);
        }
        $query = "select " . $column_str . " from " . $table ;

        if(count($condition) > 0){
            foreach($condition as $col=> $value){
                array_push($condition_arr, $col . " = " . $value);
            }
            $condition_str = implode( " and ", $condition_arr);
            $query .=  ( " where " . $condition_str);
        }
        return $query;
    }
    //not working
    function generateUpdateQuery( $table, $values,$conditionCol, $conditionValue){
        $update_str = "";
        $update_arr = array();
        $query = "update " . $table . " set " ;

        //$id = $values["id"];
        //unset($values["id"]);
        foreach($values as $col=> $value){
            array_push($update_arr, $col . " = " . $value);
        }
        $update_str = implode( ", ", $update_arr);
        $query .=  $update_str;
        $query .=  " where ". $conditionCol ." = " . $conditionValue;
        return $query;
    }

    function generateInsertQuery($table, $values){
        $columns_arr = array_keys($values);
        $value_arr = array_values($values);
        $column_str = implode(", ", $columns_arr);
        $value_str = implode(", ", $value_arr);
        
        $query = "Insert " . $table . "(" .  $column_str . ") values (". $value_str  ." )";

        return $query;
        
    }

    function generateDeleteQuery( $table, $condition){
        $delete_str = "";
        $delete_arr = array();
        $query = "delete from " . $table  ;

        foreach($condition as $col=> $value){
            array_push($delete_arr, $col . " = " . $value);
        }
        $delete_str = implode( " and ", $delete_arr);
        $query .= " where " . $delete_str;
        
        return $query;
    }

    class db{
        var $con;
        function __construct(){
            $this->$con=mysqli_connect("localhost","root","") or die(mysqli_error());
            mysqli_select_db($this->$con,"edsglobal2.0") or die(mysqli_error());
        }
        public function getDepartment(){
            $query="SELECT * from master";
            $result=mysqli_query($this->$con,$query);
            return $result;
        }
        public function getDesignation($department){
            $query="SELECT * from tbl_master where type_id=".$department."";
            $result=mysqli_query($this->$con,$query);
            return $result;
        }
        public function closeCon(){
            mysqli_close($this->$con);
        }
    }
?>