<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");

if(isset($_SESSION['user_id'])){
header("Location:".MYSHOPTWO);
exit();
}






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
	











?>