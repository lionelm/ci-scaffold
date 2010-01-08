<?php

$list_fields = '';
foreach($table_fields as $field)
	$list_fields .= "\t\t\t\t\t<td><?= \$object->$field ?></td>\n";

$head_fields = '';
foreach($table_fields as $field){
	$field = ucwords($field);
	$head_fields .= "\t\t\t\t\t<th>$field</th>\n";
}
	
$list_template = "<html>
	<head>
		<title><?= \$title ?></title>
	</head>
	<body>
		<h1><?= \$heading ?></h1>
		<? if(\$objects): ?>
		<table>
			<thead>
				<tr>
$head_fields				
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<? foreach(\$objects as \$object): ?>
				<tr>
$list_fields					<td>Edit</td>
					<td>Delete</td>
				</tr>
				<? endforeach ?>
			</tbody>
		<? endif ?>
	</body>
</html>";