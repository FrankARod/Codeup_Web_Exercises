<?php

require('../../blog_dbconnect.php');

class Model {
	protected static $dbc;
	
	protected $columns;

	// protected static $table;

	public function __construct() 
	{
		if (is_null(self::$dbc)) {
			self::$dbc = new PDO(DB_NAME, DB_USER, DB_PASS);
			self::$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
	}
	
	public function __get($name) 
	{
		if (array_key_exists($name, $this->columns)) {
			return $this->columns[$name];
		} else {
			return null;
		}
	}
	
	public function __set($name, $value) 
	{
		$this->columns[$name] = $value;
	}
	
	public static function find($id) 
	{
		$newModel = new static;
		$table = static::$table;
		$stmt = self::$dbc->prepare("SELECT * FROM $table WHERE id = ?");
		$stmt->execute([$id]);
		$columns = $stmt->fetch(PDO::FETCH_ASSOC);
		if (is_null($columns)) {
			return null;
		} else {
			$newModel->columns = $columns;
			return $newModel;
		}
	}

	public static function all()
	{
		$table = static::$table;
		$stmt = self::$dbc->prepare("SELECT id FROM $table");
		$stmt->execute();
		$ids = $stmt->fetchAll();
		foreach ($ids as $key => $id) {
			$rows[] = static::find($id['id']);
		}
		return $rows;
	}

	public function save()
	{
		if (isset($this->columns['id'])) {
			$table = static::$table;
			$insert_stmt = "UPDATE $table SET ";
			foreach (array_keys($this->columns) as $column) {
				if ($column == 'id') {
					continue;
				}
				$sets[] = "$column = :$column";
			}
			$insert_stmt .= implode(', ', $sets);
			$insert_stmt .= ' WHERE id = :id';
			$stmt = self::$dbc->prepare($insert_stmt);
			$stmt->bindValue(':id', $this->columns['id'], PDO::PARAM_INT);
			foreach ($this->columns as $column => $value) {
				if ($column == 'id') {
					continue;
				}
				$stmt->bindValue(":$column", $value, PDO::PARAM_STR);
			}
			$stmt->execute();
		}
		else {
			$keys = array_keys($this->columns);
			$stmt_columns = implode(', ', $keys);
			$table = static::$table;
			foreach($keys as $key) {
				$values[] = ":$key";
			}
			$values = implode(', ', $values);
			$stmt = self::$dbc->prepare("INSERT INTO $table ($stmt_columns) VALUES($values)");
			foreach ($this->columns as $column => $value) {
				$stmt->bindValue(":$column", $value, is_string($value) ? PDO::PARAM_STR : PDO::PARAM_INT);
			}
			$stmt->execute();
		}
	}
}

// setters and getters

class Post extends Model {
	protected static $table = 'posts';

	public function getCreatedAtAttribute($value)
	{
	    $utc = Carbon::createFromFormat($this->getDateFormat(), $value);
	    return $utc->setTimezone('America/Chicago');
	}
}

class User extends Model {
	protected static $table = 'users';
}

$post = new Post();
$post->title = "NEW TITLE";
$post->content = "NEW BODY";
$post->user_id = 1;
$post->image = null;
$post->save();

echo "NO FATAL ERRORS!";