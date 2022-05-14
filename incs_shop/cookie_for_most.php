<?php
if(!isset($_SESSION['user_id'])){	

if(isset($_COOKIE['remember_me'])){ 
	
	$cookiesessions = $_COOKIE['remember_me'];

	$decode_cookie = mysqli_query ($connect,"SELECT user_id, type, firstname, lastname, username, brand_username_name, r_email, local_area, state_local_area, address, phone1, phone2, bus_email, bus_description, headline, facebook_link, instagram_link, twitter_link FROM users WHERE cookie_sessions = '".$cookiesessions."' AND active = '1' AND payment = '1'") or die(db_conn_error);
    if (mysqli_num_rows($decode_cookie) == 1) {
	
	$rows_cookie = mysqli_fetch_array($decode_cookie, MYSQLI_NUM);
	
	$_SESSION['user_id'] = $rows_cookie[0];
	$_SESSION['firstname'] = $rows_cookie[2];
	$_SESSION['lastname'] = $rows_cookie[3];
	$_SESSION['username'] = $rows_cookie[4];
    $_SESSION['brand_username_name'] = $rows_cookie[5];
	$_SESSION['r_email'] = $rows_cookie[6];
	$_SESSION['local_area'] = $rows_cookie[7];
	$_SESSION['state_local_area'] = $rows_cookie[8];
	$_SESSION['address']= $rows_cookie[9];
	$_SESSION['phone1'] = $rows_cookie[10];
	$_SESSION['phone2'] = $rows_cookie[11];
	$_SESSION['bus_email'] = $rows_cookie[12];
	$_SESSION['bus_description'] = $rows_cookie[13];
	$_SESSION['headline'] = $rows_cookie[14];
	$_SESSION['facebook_link'] = $rows_cookie[15];
	$_SESSION['instagram_link'] = $rows_cookie[16];
	$_SESSION['twitter_link'] = $rows_cookie[17];
	
}

}
}
?>