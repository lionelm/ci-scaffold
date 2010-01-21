<?php

require("file_handler.php");
require("config.php");
	
class Scaffolder {
    
    var $test = false;
    var $sep = "/";
    
    public function __construct($testing = false){
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
        if(!$this->test){
            echo "DONE! <br/>";
        }
    }
    private function success($table){
        if(!$this->test){
            $this->separator();
            echo "Scaffold for table $table generated sucessfully! <br/>";
            $this->separator();
        }
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
        return APPPATH . $path . $this->sep . ($filename != "" ? $filename . ".php" : "");
    }
    private function getViewPath($model, $view){
        $view_path = VIEW_PATH . $this->sep . $this->pluralize($model);
        if(!$this->test){
            create_folder($this->getPath($view_path, ""));
        }
        return $this->getPath($view_path, $view);
    }
    private function pluralize($text){
        return $text . "s";
    }
    private function canWrite($path){
        clearstatcache();
        return is_writable($path);
    }
    private function cannotWrite(){
        $this->separator();
        echo "Can't write at controllers, models, and/or views path. Verify permissions.<br/>";
        $this->separator();
    }
    public function verifyPaths(){
        $response = $this->canWrite($this->getPath(CONTROLLER_PATH, ""));
        if($response)
            $response = $this->canWrite($this->getPath(MODEL_PATH, ""));
        if($response)
            $response = $this->canWrite($this->getPath(VIEW_PATH, ""));
        if(!$response && !$this->test){
            $this->cannotWrite();
        }
        return $response;
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
        $this->done();
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
        $this->done();
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
        $this->done();
        return $template;
    }
    /**
    * Cria todos os arquivos necessarios para o CRUD funcionar
    **/
    public function generate($table, $fields){
        if($this->verifyPaths()){
            $this->createController($table);
            $this->createModel($table, $fields);
            $this->createListView($table, $fields);
            $this->success($table);
        }
    }
}
