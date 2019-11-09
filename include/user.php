<?php
require_once('database.php');

class User extends DatabaseObject{

	protected static $table_name ="users";
	protected static $db_fields = array('id', 'username','password', 'first_name', 'last_name');
	public $id;
	public $firs_tname;
	public $last_name;
	public $username;
	public $password;

	public static function authonicated($username, $password){
	$sql = "SELECT * FROM ".self::$table_name;
	$sql .= " WHERE username='{$username}' ";
	$sql .= "AND password='{$password}' "; 
	$sql .= " LIMIT 1";
	$result_array = self::find_by_sql($sql);
		return !empty($result_array)?array_shift($result_array):false;
	}
	public function full_name(){
		if(isset($this->firstname) && isset($this->lastname)){
		return $this->firstname." ".$this->lastname;
		}
		else{
			return "";
		}
	}

}

$user = new User();

?>