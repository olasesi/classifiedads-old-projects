<?php
$live = false;
$contact_email = 'admin@myshoptwo.com';

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']!='off'){
	$prot= "https://localhost/";
}else{
	$prot= "http://localhost/";			//to remove localhost on launch 
	}
	

	
	
define ('BASE_URI', '/path/to/Web/parent/folder/');	//yes if i can access the folder. you should be able to access it if you are on a dedicated server
define ('BASE_URL', 'www.myshoptwo.com/');			//www.myshoptwo.com/
define ('BASE_URL_NO_SLASHES', 'www.myshoptwo.com');//www.myshoptwo.com
define ('BASE_URL_NO_WWW', 'myshoptwo.com');		//myshoptwo.com
define ('MYSQL', 'www.myshoptwo.com/incs/serv_con.inc.php');
define ('MYSHOPTWO', $prot.'www.myshoptwo.com');	// http://www.myshoptwo.com
define ('REGISTRATION_PRICE', 'a token');			//&#8358;3,500
define ('CAPITALIZED_NAME', 'Myshoptwo');			//Myshoptwo


define ('PAGE_TITLE', "Myshoptwo - Nigeria's best online marketplace");
define ('PAGE_DESCRIPTION', "Nigeria's best online marketplace to get customers and also best prices and deals on shoes, bags, phones, cars, electronics, pets, books, lands, houses, etc.");
define ('META_CONTENT', "e-shop, e-commerce, online shop, i need, i want, affordable price, cheap price, discount, original products, to post, to buy, to advertise, goods and services, in nigeria");
define ('CONTACT_NUMBER', "09061937121");
define ('AD_CONTACT_NUMBER', "09061937121");
define ('ADDRESS', "17B, Kodesho Street,<br />Computer Village, Ikeja, Lagos");


//Special occasions
define ('CHRISTMAS_DECOR', '');		//<img src="assets/vectors/xmas light2.png" style="width:95%; margin-top:-25px;"/><br>
define ('CHRISTMAS_DECOR2', '');	//<img src="assets/vectors/santa hat.png"/>

date_default_timezone_set('UTC');

session_start();

function my_error_handler($e_number, $e_message, $e_file, $e_line, $e_vars){
     global $live, $contact_email;
	 
	 
	 $message = "An error occurred in script '$e_file' on line $e_line:\n$e_message\n";
	 $message .= "<pre>" .print_r(debug_backtrace(), 1) . "</pre>\n";
	 
	 if (!$live){
     echo '<div class="error">' . nl2br($message) . '</div>';
	 }
	 else {
      error_log ($message, 1, $contact_email, 'From:admin@myshoptwo.com');
		
		if ($e_number!= E_NOTICE) {
		echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div>';
		}	
	
		} // End of $live IF-ELSE.
     return true;} 
	  
set_error_handler ('my_error_handler'); 
	  
	  
function redirect_invalid_user($check = 'user_id', $destination = 'index.php', $protocol = 'http://localhost/') { // LOCALHOST to be removed when site goes live. http because not all website has https
 
 if (!headers_sent()) {
	if (!isset($_SESSION[$check])) {
          $url = $protocol . BASE_URL . $destination;
          header("Location: $url");
          exit();
     }

	} else {
     include("../incs_shop/header.php");
      trigger_error('You do not have permission to access this page. Please log in and try again.');
     include("../incs_shop/footer.php");
		} 

		
		}	 


function custom_number_format($n, $precision = 1){
		if($n < 900){	//default
			$n_format = number_format($n);
			
		}else if ($n < 9000){	//thousand
			$n_format = number_format($n/1000, $precision).'K';
		}else if ($n < 900000000){	//million
			$n_format = number_format($n/1000000, $precision).'M';
		}else if ($n < 900000000000){	//Billion
			$n_format = number_format($n/1000000000, $precision).'B';
		}else {
			$n_format = number_format($n/1000000000000, $precision).'T';
		}
	return $n_format;
}


function time_ago($date){
	if (empty($date)){
		return "no date";
	}
	
	$periods = array("sec", "min", "hr", "day", "wk", "mth", "yr", "dc");
	$lenghts = array("60","60","24","7","4.35","12","10" );
	
		
	$now = strtotime("now");
	
	$unix_date = strtotime("now",$date);		
	
	//check validity of date
	
	if(empty($unix_date))
	{
	return "bad date";	
	}
	
	// is it a future date or past date
	
	if( $now > $unix_date )
	{
		$difference = $now - $unix_date;
		$tense = "ago";
	}
	else
	{
		$difference = $unix_date - $now;
		$tense = "ahead";
		}	

	for( $j = 0; $difference >= $lenghts[$j] && $j < count($lenghts)-1; $j++)
	{
		$difference /= $lenghts[$j];
	}
	
	$difference = round( $difference );
	
	if( $difference !=1 )
	{
		$periods[$j].="s";
	}
	
	return "$difference$periods[$j] {$tense}";
}

function getuserip(){
	
	//if(array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty('HTTP_X_FORWARDED_FOR')){
		
		//if(strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') > 0){
			//$addr = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
			//return trim($addr[0]);		//can HTTP_X_FORWARDED_FOR be spoofed? If yes, filter it with, filter_var($addr, FILTER_VALIDATE_IP)
		//}else{
			//return $_SERVER['HTTP_X_FORWARDED_FOR'];
		//}
	
	//}else{
		return $_SERVER['REMOTE_ADDR'];
	//}
	
}

?>