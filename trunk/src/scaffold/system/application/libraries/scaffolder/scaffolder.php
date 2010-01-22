<?php

require("file_handler.php");
require("config.php");
	
class Scaffolder {
    
    var $test = false;
    var $sep = "/";
    /**
    * Default constructor that set if will be runned a test
    **/    
    public function __construct($testing = false){
        $this->test = $testing;
    }
    /**
    * Include template file and return variable $($name)_template value
    * Eg.: if $name = controller
    * returns variable $controller_template value which is in file of TEMPLATES[controller]
    */
    private function getTemplate($name, $vars = array()){
        $var_name = "TEMPLATE_" . strtoupper($name);
        $template_name = constant($var_name);
        require($template_name);
        $template = $name . "_template";
        return $$template;
    }
    /**
    * Text to separate other texts to user log
    */
    private function separator(){
        echo "====================================================================================<br/>";
    }
    /**
    * Log file that is being created if not testing
    **/
    private function log($text){
        if(!$this->test){
            $this->separator();
            echo "Generating ${text}.php... ";
        }
    }
    /**
    * Done message to be displayed after a task
    **/
    private function done(){
        if(!$this->test){
            echo "DONE! <br/>";
        }
    }
    /**
    * Message to say that user has no permission to write at default $paths
    **/
    private function cannotWrite(){
        $this->separator();
        echo "Can't write at controllers, models, and/or views path. Verify permissions.<br/>";
        $this->separator();
    }
    /**
    * Success message to be displayed at the finish of scaffold tasks
    */
    private function success($table){
        if(!$this->test){
            $this->separator();
            echo "Scaffold for table $table generated sucessfully! <br/>";
            $this->separator();
        }
    }
    /**
    * Create a file at $path which content is the template
    * If it is running a test file will not be created
    **/
    private function createFile($path, $template){
        if(!$this->test){
            create_file($path, $template);
        }
    }
    /**
    * Joins $path and $filename adding extension if $filename is set
    **/
    private function getPath($path, $filename){
        return APPPATH . $path . $this->sep . ($filename != "" ? $filename . ".php" : "");
    }
    /**
    * Returns the path where the view will be created
    **/
    private function getViewPath($model, $view){
        $view_path = VIEW_PATH . $this->sep . $this->pluralize($model);
        if(!$this->test){
            create_folder($this->getPath($view_path, ""));
        }
        return $this->getPath($view_path, $view);
    }
    /**
    * Pluralize words
    * TODO: Configurable pluralize
    **/
    private function pluralize($text){
        return $text . "s";
    }
    /**
    * Verify if user who is running this application can write at $path
    **/
    private function canWrite($path){
        clearstatcache();
        return is_writable($path);
    }
    /**
    * Create template at file to $what you want, at $path using $filename
    * $vars are to fill into template variables
    **/
    private function createTemplate($what, $path, $filename, $vars){
        $this->log($filename);
        $template = $this->getTemplate($what, $vars);
        $pathname = ($what == 'controller' || $what == 'model') ? $this->getPath($path, $filename) : $this->getViewPath($vars['table'], $what);
        $this->createFile($pathname, $template);
        $this->done();
        return $template;
    }
    /**
    * Verify if user can write at default paths:
    *       Controller, model and view paths
    * Displays message if user has no permissions and it is not a test
    **/
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
    * Create a controller based on template set
    **/
    public function createController($controller){
        $controller_plural = $this->pluralize($controller);
        return $this->createTemplate("controller", CONTROLLER_PATH, $controller_plural, 
            array(
                "controller" => $controller_plural,
                "controller_name" => ucwords($controller_plural),
                "model" => "model" . $controller,
                "model_name" => ucwords($controller)
            )
        );
    }
    /**
    * Create a model based on template set
    **/
    public function createModel($model, $table_fields){
        return $this->createTemplate("model", MODEL_PATH, "model" . $model, 
            array(
                "table" => $model,
                "model_name" => "Model" . ucwords($model),
                "table_fields" => $table_fields,
            )
        );
    }
    /**
    * Create save view based on template set
    **/
    public function createSaveView($model, $fields){
        
    }
    /**
    * Create edit view based on template set
    **/
    public function createEditView($model, $fields){
    
    }
    /**
    * Create form view based on template set
    **/
    public function createFormView($model, $fields){
    
    }
    /**
    * Cria a view de deletar um item baseado no template setado
    **/
    public function createDeleteView($model){

    }
    /**
    * Create list view based on template set
    **/
    public function createListView($model, $fields){
        return $this->createTemplate("list", VIEW_PATH, "list", 
            array(
                "table" => $model,
                "model_name" => "Model" . ucwords($model),
                "table_fields" => $fields,
            )
        );
    }
    /**
    * Create all CRUD features
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
