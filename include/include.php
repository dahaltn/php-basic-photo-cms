<?php 
defined('DS')?NULL:define('DS', DIRECTORY_SEPARATOR);
defined('ROOT')?NULL:define('ROOT', dirname(dirname(__FILE__)).DS);
defined('INC')?NULL:define('INC', ROOT."include");

require_once(INC.DS.'function.php');
require_once(INC.DS.'database.php');
require_once(INC.DS.'databaseobject.php');
require_once(INC.DS.'photograph.php');
require_once(INC.DS.'user.php');
require_once(INC.DS.'comment.php');
require_once(INC.DS.'pagination.php');
require_once(INC.DS.'session.php'); 
include(INC.DS.'header.php'); 
?>
