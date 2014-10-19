<?php

require('../../blog_dbconnect.php');

class Person {
	public static $fathers = [];

	protected static $dbc;

	public $id;

	public function __construct($id)
	{
		if (is_null(self::$dbc)) {
			self::$dbc = new PDO(DB_FATHERS, DB_USER, DB_PASS);
			self::$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		$this->id = $id;
		$this->find_fathers();
	}

	public function find_fathers()
	{
		$stmt = self::$dbc->prepare("SELECT fathers_id FROM fathers WHERE id = ?");
		$stmt->execute([$this->id]);
		$new_father = $stmt->fetch(PDO::FETCH_ASSOC);
		if(!in_array($new_father, self::$fathers)) {
			self::$fathers[] = $new_father['fathers_id'];
			$new_father = new Person($new_father['fathers_id']);
		} else {
			var_dump(self::$fathers);
		}
	}
}

$youngest = new Person(1);