<?php

require_once(APPPATH . "libraries/scaffolder/drivers/field.php");

$nome = new Field();
$nome->setName("nome");

$alias = new Field();
$alias->setName("alias");

$estado = new Field();
$estado->setName("estado_id");

$table_fields = array( $nome, $alias, $estado );

$fields = '';
foreach($table_fields as $field)
    $field_name = $field->getName();
	$fields .= "\tvar \$$field_name;\n";
	
$fill = '';
foreach($table_fields as $field)
    $field_name = $field->getName();
	$fill .= "\t\t\$this->$field_name = \$this->input->post(\"$field_name\");\n";
	
$validate = '';
foreach($table_fields as $field)
    $field_name = $field->getName();
	$validate .= "\t\tif(\$this->$field_name=='') return false;\n";

$model_path = APPPATH . "models\\$model.php";
$model_template = "<?php
class ModelCidade extends Model{
	/*
		Model Fields	
	*/
$fields

	/*
		Default Constructor
	*/
	function __construct(){
		parent::Model();
	}

	function _validate(){
$validate		
		return true;
	}
	
	function save(){
		\$this->_fillFields();
		
		if(\$this->_validate()){
			return \$this->db->insert('cidade',\$this);
		}
		return false;
	}
	
	function edit(\$id){
		\$this->_fillFields();	
		
		if(\$this->_validate()){
			\$this->db->update('cidade',\$this,\$id);
		}
		return false;
	}
	
	function _fillFields(){
$fill
	}
	
	function delete(\$id){
		return \$this->db->delete('cidade',\$id);
	}
	
	function all(){
		return \$this->db->get('cidade')->result();
	}
	
	function getBy(\$where){
		return \$this->db->get_where('cidade', \$where);
	}
}

";
