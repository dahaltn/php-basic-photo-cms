<?php
class Session{
	private $logged_in =false;
	public $user_id;
	public $message;

	function __construct(){
		session_start();
		$this->check_login();
		$this->check_message();
	}
	public function set_message($msg=""){
		if(!empty($msg)){
			$_SESSION['messages'] = $msg;
			}else{
				return $this->message;
			}
	}

	private function check_message(){
		if(isset($_SESSION['messages'])){
			$this->message = $_SESSION['messages'];
			$_SESSION['messages'] = null;
		}else{
			$this->message = "";
		}
	}
	public function is_logged_in(){
		return $this->logged_in;
	}

	public function login($autho_user){
		if($autho_user){
			$this->user = $_SESSION['u_id'] = $autho_user->id;
			$this->logged_in=true;

		}
	}
	public function logout(){
		unset($_SESSION['u_id']);
		unset($this->user_id);
		$this->logged_in = false;
	}
	private function check_login(){
		if(isset($_SESSION['u_id'])){
		$this->user_id = $_SESSION['u_id'];
		$this->logged_in=true;	
		}else{
			unset($this->user_id);
			$this->logged_in=false;
		}
	}

}

$session = new Session();
$message = $session->set_message();
?>