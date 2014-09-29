<?php
require("../dbconnect.php");

// User Input
if (isset($_GET['page'])) {
	$this_page = $_GET['page'];
	$offset = ($this_page - 1) * 4;
} else {
	$this_page = 1;
	$offset = ($this_page - 1) * 4;
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
if (isset($_GET['post']) && ($this_page > $pages || !is_numeric($_GET['page'])) || $this_page < 1) {
	$page_not_exists = true;
} else {
	$page_not_exists = false;
}

// Grabs national parks from database
if (!$page_not_exists) {
	$query = "SELECT * FROM national_parks LIMIT 4 OFFSET :offset";
	$stmt = $dbc->prepare($query);
	$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
	$stmt->execute();
	$parks = $stmt->fetchAll();
}
?>
<html>
<head>
	<title>National Parks</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap-darkly.min.css">
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
					<h2><?= htmlspecialchars($park['name']); ?></h2>
					<dl>
						<dt>Location</dt>
						<dd><?= htmlspecialchars($park['location']); ?></dd>
						<dt>Date Established</dt>
						<dd>
							<?
							$date = new DateTime($park['date_established']);
							echo $date->format('l, j F Y');
							?>
						</dd>
						<dt>Size in Acres</dt>
						<dd><?= number_format($park['area_in_acres']); ?></dd>
						<dt>About</dt>
						<dd><?= htmlspecialchars($park['description']); ?></dd>
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
		<select name="location" id="location" required class="form-control"> 
			<option value="" selected="selected">Select a State</option> 
			<option value="AL">Alabama</option> 
			<option value="AK">Alaska</option> 
			<option value="AZ">Arizona</option> 
			<option value="AR">Arkansas</option> 
			<option value="CA">California</option> 
			<option value="CO">Colorado</option> 
			<option value="CT">Connecticut</option> 
			<option value="DE">Delaware</option> 
			<option value="DC">District Of Columbia</option> 
			<option value="FL">Florida</option> 
			<option value="GA">Georgia</option> 
			<option value="HI">Hawaii</option> 
			<option value="ID">Idaho</option> 
			<option value="IL">Illinois</option> 
			<option value="IN">Indiana</option> 
			<option value="IA">Iowa</option> 
			<option value="KS">Kansas</option> 
			<option value="KY">Kentucky</option> 
			<option value="LA">Louisiana</option> 
			<option value="ME">Maine</option> 
			<option value="MD">Maryland</option> 
			<option value="MA">Massachusetts</option> 
			<option value="MI">Michigan</option> 
			<option value="MN">Minnesota</option> 
			<option value="MS">Mississippi</option> 
			<option value="MO">Missouri</option> 
			<option value="MT">Montana</option> 
			<option value="NE">Nebraska</option> 
			<option value="NV">Nevada</option> 
			<option value="NH">New Hampshire</option> 
			<option value="NJ">New Jersey</option> 
			<option value="NM">New Mexico</option> 
			<option value="NY">New York</option> 
			<option value="NC">North Carolina</option> 
			<option value="ND">North Dakota</option> 
			<option value="OH">Ohio</option> 
			<option value="OK">Oklahoma</option> 
			<option value="OR">Oregon</option> 
			<option value="PA">Pennsylvania</option> 
			<option value="RI">Rhode Island</option> 
			<option value="SC">South Carolina</option> 
			<option value="SD">South Dakota</option> 
			<option value="TN">Tennessee</option> 
			<option value="TX">Texas</option> 
			<option value="UT">Utah</option> 
			<option value="VT">Vermont</option> 
			<option value="VA">Virginia</option> 
			<option value="WA">Washington</option> 
			<option value="WV">West Virginia</option> 
			<option value="WI">Wisconsin</option> 
			<option value="WY">Wyoming</option>
		</select>

		<!-- <input type="text" name="location" id="location" placeholder="Enter Location..." class="form-control" required> -->
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