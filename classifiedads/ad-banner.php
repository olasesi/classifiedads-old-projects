<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");

if(!isset($_SESSION['user_id']) && !isset($_SESSION['user_admin'])){
header("Location:".MYSHOPTWO);
exit();
}
?>

<?php
if (!isset($reg_errors_header_slider)) {$reg_errors_header_slider = array();}
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['uploadheaderslide'])){
	
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
	
 $sliderq = mysqli_query($connect,"INSERT INTO ad_banner(ad_banner_id, ad_position, ad_name, ad_link, ad_banner_image, ad_banner_timestamp) 
						VALUES ('','1','".$headerslidegoodname."','".$headerslideusername."','".$new_name."','".strtotime('now')."')") or die(db_conn_error);
 
 if (mysqli_affected_rows($connect) == 1) {
			
			$_POST = array();
			$_FILES = array();
				
			unset($_FILES['headerslideimage'], $_SESSION['headerimages']);
			header("Location:".MYSHOPTWO);
			exit();
		
			}
 }
  
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['removeslidead'])){
	if(isset($_POST['deletesponsoredslide'])){
	mysqli_query($connect, "DELETE FROM ad_banner WHERE ad_position = '1'") or die(db_conn_error);
		header("Location:".MYSHOPTWO);
		exit();
	}
	
}

//BANNER 2

if (!isset($reg_errors_header_slider2)) {$reg_errors_header_slider2 = array();}
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['uploadheaderslide2'])){
	
	if (preg_match ('/^[A-Z0-9\'.\-, !\(\)&]{3,20}$/i', $_POST['headerslide_goods_name2'])) {		//only 20 characters are allowed to be inputted
		$headerslidegoodname2 = mysqli_real_escape_string ($connect, trim($_POST['headerslide_goods_name2']));
	
	} else {
		$reg_errors_header_slider2['slide_name'] = 'Enter valid name';
	} 
	
	if (filter_var($_POST['headerslide_user_name2'], FILTER_VALIDATE_URL)) {		
     $headerslideusername2 = mysqli_real_escape_string ($connect, $_POST['headerslide_user_name2']);
	
	} else {
     $reg_errors_header_slider2['slide_username'] = 'Link not valid';
	
	}

if(empty($reg_errors_header_slider2)){	
if (is_uploaded_file($_FILES['headerslideimage2']['tmp_name']) AND $_FILES['headerslideimage2']['error'] == UPLOAD_ERR_OK){ 
		
			if($_FILES['headerslideimage2']['size'] > 1048576){ 		//conditions for the file size 1MB
				$reg_errors_header_slider['file_size']="File size is too big. Max file size 1MB";
			}
		
			$allowed_extensions2 = array('jpeg', '.png', '.jpg', '.JPG', 'JPEG', '.PNG');		
			$allowed_mime2 = array('image/jpeg', 'image/png', 'image/pjpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/x-png');
			$image_info2 = getimagesize($_FILES['headerslideimage2']['tmp_name']);
			$ext2 = substr($_FILES['headerslideimage2']['name'], -4);
			
			
			
			
			if (!in_array($_FILES['headerslideimage2']['type'], $allowed_mime2) || !in_array($image_info2['mime'], $allowed_mime2) || !in_array($ext2, $allowed_extensions2)){
				$reg_errors_header_slider2['wrong_upload'] = "Please choose correct file type. GIF images not allowed.";
				
			}
			
		}else{
		$reg_errors_header_slider2['upload_slide_image'] = 'Please upload image';	
		}	
}		
	
if(empty($reg_errors_header_slider2)){
	if($_FILES['headerslideimage2']['error'] == UPLOAD_ERR_OK){
			$new_name2= (string) sha1($_FILES['headerslideimage2']['name'] . uniqid('',true));
			$new_name2 .= ((substr($ext2, 0, 1) != '.') ? ".{$ext2}" : $ext2);
			$dest2 = "ad/ad-banner/".$new_name2;
			
			if (move_uploaded_file($_FILES['headerslideimage2']['tmp_name'], $dest2)) {
			
			$_SESSION['headerimages2']['new_name'] = $new_name2;
			$_SESSION['headerimages2']['file_name'] = $_FILES['headerslideimage2']['name'];
			
			
			} else {
			trigger_error('The file could not be moved.');
			$reg_errors_header_slider2['not_moved'] = "The file could not be moved.";
			unlink ($_FILES['headerslideimage2']['tmp_name']);
			}
			}
 
 }

if(empty($reg_errors_header_slider2)){
	
 $sliderq2 = mysqli_query($connect,"INSERT INTO ad_banner(ad_banner_id, ad_position, ad_name, ad_link, ad_banner_image, ad_banner_timestamp) 
						VALUES ('','2','".$headerslidegoodname2."','".$headerslideusername2."','".$new_name2."','".strtotime('now')."')") or die(db_conn_error);
 
 if (mysqli_affected_rows($connect) == 1) {
			
			$_POST = array();
			$_FILES = array();
				
			unset($_FILES['headerslideimage2'], $_SESSION['headerimages2']);
			header("Location:".MYSHOPTWO);
			exit();
		
			}
 }
  
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['removeslidead2'])){
	if(isset($_POST['deletesponsoredslide2'])){
	mysqli_query($connect, "DELETE FROM ad_banner WHERE ad_position = '2'") or die(db_conn_error);
		header("Location:".MYSHOPTWO);
		exit();
	}
	
}



include("../incs_shop/header.php");

echo '<header id="home" class="home">
            <div class="overlay-fluid-block">
                <div class="container text-center">
                    <div class="row">
                        <div class="home-wrapper">
                            <div class="col-md-10 col-md-offset-1">';


echo '<div class="login-page">
		<h1>HOMEPAGE BANNER 1</h1>
	<div class="form">
	<form class="login-form" method="POST" action="" role="form" enctype="multipart/form-data">';		
 
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
	 <button type="submit" name="uploadheaderslide">Upload banner</button>
	 </form>';
	
echo '<h1>DELETE BANNER 1</h1>';	
	
echo '<form class="login-form" method="POST" action="" role="form">';	

echo '<input type="hidden" name="deletesponsoredslide" />';

echo '<button type="submit" name="removeslidead">Delete banner 1</button>';

echo  '</form>';		 
echo '							</div>
                        </div>';


//banner 2

echo '<div class="login-page">
		<h1>HOMEPAGE BANNER 2</h1>
	<div class="form">
	<form class="login-form" method="POST" action="" role="form" enctype="multipart/form-data">';		

if (array_key_exists('slide_name', $reg_errors_header_slider2)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider2['slide_name'].'</p>';}
	
echo '<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Name" name="headerslide_goods_name2" value="';
	if(isset($_POST['headerslide_goods_name2'])){echo $_POST['headerslide_goods_name2'];}
echo '"/> 
	</div>';

if (array_key_exists('slide_username', $reg_errors_header_slider2)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider2['slide_username'].'</p>';}
echo '<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Enter link" name="headerslide_user_name2" value="';
	 if(isset($_POST['headerslide_user_name2'])){echo $_POST['headerslide_user_name2'];}
echo '"/> 
	</div>';	

echo '<div class="form-group">';
if (array_key_exists('file_size', $reg_errors_header_slider2)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider2['file_size'].'</p>';}
	if (array_key_exists('wrong_upload', $reg_errors_header_slider2)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider2['wrong_upload'].'</p>';}
	if (array_key_exists('upload_slide_image', $reg_errors_header_slider2)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider2['upload_slide_image'].'</p>';}
	if (array_key_exists('not_moved', $reg_errors_header_slider2)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider2['not_moved'].'</p>';}

echo '<input type="file" id="slide_1_image_1" name="headerslideimage2"/>
	</div>
	 <br>
	 <button type="submit" name="uploadheaderslide2">Upload banner</button>
	 </form>';
	
echo '<h1>DELETE BANNER 2</h1>';	
	
echo '<form class="login-form" method="POST" action="" role="form">';	

echo '<input type="hidden" name="deletesponsoredslide2" />';

echo '<button type="submit" name="removeslidead2">Delete banner 2</button>';

echo  '</form>';		 
echo '							</div>
                        </div>';



	
echo '
                    </div>
                </div>			
            </div>
        </header>';	
		
include("../incs_shop/footer.php");		




























?>



