<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");

if(!isset($_SESSION['user_id']) && !isset($_SESSION['user_admin'])){
header("Location:".MYSHOPTWO);
exit();
}
?>

<?php
include("../incs_shop/header.php");



echo '<header id="home" class="home">
            <div class="overlay-fluid-block">
                <div class="container text-center">
                    <div class="row">
                        <div class="home-wrapper">
                            <div class="col-md-10 col-md-offset-1">';
echo '<div class="login-page">
		<h1>FIRST FREE AD</h1>
	<div class="form">';	
	
////////////////////////////////////////////////////////////////	

if (!isset($payment_error)) {$payment_error = array();}
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['payment'])){

if (preg_match ('/^[A-Z0-9_-]{3,30}$/i', $_POST['search_username'])) {		//only 30 characters are allowed to be inputted
		$search_username = mysqli_real_escape_string ($connect, trim($_POST['search_username']));
	} else {
		$payment_error['payment_confirm'] = 'Incorrect username';
	}

if (empty($payment_error)) {
   $first_confirm = mysqli_query($connect,"SELECT * FROM users, first_free_ad WHERE username=username_first_ad AND confirm_first_free_ad = '0' AND username = '".$search_username."' AND active = '1'") or die(db_conn_error);
   $num_first_confirm = mysqli_num_rows($first_confirm);
   if($num_first_confirm == 1){ 
	$admin_referral_exist = mysqli_query($connect, "SELECT * FROM first_free_ad, users, lookup_table WHERE username = username_first_ad AND username_first_ad = lookup_username AND payment_status = '0' AND active = '1' AND username_first_ad = '".$search_username."' AND confirm_first_free_ad = '0'") or die(db_conn_error);
	$admin_rows_referrals = mysqli_num_rows($admin_referral_exist);
	if($admin_rows_referrals == 1){
		$array_referral_exist = mysqli_fetch_array($admin_referral_exist);
		$var_lookup_username = $array_referral_exist['username_first_ad'];
		
		echo '<br>'.$var_lookup_username.', Please make a payment of &#8358;3,000 and send your 250px by 250px banner to 09061937121. Your ad will be placed in a short while and you can now earning now.';
		
	}else{
				
		$adminif_ad_is_in_table2 = mysqli_query($connect,"SELECT * FROM first_free_ad, users, lookup_table WHERE username = username_first_ad AND username_first_ad = lookup_username AND payment_status = '1' AND active = '1' AND username_first_ad = '".$search_username."' AND confirm_first_free_ad = '0'") or die(db_conn_error);
		$adminnum_if_ad_is_in_table2 = mysqli_num_rows($adminif_ad_is_in_table2);
		if($adminnum_if_ad_is_in_table2 == 1){
			echo '<br><small><em>You have a month free ad. Send your 250px by 250px banner to 09061937121.</em></small>';
		}
			
			
		}
		
		}else{
		
			echo '<br><small><em>Incorrect username or you have done your free ad before.</em></small>';
			
		}
			
		}
		
	
	}
	

if (!isset($reg_errors_header_slider)) {$reg_errors_header_slider = array();}
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['uploadheaderslide'])){

$clean_username = mysqli_real_escape_string ($connect, $_POST['confirm_username']);
 $confirm_insertion = mysqli_query($connect,"SELECT * FROM users WHERE username = '".$clean_username."' AND active = '1'") or die(db_conn_error);
 if(mysqli_num_rows($confirm_insertion) == 1){
	
	if (preg_match ('/^[A-Z0-9_-]{3,30}$/i', $_POST['confirm_username'])) {		//only 30 characters are allowed to be inputted
		$confirm_username = mysqli_real_escape_string ($connect, trim($_POST['confirm_username']));
	
	} else {
		$reg_errors_header_slider['confirm_username'] = 'Confirm username again';
	} 
	
	if (preg_match ('/^[A-Z0-9\'.\-, !\(\)&]{3,20}$/i', $_POST['headerslide_goods_name'])) {		//only 20 characters are allowed to be inputted
		$headerslidegoodname = mysqli_real_escape_string ($connect, trim($_POST['headerslide_goods_name']));
	
	} else {
		$reg_errors_header_slider['slide_name'] = 'Enter valid name';
	} 
	
	if (filter_var($_POST['headerslide_user_name'], FILTER_VALIDATE_URL)) {		
     $headerslideusername = mysqli_real_escape_string ($connect, $_POST['headerslide_user_name']);
	
	} else {
     $reg_errors_header_slider['slide_username'] = 'Link not valid';
	
	}

	
	
if(empty($reg_errors_header_slider)){	
if (is_uploaded_file($_FILES['headerslideimage']['tmp_name']) AND $_FILES['headerslideimage']['error'] == UPLOAD_ERR_OK){ 
		
			if($_FILES['headerslideimage']['size'] > 1048576){ 		//conditions for the file size 1MB
				$reg_errors_header_slider['file_size']="File size is too big. Max file size 1MB";
			}
		
			$allowed_extensions = array('jpeg', '.png', '.jpg', '.JPG', 'JPEG', '.PNG');		
			$allowed_mime = array('image/jpeg', 'image/png', 'image/pjpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/x-png');
			$image_info = getimagesize($_FILES['headerslideimage']['tmp_name']);
			$ext = substr($_FILES['headerslideimage']['name'], -4);
			
			
			
			
			if (!in_array($_FILES['headerslideimage']['type'], $allowed_mime) || !in_array($image_info['mime'], $allowed_mime) || !in_array($ext, $allowed_extensions)){
				$reg_errors_header_slider['wrong_upload'] = "Please choose correct file type. GIF images not allowed.";
				
			}
			
		}else{
		$reg_errors_header_slider['upload_slide_image'] = 'Please upload image';	
		}	
}		
	
if(empty($reg_errors_header_slider)){
	if($_FILES['headerslideimage']['error'] == UPLOAD_ERR_OK){
			$new_name= (string) sha1($_FILES['headerslideimage']['name'] . uniqid('',true));
			$new_name .= ((substr($ext, 0, 1) != '.') ? ".{$ext}" : $ext);
			$dest = "ad/ad-banner/".$new_name;
			
			if (move_uploaded_file($_FILES['headerslideimage']['tmp_name'], $dest)) {
			
			$_SESSION['headerimages']['new_name'] = $new_name;
			$_SESSION['headerimages']['file_name'] = $_FILES['headerslideimage']['name'];
			
			
			} else {
			trigger_error('The file could not be moved.');
			$reg_errors_header_slider['not_moved'] = "The file could not be moved.";
			unlink ($_FILES['headerslideimage']['tmp_name']);
			}
			}
 
 }

if(empty($reg_errors_header_slider)){
$start_ad = strtotime('now');
$end_ad = strtotime('now') + 2592000;	
$sliderq = mysqli_query($connect, "UPDATE first_free_ad SET confirm_first_free_ad = '1' WHERE username_first_ad = '".$confirm_username."' AND confirm_first_free_ad = '0'") or die(db_conn_error);
mysqli_query($connect, "INSERT INTO ad_referral (id_ad_referral, user_from_lookup, ad_name, ad_payment_status, ad_time_to_start, ad_time_to_finish, referral_ad_link, referral_id_image) VALUES ('','".$confirm_username."', '".$headerslidegoodname."', '1','".$start_ad."', '".$end_ad."', '".$headerslideusername."', '".$new_name."')") or die(db_conn_error);	
		

 
 if (mysqli_affected_rows($connect) == 1) {
			
			$_POST = array();
			$_FILES = array();
				
			unset($_FILES['headerslideimage'], $_SESSION['headerimages']);
			echo '<center><p class="text-success">Ad has been uploaded successfully</p></center>';	
		
			}
 }
  
}else{
echo '<center><p class="text-danger">Incorrect data entered</p></center>';	
}
}


	
echo '<form class="login-form" method="POST" action="" role="form">';	
if (array_key_exists('payment_confirm', $payment_error)) {echo '<p class="message" style="color:red;">'.$payment_error['payment_confirm'].'</p>';}
if (array_key_exists('payment_incorrect', $payment_error)) {echo '<p class="message" style="color:red;">'.$payment_error['payment_incorrect'].'</p>';}
echo '<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Username search" name="search_username" value="';
	if(isset($_POST['search_username'])){echo $_POST['search_username'];}
echo '"/> 
	</div>';
	echo '<button type="submit" name="payment">Search Username</button>
	 </form>
	 </div>
	 </div>
	 ';
	
echo '<div class="login-page">
		<h1>AD UPLOAD</h1>
	<div class="form">
	<form class="login-form" method="POST" action="" role="form" enctype="multipart/form-data">';		

if (array_key_exists('confirm_username', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['confirm_username'].'</p>';}
	
echo '<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Confirm username" name="confirm_username" value="';
	if(isset($_POST['confirm_username'])){echo $_POST['confirm_username'];}
echo '"/> 
	</div>';
	
if (array_key_exists('slide_name', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['slide_name'].'</p>';}
	
echo '<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Name" name="headerslide_goods_name" value="';
	if(isset($_POST['headerslide_goods_name'])){echo $_POST['headerslide_goods_name'];}
echo '"/> 
	</div>';
 
if (array_key_exists('slide_username', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['slide_username'].'</p>';}
echo '<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Enter link" name="headerslide_user_name" value="';
	 if(isset($_POST['headerslide_user_name'])){echo $_POST['headerslide_user_name'];}
echo '"/> 
	</div>';	

echo '<div class="form-group">';
if (array_key_exists('file_size', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['file_size'].'</p>';}
	if (array_key_exists('wrong_upload', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['wrong_upload'].'</p>';}
	if (array_key_exists('upload_slide_image', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['upload_slide_image'].'</p>';}
	if (array_key_exists('not_moved', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['not_moved'].'</p>';}

echo '<input type="file" id="slide_1_image_1" name="headerslideimage"/>
	</div>
	 <br>
	 <button type="submit" name="uploadheaderslide">Upload ad</button>
	 </form>';
echo '</div></div>';	 


	
echo '
                    </div>
                </div>			
            </div>
        </header>';	
?>




<?php include("../incs_shop/footer.php"); ?>		