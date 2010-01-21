<?php

$list_fields = '';
foreach($vars['table_fields'] as $field)
    if(!$field->isPk()){
        $field_name = $field->getName();
	    $list_fields .= "\t\t\t\t\t<td><?php echo \$object->$field_name ?></td>\n";
    }

$head_fields = '';
foreach($vars['table_fields'] as $field){
    if(!$field->isPk()){
	    $field_name = ucwords($field->getName());
    	$head_fields .= "\t\t\t\t\t<th>$field_name</th>\n";
    }
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
