<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");

if(!isset($_SESSION['user_id']) && !isset($_SESSION['user_admin'])){
header("Location:".MYSHOPTWO);
exit();
}


if (isset($_SESSION['user_id'])){
if (isset($_SESSION['user_admin'])) {

include ('../incs_shop/paginate.php');
$statement= "users WHERE payment = '0' AND active = '0'";
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;
$per_page = 50; 								// Set how many records do you want to display per page.
$startpoint = ($page * $per_page) - $per_page;

$sliderq = mysqli_query($connect,"SELECT * FROM $statement LIMIT $startpoint , $per_page") or die(db_conn_error);

?>
<?php


while($whiling = mysqli_fetch_array($sliderq)){
if(isset($_POST[$whiling['user_id']])){

mysqli_query($connect, "UPDATE users SET payment = '1', active = '1' WHERE user_id='".$whiling['user_id']."' AND active = '0' AND payment = '0'") or die(db_conn_error);
if(mysqli_affected_rows($connect) == 1){
	
$contents='
<?php include("../incs_shop/users.php"); ?>
';
$created_file = $whiling['username'].'.php';
	
	if(!file_put_contents($created_file, $contents, FILE_APPEND)){
		die('<div class="text-center text-danger">Error: Failed to write data to '.$created_file.'</div>');
	}

$body = '
<div style="max-width:1000px; margin-left:auto; margin-right:auto;">
	<div style="font-size:14px; margin-top:50px;">
	<center><h1 style="color:#f5f5f5; background-color:#161616; text-shadow:1px 1px 1px #a2a2a2; padding-top:10px; padding-bottom:10px; text-transform:uppercase;">'.$whiling['brand_username_name'].' e-shop set up</h1></center>
	<p>CONGRATULATIONS!!!.<span style="text-transform:capitalize;">'.$whiling['brand_username_name'].'</span> has now been set up. Login with your username and password to enter.</p>
	
	
	</div>
</div>

';
		
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: noreply@myshoptwo.com' . "\r\n";
		$headers .= 'Reply-To: noreply@myshoptwo.com' . "\r\n";
		$headers .= 'Return-Path: noreply@myshoptwo.com' . "\r\n";
		$headers .= 'BCC: noreply@myshoptwo.com' . "\r\n";
		$headers .= 'X-Priority: 3' . "\r\n";
		$headers .= 'X-Mailer: PHP/'. phpversion() . "\r\n";
		
		mail($whiling['r_email'], 'My Shop Two - Registration', $headers);	

		
		
		
		}



header("Location: payment-confirmation.php");
exit();
}	


echo '<div style="float:left; display:inline-block; margin-left:5px;">';
	echo 'Firstname: '.$whiling['firstname'].'<br/>';
	echo 'Lastname: '.$whiling['lastname'].'<br/>';
	echo 'Username: '.$whiling['username'].'<br/>';
	echo 'E-shop name: '.$whiling['brand_username_name'].'<br/>';
	echo 'Email: '.$whiling['r_email'].'<br/>';

echo '<form action="" method="POST">
	<button type="submit" name="'.$whiling['user_id'].'">Confirm User</button>
	</form>';
	
echo '</div>';
	
	
	}
	
echo pagination($statement,$per_page,$page,$url=MYSHOPTWO."/payment-confirmation.php?"); 


	 
echo '<center><a href="'.MYSHOPTWO.'">HOMEPAGE</a></center>';	

}
}
?>