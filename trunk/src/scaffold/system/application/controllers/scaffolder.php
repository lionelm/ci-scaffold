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
			
			//GERA SCAFFOLD PARA TODO DB
			if(strtolower($option)=="db"){
				$this->_generateForDatabase();
			}
			//GERA SCAFFOLD PATA UMA TABELA
			else if(strtolower($option)=="table"){
				$this->_generateForTable($name);
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
		function _generateForTable($table = NULL){
			if($table==NULL || trim($table)=="")
				die("Table name not set");
				
			$scaffolderGenerator = new ScaffoldGenerator($table);					
			$scaffolderGenerator->generate();
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
	}
	function _generateController(){	
		$c = "<?php\n";
		$c .= "class ".ucwords($this->tableInfo)."Controller extends Controller{\n";
		
			$c .= "\tfunction __construct(){\n";
				$c .= "\t\tparent::Controller();\n";
				$c .= "\t\t".'$this->load->model("'.$this->tableInfo.'model","",TRUE)'."\n";
			$c .= "\t}\n";
			
			$c .= "\tfunction index(){\n";
				$c .= "\t\t".'$this->load->view("'.$this->tableInfo."view.php\");\n";
			$c .= "\t}\n";
			
			$c .= "\tfunction create(){\n";
				$c .= "\t\t".'$this->load->view("create'.$this->tableInfo."view.php\");\n";
			$c .= "\t}\n";
			
			$c .= "\tfunction save(){\n";
				$c .= "\t\t".'$this->'.$this->tableInfo."model->save();\n";
			$c .= "\t}\n";
			
			$c .= "\tfunction edit(".'$id'."){\n";
				$c .= "\t\t".'$this->load->view("edit'.$this->tableInfo.'view.php");'."\n";
			$c .= "\t}\n";
			
			$c .= "\tfunction update(".'$id'."){\n";
				$c .= "\t\t".'$this->'.$this->tableInfo.'model->update($id);'."\n";
			$c .= "\t}\n";
			
			$c .= "\tfunction delete(".'$id'."){\n";
				$c .= "\t\t".'$this->'.$this->tableInfo.'model->delete($id);'."\n";
			$c .= "\t}\n";
			
			
			
		
		
		$c .= "}\n";
		$c .= "?>";	
		
		$file = fopen("/".ucwords($this->tableInfo)."Controller.php", "w"); // abre o arquivo
		fwrite($file, $c); // grava no arquivo. Se o arquivo não existir ele será criado
		fclose($file); // fecha o arquivo

	}
	function _generateModel(){
		//TODO
	}
}
?>