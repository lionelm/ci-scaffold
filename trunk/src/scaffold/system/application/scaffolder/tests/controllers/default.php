<?php

$controller_path = APPPATH . "controllers\\$controller.php";
$controller_template = "<\?php
class Cidade extends Controller{
	/*
		Default Constructor
	*/
	function __construct(){
		parent::Controller();
		\$this->load->model('model_cidade', '', true);
	}

	/*
		Create new Cidade
	*/
	function save(){
		if(\$_POST){
			\$this->load->view('cidades/save');
		}
        
	}
	
	/*
		Edit Cidade
	*/
	function edit(\$id){
		
	}
	
	/*
		Delete Cidade
	*/
	function delete(\$id){
		\$response = \$this->model_cidade->delete(\$id);
		\$this->load->view('cidades/delete', array('response' => \$response));
	}
	
	/*
		List objects of Cidade
	*/
	function index(){
		\$data = array(
			\"objects\" => \$this->model_cidade->all(),
			\"title\" => \"Cidade\",
			\"heading\" => \"List\",
		);
		\$this->load->view('cidades/list', \$data);
	}
	
}

";
