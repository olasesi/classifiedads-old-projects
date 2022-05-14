<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");

if(!isset($_SESSION['user_id']) && !isset($_SESSION['user_admin'])){
header("Location:".MYSHOPTWO);
exit();
}
?>


<?php
$header = mysqli_query($connect, "SELECT * FROM ad_header, users WHERE username = username_header AND active ='1' AND payment = '1'") or die(db_conn_error);
if(mysqli_num_rows($header) == 0){
	
if (!isset($reg_errors_header)) {$reg_errors_header = array();}
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['submit_header'])){
	 
	if (preg_match ('/^[A-Z0-9_-]{3,18}$/i', $_POST['username_header'])) {		//to use underscore 
     $header_username = mysqli_real_escape_string ($connect, $_POST['username_header']);
	
	} else {
     $reg_errors_header['username_header'] = '3-18 characters. Alphanumerals, underscores, and dashes are allowed.';
	
	}
	
	if (preg_match ('/^[A-Z0-9?\040\'.!\-",\(\)\s:();%]{3,255}+$/i', trim($_POST['header']))) {		
		$header_var = mysqli_real_escape_string ($connect, trim($_POST['header']));
	
	} else {
		$reg_errors_header['header'] = 'Header consists of invalid characters';
	} 

 if(empty($reg_errors_header)){
	
 $q = mysqli_query($connect,"INSERT INTO ad_header(ad_header_id, username_header, header, header_timestamp) 
						VALUES ('','".$header_username."','".$header_var."','".strtotime('now')."')") or die(db_conn_error);
 
 if (mysqli_affected_rows($connect) == 1) {
	header("Location:".MYSHOPTWO."/ad-header.php");
	exit();
			}
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
		<h1>INPUT HEADER</h1>
	<div class="form">
	
    <form class="login-form" method="POST" action="" role="form">';		
	
	if (array_key_exists('username_header', $reg_errors_header)) {echo '<p class="message" style="color:red;">'.$reg_errors_header['username_header'].'</p>';}
	
echo '<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Username of advertiser" name="username_header" value="';
	if(isset($_POST['slide_goods_name'])){echo $_POST['slide_goods_name'];}
echo '"/> 
	</div>
	';
	
	if (array_key_exists('header', $reg_errors_header)) {echo '<p class="message" style="color:red;">'.$reg_errors_header['header'].'</p>';}
	 
echo '<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Header" name="header" value="';
	if(isset($_POST['slide_price'])){echo $_POST['slide_price'];}
echo '"/> 
	 </div>
	 
	  <br>
	 
	 <button type="submit" name="submit_header">Submit Header</button>
	 </form>
</div>
</div>';

echo  '					</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';	
		
include("../incs_shop/footer.php");
}else{
if (!isset($reg_errors_changeheader)) {$reg_errors_changeheader = array();}
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['editheader'])){

if (preg_match ('/^[A-Z0-9?\040\'.\-",\(\)\s:();%]{3,256}+$/i', trim($_POST['changeheader']))) {		
		$header_filter = mysqli_real_escape_string ($connect, trim($_POST['changeheader']));
	
	} else {
		$reg_errors_changeheader['changeheader'] = 'Header consists of invalid characters';
	} 	

	if(empty($reg_errors_changeheader)){

	$changeq = mysqli_query($connect,"UPDATE ad_header SET header = '".$header_filter."'") or die(db_conn_error);
 
 if (mysqli_affected_rows($connect) == 1) {
	header("Location:".MYSHOPTWO."/ad-header.php");
	exit();
			}
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
		<h1>SPONSORED HEADER</h1>
	<div class="form">';	
	while($looping = mysqli_fetch_array($header)){
		echo '<h3>HEADER</h3>';
		echo '<h5>'.$looping['header'].'</h5>';
		
	}
	
echo '<form class="login-form" method="POST" action="" role="form">';

  if (array_key_exists('changeheader', $reg_errors_changeheader)) {
		echo '<p class="message" style="color:red;">'.$reg_errors_changeheader['changeheader'].'</p>';
	  }
	 
echo '<input type="text" placeholder="Edit sponsored header" name="changeheader" value="';
if(isset($_POST['changeheader'])){ echo $_POST['changeheader'];}
echo '"/>';

echo '<button type="submit" name="editheader">Change ad header</button>';

echo  '</form>';		//update header 

	
echo '<form class="login-form" method="POST" action="" role="form">
</div>
</div>';

echo  '</form>';		//delete header 










echo '							</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';	
		
include("../incs_shop/footer.php");	
	// echo the content of the header and the time left and deleting it.
}

//end of header

?>