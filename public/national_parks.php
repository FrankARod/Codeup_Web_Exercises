<?php
	require("../dbconnect.php");
	
	// User Input
	if (isset($_GET['page'])) {
		$this_page = $_GET['page'];
		$offset = ($this_page - 1) * 4;
	} else {
		$this_page = 0;
		$offset = $this_page;
	}

	$valid = false;
	if (isset($_POST)) {
		foreach($_POST as $input) {
			if (empty($input)) {
				$valid = false;
				break;			
			} else {
				$valid = true;
			}
		}
	}
	
	//Writes to db
	if ($valid) {
		$insert = "INSERT INTO national_parks (name, location, date_established, area_in_acres, description) VALUES (:name, :location, :date_established, :area_in_acres, :description)";
		$add_to_db = $dbc->prepare($insert);
		$add_to_db->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
		$add_to_db->bindValue(':location', $_POST['location'], PDO::PARAM_STR);
		$add_to_db->bindValue(':date_established', $_POST['date_established'], PDO::PARAM_STR);
		$add_to_db->bindValue(':area_in_acres', $_POST['area_in_acres'], PDO::PARAM_INT);
		$add_to_db->bindValue(':description', $_POST['description'], PDO::PARAM_STR);
		$add_to_db->execute();
	}


	// Determines page count for pagination
	$row_count = "SELECT * FROM national_parks";
	$count = $dbc->prepare($row_count);
	$count->execute();
	$all_results = $count->rowCount();
	$pages = ceil($all_results / 4);

	// Prevents invalid page numbers
	if ($this_page > $pages) {
		$page_not_exists = true;
	} else {
		$page_not_exists = false;
	}

	// Grabs national parks from database
	$query = "SELECT * FROM national_parks LIMIT 4 OFFSET :offset";
	$stmt = $dbc->prepare($query);
	$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	$parks = $stmt->fetchAll();
?>
<html>
<head>
	<title>National Parks</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/national_parks.css">
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			<h1>National Parks</h1>
			<? if ($page_not_exists): ?>
				<p class="alert alert-danger">This page does not exist</p>
			<? else: ?>
				<? foreach ($parks as $park): ?>
				<div class="park col-md-3">
					<h2><?= $park['name']; ?></h2>
					<dl>
						<dt>Location</dt>
						<dd><?= $park['location']; ?></dd>
						<dt>Date Established</dt>
						<dd>
							<?
								$date = new DateTime($park['date_established']);
								echo $date->format('l, j F Y'); 
							?>
						</dd>
						<dt>Size in Acres</dt>
						<dd><?= number_format($park['area_in_acres']); ?></dd>
					</dl>
				</div>
				<? endforeach ?>
			<? endif; ?>
			<div class="clearfix"></div>
			<ul class="pagination clearfix">
			<? for ($i = 1; $i <= $pages; $i++ ): ?>
				<li><a href="?page=<?= $i; ?>"><?= $i; ?></a></li>
			<? endfor; ?>
			</ul>
			<h2>Know a Better National Park?</h2>	
			<form method="POST" action="national_parks.php" role="form" class="form-horizontal">
				<div class="form-group">	
					<label for="name">Name</label>
					<input type="text" name="name" id="name" placeholder="Enter Name..." class="form-control" required>
				</div>	
				<div class="form-group">
					<label for="location">Location</label>
					<input type="text" name="location" id="location" placeholder="Enter Location..." class="form-control" required>
				</div>
				<div class="form-group">
					<label for="date_established">Date Established</label>
					<input type="date" name="date_established" id="date_established" class="form-control" placeholder="Enter Date Established (YYYY-MM-DD)" required>
				</div>	
				<div class="form-group">	
					<label for="area_in_acres">Area in Acres</label>
					<input type="number" name="area_in_acres" id="area_in_acres" placeholder="Enter Area in Acres..." class="form-control" required>
				</div>	
				<div class="form-group">
					<label for="description">Description</label>
					<textarea id="description" name="description" placeholder="Enter Description..." class="form-control" required></textarea>
				</div>
				<input type="submit" class="btn btn-default">
			</form>
		</div>
	</div>
	<script type="text/javascript" src="boostrap/js/bootstrap.min.js"></script>
</body>
</html>