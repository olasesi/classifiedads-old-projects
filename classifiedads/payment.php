<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");
if(isset($_SESSION['user_id'])){
	 header("Location:".MYSHOPTWO);
	 exit();
	}
$page_title = 'Sign Up Registration';					//Name of the page
$descript = 'Sign up to own your own website page and advertise your goods and services. Come see those who need your goods now, and also, get paid whenever you buy a product ot service. ';
include("../incs_shop/header.php");
?>

<?php
echo '<header id="home" class="home">
            <div class="overlay-fluid-block">
                <div class="container text-center">
                    <div class="row">
                        <div class="home-wrapper">
                            <div class="text-center">
        
		<div class="home-content">
			<h3 class="text-success">Registration Successful!!!</h3>
			
			</br>
			<p>Payment status: <b>Paid</b></p>
			<p>Your e-shop is now being set up. It may take minutes to hours to complete. On completion, you can now login with your username and password. Thank You. </p>
		
		
		
		</div>
                            
							</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';
		
		
		include("../incs_shop/footer.php");
		
?>