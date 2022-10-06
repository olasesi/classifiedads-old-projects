<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");
if(isset($_SESSION['user_id'])){
	 header("Location:".MYSHOPTWO);
	 exit();
	}
$page_title = 'Sign Up Registration';					//Name of the page
$descript = 'Sign up now for free to start getting customers for your goods and services. Also post what you need (goods or services) and you will see alot of people who will answer you.';
include("../incs_shop/header.php");
?>
<?php
if (!isset($reg_errors)) {$reg_errors = array();}

if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submitting_form'])){    //though the browser will take you to the next stage if everything is set except "Choose City". But php will ensure that a city is checked.
	
	//edit 1
	if (preg_match ('/^[A-Z\'\. -]{3,30}$/i', $_POST['first_name'])) {		//only 30 characters are allowed to be inputted
		$fn = mysqli_real_escape_string ($connect, trim($_POST['first_name']));
	
	
	} else {
		$reg_errors['first_name'] = 'Please enter your first name';
	
	}
	//edit 1
	if (preg_match ('/^[A-Z\'\. -]{3,30}$/i', $_POST['last_name'])) {
     $ln = mysqli_real_escape_string ($connect, trim($_POST['last_name']));
	
	} else {
     $reg_errors['last_name'] = 'Please enter your last name';
	
	}
	if (preg_match ('/^[A-Z0-9_-]{3,30}$/i', $_POST['username'])) {		//to use underscore and dashes
     $u = mysqli_real_escape_string ($connect, $_POST['username']);
	
	} else {
     //edit 1
	 $reg_errors['username'] = 'Please remove spaces, and total characters must be 3-30. Underscores and dashes could be used.';
	
	}
	 //edit 1
	if (preg_match ('/^[A-Z0-9 \'.-]{3,20}$/i', $_POST['brand_username_name'])) {		//should numbers be allowed to be included.
     $b = mysqli_real_escape_string ($connect, trim($_POST['brand_username_name']));
	
	} else {
     $reg_errors['brand_username_name'] = 'Please enter the name of your e-shop/business. 3-20 characters only';
	
	}
	//edit 1
	if (filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
     $e = mysqli_real_escape_string ($connect, $_POST['email']);			
	
	} else {
     $reg_errors['email'] = 'Please enter a valid email address';
	
	}
	if (preg_match ('/^.{6,255}+$/', $_POST['pass1'])) {
		if ($_POST['pass1'] == $_POST['pass2']) {
          $p = mysqli_real_escape_string ($connect, $_POST['pass1']);
		
		} else {
           $reg_errors['pass2'] = 'The password did not match';
		   
		   }
	} else {
     $reg_errors['pass1'] = 'Please enter password. Minimum of 6 characters';
	
	}
	if ($_POST['city'] == "Choose Area") {
		
		$reg_errors['city'] = 'Please choose Area';
	} else{
	$area = $_POST['city'];
	}
	
	if (empty($reg_errors)) {
	$file_name = $_SERVER['DOCUMENT_ROOT'].'/'. BASE_URL_NO_SLASHES .'/'.strtolower($u).'.php';		//!!!DANGER DANGER!! DANGER!! Filenames(not usernames) should be lowercase for now. To be dealt with very well
		if (file_exists($file_name)) {
		 $reg_errors['username'] = 'Username already exist. Only letters, numbers, dashes and underscores are allowed. No spaces. 3-30 characters';
		}
	
	}
	
	
	
	if (empty($reg_errors)) {
    
	 $q = "SELECT username FROM users WHERE LOWER(username) = '".strtolower($u)."'";
     $r = mysqli_query ($connect, $q);
    $rows = mysqli_num_rows($r);
  
	if ($rows == 0) { // No problem	
	$hashs=md5(rand(0,1000));	
	
	
	$statecode = mysqli_query($connect, "SELECT state_name FROM local_area WHERE area='".$area."'");
	while($while_statecode = mysqli_fetch_array($statecode)){
		
		$user_state=$while_statecode['state_name'];
		}
	
	$business_description = "Visit us to see all our products and services. They are all of high quality and are affordable. Click now to explore.";		//150 characters
	$nows = strtotime('now');
	
	$q_query = "INSERT INTO users (firstname, lastname, username, brand_username_name, password, r_email, local_area, state_local_area, bus_description, hash_num, time_registered) VALUES 
	('".$fn."','".$ln."','".$u."','".$b."', '".get_password_hash($p)."', '".$e."', '".$area."', '".$user_state."','".$business_description."','".$hashs."','".$nows."')";
	
	
	$r_query = mysqli_query($connect, $q_query);
	
	if(mysqli_affected_rows($connect) == 1){
		
$contents='<?php include("../incs_shop/users.php"); ?>';
$created_file = $u.'.php';
	
	if(!file_put_contents($created_file, $contents, FILE_APPEND)){
		die('<div class="text-center text-danger">Error: Failed to write data to '.$created_file.'</div>');
	}

//share
		//referral
		/*if (empty($reg_errors)) {
		if(isset($_GET['ref']) AND !empty($_GET['ref']) AND strlen($_GET['ref']) <= 30 AND strlen($_GET['ref']) >= 3){
			$referral = mysqli_real_escape_string ($connect, $_GET['ref']);
			
			
			$if_referral_exist = mysqli_query($connect,"SELECT lookup_username FROM users, lookup_table WHERE username = lookup_username AND lookup_username = '".$referral."' AND payment_status = '1' AND active = '1' AND payment = '1'") or die(db_conn_error);
			
			//$if_referral_exist_array = mysqli_fetch_array($if_referral_exist);
			//$finding_if_referee_exist = $if_referral_exist_array['lookup_username'];
			
			$confirm_rows_referrals = mysqli_num_rows($if_referral_exist);
			if($confirm_rows_referrals == 1){
			//This is for those that came with referal
			//First is to confirm if there are 21 people in the group.
			//inserting the complete value of in the row 
			//inserting in the lookup table. This has a confirmed referral.
			mysqli_query($connect, "INSERT INTO lookup_table (id_lookup_table, lookup_username, account_name, account_number, bank_name, payment_status, total_cash_to_withdraw, lookup_timestamp) VALUES ('','".$u."','','','','0','0','".$nows."')") or die(db_conn_error);
			//
			$query_knowing_the_id = mysqli_query($connect, "SELECT id_lookup_table FROM lookup_table WHERE lookup_username = '".$u."'") or die(db_conn_error);
			$array_knowing_the_id = mysqli_fetch_array($query_knowing_the_id);
			$know_lookup = $array_knowing_the_id['id_lookup_table'];
			
			
			
			//Selecting the row(s) of the (lookup, referral joined table). The row(s) having the referral's name are to be selected.
			$query_num_of_people = mysqli_query($connect, "SELECT ref_level, ref_group, id_lookup_table2 FROM referral, lookup_table WHERE lookup_username = ref_username AND ref_username = '".$referral."' AND payment_status = '1'") or die(db_conn_error);
			$value_num_of_people = mysqli_num_rows($query_num_of_people);
		
			$query_num_of_people_other = mysqli_query($connect, "SELECT ref_referrer FROM referral WHERE ref_referrer = '".$referral."'") or die(db_conn_error);
			$value_num_of_people_other = mysqli_num_rows($query_num_of_people_other);
			
			
			if($value_num_of_people == 1 AND $value_num_of_people_other == 0){
				
			$query_num_of_people_array = mysqli_fetch_array($query_num_of_people);
			$know_your_level = $query_num_of_people_array['ref_level'];
			$know_group = $query_num_of_people_array['ref_group'];
				
			$inc_know_your_level = $know_your_level + 1;	//confirmed
			
			mysqli_query($connect, "INSERT INTO referral (ref_id, id_lookup_table2, ref_referrer, ref_username, ref_group, ref_level, ref_total_cash, ref_withdrawal, ref_timestamp) VALUES ('', '".$know_lookup."','".$referral."','".$u."','".$know_group."','".$inc_know_your_level."','0','0', '".$nows."')") or die(db_conn_error);
			
			}else{
			
			$or_auto_max_value = mysqli_query($connect, "SELECT MAX(ref_group) AS maximum FROM referral");
			$or_auto_max_value_array = mysqli_fetch_array($or_auto_max_value);
			$or_auto_max_value_inc = $or_auto_max_value_array['maximum'] + 1;
		
			$id_of_referral_in_lookup = mysqli_query($connect, "SELECT id_lookup_table FROM lookup_table WHERE lookup_username = '".$referral."' AND payment_status = '1'") or die(db_conn_error);
			$val_id_of_referral_in_lookup = mysqli_fetch_array($id_of_referral_in_lookup);
			$arr_val_id_of_referral_in_lookup = $val_id_of_referral_in_lookup['id_lookup_table'];
			//inserting into the previous row before inserting into its own row
			mysqli_query($connect, "INSERT INTO referral (ref_id, id_lookup_table2, ref_referrer, ref_username, ref_group, ref_level, ref_total_cash, ref_withdrawal, ref_timestamp) VALUES ('', '".$arr_val_id_of_referral_in_lookup."','OR','".$referral."','".$or_auto_max_value_inc."','1','0','0', '".$nows."')") or die(db_conn_error);
			
			mysqli_query($connect, "INSERT INTO referral (ref_id, id_lookup_table2, ref_referrer, ref_username, ref_group, ref_level, ref_total_cash, ref_withdrawal, ref_timestamp) VALUES ('', '".$know_lookup."','".$referral."','".$u."','".$or_auto_max_value_inc."','2','0','0', '".$nows."')") or die(db_conn_error);
				
			}
			
		
			
			
			}elseif($confirm_rows_referrals == 0){
				
				mysqli_query($connect, "INSERT INTO lookup_table (id_lookup_table, lookup_username, account_name, account_number, bank_name, payment_status, total_cash_to_withdraw, lookup_timestamp) VALUES ('','".$u."','','','','0','0','".$nows."')") or die(db_conn_error);
				$search_id_of_lookup = mysqli_query($connect, "SELECT id_lookup_table FROM lookup_table WHERE lookup_username = '".$u."'") or die(db_conn_error);		//to know the id of the lookup_table
				$value_id_of_lookup = mysqli_fetch_array($search_id_of_lookup);
				$arr_value_id_of_lookup = $value_id_of_lookup['id_lookup_table'];
			
				$max_value = mysqli_query($connect, "SELECT MAX(ref_group) AS maximum FROM referral");
				$max_value_array = mysqli_fetch_array($max_value);
				$max_group_value = $max_value_array['maximum'] + 1;
			
				mysqli_query($connect, "INSERT INTO referral (ref_id, id_lookup_table2, ref_referrer, ref_username, ref_group, ref_level, ref_total_cash, ref_withdrawal, ref_timestamp) VALUES ('', '".$arr_value_id_of_lookup."','NR','".$u."','".$max_group_value."','1','0', '0','".$nows."')") or die(db_conn_error);	
		
				
			}
			
		}else{
			//This is for those that came on their own or has invalid referral. They will have NR		
			
			mysqli_query($connect, "INSERT INTO lookup_table (id_lookup_table, lookup_username, account_name, account_number, bank_name, payment_status, total_cash_to_withdraw, lookup_timestamp) VALUES ('','".$u."','','','','0','0','".$nows."')") or die(db_conn_error);
				$search_id_of_lookup_wrong = mysqli_query($connect, "SELECT id_lookup_table FROM lookup_table WHERE lookup_username = '".$u."'") or die(db_conn_error);		//to know the id of the lookup_table
				$value_id_of_lookup_wrong = mysqli_fetch_array($search_id_of_lookup_wrong);
				$arr_value_id_of_lookup_wrong = $value_id_of_lookup_wrong['id_lookup_table'];
				//searching for the last group value
				$max_value_wrong = mysqli_query($connect, "SELECT MAX(ref_group) AS maximum FROM referral");
				$max_value_array_wrong = mysqli_fetch_array($max_value_wrong);
				$max_group_value_wrong = $max_value_array_wrong['maximum'] + 1;
				//
				
				mysqli_query($connect, "INSERT INTO referral (ref_id, id_lookup_table2, ref_referrer, ref_username, ref_group, ref_level, ref_total_cash, ref_withdrawal, ref_timestamp) VALUES ('', '".$arr_value_id_of_lookup_wrong."','NR','".$u."','".$max_group_value_wrong."','1','0','0','".$nows."')") or die(db_conn_error);	
		
		}
		
		
		}*/
		//referral
		//share	
	
	
	

$body = '
<div style="max-width:1000px; margin-left:auto; margin-right:auto;">
	<div style="font-size:14px; margin-top:50px;">
	<center><h1 style="color:#f5f5f5; background-color:#161616; text-shadow:1px 1px 1px #a2a2a2; padding-top:10px; padding-bottom:10px; text-transform:uppercase;">'.$b.' e-shop set up</h1></center>
	<p>CONGRATULATIONS!!!.<span style="text-transform:capitalize;">'.$b.'</span> has now been set up. Login with your username and password to enter.</p>
	
	
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
		
		mail($e, 'My Shop Two - Registration', $headers);	
		
		//edit 1
		echo '<header id="home" class="home">
            <div class="overlay-fluid-block">
                <div class="container text-center">
                    <div class="row">
                        <div class="home-wrapper">
                            <div class="text-center">
        
		<div class="home-content">
			<h3 class="text-success">Registration Successful!!!</h3>
			
			</br>
			Please click the link sent to your inbox to verify your email. If you did not find it, please check your spam mails.
		
		
		
		</div>
                            
							</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';
		//<a href="https://paystack.com/pay/myshoptwo" class="btn btn-primary active">Pay with Paystack</a>
		
		include("../incs_shop/footer.php");
		exit();
	
	}else{
      trigger_error('You could not be registered due to a system error. We apologize for any inconvenience.');
	}
	
	}else{
     
	 $reg_errors['username'] = 'This username has already been registered. Please try another.';
	   
	 } // End of $rows == 0 IF.
     } // End of empty($reg_errors) IF.
} // End of the main form submission conditional.	   
	

?>
  <header id="home" class="home">
            <div class="overlay-fluid-block">
                <div class="container text-center">
                    <div class="row">
                        <div class="home-wrapper">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="home-content">

 <div class="login-page">
		<h1>SIGNUP FORM</h1>
  <div class="form">
	<p class="message1"><a></a></p>
     
	 <form class="login-form" method="POST" action="signup-page.php<?php //if(isset($_GET['ref'])){ echo "?ref=".$_GET['ref'];}?>" role="form">
	 <div class="form-group">
	 
	 <p class="message1"></p>
 
	  <?php
	  if (array_key_exists('first_name', $reg_errors)) {
				echo '<p class="message" style="color:red;">'.$reg_errors['first_name'].'</p>';
	  }?>
	  <label for="firstname">First name</label>
	 <input id="firstname" type="text" placeholder="e.g Robert" name="first_name" value="<?php if(isset($_POST['first_name'])){ echo $_POST['first_name'];}  ?>"/>
	<?php
	  if (array_key_exists('last_name', $reg_errors)) {
				echo '<p class="message" style="color:red;">'.$reg_errors['last_name'].'</p>';
	  }?>
	 <label for="lastname">Last name</label>
	<input id="lastname" type="text" placeholder="e.g Johnson" name="last_name" value="<?php if(isset($_POST['last_name'])){ echo $_POST['last_name'];} ?>"/>
	<?php
	  if (array_key_exists('username', $reg_errors)) {
				echo '<p class="message" style="color:red;">'.$reg_errors['username'].'</p>';
	  }?>
	 <label for="username">Username</label> 
	<input id="username" type="text" placeholder="e.g johnson_clothings" name="username" value="<?php if(isset($_POST['username'])){ echo $_POST['username'];} ?>"/>
	 <?php
	  if (array_key_exists('brand_username_name', $reg_errors)) {
				echo '<p class="message" style="color:red;">'.$reg_errors['brand_username_name'].'</p>';
	  }?>
	  <label for="businessname">Name of business</label> 
	<input id="businessname" type="text" placeholder="e.g Johnson Clothings" name="brand_username_name" value="<?php if(isset($_POST['brand_username_name'])){ echo $_POST['brand_username_name'];} ?>"/> 
	 <?php
	  if (array_key_exists('email', $reg_errors)) {
				echo '<p class="message" style="color:red;">'.$reg_errors['email'].'</p>';
	  }?>
	 <label for="email">Email Address</label>
	 <input id="email" type="text" placeholder="e.g robertj@gmail.com" name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];} ?>"/>
	 <?php
	  if (array_key_exists('pass1', $reg_errors)) {
				echo '<p class="message" style="color:red;">'.$reg_errors['pass1'].'</p>';
	  }
	 ?>
      <?php
	  if (array_key_exists('pass2', $reg_errors)) {
				echo '<p class="message" style="color:red;">'.$reg_errors['pass2'].'</p>';
	  }
	 ?>
	<label for="password">Password</label>
	 <input id="password" type="password" placeholder="Password" name="pass1" value="<?php if(isset($_POST['password'])){ echo '';}  ?>"/>
	 
	 <label for="confirmpassword">Confirm password</label>
	 <input id="confirmpassword" type="password" placeholder="Confirm password" name="pass2" value="<?php if(isset($_POST['password'])){ echo '';}  ?>"/>
	 
	 
	 <?php
	  if (array_key_exists('city', $reg_errors)) {
				echo '<p class="message" style="color:red;">'.$reg_errors['city'].'</p>';
	  }
	?>
	 
	 <label for="name">Local Government of Business</label>
	 <select class="form-control" name="city">
	<?php
	include("../incs_shop/cities_signup.php");
	?>
	 </select>
	 <br><br>
	 
	 
	 
	  <button type="submit" name="submitting_form">Register</button>

      
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
include("../incs_shop/footer.php");
?>