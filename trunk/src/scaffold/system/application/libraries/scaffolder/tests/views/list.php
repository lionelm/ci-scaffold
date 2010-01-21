<?php

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
                    <th>Nome</th>
                    <th>Alias</th>
                    <th>Estado_id</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach(\$objects as \$object): ?>
				<tr>
                    <td><?php echo \$object->nome ?></td>
                    <td><?php echo \$object->alias ?></td>
                    <td><?php echo \$object->estado_id ?></td>
                    <td>Edit</td>
					<td>Delete</td>
				</tr>
				<?php endforeach ?>
			</tbody>
		<?php endif ?>
	</body>
</html>";