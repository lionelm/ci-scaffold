<?php

$controller_path = APPPATH . "controllers\\$controller.php";
$controller_template = "<?php
class $controller_name extends Controller{
	/*
		Default Constructor
	*/
	function __construct(){
		parent::Controller();
		\$this->load->model('$model');
	}

	/*
		Create new $model_name
	*/
	function save(){
		if(\$_POST){
			\$this->load->view('$controller/save');
		}
		
				
	}
	
	/*
		Edit $model_name
	*/
	function edit(\$id){
		
	}
	
	/*
		Delete $model_name
	*/
	function delete(\$id){
		\$response = \$this->$model->delete(\$id);
		\$this->load->view('$controller/delete', array('response' => \$response));
	}
	
	/*
		List objects of $model_name
	*/
	function list(){
		\$data = array(
			\"objects\" => \$this->$model->list(),
		);
		\$this->load->view('$controller/list', \$data);
	}
	
	/*
		Default Code Igniter action
	*/
	function index(){
		\$this->list();
	}
	
}

";
