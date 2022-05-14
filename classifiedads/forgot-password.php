<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");

if(isset ($_SESSION['user_id'])){
	header("Location:".MYSHOPTWO);
	 exit();
}

$page_title = 'Forgot Password';

include("../incs_shop/header.php");

echo '<header id="home" class="home">
            <div class="overlay-fluid-block">
                <div class="container text-center">
                    <div class="row">
                        <div class="home-wrapper">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="home-content">';

if (!isset($reg_errors)) {$reg_errors = array();}

if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['sendpass'])){
		
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
   
		$email_forgot_pass = mysqli_real_escape_string ($connect,$_POST['email'] );
		
		} else {
		$reg_errors['email'] = 'Email address is invalid';
		}
	
	
	
		if (empty($reg_errors)) {
		
		$r = mysqli_query ($connect, "SELECT r_email FROM users WHERE r_email='".$email_forgot_pass."' AND active='1' AND payment = '1'") or die(db_conn_error);
		
		if (mysqli_num_rows($r) == 1) { // No problem	
		$hash=md5(rand(0,1000));
		
		$this_moment = strtotime('now');
		mysqli_query($connect, "UPDATE users SET forgot_password = '".$hash."', forget_link_expiry = '".$this_moment."' WHERE r_email='".$email_forgot_pass."' AND active='1' AND payment = '1'") or die(db_conn_error);
		
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: noreply@'.BASE_URL_NO_WWW. "\r\n";
		$headers .= 'Reply-To: noreply@'.BASE_URL_NO_WWW. "\r\n";
		$headers .= 'Return-Path: noreply@'.BASE_URL_NO_WWW. "\r\n";
		$headers .= 'BCC: noreply@'.BASE_URL_NO_WWW. "\r\n";
		$headers .= 'X-Priority: 3' . "\r\n";
		$headers .= 'X-Mailer: PHP/'. phpversion() . "\r\n";
		
		$body = "
		PASSWORD RESET - Please click this link to reset your myshoptwo password:
		<a href='http://".BASE_URL_NO_SLASHES."/password-reset.php?hash=".$hash."'> http://".BASE_URL_NO_SLASHES."/password-reset.php?hash=".$hash."</a>";	//changed
		
		mail($email_forgot_pass, 'Password Reset - Myshoptwo', $body, $headers);
		



		
		echo '<br><br><br>';
		echo '<div>Your password reset link has been sent to your email.</div>
		<div><b>If you did not see the mail in your inbox, please check your spam mails. </b></div>';
		echo '<br>';
		echo '<br>';
      
echo '                              </div>
                            </div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';
		
		
		
		
		include("../incs_shop/footer.php");
		}else{
		echo '<br><br><br>';
		echo '<div>Your password reset link has been sent to your email.</div>
		<div><b>If you did not see the mail in your inbox, please check your spam mails.</b> </div>';
		echo '<br>';	
		echo '<br>';
		
		echo '                              </div>
                            </div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';

		include("../incs_shop/footer.php");

		
		}
			
		exit();
	
	}
	}	

?>
<div class="login-page">
	<h1>FORGOT PASSWORD?</h1>
  <div class="form" >

      <form class="login-form" method="POST" action="">
	 
	 
      
	  <?php
	  if (array_key_exists('email', $reg_errors)) {
				echo '<p class="message" style="color:red;">'.$reg_errors['email'].'</p>';
	  }
	 ?>
	 <input type="text" placeholder="Enter your email" name="email" value="<?php if(isset($_POST['email'])){ echo $_POST['email'];} ?>"/>
	
      <button type="submit" name="sendpass" >Submit</button>
		
		
    </form>

  </div>

</div>


<?php
echo '                              </div>
                            </div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';

		include("../incs_shop/footer.php");

?>

