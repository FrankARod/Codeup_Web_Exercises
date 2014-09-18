<?php
// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=codeup_pdo_test_db', 'codeup', '711352');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Create the query and assign to var
$query = 'CREATE TABLE national_parks (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    location VARCHAR(50) NOT NULL,
    date_established DATE NOT NULL,
    area_in_acres INT NOT NULL,
    PRIMARY KEY (id)
)';

// Run query, if there are errors they will be thrown as PDOExceptions
$dbc->exec($query);

$parks = [
	['Acadia', 'Maine', '1919-02-26', 47389],
	['American Samoa', 'American Samoa', '1988-10-31', 9000],
	['Arches', 'Utah', '1971-11-12', 76518],
	['Badlands', 'South Dakota', '1978-11-10', 242755],
	['Big Bend', 'Texas', '1944-06-12', 801163],
	['Biscayne', 'Florida', '1980-06-28', 172924],
	['Black Cantyon of the Gunnison', 'Colorado', '1999-10-21', 32950],
	['Bryce Canyon', 'Utah', '1928-02-25', 35835],
	['Canyonlands', 'Utah', '1964-09-12', 337597],
	['Capitol Reef', 'Utah', '1971-12-18', 241904]
];

// Create INSERT query
$insert = "INSERT INTO national_parks (name, location, date_established, area_in_acres) VALUES ";
$i = 0;
foreach ($parks as $park) {
	$i++;
	$insert .= "('$park[0]', '$park[1]', '$park[2]', $park[3])";
	if ($i != count($parks)) {
		$insert .= ", " . PHP_EOL;
	}
}

var_dump($insert);
// Execute Query
$numRows = $dbc->exec($insert);
echo "Inserted $numRows row." . PHP_EOL;