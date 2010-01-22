<?php

$controller_template = "<?php
class ${vars['controller_name']} extends Controller{
	/*
		Default Constructor
	*/
	function __construct(){
		parent::Controller();
		\$this->load->model('${vars['model']}', '', true);
	}

	/*
		Create new ${vars['model_name']}
	*/
	function save(){
		if(\$_POST){
			\$this->load->view('${vars['controller']}/save');
		}
		
				
	}
	
	/*
		Edit ${vars['model_name']}
	*/
	function edit(\$id){
		
	}
	
	/*
		Delete ${vars['model_name']}
	*/
	function delete(\$id){
		\$response = \$this->${vars['model']}->delete(\$id);
		\$this->load->view('${vars['controller']}/delete', array('response' => \$response));
	}
	
	/*
		List objects of ${vars['model_name']}
	*/
	function index(){
		\$data = array(
			\"objects\" => \$this->${vars['model']}->all(),
			\"title\" => \"${vars['model_name']}\",
			\"heading\" => \"List\",
		);
		\$this->load->view('${vars['controller']}/list', \$data);
	}
	
}

";
