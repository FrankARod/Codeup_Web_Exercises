<?php
	if (isset($_GET['page'])) {
		$offset = ($_GET['page'] - 1) * 4;
	} else {
		$offset = 0;
	}
	$query = "SELECT * FROM national_parks LIMIT 4 OFFSET $offset";
	$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'codeup', '711352');
	$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$park_query = $dbc->query($query);
	while($row = $park_query->fetch(PDO::FETCH_ASSOC)) {
		$parks[] = $row;
	}
?>
<html>
<head>
	<title>National Parks</title>
</head>
<body>
	<ul>
		<li><a href="?page=1">1</a></li>
		<li><a href="?page=2">2</a></li>
	</ul>
	<h1>National Parks</h1>
	<? foreach ($parks as $park): ?>
	<h2><?= $park['name']; ?></h2>
	<dl>
		<dt>Location</dt>
		<dd><?= $park['location']; ?></dd>
		<dt>Date Established</dt>
		<dd><?= $park['date_established']; ?></dd>
		<dt>Size in Acres</dt>
		<dd><?= $park['area_in_acres']; ?></dd>
	</dl>
	<? endforeach ?>
</body>
</html>