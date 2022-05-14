<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");
if(!isset($_SESSION['user_id'])){
	 header("Location:".MYSHOPTWO);
	 exit();
	}
$page_title = 'Edit my shop products';					
$descript = 'Edit shop goods and services';		

?>
<?php
$query = mysqli_query($connect,"SELECT * FROM goods WHERE goods_id = '".mysqli_real_escape_string ($connect, $_GET['goods_no'])."' AND UID = '".$_SESSION['user_id']."'") or die(db_conn_error);

if (mysqli_affected_rows($connect) == 1) {

if (!isset($reg_errors_edit)) {$reg_errors_edit = array();}
if (!isset($reg_errors_images)) {$reg_errors_images = array();}
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['uploadedit'])){
	 
	if (preg_match ('/^[A-Z0-9\'.\-, \(\)&]{3,20}$/i', trim($_POST['edit_goods_name']))) {		//only 20 characters are allowed to be inputted
		$editgoodname = mysqli_real_escape_string ($connect, trim($_POST['edit_goods_name']));
	
	} else {
		$reg_errors_edit['edit_name'] = 'Enter valid product or service name';
	} 
	 
 
 if (preg_match ('/^[0-9]{1,10}$/', trim($_POST['edit_price']))) {						//only numbers are allowed here. no decimals or commas
		$editprice = mysqli_real_escape_string ($connect,trim($_POST['edit_price']));
		} else {
		$reg_errors_edit['edit_price'] = 'Please enter correct price e.g 13000';
		}
		
	if (preg_match ('/0\d{10}/', trim($_POST['edit_number']))) {
		$editnumber = mysqli_real_escape_string ($connect,trim($_POST['edit_number']));		//match phone number
		} else {
		$reg_errors_edit['edit_number'] = 'Mobile phone number only. e.g 08012345678';
		}
	
	if ($_POST['edit_categories'] == "Categories") {
		$reg_errors_edit['edit_categories'] = 'Please choose from the category';			//same reason as above
		}else{
		$editcategories = $_POST['edit_categories'];
		}

	
	if ($_POST['editcity'] == "Choose Area") {
		$reg_errors_edit['editcity'] = 'Please choose Area';
	} else{
	$editarea = $_POST['editcity'];
	}

	if (preg_match ('/^[A-Z0-9?\040\'.\-",\(\)\s:();%]{0,100}+$/i', trim($_POST['editdescription']))) {		
		$editdescription_g = mysqli_real_escape_string ($connect, trim($_POST['editdescription']));
		} else {
		$reg_errors_edit['editdescription'] = 'Please delete invalid characters';
		}
		
	if(isset($_POST['editbonus'])){				
		$editbonus=1;
		}else{
		$editbonus=0;	
		}																												
				
		
//now to edit the product	
	if (empty($reg_errors_edit)){
			
			mysqli_query($connect, "UPDATE goods SET goods_name = '".$editgoodname."', goods_price = '".$editprice."', goods_phone_number = '".$editnumber."', categories = '".$editcategories."', local_area_id = '".$editarea."', description = '".$editdescription_g."', bonus_fee = '".$editbonus."' WHERE goods_id = '".mysqli_real_escape_string ($connect, $_GET['goods_no'])."' AND UID = '".$_SESSION['user_id']."'") or die(db_conn_error);
			if (mysqli_affected_rows($connect) == 1) {
			header("Location:".MYSHOPTWO."/full-details.php?details=".mysqli_real_escape_string ($connect, $_GET['goods_no']));
			exit;
			}
} 


 }
 
 
 
  if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['uploadeditimages'])){
	  
	 
	if (is_uploaded_file($_FILES['editimage']['tmp_name']) AND $_FILES['editimage']['error'] == UPLOAD_ERR_OK){ 
		
			if($_FILES['editimage']['size'] > 1048576){ 		//conditions for the file size 1MB
				$reg_errors_images['editfile_size']="File size is too big. Max file size 1MB";
			}
		
			$editallowed_extensions = array('jpeg', '.png', '.jpg', '.JPG', 'JPEG', '.PNG');		
			$editallowed_mime = array('image/jpeg', 'image/png', 'image/pjpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/x-png');
			$editimage_info = getimagesize($_FILES['editimage']['tmp_name']);
			$editext = substr($_FILES['editimage']['name'], -4);
			
			
			
			
			if (!in_array($_FILES['editimage']['type'], $editallowed_mime) || !in_array($editimage_info['mime'], $editallowed_mime) || !in_array($editext, $editallowed_extensions)){
				$reg_errors_images['editwrong_upload'] = "Please choose correct file type. GIF images not allowed.";
				
			}
			
		}else{
		$reg_errors_images['editupload_slide_image'] = 'Please upload image';	
		
		}
	

	if(empty($reg_errors_images)){
	if($_FILES['editimage']['error'] == UPLOAD_ERR_OK){
			$editnew_name= (string) sha1($_FILES['editimage']['name'] . uniqid('',true));
			$editnew_name .= ((substr($editext, 0, 1) != '.') ? ".{$editext}" : $editext);
			$editdest = "assets/ItemSlider/images/".$editnew_name;
			
			if (move_uploaded_file($_FILES['editimage']['tmp_name'], $editdest)) {
			
			$_SESSION['editimages']['new_name'] = $editnew_name;
			$_SESSION['editimages']['file_name'] = $_FILES['editimage']['name'];
			
			
			} else {
			trigger_error('The file could not be moved.');
			$reg_errors_images['editnot_moved'] = "The file could not be moved.";
			unlink ($_FILES['editimage']['tmp_name']);
			}
			}
 
 }

if(empty($reg_errors_images)){

mysqli_query($connect, "UPDATE goods SET file_name_goods = '".$editnew_name."' WHERE goods_id = '".mysqli_real_escape_string ($connect, $_GET['goods_no'])."' AND UID = '".$_SESSION['user_id']."'") or die(db_conn_error);
			if (mysqli_affected_rows($connect) == 1) {
			
			$_POST = array();		//I know there isnt any post variable here
			$_FILES = array();
				
			unset($_FILES['editimage'], $_SESSION['editimages']);
			
			header("Location:".MYSHOPTWO."/full-details.php?details=".mysqli_real_escape_string ($connect, $_GET['goods_no']));
			exit;
			}

}

  
}




	
$all_about_goods = mysqli_query($connect, "SELECT * FROM goods WHERE goods_id = '".$_GET['goods_no']."'") or die(db_conn_error);

while ($row = mysqli_fetch_array($all_about_goods)) {
	$goods_name = $row['goods_name'];
	$goods_price = $row['goods_price'];
	$phone_number = $row['goods_phone_number'];
	$cat = $row['categories'];
	$goods_pic = $row['file_name_goods'];
	$about = $row['description'];
	$bonus = $row['bonus_fee'];
	$localarea = $row['local_area_id'];
	}
	
}else{
	
	 header("Location:".MYSHOPTWO);
	 exit;
}
	
include("../incs_shop/header_all.php");
 
?>
  <header id="home" class="home">
            <div class="overlay-fluid-block">
                <div class="container text-center">
                    <div class="row">
                        <div class="home-wrapper">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="home-content">

 <div class="login-page">
		<h2>EDIT PRODUCTS INFO</h2>
	<div class="form">
	
     
	 <form class="login-form" method="POST" action="" role="form">		
	
	<?php if (array_key_exists('edit_name', $reg_errors_edit)) {echo '<p class="message" style="color:red;">'.$reg_errors_edit['edit_name'].'</p>';}?>
	
	<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Goods name" name="edit_goods_name" value="<?php if(!isset($_POST['edit_goods_name'])){echo $goods_name;}?>"/> 
	</div>
	 
	
	<?php if (array_key_exists('edit_price', $reg_errors_edit)) {echo '<p class="message" style="color:red;">'.$reg_errors_edit['edit_price'].'</p>';}?>
	 
	<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Price e.g 1500" name="edit_price" value="<?php if(!isset($_POST['edit_price'])){echo $goods_price;}?>"/> 
	 </div>
	
	
	<?php if (array_key_exists('edit_number', $reg_errors_edit)) {echo '<p class="message" style="color:red;">'.$reg_errors_edit['edit_number'].'</p>';}?>
	 
	<div class="form-group"> 
	<input class="form-control" type="text" placeholder="08123456789" name="edit_number" value="<?php if(!isset($_POST['edit_number'])){echo $phone_number;}?>"/> 
	 </div>
	
<?php
$edit_categories_array=array('Mobile and Tabs', 'Computers', 'Appliances', 'Clothings', 'Fashion Items', 
				'Kids Accessories', 'Vehicles', 'Vehicle Accessories','Real Estate', 'Pets','Food and Drinks', 'Groceries', 
				'Health', 'Garden', 'Home', 'Fun', 'Art');	
	
?>
<div class="form-group">
	<label for="editcategories">Categories</label>
<?php if (array_key_exists('edit_categories', $reg_errors_edit)) {echo '<p class="message" style="color:red;">'.$reg_errors_edit['edit_categories'].'</p>';}?>
	<select class="form-control input-sm" name="edit_categories" id="editcategories">
		 <option>Categories</option>
			<?php
			foreach($edit_categories_array as $editoption){	
				if(!isset ($_POST['edit_categories'])){
				$editsel = ($editoption==$cat)?"Selected='selected'":"";
				}else{
				$editsel = ($editoption==$_POST['edit_categories'])?"Selected='selected'":"";			
				}
				echo "<option $editsel>$editoption</option>";
			}
			?>
	</select>
	</div>

	
<div class="form-group">
		<label for="editselectname"></label>
<?php if (array_key_exists('editcity', $reg_errors_edit)) {echo '<p class="message" style="color:red;">'.$reg_errors_edit['editcity'].'</p>';}?>		
		<select class="form-control input-sm" name="editcity" id="editselectname">
		
		<?php include("../incs_shop/cities_signup_edit.php");?>

	</select>
	 </div>	
	
<?php if (array_key_exists('editdescription', $reg_errors_edit)) {echo '<p class="message" style="color:red;">'.$reg_errors_edit['editdescription'].'</p>';} ?>

	<div class="form-group">
	<label for="editdescription">Description</label>
	<textarea class="form-control" name="editdescription" value="" id="editdescription">
	<?php if(!isset($_POST['editdescription'])){echo $about;} ?>
	</textarea>
	</div>


<input type="hidden" name="editbonus" />

<button type="submit" name="uploadedit">Update Info</button>
</form>

</div>
</div>	 

	
<div class="login-page">	
	<h2>CHANGE PRODUCTS IMAGE</h2>
	<div class="form">
	
	<form class="login-form" method="POST" action="" role="form" enctype="multipart/form-data">
	<div class="form-group">
	<label for="slide_1_image_1">Image input</label>
	<?php 
	if (array_key_exists('editfile_size', $reg_errors_images)) {echo '<p class="message" style="color:red;">'.$reg_errors_images['editfile_size'].'</p>';}
	if (array_key_exists('editwrong_upload', $reg_errors_images)) {echo '<p class="message" style="color:red;">'.$reg_errors_images['editwrong_upload'].'</p>';}
	if (array_key_exists('editupload_slide_image', $reg_errors_images)) {echo '<p class="message" style="color:red;">'.$reg_errors_images['editupload_slide_image'].'</p>';}
	if (array_key_exists('editnot_moved', $reg_errors_images)) {echo '<p class="message" style="color:red;">'.$reg_errors_images['editnot_moved'].'</p>';}
	?>
	
	<input type="file" id="slide_1_image_1" name="editimage"/>
	</div>
	 
	  <br>
	 
	 <button type="submit" name="uploadeditimages">Change Image</button>
	 </form>
	 </div>
	</div>

</div>
								 </div>
                            </div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>


<?php
include("../incs_shop/footer_all.php");
?>