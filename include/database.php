<?php
require_once('config.php');

class MySqlDatabase{	
	//connect to database
	private $connection;
	private $last_query;
	function __construct(){
		//Open the DB connection as soon as object is created
		$this->open_connection();
	}
	public function open_connection(){
		$this->connection = mysqli_connect(DBHOST, DBUSER, DBPW, DBNAME);
		if(mysqli_connect_errno()){
			die("Database connection error". mysqli_connect_error());
		}
	}
	public function close_connection(){
		if(isset($this->connection)){
		mysqli_close($this->connection);}
	}
	private function confirm_query($result){
				if(!$result){
					$output = $this->last_query."<br />";
					$output .= " Mysql query error ";
					$output .= mysqli_error($this->connection);
					die($output);
				}	
			}

	public function query($sql){
		$this->last_query = $sql;
		$result = mysqli_query($this->connection, $sql);
		$this->confirm_query($result);				
		return $result;
		 
	}
	//database adapter functions 
	public function fetch_array($result_set){
		return mysqli_fetch_array($result_set);
		}

	public function num_rows($result_set){
		return mysqli_num_rows($result_set);
		}
	public function insert_id(){
		return mysqli_insert_id($this->connection);
		}
	public function affected_rows(){
		return mysqli_affected_rows($this->connection);
	}		

}

$database = new MySqlDatabase;




?>