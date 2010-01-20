<?php
	define("APPPATH", "c:\\xampp\\htdocs\\ci-scaffold\\src\\scaffold\\system\\application\\");
	require("file_handler.php");
    require("config.php");
	$table = "canal";
	$controller = $table . "s";
	$model = $table;
	$table_fields = array("nome"=>"nome");
	
	
	// Parse fields
	$controller = strtolower($controller);
	$controller_name = ucwords($controller);
	$model_name = ucwords($model);
	
	
	
	
	
	
	// Call templates
	/*require("templates/controllers/default.php");
	require("templates/models/default.php");
	require("templates/views/list.php");
	require("templates/views/save.php");
	require("templates/views/edit.php");
	require("templates/views/delete.php");
	require("templates/views/form.php");
	echo "====================================================================================<br/>";
	echo "Gererating $controller.php... ";
	create_file($controller_path, $controller_template);
	echo "DONE! <br/>";
	echo "====================================================================================<br/>";
	echo "Gererating $model.php... ";
	create_file($model_path, $model_template);
	echo "DONE! <br/>";
	echo "====================================================================================<br/>";
	echo "Generating views....<br/>";
	$view_path = APPPATH . "\\views\\$controller";
	create_folder($view_path);
	echo "Generating save.php... ";
	create_file($view_path . '\\save.php', $save_template);
	echo "DONE! <br/>";
	echo "Generating form.php... ";
	create_file($view_path . '\\form.php',$form);
	echo "DONE! <br/>";
	echo "Generating edit.php... ";
	create_file($view_path . '\\edit.php', $edit_template);
	echo "DONE! <br/>";
	echo "Generating delete.php... ";
	create_file($view_path . '\\delete.php', $delete_template);
	echo "DONE! <br/>";
	echo "Generating list.php... ";
	create_file($view_path . '\\list.php', $list_template);
	echo "DONE! <br/>";*/
	
class Scaffolder {
    
    var $test = false;
    
    public function __construct($testing){
        $this->test = $testing;
    }
    /**
    * Inclui arquivo de template e retorna o conteudo da variavel $($name)_template
    * Ex.: se $name = controller
    * retorna o valor de $controller_template que estara dentro do arquivo contido em TEMPLATES[controller]
    */
    private function getTemplate($name, $vars = array()){
        $var_name = "TEMPLATE_" . strtoupper($name);
        $template_name = constant($var_name);
        require($template_name);
        $template = $name . "_template";
        return $$template;
    }
    private function separator(){
        echo "====================================================================================<br/>";
    }
    private function log($text){
        if(!$this->test){
            $this->separator();
            echo "Generating ${text}.php... ";
        }
    }
    private function done(){
        echo "DONE! <br/>";
    }
    /**
    * Cria um arquivo com o conteudo do template somente se não estiver sendo rodado um teste
    **/
    private function createFile($path, $template){
        if(!$this->test){
            create_file($path, $template);
        }
    }
    private function getPath($path, $filename){
        return APPPATH . $path . "\\" . ($filename != "" ? $filename . ".php" : "");
    }
    private function getViewPath($model, $view){
        $view_path = VIEW_PATH . "\\" . $this->pluralize($model);
        if(!$this->test){
            create_folder($this->getPath($view_path, ""));
        }
        return $this->getPath($view_path, $view);
    }
    private function pluralize($text){
        return $text . "s";
    }
    /**
    * Cria um controller baseado no template setado
    **/
    public function createController($controller){
        $controller_plural = $this->pluralize($controller); 
        $this->log($controller_plural);
        $vars = array(
            "controller" => $controller_plural,
            "controller_name" => ucwords($controller_plural),
            "model" => "model" . $controller,
            "model_name" => ucwords($controller)
        );
        $template = $this->getTemplate("controller", $vars);
        $this->createFile($this->getPath(CONTROLLER_PATH, $controller_plural), $template);
        return $template;
    }
    /**
    * Cria um model baseado no template setado
    **/
    public function createModel($model, $table_fields){
        $this->log("model_" . $model);
        $vars = array(
            "table" => $model,
            "model_name" => "Model" . ucwords($model),
            "table_fields" => $table_fields,
        );
        $template = $this->getTemplate("model", $vars);
        $this->createFile($this->getPath(MODEL_PATH, "model" . $model), $template);
        return $template;
    }
    /**
    * Cria a view de criacao baseado no template setado
    **/
    public function createSaveView($model, $fields){
    
    }
    /**
    * Cria a view de edicao baseado no template setado
    **/
    public function createEditView($model, $fields){
    
    }
    /**
    * Cria a view do formulario baseado no template setado
    **/
    public function createFormView($model, $fields){
    
    }
    /**
    * Cria a view de deletar um item baseado no template setado
    **/
    public function createDeleteView($model){

    }
    /**
    * Cria a view de listagem baseado no template setado
    **/
    public function createListView($model, $fields){
        $this->log("list");
        $vars = array(
            "table" => $model,
            "model_name" => "Model" . ucwords($model),
            "table_fields" => $fields,
        );
        $template = $this->getTemplate("list", $vars);
        $this->createFile($this->getViewPath($model, "list"), $template);
        return $template;
    }
    /**
    * Cria todos os arquivos necessarios para o CRUD funcionar
    **/
    public function generate($table){
        $controller = $this->parseField($table);
        $fields = array();
        $this->createController($controller);
        $this->createModel($table, $fields);
    }
}
