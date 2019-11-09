<?php
require_once('database.php');

class Comment extends DatabaseObject{
	protected static $table_name ="comments";
	protected static $db_fields = array('photograph_id', 'created', 'author', 'body');
	public $id;
	public $photograph_id;
	public $author;
	public $created;
	public $body;		

	public static function make($photo_id, $author="Anonymous", $body=""){
			if(!empty($photo_id)&&!empty($author)&&!empty($body)){
				$comment = new self;
				$comment->photograph_id = (int)$photo_id;
				$comment->author  = $author;
				$comment->created = strftime("%Y-%m-%d %H:%M:%S",time());
				$comment->body    = $body;
				return $comment;
		}else{
			return false;
		}
	}
	public static function find_comments_on($photo_id){
		$sql = "SELECT * FROM ".self::$table_name;
		$sql .= " WHERE photograph_id =".$photo_id;
		$sql .= " ORDER BY created ASC";
		return self::find_by_sql($sql);
	}


}

//$comments = new Comment::find_comments_on($photo_id);

?>