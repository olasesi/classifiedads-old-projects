<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");
if(!isset($_SESSION['user_id'])){
	 header("Location:".MYSHOPTWO);
	 exit();
	}

$page_title = 'Edit Shop';
$descript = '';
include("../incs_shop/header_all.php");
?>