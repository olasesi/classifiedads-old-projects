<?php
$username_search_array = array();
if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['users'])){
	
	if (preg_match ('/^[a-z0-9_-]{3,30}$/', trim($_POST['users']))) {		//to be updated online
    $users_var = mysqli_real_escape_string ($connect, trim($_POST['users']));
	
	} else {
     $username_search_array['users'] = 'Username not correctly spelt';
	}
	
	if(empty($username_search_array)){
	
	$selecting_users = mysqli_query($connect, "SELECT username FROM users WHERE LOWER(username) = '".strtolower($users_var)."' AND active = '1' AND payment = '1'") or die(db_conn_error);	//And those that have paid
	if(mysqli_num_rows($selecting_users) == 1){
	header("Location:".MYSHOPTWO."/".$users_var.".php");
	exit();	
	}else{
		$username_search_array['notfound'] = "Sorry, username was not found or not correctly spelt";
		
	}					
	
	
	}
					
					
}
?>