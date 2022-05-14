<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");
if(!isset($_SESSION['user_id'])){
	 header("Location:".MYSHOPTWO);
	 exit();
	}
$page_title = 'Edit my Shop';					
$descript = 'Edit shop name, contact, headline, slider, etc';		//change, delete, etc

?>
<?php
if (!isset($reg_errors_contact)) {$reg_errors_contact = array();}

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['save_contact'])){    
	
	if (preg_match ('/^[A-Z0-9 \'.-]{3,20}$/i', trim($_POST['brand_username_name']))) {		
     $b = mysqli_real_escape_string ($connect, trim($_POST['brand_username_name']));
	
	} else {
     $reg_errors_contact['brand_username_name'] = 'Please enter a shop name. 3-20 characters';
	
	}
	
	if (filter_var($_POST['bus_email'], FILTER_VALIDATE_EMAIL)) {
     $bus= mysqli_real_escape_string ($connect, $_POST['bus_email']);			
	
	} else {
     $reg_errors_contact['bus_email'] = 'Please enter a valid email address';
	
	}
	
	if (preg_match ('/0\d{10}/', trim($_POST['phone1']))) {
	$phone1 = mysqli_real_escape_string ($connect,trim($_POST['phone1']));		
	} else {
	$reg_errors_contact['phone1'] = 'Mobile phone numbers only. e.g 08012345678';
	}
	
	if (preg_match ('/0\d{10}/', trim($_POST['phone2']))) {
	$phone2 = mysqli_real_escape_string ( $connect,trim($_POST['phone2']));		
	} else {
	$reg_errors_contact['phone2'] = 'Mobile phone numbers only. e.g 08012345678';
	}
	
	if (preg_match ('/^.{0,150}+$/i', trim($_POST['description']))) {	//50-150 characters for description	
	$bus_info = mysqli_real_escape_string ($connect, trim($_POST['description']));
	} else {
	$reg_errors_contact['bus_description'] = 'Please delete invalid characters. Only 0-150 characters are allowed.';
	}
	
	if (preg_match ('/^.{0,100}+$/i', trim($_POST['address']))) {	//60 characters for address	
	$add = mysqli_real_escape_string ($connect, trim($_POST['address']));
	} else {
	$reg_errors_contact['address'] = 'Please delete invalid characters. Only 0-100 characters are allowed.';
	}
	
	if ($_POST['city'] == "Choose Area") {
	$reg_errors_contact['city'] = 'Please choose Area';
	}else{
	$area = $_POST['city'];
	}
	
	if (preg_match ('/^.{0,100}+$/i', trim($_POST['headline']))) {	//maybe 100 characters for description	
	$tophead = mysqli_real_escape_string ($connect, trim($_POST['headline']));
	} else {
	$reg_errors_contact['array_tophead'] = 'Please delete invalid characters. Only 0-100 characters are allowed';
	}
	
	if (filter_var($_POST['facebook'], FILTER_VALIDATE_URL) OR empty($_POST['facebook'])) {
     $facebook_link= mysqli_real_escape_string ($connect, trim($_POST['facebook']));			
	} else {
     $reg_errors_contact['facebook'] = 'Please enter the correct URL of your facebook page';
	}
	
	if (filter_var($_POST['instagram'], FILTER_VALIDATE_URL) OR empty($_POST['instagram'])) {
     $instagram_link= mysqli_real_escape_string ($connect, trim($_POST['instagram']));			
	} else {
     $reg_errors_contact['instagram'] = 'Please enter the correct URL of your instagram page';
	}
	
	if (filter_var($_POST['twitter'], FILTER_VALIDATE_URL) OR empty($_POST['twitter'])) {
     $twitter_link= mysqli_real_escape_string ($connect, trim($_POST['twitter']));			
	} else {
     $reg_errors_contact['twitter'] = 'Please enter the correct URL of your twitter page';
	}
	
	
	if (empty($reg_errors_contact)) {
    
	$statecode_contact = mysqli_query($connect, "SELECT state_name FROM local_area WHERE area='".$area."'");
	while($while_statecode_contact = mysqli_fetch_array($statecode_contact)){
		
		$user_state_contact=$while_statecode_contact['state_name'];
		}
	
	$update_query_contact = mysqli_query($connect,"UPDATE users SET brand_username_name = '".$b."', local_area = '".$area."', state_local_area = '".$user_state_contact."', address = '".$add."', phone1 = '".$phone1."', phone2 = '".$phone2."', bus_email = '".$bus."', bus_description = '".$bus_info."', headline = '".$tophead."', facebook_link = '".$facebook_link."', instagram_link = '".$instagram_link."', twitter_link = '".$twitter_link."' WHERE user_id = '".$_SESSION['user_id']."' AND active='1' AND payment = '1'") or die(db_conn_error);	// another condition to be added to it.(if paid, or not)
	 
	if (mysqli_affected_rows($connect) == 1) {
		
	
	$_SESSION['brand_username_name'] = $b;
	$_SESSION['address'] = $add;
	$_SESSION['phone1'] = $phone1;
	$_SESSION['phone2'] = $phone2;
	$_SESSION['bus_email'] = $bus;
	$_SESSION['local_area'] = $area;
	$_SESSION['state_local_area'] = $user_state_contact;
	$_SESSION['bus_description'] = $bus_info;		
	$_SESSION['headline'] = $tophead;	
	$_SESSION['facebook_link'] = $facebook_link;		
	$_SESSION['instagram_link'] = $instagram_link;	
	$_SESSION['twitter_link'] = $twitter_link;
	
		header("Location:".MYSHOPTWO."/".$_SESSION['username'].".php");		//confirm that editing has been done by displaying successful in the shop page
		exit();
		
		
	} 
	
	
	
	
	
	
	
     }
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
		<h1>EDIT SHOP CONTACT</h1>
  <div class="form">
	<p class="message1"><a></a></p>
     
	 <form class="login-form" method="POST" action="" role="form">
	
		<?php
	  if (array_key_exists('brand_username_name', $reg_errors_contact)) {echo '<p class="message" style="color:red;">'.$reg_errors_contact['brand_username_name'].'</p>';}
	  ?>
	<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Shop name" name="brand_username_name" value="<?php if(!isset($_POST['brand_username_name'])){echo $_SESSION['brand_username_name'];}else{echo $_POST['brand_username_name'];} ?>"/> 
	 </div>
	 <?php
	  if (array_key_exists('bus_email', $reg_errors_contact)) {echo '<p class="message" style="color:red;">'.$reg_errors_contact['bus_email'].'</p>';}
	  ?>
	  <div class="form-group">
	 <label for="bus_mail">Email for your customers enquiries</label>
	<input class="form-control" id="bus_mail" type="text" placeholder="Business email" name="bus_email" value="<?php if(!isset($_POST['bus_email'])){echo $_SESSION['bus_email'];}else{echo $_POST['bus_email'];} ?>"/> 
	 </div>
	  <?php
	  if (array_key_exists('phone1', $reg_errors_contact)) {echo '<p class="message" style="color:red;">'.$reg_errors_contact['phone1'].'</p>';}
	  ?>
	<div class="form-group">
	<input class="form-control" type="text" placeholder="Phone number 1" name="phone1" value="<?php if(!isset($_POST['phone1'])){echo $_SESSION['phone1'];}else{echo $_POST['phone1'];} ?>"/>
	 </div>
	  <?php
	  if (array_key_exists('phone2', $reg_errors_contact)) {echo '<p class="message" style="color:red;">'.$reg_errors_contact['phone2'].'</p>';}
	  ?>
	  <div class="form-group">
	<input class="form-control" type="text" placeholder="Phone number 1" name="phone2" value="<?php if(!isset($_POST['phone2'])){echo $_SESSION['phone2'];}else{echo $_POST['phone2'];} ?>"/>
	 </div>
	 
	 
	 <?php
	  if (array_key_exists('city', $reg_errors_contact)) {echo '<p class="message" style="color:red;">'.$reg_errors_contact['city'].'</p>';}

	?>
	 <div class = "form-group">
	 <label for="name">My Shop Location</label>
	 <select class="form-control" class="form-control" name="city" id="name">
	<?php
	include("../incs_shop/cities_signup_edit.php");
	?>
	 </select>
	</div>
	
	 <?php
	  if (array_key_exists('bus_description', $reg_errors_contact)) {echo '<p class="message" style="color:red;">'.$reg_errors_contact['bus_description'].'</p>';}

	?>
	<div class="form-group">
	<label for="bus_description">Business Description</label><br>
	<textarea class="form-control" name="description" value="" id="bus_description"><?php if(!isset($_POST['description'])){echo $_SESSION['bus_description'];}else{echo $_POST['description'];} ?></textarea>
	
	</div> 
	 
	 
	 
	 <?php
	  if (array_key_exists('address', $reg_errors_contact)) {echo '<p class="message" style="color:red;">'.$reg_errors_contact['address'].'</p>';}

	?>
	<div class="form-group">
	<label for="address">Location</label>
	<textarea class="form-control" name="address" value="" id="address"><?php if(!isset($_POST['address'])){echo $_SESSION['address'];}else{echo $_POST['address'];} ?></textarea>
	
	</div>
	
	 <?php
	  if (array_key_exists('array_tophead', $reg_errors_contact)) {echo '<p class="message" style="color:red;">'.$reg_errors_contact['array_tophead'].'</p>';}

	?>
	<div class="form-group">
	<label for="headline">Header</label><br>
	<em><small>The top information in the blue box of your e-shop</small></em>
	<textarea class="form-control" name="headline" value="" id="headline"><?php if(!isset($_POST['headline'])){echo $_SESSION['headline'];}else{echo $_POST['headline'];} ?></textarea>
	
	</div> 
	
	<?php
	  if (array_key_exists('facebook', $reg_errors_contact)) {echo '<p class="message" style="color:red;">'.$reg_errors_contact['facebook'].'</p>';}
	  ?>
	  <div class="form-group">
	 <label for="fb">Your facebook business page link </label><br>
	 <em><small>(optional)</small></em>
	<input class="form-control" id="fb" type="text" placeholder="Facebook page URL" name="facebook" value="<?php if(!isset($_POST['facebook'])){echo $_SESSION['facebook_link'];}else{echo $_POST['facebook'];} ?>"/> 
	 </div>
	
	 <?php
	  if (array_key_exists('twitter', $reg_errors_contact)) {echo '<p class="message" style="color:red;">'.$reg_errors_contact['twitter'].'</p>';}
	  ?>
	  <div class="form-group">
	 <label for="twitter">Your twitter page link</label><br>
	 <em><small>(optional)</small></em>
	<input class="form-control" id="twitter" type="text" placeholder="Twitter page URL" name="twitter" value="<?php if(!isset($_POST['twitter'])){echo $_SESSION['twitter_link'];}else{echo $_POST['twitter'];} ?>"/> 
	 </div>
	
	 <?php
	  if (array_key_exists('instagram', $reg_errors_contact)) {echo '<p class="message" style="color:red;">'.$reg_errors_contact['instagram'].'</p>';}
	  ?>
	  <div class="form-group">
	 <label for="instagram">Your instagram page link</label><br>
	 <em><small>(optional)</small></em>
	<input class="form-control" id="instagram" type="text" placeholder="Instagram page URL" name="instagram" value="<?php if(!isset($_POST['instagram'])){echo $_SESSION['instagram_link'];}else{echo $_POST['instagram'];} ?>"/> 
	 </div>
	<br>
	 
	 
	 
	  <button type="submit" name="save_contact">Save</button>

      
	</div>
    </form>

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