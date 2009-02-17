<?php

$controller_path = APPPATH . "controllers\\$controller.php";
$controller_template = "<?php
class $controller_name extends Controller{
	/*
		Default Constructor
	*/
	function __construct(){
		parent::Controller();
		\$this->load->model('$model', '', true);
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
		\$response = \$this->${model}->delete(\$id);
		\$this->load->view('$controller/delete', array('response' => \$response));
	}
	
	/*
		List objects of $model_name
	*/
	function index(){
		\$data = array(
			\"objects\" => \$this->${model}->all(),
			\"title\" => \"$controller_name\",
			\"heading\" => \"List\",
		);
		\$this->load->view('$controller/list', \$data);
	}
	
}

";
