<?php

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
                    <th>Nome</th>
                    <th>Alias</th>
                    <th>Estado_id</th>
					<th>Edit</th>
					<th>Delete</th>
				</tr>
			</thead>
			<tbody>
				<? foreach(\$objects as \$object): ?>
				<tr>
                    <td><?= \$object->nome ?></td>
                    <td><?= \$object->alias ?></td>
                    <td><?= \$object->estado_id ?></td>
                    <td>Edit</td>
					<td>Delete</td>
				</tr>
				<? endforeach ?>
			</tbody>
		<? endif ?>
	</body>
</html>";