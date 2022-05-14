<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
if(isset($_SESSION['user_id'])){
	header("Location:".MYSHOPTWO);
    exit();
}

$page_title = 'Email Verification';	

include("../incs_shop/header.php");
?>

<header id="home" class="home">
            <div class="overlay-fluid-block">
                <div class="container text-center">
                    <div class="row">
                        <div class="home-wrapper">
                            <div class="col-md-10 col-md-offset-1">
                                <div class="home-content">

<?php
if(isset($_GET['username']) && !empty($_GET['username']) AND isset($_GET['hash']) && !empty($_GET['hash'])){

$username = mysqli_real_escape_string($connect, $_GET['username']);	
$hash = mysqli_real_escape_string($connect, $_GET['hash']);

$search = mysqli_query($connect, "SELECT username, hash_num, active FROM users WHERE username='".$username."' AND hash_num = '".$hash."' AND active = '0'") or die(db_conn_error);
$match = mysqli_num_rows($search);

	if($match > 0){

	mysqli_query($connect, "UPDATE users SET active = '1' WHERE username='".$username."' AND hash_num='".$hash."' AND active='0'") or die(db_conn_error);	
$contents='
<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");
include("../incs_shop/header_all.php");
include("../incs_shop/content.php");
include("../incs_shop/footer_all.php");
?>
';

	$created_file = $username.'.php';
	
	if(!file_put_contents($created_file,$contents, FILE_APPEND)){
		die('<center><div class="verify">Error: Failed to write data to '.$created_file.'</div></center>');
	}
	
	
	echo '<div class="verify">CONGRATULATIONS!!! Your account has been activated. Go to the Homepage and login now.</div>';

	}else{

	echo '<div class="verify">The url is either invalid or expired.</div>';	

	}

}else{
	
	echo '<div class="verify">Invalid approach. Please use the link that has been sent to your email.</div>';	
}
?>

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
