<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");
if(isset($_SESSION['user_id'])){
header("Location:".MYSHOPTWO);
exit();
}

$page_title = 'Email Verification';

include("../incs_shop/header.php");

echo '<header id="home" class="home">
            <div class="overlay-fluid-block">
                <div class="container text-center">
                    <div class="row">
                        <div class="home-wrapper">
                            <div class="col-md-10 col-md-offset-1">';

if(isset($_GET['username']) && !empty($_GET['username']) AND isset($_GET['hash']) && !empty($_GET['hash'])){

$username = mysqli_real_escape_string($connect, $_GET['username']);	
$hash = mysqli_real_escape_string($connect, $_GET['hash']);

$search = mysqli_query($connect, "SELECT username, hash_num, active FROM users WHERE username='".$username."' AND hash_num = '".$hash."' AND active = '0' AND payment = '0'") or die(db_conn_error);
$match = mysqli_num_rows($search);

	if($match > 0){

	mysqli_query($connect, "UPDATE users SET active = '1' WHERE username='".$username."' AND hash_num='".$hash."' AND active='0' AND payment = '0'") or die(db_conn_error);	
	
	echo '<br><br><br>';
	echo '<div class="">CONGRATULATIONS!!! Your account is being processed. To complete your e-shop set up, please pay a sum of &#8358;3,000 to <b>Olusesi Ahmed Oladipupo</b> through <b>0037477001</b>(GTbank). <b>08074574512</b></div>';
	echo '<br><br><br>';
	
echo  						'</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';	
	
	
	}else{
	echo '<br><br><br>';
	echo '<div class="">The url is either invalid or expired. Please sign up again and click the link sent to you.</div>';	
	echo '<br><br><br>';
	echo  						'</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';	
	}

}else{
	echo '<br><br><br>';
	echo '<div class="">Invalid approach. Please use the link that has been sent to your email.</div>';	
	echo '<br><br><br>';
	echo  						'</div>
                        </div>
                    </div>
                </div>			
            </div>
        </header>';	
}


?>