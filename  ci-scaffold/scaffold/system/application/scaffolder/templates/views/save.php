<?php

$formFields = '';
foreach($table_fields as $field){
	$formFields .= "<label for=$field>$field</label>";
	$formFields .= "<input type=\"text\" name=\"$field\" id=\"$field\" /><br />";
}

$save_template = "<html>
	<head><title><?= \$title ?></title></head>
	<body>
		<? include(\"form.php\") ?>
	</body>
</html>
";