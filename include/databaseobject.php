<?php
require_once('database.php');
class DatabaseObject{
		protected static $table_name ="users";
	
	public static function find_all(){
			 return static::find_by_sql("SELECT * FROM ".static::$table_name." ORDER BY id DESC");
		}
	public static function find_by_id($id=1){
		global $database;
		$result_array = static::find_by_sql("SELECT * FROM ".static::$table_name." WHERE id={$id}");
		return !empty($result_array)?array_shift($result_array):false;
	}	

	public static function find_by_sql($sql=""){
		global $database;
		$result_set = $database->query($sql);
		$object_array = array();
		while ($row= $database->fetch_array($result_set)){
			$object_array[] = static::instan($row); 
		}
		return $object_array;
	}

	public static function count_all(){
		global $database;
		$sql = "SELECT COUNT(*) FROM ".static::$table_name;
		$result = $database->query($sql);
		$row = $database->fetch_array($result);
		return array_shift($row);
		}


	private static function instan($record){
				$get_class = get_called_class();
				$object = new $get_class;
				foreach($record as $attribute=>$value) {
					if($object->has_attribute($attribute)){
						$object->$attribute = $value;
					}
				}
				return $object;

	}
	public function has_attribute($attribute){
			$object_vars = $this->attribute();
			return array_key_exists($attribute, $object_vars);
	}
	protected function attribute(){
		$attribute = array();
		foreach (static::$db_fields as $field) {
			if(property_exists(get_called_class(), $field)){
				$attribute[$field]= $this->$field;
			}
		}
		return $attribute;
	}

	public function create(){
		global $database;

		$attribute = $this->attribute($this);
		$sql 	= "INSERT INTO ".static::$table_name."(";
		$sql   .= implode(", ", array_keys($attribute));
		$sql   .= ")VALUES('";
		$sql   .= implode("', '", array_values($attribute));
		$sql   .= "')";
		if($database->query($sql)){
			$this->id = $database->insert_id();
			return true;
		}else{
			return false;
		}
	}
	public function update(){
		global $database;

		$attribute = $this->attribute($this);
		$attribute_key_val = array();
		foreach ($attribute as $key => $value) {
			$attribute_key_val[]=$key."='".$value."'";
		}

		$sql 	= "UPDATE ".static::$table_name." SET ";
		$sql   .= implode(", ", $attribute_key_val);
		$sql   .= " WHERE id=".$this->id;
		$database->query($sql);
		return $database->affected_rows()>0?$sql:$sql;	
	}
	public function save(){
		return isset($this->id)?$this->update():$this->create();
	}

	public function delete(){
		global $database;
		$sql  = "DELETE FROM ".static::$table_name;
		$sql .= " WHERE id=".$this->id;
		$sql .= " LIMIT 1";
		if($result = $database->query($sql)){
			return $database->affected_rows()>0?true:false;
		}else{
			return false;
		}

	}

	}			
?>