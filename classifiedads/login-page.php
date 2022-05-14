<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");
if(isset($_SESSION['user_id'])){
header("Location:".MYSHOPTWO);
exit();
}

$login_errorsl = array();
if($_SERVER['REQUEST_METHOD'] == 'POST'){

if (preg_match ('/^[A-Z0-9_-]{3,30}$/i',trim( $_POST['username']))) {
   $el = mysqli_real_escape_string ($connect,trim($_POST['username'] ));
} else {
     $login_errorsl['username'] = 'Wrong username. Please type your username exactly the way you registered it.';
}
if (!empty($_POST['pass'])) {									
   $pl = mysqli_real_escape_string ($connect,$_POST['pass']);
}else{
   $login_errorsl['pass'] = 'Please enter your password';
}


if (empty($login_errorsl)) {
    
	$rl = mysqli_query($connect, "SELECT user_id, type, firstname, lastname, username, brand_username_name, r_email, local_area, state_local_area, address, phone1, phone2, bus_email, bus_description, headline, facebook_link, instagram_link, twitter_link FROM users WHERE username='".$el."' AND password='".get_password_hash($pl)."' AND active='1' AND payment = '1'") or mysqli_error($connect);
	
	if (mysqli_num_rows($rl) == 1) {
    
	$row = mysqli_fetch_array ($rl, MYSQLI_NUM);
    
	
	$value = md5(uniqid(rand(), true));
	$query_confirm_sessions = mysqli_query ($connect, "SELECT cookie_sessions FROM users WHERE username='".$el."' AND active = '1' AND payment = '1'") or die(db_conn_error);
	$cookie_value_if_empty = mysqli_fetch_array($query_confirm_sessions);
	
	if (empty($cookie_value_if_empty[0])){
	mysqli_query($connect,"UPDATE users SET cookie_sessions = '".$value."' WHERE username='".$el."' AND active = '1' AND payment = '1'") or die(db_conn_error);		
	setcookie("remember_me", $value, time() + 30*24*3600);	
	
	}else if(!empty($cookie_value_if_empty[0])){
	
	setcookie("remember_me", $cookie_value_if_empty[0], time() + 30*24*3600);	
	}
	
	
	$_SESSION['user_id'] = $row[0];
    $_SESSION['firstname'] = $row[2];
	$_SESSION['lastname'] = $row[3];
	$_SESSION['username'] = $row[4];
    $_SESSION['brand_username_name'] = $row[5];
	$_SESSION['r_email'] = $row[6];
	$_SESSION['local_area'] = $row[7];
	$_SESSION['state_local_area'] = $row[8];
	$_SESSION['address'] = $row[9];
	$_SESSION['phone1'] = $row[10];
	$_SESSION['phone2'] = $row[11];
	$_SESSION['bus_email'] = $row[12];
	$_SESSION['bus_description'] = $row[13];
	$_SESSION['headline'] = $row[14];
	$_SESSION['facebook_link'] = $row[15];
	$_SESSION['instagram_link'] = $row[16];
	$_SESSION['twitter_link'] = $row[17];
	 
	 if ($row[1] == 'admin') $_SESSION['user_admin'] = true;
    
	
	 header("Location:".MYSHOPTWO."/".$_SESSION['username'].".php");
	 exit;
	 
	} else {
      $login_errorsl['pass'] = 'The username and password did not match.';	
}
} // End of $login_errors IF.

}
$page_title = 'Login to myshoptwo';					
$descript = 'Start getting people who need or are searching for your goods and services here. Or post the products or services you have been searching for and see several people who can help you with it. Sign up for free to see more features you can get.';
include("../incs_shop/header.php");

?>
        <!--Home page style-->
        <header id="home" class="home">
            <div class="overlay-fluid-block">
                <div class="container text-center">
                    <div class="row">
                        <div class="home-wrapper">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="home-content">

 <div class="login-page">
	<h1>LOGIN FORM</h1>
  <div class="form" >

      <form class="login-form" method="POST" action="">
	 
	 <p class="message"></p>
      
	  <?php
	  if (array_key_exists('username', $login_errorsl)) {
				echo '<p class="message" style="color:red;">'.$login_errorsl['username'].'</p>';
	  }
	 ?>
	  <label for="username">Username</label>
	 <input id="username" type="text" placeholder="username" name="username" value="<?php if(isset($_POST['username'])){ echo $_POST['username'];} ?>"/>
	 <?php
	  if (array_key_exists('pass', $login_errorsl)) {
				echo '<p class="message" style="color:red;">'.$login_errorsl['pass'].'</p>';
	  }
	  ?>
	  <label for="password">Password</label>
	 <input id="password" type="password" placeholder="password" name="pass" value="<?php if(isset($_POST['password'])){ echo '';} ?>"/>

      <button type="submit">login</button>
		
		<br/><br/>
      <p class="text-success"><a href="forgot-password.php">Forgot password?</a></p>

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