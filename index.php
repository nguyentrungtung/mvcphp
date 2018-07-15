<?php
date_default_timezone_set("Asia/Ho_Chi_Minh");
//define path
require_once("config/define_path.php");
require_once("config/define_database.php");
//end define path
require_once(__LIB_PATH."Session.php");
require_once(__LIB_PATH."Controller.php");
require_once(__LIB_PATH."View.php");
require_once(__LIB_PATH."Model.php");
require_once(__LIB_PATH."Bootstrap.php");
require_once(__LIB_PATH."Validation.php");
require_once(__LIB_PATH."Pagination.php");
$bootstrap= new Bootstrap;

?>