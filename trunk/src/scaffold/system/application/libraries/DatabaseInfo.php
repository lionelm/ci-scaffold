<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class DatabaseInfo{
	var $CI;
	function __construct(){
		$this->CI =& get_instance();
		$this->CI->load->database();
	}
	function getDatabaseTables(){
		//TODO
		$result = $this->CI->db->query("show tables")->result_array();
		return $result;
	}
	function getTableInfo($table){
		//TODO
		$result = $this->CI->db->query("describe $table")->result_array();
		return $result;
	}
}
?>