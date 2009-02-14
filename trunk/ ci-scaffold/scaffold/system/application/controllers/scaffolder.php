<?php
	class Scaffolder extends Controller
	{
		//INICIALIZA CLASSE
		//CARREGANDO A LIBRARY AUXILIAR DE DB
		function Scaffolder(){
			parent::Controller();
			$this->load->library("DatabaseInfo");
		}	
		//INDEX NÃO FAZ NADA
		function index(){
			echo "index";
		}
		
		//MÉTODO PRINCIPAL
		//RECEBE A OPÇÃO {TABLE ou DB}
		//RECEBE O NOME DA TABLE
		function generateFor($option = NULL,$name = NULL){
			//VERIFICA SE OS PARAMETROS ESTÃO CORRETOS
			$this->_verifyParameters($option,$name);
			
			if(strtolower($option)=="db"){
				$this->_generateForDatabase();
			}
		}
		function _generateForDatabase(){
			$tables = $this->databaseinfo->getDatabaseTables();

			for($i = 0; $i<count($tables);$i++){
				foreach($tables[$i] as $table){
					$tableInfo = $this->databaseinfo->getTableInfo($table);

					$scaffolderGenerator = new ScaffoldGenerator($tableInfo);					
					$scaffolderGenerator->generate();
				}			
			}
		}
		function _verifyParameters($option,$name){
			if((strtolower($option)=="table") && ($name!=NULL && trim($name)!="")){
				return true;
			}
			else if(strtolower($option)=="db"){
				return true;
			}
			else{
				die($this->_parametersError());
			}
		}
		function _parametersError(){
				echo "<h1>Informe uma URL no padr&atilde;o:</h1>";
				echo "<i>app/scaffolder/<b>generatefor</b>/<b>table</b>/<b><span style=\"color:#000099;\">tablename</span></b></i>";
				echo "<br>ou<br>";
				echo "<i>app/scaffolder/<b>generatefor</b>/<b>db</b>/</i>";
		}
	}
	
class ScaffoldGenerator{
	var $tableInfo;
	function __construct($tableInfo = NULL){
		if($tableInfo!=NULL){
			$this->tableInfo = $tableInfo;
		}
	}
	
	function generate(){
		$this->_generateView();
		$this->_generateModel();
		$this->_generateController();
	}

	function _generateView(){
		//TODO
		foreach($this->tableInfo as $info)
		{
			echo $info["Field"] . "<br>" ;
		}
	}
	function _generateController(){
		//TODO
	}
	function _generateModel(){
		//TODO
	}
}
?>