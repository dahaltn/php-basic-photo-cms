<?php
require_once('database.php');

class Photograph extends DatabaseObject{
	protected static $table_name ="photographs";
	protected static $db_fields = array('id', 'filename', 'type', 'size', 'caption');
	public $id;
	public $filename;
	public $type;
	public $size;
	public $caption;		

	private $temp_path;
	protected $upload_dir = 'images';
	public $errors =array();

	public $upload_errors = array(
	UPLOAD_ERR_OK			=>	"No errors has been found",
	UPLOAD_ERR_INI_SIZE 	=> 	"Larger than max upload size",
	UPLOAD_ERR_FORM_SIZE	=> 	"Larger than max upload form size",
	UPLOAD_ERR_PARTIAL		=> 	"Partial Uploaded",
	UPLOAD_ERR_NO_FILE		=> 	"No file has been selected",
	UPLOAD_ERR_NO_TMP_DIR	=> 	"No temporary directory",
	UPLOAD_ERR_CANT_WRITE	=>	"Temp directiory is not writable",
	UPLOAD_ERR_EXTENSION	=>	"Invalid upload stop by file extension"
	);

	public function image_path(){
		return $this->upload_dir.'/'.$this->filename;
	} 
	public function size_as_text(){
		if($this->size<1024){
			return $this->size." byts";
		
		}elseif($this->size<1048567){
			$kb = round($this->size/1024);
			return $kb." Kb";
		
		}else{
			$mb = round($this->size/1048567, 1);
			return $mb." Mb";
			
		}
	}
	public function comments(){
		return Comment::find_comments_on($this->id);
	}
	public function destroy(){
		if($this->delete()){
			$del_file = ROOT."upload".DS.$this->upload_dir.DS.$this->filename;
			return unlink($del_file)?true:false;
		}else{
			return false;
		}
	}
	public function attach_file($file){
		if(!$file || empty($file) || !is_array($file)){
			$this->errors[] = "Couldnt upload file ";
			return false;
		}elseif($file['error']!==0){
			$this->errors[]=$this->upload_errors[$file['error']];
			return false;
		}else{

			$this->temp_path = $file['tmp_name'];
			$this->filename = basename($file['name']);
			$this->type =  $file['type'];
			$this->size = $file['size'];
			return true;
		}


	}



	public function save(){
		if(isset($this->id)){
			$this->update();
		}else{
			if(!empty($this->errors)){
				return false;
			}
			if(strlen($this->caption) >255){
				$this->errors[]="Caption can not be longer than 255 char";
				return false;
			}
			if(empty($this->filename) || empty($this->temp_path)){
				$this->error[]	= "The file location was not available";
				return false;
			}
			$target_path = ROOT."upload".DS.$this->upload_dir.DS.$this->filename;
			if(file_exists($target_path)){
				$this->errors[]="The {$this->filename} file already exists";
				return false;
			}
			if(move_uploaded_file($this->temp_path, $target_path)){
				if($this->create()){
					unset($this->temp_path);
					return true;	
				}
			}else{
				$this->errors[] = "Couldnt upload file possible folder permissin error";
				return false;
			}

		}
	} 



}

$photograph = new Photograph();

?>