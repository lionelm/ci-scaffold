<?php
	define("APPPATH", "f:\\xampp\\htdocs\\system\\application\\");
	require("file_handler.php");
	$table = "relaxo";
	$controller = $table . "s";
	$model = $table;
	$table_fields = array("campo1"=>"campo1","campo2"=>"campo2","campo3"=>"campo3","campo4"=>"campo4");
	
	
	
	
	
	
	// Parse fields
	$controller = strtolower($controller);
	$controller_name = ucwords($controller);
	$model_name = $controller_name . "_model";
	
	
	
	
	
	
	// Call templates
	require("templates/controllers/default.php");
	require("templates/models/default.php");
	echo "====================================================================================<br/>";
	echo "Gererating $controller.php... ";
	create_file($controller_path, $controller_template);
	echo "DONE! <br/>";
	echo "====================================================================================<br/>";
	echo "Gererating $model.php... ";
	create_file($model_path, $model_template);
	echo "DONE! <br/>";
	echo "====================================================================================<br/>";
?>