<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");

if(isset ($_SESSION['user_id'])){
	header("Location:".MYSHOPTWO);
	 exit();
}

$page_title = 'Password Reset';	
include("../incs_shop/header.php");

echo '<header id="home" class="home">
            <div class="overlay-fluid-block">
                <div class="container text-center">
                    <div class="row">
                        <div class="home-wrapper">
                            <div class="col-md-10 col-md-offset-1">';

if(isset($_GET['hash']) && !empty($_GET['hash'])){		
	
$hash = mysqli_real_escape_string($connect, $_GET['hash']);

$search = mysqli_query($connect, "SELECT * FROM users WHERE forgot_password = '".$hash."' AND active = '1' AND payment = '1'") or die(db_conn_error); 
$match = mysqli_num_rows($search);

	if($match > 0){
	

	if (!isset($reg_errors)) {$reg_errors = array();}
	
	
	if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['resetpass'])) { 
	
	if (preg_match ('/^[A-Z0-9_-]{3,18}$/i', $_POST['username1'])) {		//to use underscore and dash
     $us = mysqli_real_escape_string ($connect, $_POST['username1']);
	
	} else {
     $reg_errors['username1'] = '3-18 characters. Alphanumerals, underscores, and dashes are allowed.';
	
	}
	
	if (preg_match ('/^.{6,256}+$/', $_POST['pass1'])) {
		if ($_POST['pass1'] == $_POST['pass2']) {
          $p = mysqli_real_escape_string ($connect, $_POST['pass1']);
		
		} else {
           $reg_errors['pass2'] = 'The password did not match.';
		   }
	
	} else {
     $reg_errors['pass1'] = 'Please enter password. Minimum of 6 characters.';
	}
	
	
	
	if (empty($reg_errors)) {
	
	$no_result_query = mysqli_query($connect, "SELECT username, forgot_password FROM users WHERE username = '".$us."' AND forgot_password = '".$hash."'") or die(db_conn_error);
	if (mysqli_num_rows($no_result_query) == 1) { 
	
		$update_query=mysqli_query($connect, "UPDATE users SET password = '".get_password_hash($p)."' WHERE username = '".$us."' AND active = '1' AND payment = '1'") or die(db_conn_error);
		$delete_forget_pass_hash=mysqli_query($connect, "UPDATE users SET forgot_password='', forget_link_expiry = '' WHERE username = '".$us."' AND active = '1' AND payment = '1'") or die(db_conn_error);
	
	echo '<br><br><br>';
	echo '<div class="">Your Password has been reset and you can log in now.</div>';	
	echo '<br><br><br>';
	echo  '					</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';	
	
	include("../incs_shop/footer.php");
	
	
	exit();
	}else{
	
	echo '<br><br><br>';
	echo '<div class="">The link is incorrect or expired.</div>';	
	echo '<br><br><br>';
	echo  '					</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';		
	
	include("../incs_shop/footer.php");
	
	exit();
	
	}
	
	}
	
	}
	
	
echo '<div class="login-page">
	<h1>PASSWORD RESET</h1>
  <div class="form">

      <form class="login-form" method="POST" action="">
	 
	 <p class="message"></p>';
      
	  
	  if (array_key_exists('username1', $reg_errors)) {
				echo '<p class="message" style="color:red;">'.$reg_errors['username1'].'</p>';
	  }
	 
echo '<input type="text" placeholder="Enter your username" name="username1" value="';
if(isset($_POST['username1'])){ echo $_POST['username1'];}
echo '"/>';
 
 if (array_key_exists('pass1', $reg_errors)) {
				echo '<p class="message" style="color:red;">'.$reg_errors['pass1'].'</p>';
	  }	
 if (array_key_exists('pass2', $reg_errors)) {
				echo '<p class="message" style="color:red;">'.$reg_errors['pass2'].'</p>';
	  }	
echo '<input type="password" placeholder="Choose your new password" name="pass1" value=""/>
	<input type="password" placeholder="Confirm password" name="pass2" value=""/>
      
	  <button type="submit" name="resetpass">Reset</button>
		
		<br/><br/>
     

    </form>

  </div>

</div>';

echo '<br><br><br>';
	echo  '					</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';		
	
	include("../incs_shop/footer.php");
	
	}else{
	echo '<br><br><br>';
	echo '<div class="">The url link from your email is invalid or expired.</div>';	
	echo '<br><br><br>';
	echo  '					</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';		
	
	include("../incs_shop/footer.php");
	}

}else{
	echo '<br><br><br>';
	echo '<div class="">Invalid approach. Please use the link that was sent to your email.</div>';
	echo '<br><br><br>';
	echo  '					</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';		
	
	include("../incs_shop/footer.php");
}
?>