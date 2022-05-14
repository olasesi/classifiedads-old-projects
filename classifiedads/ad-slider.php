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

if (preg_match ('/^[A-Z0-9_-]{3,18}$/i', $_POST['headerslide_user_name'])) {		//to use underscore 
     $headerslideusername = mysqli_real_escape_string ($connect, $_POST['headerslide_user_name']);
	
	} else {
     $reg_errors_header_slider['slide_username'] = '3-18 characters. Alphanumerals, underscores, and dashes are allowed.';
	
	}


if (preg_match ('/^[A-Z0-9\'.\-, !\(\)&]{3,20}$/i', $_POST['headerslide_goods_name'])) {		//only 20 characters are allowed to be inputted
		$headerslidegoodname = mysqli_real_escape_string ($connect, trim($_POST['headerslide_goods_name']));
	
	} else {
		$reg_errors_header_slider['slide_name'] = 'Enter valid product or service name';
	} 
	 
 
 if (preg_match ('/^[0-9]{1,10}$/', trim($_POST['headerslide_price']))) {						//only numbers are allowed here. no decimals or commas
		$headerslideprice = mysqli_real_escape_string ($connect,$_POST['headerslide_price']);
		} else {
		$reg_errors_header_slider['slide_price'] = 'Please enter correct price e.g 13000';
		}
		
	if (preg_match ('/0\d{10}/', trim($_POST['headerslide_number']))) {
		$headerslidenumber = mysqli_real_escape_string ($connect,$_POST['headerslide_number']);		//match phone number
		} else {
		$reg_errors_header_slider['slide_number'] = 'Mobile phone number only. e.g 08012345678';
		}
	
	if ($_POST['headerslide_categories'] == "Categories") {
		$reg_errors_header_slider['slide_categories'] = 'Please choose from the category';			//same reason as above
		}else{
		$headerslidecategories = $_POST['headerslide_categories'];
		}

	
	if ($_POST['city'] == "Choose Area") {
		$reg_errors_header_slider['city'] = 'Please choose Area';
	} else{
	$headerarea = $_POST['city'];
	}

	if (preg_match ('/^[A-Z0-9?\040\'.!\-",\(\)\s:();%]{0,255}+$/i', trim($_POST['headerdescription']))) {		
		$headerdescription_g = mysqli_real_escape_string ($connect, trim($_POST['headerdescription']));
		}else{
		$reg_errors_header_slider['description'] = 'Please delete invalid characters';
		}
		
	if(isset($_POST['headerbonus'])){	
		$headerbonus=1;
		}else{
		$headerbonus=0;	
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
			$dest = "ad/ad-slider/".$new_name;
			
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
	
 $sliderq = mysqli_query($connect,"INSERT INTO ad_header_slide(id_header_slide, ad_username_slide, ad_goods_slide, ad_price_slide, ad_description, ad_phone, ad_categories, ad_local_area, ad_bonus, ad_images, ad_timestamp) 
						VALUES ('','".$headerslideusername."','".$headerslidegoodname."','".$headerslideprice."','".$headerdescription_g."','".$headerslidenumber."','".$headerslidecategories."','".$headerarea."','".$headerbonus."','".$new_name."','".strtotime('now')."')") or die(db_conn_error);
 
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
	mysqli_query($connect, "DELETE FROM ad_header_slide") or die(db_conn_error);
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
		<h1>UPLOAD SPONSORED SLIDE</h1>
	<div class="form">
	
     
	 <form class="login-form" method="POST" action="" role="form" enctype="multipart/form-data">';		

	 
	 if (array_key_exists('slide_username', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['slide_username'].'</p>';}
	
echo '<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Username" name="headerslide_user_name" value="';
	 if(isset($_POST['headerslide_user_name'])){echo $_POST['headerslide_user_name'];}
echo '"/> 
	</div>';	
	
	
	if (array_key_exists('slide_name', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['slide_name'].'</p>';}
	
echo '<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Goods name" name="headerslide_goods_name" value="';
	 if(isset($_POST['headerslide_goods_name'])){echo $_POST['headerslide_goods_name'];}
echo '"/> 
	</div>';
	 
	
	if (array_key_exists('slide_price', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['slide_price'].'</p>';}
	 
echo '<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Price e.g 1500" name="headerslide_price" value="';
	if(isset($_POST['headerslide_price'])){echo $_POST['headerslide_price'];}
echo '"/> 
	 </div>';
	
	if (array_key_exists('slide_number', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['slide_number'].'</p>';}
	 
echo '<div class="form-group"> 
	<input class="form-control" type="text" placeholder="08123456789" name="headerslide_number" value="';
	if(isset($_POST['headerslide_number'])){echo $_POST['headerslide_number'];}
echo '"/> 
	 </div>';
	

$categories_array=array('Mobile and Tabs', 'Computers', 'Appliances', 'Clothings', 'Fashion Items', 
				'Kids Accessories', 'Vehicles', 'Vehicle Accessories','Real Estate', 'Pets','Food and Drinks', 'Groceries', 
				'Health', 'Garden', 'Home', 'Fun', 'Art');
	

echo '<div class="form-group">
	<label for="categories">Categories</label>';
if (array_key_exists('slide_categories', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['slide_categories'].'</p>';}
echo	'<select class="form-control input-sm" name="headerslide_categories" id="categories">
		 <option>Categories</option>';
			
				if(isset ($_POST['headerslide_categories'])){
					foreach ($categories_array as $option){
						$sel = ($option==$_POST['headerslide_categories'])?"Selected='selected'":"";
						echo '<option '.$sel.'>'.$option.'</option>';}
				}else{
						foreach ($categories_array as $option){
						echo '<option>'.$option.'</option>';
						}
				}
			
echo	'</select>
	</div>

<div class="form-group">
		<label for="selectname"></label>';
if (array_key_exists('city', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['city'].'</p>';}	
echo		'<select class="form-control input-sm" name="city" id="selectname">';
		
		include("../incs_shop/cities_signup.php"); 
							
echo	'</select>
	 </div>';
	
if (array_key_exists('description', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['description'].'</p>';}

echo	'<div class="form-group">
	<label for="description">Description</label>
	<textarea class="form-control" name="headerdescription" value="" id="description">';
if(isset($_POST['headerdescription'])){echo trim($_POST['headerdescription']);} 
	
echo '</textarea>
	</div>

<div>
<label>
<input type="checkbox" name="headerbonus"';
if(isset($_POST['headerbonus'])){ echo 'checked="checked"';}
echo '/><b><i>Customer Bonus</i></b>
</label>
</div>';


	
	
echo '<div class="form-group">
	<label for="slide_1_image_1">Image input</label>';
	 
	if (array_key_exists('file_size', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['file_size'].'</p>';}
	if (array_key_exists('wrong_upload', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['wrong_upload'].'</p>';}
	if (array_key_exists('upload_slide_image', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['upload_slide_image'].'</p>';}
	if (array_key_exists('not_moved', $reg_errors_header_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_header_slider['not_moved'].'</p>';}
	
	
echo '<input type="file" id="slide_1_image_1" name="headerslideimage"/>
	</div>
	 
	 <br>
	 
	 <button type="submit" name="uploadheaderslide">Save to Paid Slide</button>
	 </form>
	</div></div>';
	
echo '<div class="login-page">
		<h1>DELETE AD SLIDE</h1>
	<div class="form">';	
	
echo '<form class="login-form" method="POST" action="" role="form">';	

echo '<input type="hidden" name="deletesponsoredslide" />';

echo '<button type="submit" name="removeslidead">Delete Paid Slide</button>';



echo  '</form>';		//delete header 


echo '</div>
     </div>';
	
echo '							</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';	
		
include("../incs_shop/footer.php");		
	

	







	


?>

