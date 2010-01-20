<?php

$list_fields = '';
foreach($vars['table_fields'] as $field)
	$list_fields .= "\t\t\t\t\t<td><?php echo \$object->$field ?></td>\n";

$head_fields = '';
foreach($vars['table_fields'] as $field){
	$field = ucwords($field);
	$head_fields .= "\t\t\t\t\t<th>$field</th>\n";
}
	
$list_template = "<html>
	<head>
		<title><?php echo \$title ?></title>
	</head>
	<body>
		<h1><?php echo \$heading ?></h1>
		<?php if(\$objects): ?>
		<table>
			<thead>
				<tr>
$head_fields				
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach(\$objects as \$object): ?>
				<tr>
$list_fields					<td>Edit</td>
					<td>Delete</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		<?php endif ?>
	</body>
</html>";