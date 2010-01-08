<?php

require("driver.php");

class MysqlDriver extends Driver {

    function getTables(){
        $response = array();
        $results = $this->db->query('show tables')->result_array();
        foreach($results as $result){
            foreach($result as $table){
                $response[] = $table;
            }
        }
        return $response;
    }
    
    function getFields($table){
        $response = array();
        $results = $this->db->query("describe $table")->result_array();
        $number = 0;
        foreach($results as $result){
            $properties = 0;
            foreach($result as $field){
                if(!isset($response[$number])){
                    $response[$number] = array();
                }
                $response[$number][$properties] = $field;
                $properties++;
                if($properties == 2){
                    $number++;
                    break;
                }
            }
        }
        return $response;
    }

}
