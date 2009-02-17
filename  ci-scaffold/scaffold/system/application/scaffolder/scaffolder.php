<?php
	define("APPPATH", "f:\\xampp\\htdocs\\system\\application\\");
	require("file_handler.php");
	$table = "canal";
	$controller = $table . "s";
	$model = $table;
	$table_fields = array("nome"=>"nome");
	
	
	// Parse fields
	$controller = strtolower($controller);
	$controller_name = ucwords($controller);
	$model_name = ucwords($model);
	
	
	
	
	
	
	// Call templates
	require("templates/controllers/default.php");
	require("templates/models/default.php");
	require("templates/views/list.php");
	require("templates/views/save.php");
	require("templates/views/edit.php");
	require("templates/views/delete.php");
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
	echo "Generating edit.php... ";
	create_file($view_path . '\\edit.php', $edit_template);
	echo "DONE! <br/>";
	echo "Generating delete.php... ";
	create_file($view_path . '\\delete.php', $delete_template);
	echo "DONE! <br/>";
	echo "Generating list.php... ";
	create_file($view_path . '\\list.php', $list_template);
	echo "DONE! <br/>";
	
?>