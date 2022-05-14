<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");
if(!isset($_SESSION['user_id'])){
	 header("Location:".MYSHOPTWO);
	 exit();
	}
$page_title = 'Products Upload';					
$descript = 'Products Upload';		

?>

<?php
include("../incs_shop/header_all.php");
?>






 <header id="home" class="home">
            <div class="overlay-fluid-block">
                <div class="container text-center">
                    <div class="row">
                        <div class="home-wrapper">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="home-content">

	<?php							
//if the number of slides is now 16 and you wish to add to it, it can be added but the list slide will be put into product category						
 if (!isset($reg_errors_slider)) {$reg_errors_slider = array();}
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['uploadslide'])){
	 
	if (preg_match ('/^.{3,20}$/i', trim($_POST['slide_goods_name']))) {		//only 20 characters are allowed to be inputted
		$slidegoodname = mysqli_real_escape_string ($connect, trim($_POST['slide_goods_name']));
	
	} else {
		$reg_errors_slider['slide_name'] = 'Maximum characters, 20';
	} 
	 
 
 if (preg_match ('/^[0-9]{1,10}$/', trim($_POST['slide_price']))) {						//only numbers are allowed here. no decimals or commas
		$slideprice = mysqli_real_escape_string ($connect,trim($_POST['slide_price']));
		} else {
		$reg_errors_slider['slide_price'] = 'Please enter correct price e.g 13000';
		}
		
	if (preg_match ('/0\d{10}/', trim($_POST['slide_number']))) {
		$slidenumber = mysqli_real_escape_string ($connect,trim($_POST['slide_number']));		//match phone number
		} else {
		$reg_errors_slider['slide_number'] = 'Mobile phone number only. e.g 08012345678';
		}
	
	if ($_POST['slide_categories'] == "Categories") {
		$reg_errors_slider['slide_categories'] = 'Please choose from the category';			//same reason as above
		}else{
		$slidecategories = $_POST['slide_categories'];
		}

	
	if ($_POST['city'] == "Choose Area") {
		$reg_errors_slider['city'] = 'Please choose Area';
	} else{
	$area = $_POST['city'];
	}

	if (preg_match ('/^.{0,1000}+$/i', trim($_POST['description']))) {			//exclamation mark(!) added to it. To be added to others	
		$description_g = mysqli_real_escape_string ($connect, trim($_POST['description']));
		} else {
		$reg_errors_slider['description'] = 'Maximum characters: 1000';
		}
		
	if(isset($_POST['bonus'])){				
		$bonus=1;
		}else{
		$bonus=0;	
		}																												
	
		
	
	if (is_uploaded_file($_FILES['slideimage']['tmp_name']) AND $_FILES['slideimage']['error'] == UPLOAD_ERR_OK){ 
		
			if($_FILES['slideimage']['size'] > 1048576){ 		//conditions for the file size 1MB
				$reg_errors_slider['file_size']="File size is too big. Max file size 1MB";
			}
		
			$allowed_extensions = array('jpeg', '.png', '.jpg', '.JPG', 'JPEG', '.PNG');		
			$allowed_mime = array('image/jpeg', 'image/png', 'image/pjpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/x-png');
			$image_info = getimagesize($_FILES['slideimage']['tmp_name']);
			$ext = substr($_FILES['slideimage']['name'], -4);
			
			
			
			
			if (!in_array($_FILES['slideimage']['type'], $allowed_mime) || !in_array($image_info['mime'], $allowed_mime) || !in_array($ext, $allowed_extensions)){
				$reg_errors_slider['wrong_upload'] = "Please choose correct file type. GIF images not allowed.";
				
			}
			
		}
 		

	if(empty($reg_errors_slider)){
	if($_FILES['slideimage']['error'] == UPLOAD_ERR_OK){
			$new_name= (string) sha1($_FILES['slideimage']['name'] . uniqid('',true));
			$new_name .= ((substr($ext, 0, 1) != '.') ? ".{$ext}" : $ext);
			$dest = "assets/ItemSlider/images/".$new_name;
			
			if (move_uploaded_file($_FILES['slideimage']['tmp_name'], $dest)) {
			
			$_SESSION['images']['new_name'] = $new_name;
			$_SESSION['images']['file_name'] = $_FILES['slideimage']['name'];
			
			
			} else {
			trigger_error('The file could not be moved.');
			$reg_errors_slider['not_moved'] = "The file could not be moved.";
			unlink ($_FILES['slideimage']['tmp_name']);
			}
			}
 
if(empty($reg_errors_slider)){

$max_slide_no = mysqli_query($connect,"SELECT * FROM slider WHERE user_id_slider = '".$_SESSION['user_id']."'") or die(db_conn_error);
if(mysqli_num_rows($max_slide_no) <= 15 ){
	
$new_name = ((isset($_SESSION['images']['new_name']))? $_SESSION['images']['new_name']:"goods_serv_pix.jpg");
$q = mysqli_query($connect,"INSERT INTO slider(id_slider,user_id_slider, slide_goods_name,slide_goods_price,slide_goods_cat, slide_goods_number,slide_goods_desc,slide_bonus_fee,slider_image,slide_local_area,slide_timestamp) 
						VALUES ('','".$_SESSION['user_id']."','".$slidegoodname."','".$slideprice."','".$slidecategories."','".$slidenumber."','".$description_g."','".$bonus."','".$new_name."','".$area."','".strtotime('now')."')") or die(db_conn_error);
 
 if (mysqli_affected_rows($connect) == 1) {
			
			$_POST = array();
			if(isset($_FILES['slideimage'])){
				$_FILES = array();
				}
			
			if(isset($_SESSION['images'])){
				unset($_FILES['slideimage'], $_SESSION['images']);
				}
			
			
			
		echo '<p class="text-success">Goods upload to slide was successful!!!</p>';
			}
 
 }else{
	$removing_the_last = mysqli_query($connect,"SELECT * FROM slider WHERE user_id_slider = '".$_SESSION['user_id']."' ORDER BY 'slide_timestamp' DESC LIMIT 15, 1") or die(db_conn_error); 
	if(mysqli_num_rows($removing_the_last) == 1){
	while($last_slide = mysqli_fetch_array($removing_the_last, MYSQLI_ASSOC)){
		$inserted_user_id = $_SESSION['user_id'];
		$inserted_id_slider = $last_slide['id_slider'];
		$inserted_goods_name = $last_slide['slide_goods_name'];
		$inserted_goods_price = $last_slide['slide_goods_price'];
		$inserted_image = $last_slide['slider_image'];
		$inserted_goods_desc = $last_slide['slide_goods_desc'];
		$inserted_goods_cat = $last_slide['slide_goods_cat'];
		$inserted_goods_number = $last_slide['slide_goods_number'];
		$inserted_bonus_fee = $last_slide['slide_bonus_fee'];
		$inserted_local_area = $last_slide['slide_local_area'];
		$inserted_timestamp = $last_slide['slide_timestamp'];
	}
	 
	mysqli_query($connect,"INSERT INTO goods(goods_id, UID, goods_name, goods_price, file_name_goods, description, categories, goods_phone_number, bonus_fee, local_area_id, goods_timestamp) 
	VALUES ('','".$inserted_user_id."','".$inserted_goods_name."','".$inserted_goods_price."','".$inserted_image."','".$inserted_goods_desc."','".$inserted_goods_cat."','".$inserted_goods_number."','".$inserted_bonus_fee."','".$inserted_local_area."','".$inserted_timestamp."')") or die(db_conn_error);	

	mysqli_query($connect, "DELETE FROM slider WHERE id_slider = '".$inserted_id_slider."'") or die(db_conn_error);	
	
	$new_name = ((isset($_SESSION['images']['new_name']))? $_SESSION['images']['new_name']:"goods_serv_pix.jpg");
	$q = mysqli_query($connect,"INSERT INTO slider(id_slider,user_id_slider, slide_goods_name,slide_goods_price,slide_goods_cat, slide_goods_number,slide_goods_desc,slide_bonus_fee,slider_image,slide_local_area,slide_timestamp) 
						VALUES ('','".$_SESSION['user_id']."','".$slidegoodname."','".$slideprice."','".$slidecategories."','".$slidenumber."','".$description_g."','".$bonus."','".$new_name."','".$area."','".strtotime('now')."')") or die(db_conn_error);
 
	if (mysqli_affected_rows($connect) == 1) {
			
			$_POST = array();
			if(isset($_FILES['slideimage'])){
				$_FILES = array();
				}
			
			if(isset($_SESSION['images'])){
				unset($_FILES['slideimage'], $_SESSION['images']);
				}
			
			
			
		echo '<p class="text-success">Goods upload to slide was successful!!!. The last product in the last slide has been moved to latest products.</p>';
			}
	
	
	}
	
 
 }
 
 
 
 
 
 }
 
 
 }
 
 
 
 
 
 
 
 }
 
 //end of slide upload
 ?>
 <?php
  //beginning of slide upload
   if (!isset($reg_errors_products)) {$reg_errors_products = array();}
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['uploadproducts'])){
	 
	if (preg_match ('/^.{3,20}$/i', trim($_POST['products_goods_name']))) {		//only 20 characters are allowed to be inputted
		$productsgoodname = mysqli_real_escape_string ($connect, trim($_POST['products_goods_name']));
	
	} else {
		$reg_errors_products['products_name'] = 'Maximum characters: 20';
	} 
	 
 
 if (preg_match ('/^[0-9]{1,10}$/', trim($_POST['products_price']))) {						//only numbers are allowed here. no decimals or commas
		$productsprice = mysqli_real_escape_string ($connect,trim($_POST['products_price']));
		} else {
		$reg_errors_products['products_price'] = 'Please enter correct price e.g 13000';
		}
		
	if (preg_match ('/0\d{10}/', trim($_POST['products_number']))) {
		$productsnumber = mysqli_real_escape_string ($connect,trim($_POST['products_number']));		//match phone number
		} else {
		$reg_errors_products['products_number'] = 'Mobile phone number only. e.g 08012345678';
		}
	
	if ($_POST['products_categories'] == "Categories") {
		$reg_errors_products['products_categories'] = 'Please choose from the category';			//same reason as above
		}else{
		$productscategories = $_POST['products_categories'];
		}

	
	if ($_POST['productscity'] == "Choose Area") {
		$reg_errors_products['productscity'] = 'Please choose Area';
	} else{
	$productsarea = $_POST['productscity'];
	}

	if (preg_match ('/^.{0,1000}+$/i', trim($_POST['productsdescription']))) {		
		$productsdescription_g = mysqli_real_escape_string ($connect, trim($_POST['productsdescription']));
		} else {
		$reg_errors_products['productsdescription'] = 'Maximum characters: 1000';
		}
		
	if(isset($_POST['productsbonus'])){				
		$productsbonus=$_POST['productsbonus'];
		}else{
		$productsbonus=0;	
		}																												
				
		

	if (is_uploaded_file($_FILES['productsimage']['tmp_name']) AND $_FILES['productsimage']['error'] == UPLOAD_ERR_OK){ 
		
			if($_FILES['productsimage']['size'] > 1048576){ 		//conditions for the file size 1MB
				$reg_errors_products['productsfile_size']="File size is too big. Max file size 1MB";
			}
		
			$productsallowed_extensions = array('jpeg', '.png', '.jpg', '.JPG', 'JPEG', '.PNG');		
			$productsallowed_mime = array('image/jpeg', 'image/png', 'image/pjpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/x-png');
			$productsimage_info = getimagesize($_FILES['productsimage']['tmp_name']);
			$productsext = substr($_FILES['productsimage']['name'], -4);
			
			
			
			
			if (!in_array($_FILES['productsimage']['type'], $productsallowed_mime) || !in_array($productsimage_info['mime'], $productsallowed_mime) || !in_array($productsext, $productsallowed_extensions)){
				$reg_errors_products['productswrong_upload'] = "Please choose correct file type. GIF images not allowed.";
				
			}
			
		}
		

	if(empty($reg_errors_products)){
	if($_FILES['productsimage']['error'] == UPLOAD_ERR_OK){
			$productsnew_name= (string) sha1($_FILES['productsimage']['name'] . uniqid('',true));
			$productsnew_name .= ((substr($productsext, 0, 1) != '.') ? ".{$productsext}" : $productsext);
			$productsdest = "assets/ItemSlider/images/".$productsnew_name;
			
			if (move_uploaded_file($_FILES['productsimage']['tmp_name'], $productsdest)) {
			
			$_SESSION['productsimages']['productsnew_name'] = $productsnew_name;
			$_SESSION['productsimages']['productsfile_name'] = $_FILES['productsimage']['name'];
			
			
			} else {
			trigger_error('The file could not be moved.');
			$reg_errors_products['not_moved'] = "The file could not be moved.";
			unlink ($_FILES['productsimage']['tmp_name']);
			}
			}
 
 
 if(empty($reg_errors_products)){

 $productsnew_name = ((isset($_SESSION['productsimages']['productsnew_name']))? $_SESSION['productsimages']['productsnew_name']:"goods_serv_pix.jpg");
 
 $productsq = mysqli_query($connect,"INSERT INTO goods(goods_id, UID, goods_name, goods_price,file_name_goods, description, categories, goods_phone_number, bonus_fee, local_area_id, goods_timestamp) 
						VALUES ('','".$_SESSION['user_id']."','".$productsgoodname."','".$productsprice."','".$productsnew_name."','".$productsdescription_g."','".$productscategories."','".$productsnumber."','".$productsbonus."','".$productsarea."','".strtotime('now')."')") or die(db_conn_error);
 
 if (mysqli_affected_rows($connect) == 1) {
			
			$_POST = array();
			if(isset($_FILES['productsimage'])){
				$_FILES = array();
				}
						
			if(isset($_SESSION['productsimages'])){
				unset($_FILES['productsimage'], $_SESSION['productsimages']);
				}
			
			
		echo '<p class="text-success">Products upload was successful!!!</p>';
			}
 }
 
 
 
 
 
 }
 
 
 
 
 
 
 }
 
 ?>
 
 <h5>Uploading to "Latest Products" will make the uploaded product appear in your e-shop and the homepage, but uploading to the next form below, "Upload to Slide" will make it appear in your e-shop in slides on Tabs and PCs.</h5>
 
 <div class="login-page">
		
	<h2>UPLOAD TO LATEST PRODUCTS</h2>
	<div class="form">
	
     
	 <form class="login-form" method="POST" action="" role="form" enctype="multipart/form-data">		
	
	<?php if (array_key_exists('products_name', $reg_errors_products)) {echo '<p class="message" style="color:red;">'.$reg_errors_products['products_name'].'</p>';}?>
	
	<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Goods name" name="products_goods_name" value="<?php if(isset($_POST['products_goods_name'])){echo $_POST['products_goods_name'];}?>"/> 
	</div>
	 
	
	<?php if (array_key_exists('products_price', $reg_errors_products)) {echo '<p class="message" style="color:red;">'.$reg_errors_products['products_price'].'</p>';}?>
	 
	<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Price e.g 1500" name="products_price" value="<?php if(isset($_POST['products_price'])){echo $_POST['products_price'];}?>"/> 
	 </div>
	
	
	<?php if (array_key_exists('products_number', $reg_errors_products)) {echo '<p class="message" style="color:red;">'.$reg_errors_products['products_number'].'</p>';}?>
	 
	<div class="form-group"> 
	<input class="form-control" type="text" placeholder="08123456789" name="products_number" value="<?php if(isset($_POST['products_number'])){echo $_POST['products_number'];}?>"/> 
	 </div>
	
<?php
$productscategories_array=array('Mobile and Tabs', 'Computers', 'Appliances', 'Clothings', 'Fashion Items', 
				'Kids Accessories', 'Vehicles', 'Vehicle Accessories','Real Estate', 'Pets','Food and Drinks', 'Groceries', 
				'Health', 'Garden', 'Home', 'Fun', 'Art');	
	
?>
<div class="form-group">
	<label for="categories">Categories</label>
<?php if (array_key_exists('products_categories', $reg_errors_products)) {echo '<p class="message" style="color:red;">'.$reg_errors_products['products_categories'].'</p>';}?>
	<select class="form-control input-sm" name="products_categories" id="categories">
		 <option>Categories</option>
			<?php
				if(isset ($_POST['products_categories'])){
					foreach ($productscategories_array as $productsoption){
						$productssel = ($productsoption==$_POST['products_categories'])?"Selected='selected'":"";
						echo '<option '.$productssel.'>'.$productsoption.'</option>';}
				}else{
						foreach ($productscategories_array as $productsoption){
						echo '<option>'.$productsoption.'</option>';
						}
				}
			?>
	</select>
	</div>

<div class="form-group">
		<label for="productsselectname"></label>
<?php if (array_key_exists('productscity', $reg_errors_products)) {echo '<p class="message" style="color:red;">'.$reg_errors_products['productscity'].'</p>';}?>		
		<select class="form-control input-sm" name="productscity" id="productsselectname">
		
		<?php include("../incs_shop/cities_signup.php"); ?>
							
	</select>
	 </div>	
	
<?php if (array_key_exists('productsdescription', $reg_errors_products)) {echo '<p class="message" style="color:red;">'.$reg_errors_products['productsdescription'].'</p>';} ?>

	<div class="form-group">
	<label for="productsdescription">Description</label>
	<textarea class="form-control" name="productsdescription" value="" id="productsdescription">
<?php if(isset($_POST['productsdescription'])){echo trim($_POST['productsdescription']);} ?>
	
</textarea>
	</div>


<input type="hidden" name="productsbonus" id="product_bonus" />


<div class="form-group">
	<label for="products_1_image_1">Image input</label>
	<?php 
	if (array_key_exists('productsfile_size', $reg_errors_products)) {echo '<p class="message" style="color:red;">'.$reg_errors_products['productsfile_size'].'</p>';}
	if (array_key_exists('productswrong_upload', $reg_errors_products)) {echo '<p class="message" style="color:red;">'.$reg_errors_products['productswrong_upload'].'</p>';}
	if (array_key_exists('productsupload_slide_image', $reg_errors_products)) {echo '<p class="message" style="color:red;">'.$reg_errors_products['productsupload_slide_image'].'</p>';}
	if (array_key_exists('productsnot_moved', $reg_errors_products)) {echo '<p class="message" style="color:red;">'.$reg_errors_products['productsnot_moved'].'</p>';}
	?>
	
	<input type="file" id="products_1_image_1" name="productsimage"/>
	</div>
	 
	 <br>
	 
	 <button type="submit" name="uploadproducts">Save to Latest Products</button>
	 </form>
	</div>	
		
		
		
		
		
		
		
		
		
		
		
		
		
		<h2>UPLOAD TO SLIDE</h2>
	<div class="form">
	
     
	 <form class="login-form" method="POST" action="" role="form" enctype="multipart/form-data">		
	
	<?php if (array_key_exists('slide_name', $reg_errors_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_slider['slide_name'].'</p>';}?>
	
	<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Goods name" name="slide_goods_name" value="<?php if(isset($_POST['slide_goods_name'])){echo $_POST['slide_goods_name'];}?>"/> 
	</div>
	 
	
	<?php if (array_key_exists('slide_price', $reg_errors_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_slider['slide_price'].'</p>';}?>
	 
	<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Price e.g 1500" name="slide_price" value="<?php if(isset($_POST['slide_price'])){echo $_POST['slide_price'];}?>"/> 
	 </div>
	
	
	<?php if (array_key_exists('slide_number', $reg_errors_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_slider['slide_number'].'</p>';}?>
	 
	<div class="form-group"> 
	<input class="form-control" type="text" placeholder="08123456789" name="slide_number" value="<?php if(isset($_POST['slide_number'])){echo $_POST['slide_number'];}?>"/> 
	 </div>
	
<?php
$categories_array=array('Mobile and Tabs', 'Computers', 'Appliances', 'Clothings', 'Fashion Items', 
				'Kids Accessories', 'Vehicles', 'Vehicle Accessories','Real Estate', 'Pets','Food and Drinks', 'Groceries', 
				'Health', 'Garden', 'Home', 'Fun', 'Art');	
	
?>
<div class="form-group">
	<label for="categories">Categories</label>
<?php if (array_key_exists('slide_categories', $reg_errors_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_slider['slide_categories'].'</p>';}?>
	<select class="form-control input-sm" name="slide_categories" id="categories">
		 <option>Categories</option>
			<?php
				if(isset ($_POST['slide_categories'])){
					foreach ($categories_array as $option){
						$sel = ($option==$_POST['slide_categories'])?"Selected='selected'":"";
						echo '<option '.$sel.'>'.$option.'</option>';}
				}else{
						foreach ($categories_array as $option){
						echo '<option>'.$option.'</option>';
						}
				}
			?>
	</select>
	</div>

<div class="form-group">
		<label for="selectname"></label>
<?php if (array_key_exists('city', $reg_errors_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_slider['city'].'</p>';}?>		
		<select class="form-control input-sm" name="city" id="selectname">
		
		<?php include("../incs_shop/cities_signup.php"); ?>
							
	</select>
	 </div>	
	
<?php if (array_key_exists('description', $reg_errors_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_slider['description'].'</p>';} ?>

	<div class="form-group">
	<label for="description">Description</label>
	<textarea class="form-control" name="description" value="" id="description">
<?php if(isset($_POST['description'])){echo trim($_POST['description']);} ?>
	
</textarea>
	</div>


<input type="hidden" name="bonus" id="slide_bonus" />
	
	
<div class="form-group">
	<label for="slide_1_image_1">Image input</label>
	<?php 
	if (array_key_exists('file_size', $reg_errors_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_slider['file_size'].'</p>';}
	if (array_key_exists('wrong_upload', $reg_errors_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_slider['wrong_upload'].'</p>';}
	if (array_key_exists('upload_slide_image', $reg_errors_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_slider['upload_slide_image'].'</p>';}
	if (array_key_exists('not_moved', $reg_errors_slider)) {echo '<p class="message" style="color:red;">'.$reg_errors_slider['not_moved'].'</p>';}
	?>
	
	<input type="file" id="slide_1_image_1" name="slideimage"/>
</div>
	 
	 <br>
	 
	 <button type="submit" name="uploadslide">Save to Slide</button>
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





