<?php

require_once(APPPATH . '../database/DB.php');

abstract class Driver {

    var $db;
    
	function __construct(){
		$this->db = DB();
	}

    function getTables(){
        
    }
    
    function getFields($table){
        
    }

}