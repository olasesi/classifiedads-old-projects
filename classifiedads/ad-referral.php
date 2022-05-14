<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");

if(!isset($_SESSION['user_id']) && !isset($_SESSION['user_admin'])){
header("Location:".MYSHOPTWO);
exit();
}
?>










<?php
include("../incs_shop/header.php");



echo '<header id="home" class="home">
            <div class="overlay-fluid-block">
                <div class="container text-center">
                    <div class="row">
                        <div class="home-wrapper">
                            <div class="col-md-10 col-md-offset-1">';
echo '<div class="login-page">
		<h1>REFERRAL PAYMENT</h1>
	<div class="form">';	
	
////////////////////////////////////////////////////////////////	

	if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['confirm$var_lookup_username'])){
		$var_lookup_username = $_POST['confirm$var_lookup_username'];
		mysqli_query($connect, "UPDATE lookup_table SET payment_status = '1' WHERE lookup_username = '".$var_lookup_username."' AND payment_status = '0'") or die(db_conn_error);
			if (mysqli_affected_rows($connect) == 1){
			$selecting_group = mysqli_query($connect,"SELECT ref_group, ref_level FROM referral WHERE ref_username = '".$var_lookup_username."' AND ref_referrer != 'OR'") or die(db_conn_error);
			$selecting_group_array = mysqli_fetch_array($selecting_group);
			$your_group = $selecting_group_array['ref_group'];
			$your_level = $selecting_group_array['ref_level'];
			//$start = $your_level - 5;	//20
			//$begin = $start - 1;
			//if($begin < 0){
				//$begin = 0;
			//}
			
			
			$selecting_the_results = mysqli_query($connect,"SELECT ref_total_cash, ref_level FROM referral WHERE ref_group = '".$your_group."' AND ref_level < '".$your_level."' ORDER BY ref_level DESC LIMIT 0, 20") or die(db_conn_error); //20
			while($calculations = mysqli_fetch_array($selecting_the_results)){
				$calc_each_level = $calculations['ref_level'];
				
				$select_from_levels = mysqli_query($connect, "SELECT ref_total_cash, ref_level FROM referral WHERE ref_group = '".$your_group."' AND ref_level = '".$calc_each_level."'") or die(db_conn_error);
				$select_from_levels_fetched = mysqli_fetch_array($select_from_levels);
				$cash = $select_from_levels_fetched['ref_total_cash'];
				
				
				
				//$range = $your_level - $calc_each_level;
				
				
				if($your_level <= 21){	//21
					switch(mysqli_num_rows($selecting_the_results)){
						case 1:
							switch($calc_each_level){
							case 1:
							$token = 1500;
							break;
							}
							break;
					
						case 2:
							switch($calc_each_level){
							case 1:
							$token = 500;
							break;
							
							case 2:
							$token = 1500;
							break;
							}
							break;
					
						case 3:
							switch($calc_each_level){
							case 1:
							$token = 500;
							break;
							case 2:
							$token = 500;
							break;
							case 3:
							$token = 1500;
							break;
							}
							break;
						
						case 4:
							switch($calc_each_level){
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 500;
							break;
							case 3:
							$token = 500;
							break;
							case 4:
							$token = 1500;
							break;
							}
							break;
					
						case 5:
							switch($calc_each_level){
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 0;
							break;
							case 3:
							$token = 500;
							break;
							case 4:
							$token = 500;
							break;
							case 5:
							$token = 1500;
							break;
							}
							break;
							
							case 6:
							switch($calc_each_level){
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 0;
							break;
							case 3:
							$token = 0;
							break;
							case 4:
							$token = 500;
							break;
							case 5:
							$token = 500;
							break;
							case 6:
							$token = 1500;
							break;
							}
							break;
					
							case 7:
							switch($calc_each_level){
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 0;
							break;
							case 3:
							$token = 0;
							break;
							case 4:
							$token = 0;
							break;
							case 5:
							$token = 500;
							break;
							case 6:
							$token = 500;
							break;
							case 7:
							$token = 1500;
							break;
							}
							break;
					
							case 8:
							switch($calc_each_level){
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 0;
							break;
							case 3:
							$token = 0;
							break;
							case 4:
							$token = 0;
							break;
							case 5:
							$token = 0;
							break;
							case 6:
							$token = 500;
							break;
							case 7:
							$token = 500;
							break;
							case 8:
							$token = 1500;
							break;
							}
							break;
					
							case 9:
							switch($calc_each_level){
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 0;
							break;
							case 3:
							$token = 0;
							break;
							case 4:
							$token = 0;
							break;
							case 5:
							$token = 0;
							break;
							case 6:
							$token = 0;
							break;
							case 7:
							$token = 500;
							break;
							case 8:
							$token = 500;
							break;
							case 9:
							$token = 1500;
							break;
							}
							break;
							
							case 10:
							switch($calc_each_level){
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 0;
							break;
							case 3:
							$token = 0;
							break;
							case 4:
							$token = 0;
							break;
							case 5:
							$token = 0;
							break;
							case 6:
							$token = 0;
							break;
							case 7:
							$token = 0;
							break;
							case 8:
							$token = 500;
							break;
							case 9:
							$token = 500;
							break;
							case 10:
							$token = 1500;
							break;
							}
							break;
					
							case 11:
							switch($calc_each_level){
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 0;
							break;
							case 3:
							$token = 0;
							break;
							case 4:
							$token = 0;
							break;
							case 5:
							$token = 0;
							break;
							case 6:
							$token = 0;
							break;
							case 7:
							$token = 0;
							break;
							case 8:
							$token = 0;
							break;
							case 9:
							$token = 500;
							break;
							case 10:
							$token = 500;
							break;
							case 11:
							$token = 1500;
							break;
							}
							break;
					
							case 12:
							switch($calc_each_level){
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 0;
							break;
							case 3:
							$token = 0;
							break;
							case 4:
							$token = 0;
							break;
							case 5:
							$token = 0;
							break;
							case 6:
							$token = 0;
							break;
							case 7:
							$token = 0;
							break;
							case 8:
							$token = 0;
							break;
							case 9:
							$token = 0;
							break;
							case 10:
							$token = 500;
							break;
							case 11:
							$token = 500;
							break;
							case 12:
							$token = 1500;
							break;
							}
							break;
					
							case 13:
							switch($calc_each_level){
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 0;
							break;
							case 3:
							$token = 0;
							break;
							case 4:
							$token = 0;
							break;
							case 5:
							$token = 0;
							break;
							case 6:
							$token = 0;
							break;
							case 7:
							$token = 0;
							break;
							case 8:
							$token = 0;
							break;
							case 9:
							$token = 0;
							break;
							case 10:
							$token = 0;
							break;
							case 11:
							$token = 500;
							break;
							case 12:
							$token = 500;
							break;
							case 13:
							$token = 1500;
							break;
							}
							break;
					
							case 14:
							switch($calc_each_level){
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 0;
							break;
							case 3:
							$token = 0;
							break;
							case 4:
							$token = 0;
							break;
							case 5:
							$token = 0;
							break;
							case 6:
							$token = 0;
							break;
							case 7:
							$token = 0;
							break;
							case 8:
							$token = 0;
							break;
							case 9:
							$token = 0;
							break;
							case 10:
							$token = 0;
							break;
							case 11:
							$token = 0;
							break;
							case 12:
							$token = 500;
							break;
							case 13:
							$token = 500;
							break;
							case 14:
							$token = 1500;
							break;
							}
							break;
					
							case 15:
							switch($calc_each_level){
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 0;
							break;
							case 3:
							$token = 0;
							break;
							case 4:
							$token = 0;
							break;
							case 5:
							$token = 0;
							break;
							case 6:
							$token = 0;
							break;
							case 7:
							$token = 0;
							break;
							case 8:
							$token = 0;
							break;
							case 9:
							$token = 0;
							break;
							case 10:
							$token = 0;
							break;
							case 11:
							$token = 0;
							break;
							case 12:
							$token = 0;
							break;
							case 13:
							$token = 500;
							break;
							case 14:
							$token = 500;
							break;
							case 15:
							$token = 1500;
							break;
							}
							break;
							
							case 16:
							switch($calc_each_level){
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 0;
							break;
							case 3:
							$token = 0;
							break;
							case 4:
							$token = 0;
							break;
							case 5:
							$token = 0;
							break;
							case 6:
							$token = 0;
							break;
							case 7:
							$token = 0;
							break;
							case 8:
							$token = 0;
							break;
							case 9:
							$token = 0;
							break;
							case 10:
							$token = 0;
							break;
							case 11:
							$token = 0;
							break;
							case 12:
							$token = 0;
							break;
							case 13:
							$token = 0;
							break;
							case 14:
							$token = 500;
							break;
							case 15:
							$token = 500;
							break;
							case 16:
							$token = 1500;
							break;
							}
							break;
							
							case 17:
							switch($calc_each_level){
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 0;
							break;
							case 3:
							$token = 0;
							break;
							case 4:
							$token = 0;
							break;
							case 5:
							$token = 0;
							break;
							case 6:
							$token = 0;
							break;
							case 7:
							$token = 0;
							break;
							case 8:
							$token = 0;
							break;
							case 9:
							$token = 0;
							break;
							case 10:
							$token = 0;
							break;
							case 11:
							$token = 0;
							break;
							case 12:
							$token = 0;
							break;
							case 13:
							$token = 0;
							break;
							case 14:
							$token = 0;
							break;
							case 15:
							$token = 500;
							break;
							case 16:
							$token = 500;
							break;
							case 17:
							$token = 1500;
							break;
							}
							break;
							
							case 18:
							switch($calc_each_level){
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 0;
							break;
							case 3:
							$token = 0;
							break;
							case 4:
							$token = 0;
							break;
							case 5:
							$token = 0;
							break;
							case 6:
							$token = 0;
							break;
							case 7:
							$token = 0;
							break;
							case 8:
							$token = 0;
							break;
							case 9:
							$token = 0;
							break;
							case 10:
							$token = 0;
							break;
							case 11:
							$token = 0;
							break;
							case 12:
							$token = 0;
							break;
							case 13:
							$token = 0;
							break;
							case 14:
							$token = 0;
							break;
							case 15:
							$token = 0;
							break;
							case 16:
							$token = 500;
							break;
							case 17:
							$token = 500;
							break;
							case 18:
							$token = 1500;
							break;
							}
							break;
							
							case 19:
							switch($calc_each_level){
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 0;
							break;
							case 3:
							$token = 0;
							break;
							case 4:
							$token = 0;
							break;
							case 5:
							$token = 0;
							break;
							case 6:
							$token = 0;
							break;
							case 7:
							$token = 0;
							break;
							case 8:
							$token = 0;
							break;
							case 9:
							$token = 0;
							break;
							case 10:
							$token = 0;
							break;
							case 11:
							$token = 0;
							break;
							case 12:
							$token = 0;
							break;
							case 13:
							$token = 0;
							break;
							case 14:
							$token = 0;
							break;
							case 15:
							$token = 0;
							break;
							case 16:
							$token = 0;
							break;
							case 17:
							$token = 500;
							break;
							case 18:
							$token = 500;
							break;
							case 19:
							$token = 1500;
							break;
							}
							break;
							
							case 20:
							switch($calc_each_level){
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 0;
							break;
							case 3:
							$token = 0;
							break;
							case 4:
							$token = 0;
							break;
							case 5:
							$token = 0;
							break;
							case 6:
							$token = 0;
							break;
							case 7:
							$token = 0;
							break;
							case 8:
							$token = 0;
							break;
							case 9:
							$token = 0;
							break;
							case 10:
							$token = 0;
							break;
							case 11:
							$token = 0;
							break;
							case 12:
							$token = 0;
							break;
							case 13:
							$token = 0;
							break;
							case 14:
							$token = 0;
							break;
							case 15:
							$token = 0;
							break;
							case 16:
							$token = 0;
							break;
							case 17:
							$token = 0;
							break;
							case 18:
							$token = 500;
							break;
							case 19:
							$token = 500;
							break;
							case 20:
							$token = 1500;
							break;
							}
							break;
					}
					
				}else{
			 
				switch($calc_each_level - ($calc_each_level % 20)){	//20
							case 1:
							$token = 0;
							break;
							case 2:
							$token = 0;
							break;
							case 3:
							$token = 0;
							break;
							case 4:
							$token = 0;
							break;
							case 5:
							$token = 0;
							break;
							case 6:
							$token = 0;
							break;
							case 7:
							$token = 0;
							break;
							case 8:
							$token = 0;
							break;
							case 9:
							$token = 0;
							break;
							case 10:
							$token = 0;
							break;
							case 11:
							$token = 0;
							break;
							case 12:
							$token = 0;
							break;
							case 13:
							$token = 0;
							break;
							case 14:
							$token = 0;
							break;
							case 15:
							$token = 0;
							break;
							case 16:
							$token = 0;
							break;
							case 17:
							$token = 0;
							break;
							case 18:
							$token = 500;
							break;
							case 19:
							$token = 500;
							break;
							case 20:
							$token = 1500;
							break;
							}
							
					
				}
				
				$sumup_cash = $cash + $token;
			
			mysqli_query($connect, "UPDATE referral SET ref_total_cash = '".$sumup_cash."' WHERE ref_group = '".$your_group."' AND ref_level = '".$calc_each_level."'") or die(mysqli_error());
			}
			
				
			}
			
			echo '<h3 class="text-success"><center>Payment has been confirmed!!!</center></h3>';

	}



if (!isset($payment_error)) {$payment_error = array();}
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['payment'])){

if (preg_match ('/^[A-Z0-9_-]{3,30}$/i', $_POST['search_username'])) {		//only 30 characters are allowed to be inputted
		$search_username = mysqli_real_escape_string ($connect, trim($_POST['search_username']));
	} else {
		$payment_error['payment_confirm'] = 'Incorrect username';
	}

if (empty($payment_error)) {
    $admin_referral_exist = mysqli_query($connect, "SELECT * FROM lookup_table, users WHERE username = lookup_username AND lookup_username = '".$search_username."' AND payment_status = '0'") or die(db_conn_error);
	$admin_rows_referrals = mysqli_num_rows($admin_referral_exist);
	if($admin_rows_referrals == 1){
		$array_referral_exist = mysqli_fetch_array($admin_referral_exist);
		$var_firstname = $array_referral_exist['firstname'];
		$var_lastname = $array_referral_exist['lastname'];
		$var_lookup_username = $array_referral_exist['lookup_username'];
		
		echo '<p class="text-center">'.$var_lastname.', '.$var_firstname.'</p>';
		echo '<p class="text-center">'.$var_lookup_username.'</p>';
		
		echo '<form action="" method="POST">';
					echo ('<input type="hidden" name="confirm$var_lookup_username" value="'.$var_lookup_username.'" />');					
					echo ('<button type="submit" class="btn btn-danger">Confirm payment</button>');
					
				echo '</form>';
				echo '<br>';
		
		
			
			}else{
				
			echo '<h3 class="text-danger"><center>No such user or payment has already been made.</center></h3>';		
			}
			
		}
		
	
	}else{
		$payment_error['payment_incorrect'] = 'Username is incorrect.';
		
	}
	





	
echo '<form class="login-form" method="POST" action="" role="form">';	
if (array_key_exists('payment_confirm', $payment_error)) {echo '<p class="message" style="color:red;">'.$payment_error['payment_confirm'].'</p>';}
if (array_key_exists('payment_incorrect', $payment_error)) {echo '<p class="message" style="color:red;">'.$payment_error['payment_incorrect'].'</p>';}
echo '<div class="form-group"> 
	<input class="form-control" type="text" placeholder="Username search" name="search_username" value="';
	if(isset($_POST['search_username'])){echo $_POST['search_username'];}
echo '"/> 
	</div>';
	echo '<button type="submit" name="payment">Search Username</button>
	 </form>
	 </div>
	 </div>
	 ';
	
echo '
                    </div>
                </div>			
            </div>
        </header>';	
?>




<?php include("../incs_shop/footer.php"); ?>		