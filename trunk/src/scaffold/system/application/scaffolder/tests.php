<?php

require("scaffolder.php");


class ScaffolderTest {
    var $scaffolder;
    
    public function __construct(){
        $this->scaffolder = new Scaffolder(true);
    }
    /**
    * Inclui arquivo de template e retorna o conteudo da variavel $($name)_template
    * Ex.: se $name = controller
    * retorna o valor de $controller_template que estara dentro do arquivo contido em TEMPLATE_CONTROLLER
    */
    private function getTemplate($name){
        $var_name = "TEMPLATE_" . strtoupper($name);
        $template_name = constant($var_name);
        $template_name = str_replace("templates", "tests", $template_name);
        require($template_name);
        $template = $name . "_template";
        return $$template;
    }
    private function showAssertion($name, $result){
        $result = ($result) ? "<span style=\"color:green;\">Success</span>" : "<span style=\"color:red;\">Failure</span>";
        echo "<table border=\"1\" width=\"50%\"><caption style=\"font-weight:bold;\">${name}</caption><tr><td>Result</td><td>${result}</td></tr></table>";
    }
    private function assert($test, $expected, $name){
        $this->showAssertion($name, $test === $expected);
    }
    private function assertNotNull($test, $name){
        $this->showAssertion($name, $test != null && $test != "" && $test != false);
    }
    private function parseText($text){
        return preg_replace('/\s/', "", $text);
    }
    public function testController(){
        $result = $this->scaffolder->createController("cidade");
        $expected = $this->getTemplate("controller");
        $this->assertNotNull($result, "Conteudo controller nao vazio");
        $this->assert($this->parseText($result), $this->parseText($expected), "Controller correto");
    }
}

$test = new ScaffolderTest();
$test->testController();