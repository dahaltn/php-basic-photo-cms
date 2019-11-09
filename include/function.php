<?php
function strip_zeros_from_date($marked_string=""){
$no_zero = str_replace('*0', '', $marked_string);
$clean_string = str_replace('*', '', $no_zero);
return $clean_string;
}

function redirect_to($location=null){
	if($location!=null){
		return header("Location:{$location}");
		exit;
	}
}
function output_message($message=''){
	if(!empty($message)){
		echo "<p class=\"message\">{$message}</p>"; 
	}else{
		return '';
	}
}
function timedate_format($datetime=""){
$unix_date = strtotime($datetime);
return strftime("%B %d, %Y at %I:%M %p", $unix_date);

}
function __autoload($class_name){
	$class_name = strtolower($class_name);
	$path = INC.DS."{$class_name}.php";
	if(file_exists($path)){
		require_once($path);
	}else{
		die("The file {$class_name}.php could not be found");
	}

}
function include_template($template){
	include(ROOT.DS.'layout'.DS.$template);
}

function log_entry($log_user="", $message=""){
		$log_dir = ROOT."logs";
		$log_file = $log_dir.DS."log.txt";
		$date = date("d/m/Y | h:m");
		$log_content = $date." User: ".$log_user.$message;
		if(!file_exists($log_dir)){
			$mkdir = mkdir($log_dir, 0666, true);
			if(!$mkdir){
				$message = "couldn't create directory error";
			}
		}
		if($handle = fopen($log_file, 'a+')){
		fwrite($handle, $log_content);				
		}				
	}



?>