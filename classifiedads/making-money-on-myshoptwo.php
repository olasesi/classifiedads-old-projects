<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");

$page_title = 'Earning money on Myshoptwo';					//Name of the page
$descript = 'You can earn thousands of naira daily on Myshoptwo in just these few steps. With just only one referral you can earn &#8358;3,000';		//...incomplete
include("../incs_shop/header.php");
?>

<?php



?>


<div class="container">
<div class="row">

<br>
<h1 class="text-center">HOW TO EARN A LIVING ON MYSHOPTWO</h1>
<?php
if(isset($_SESSION['user_id'])){
	echo '<h2 class="text-center">(';
	echo $_SESSION['username'];
	echo ')</h2>';

	
//Referral link is .............
	
}
?>
</br>

<div style="margin-left:12px; margin-right:8px;margin-bottom:8px;">

<p>Myshoptwo is a website that consists of several e-shops or profiles for posting one's products or services and you can also earn. To start
earning, you first signup for free. And from your dashboard, you either choose to do a &#8358;3,000 ad with us (whatsapp 09061937121 for ad) or you follow the listed steps below.<br>Earning involves referring at least one person with your referral link. And when that person (Mr 1) registers, you get &#8358;1,500. When Mr 2 comes with Mr 1
referral link and registers also, you get &#8358;500. And when Mr 3 comes to register with Mr 2 referral link, you get &#8358;500 again. It is like a multilevel marketing and you will continue to be paid till Mr 20.
You can refer again and the circle begins again. Just like in a multilevel marketing, there is a product to sell. In this case, it is advert. This means if any of Mr 1 to Mr 20 does a paid advert with us, you will be paid in the same manner again.
Your least withdrawal is &#8358;1,000. <br>

</p>
To start earning and become a premium member like others, do a paid ad with us or you follow these steps.  
</br><br>

<em><b>Step 1:</b> Signup and Login</em><br>

<em><b>Step 2:</b> Click the "Make money on Myshoptwo" button on top in your page.</em><br>

<em><b>Step 3:</b> Enter your bank details</em><br>
<?php
if(isset($_SESSION['user_id'])){

$account_details = array();
if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['update'])){
	
	if (preg_match ('/^[A-Z -]{3,100}$/i', trim($_POST['account_name']))) {		//to be updated online
		$filtered_acc_name = mysqli_real_escape_string ($connect, trim($_POST['account_name']));
	}else{
		$account_details['account_name'] = 'Account name incorrect';
	}
	
	if (preg_match ('/^[0-9]{10}$/', trim($_POST['account_number']))) {		//to be updated online
		$filtered_acc_number = mysqli_real_escape_string ($connect, trim($_POST['account_number']));
	}else{
		$account_details['account_number'] = 'Account number incorrect';
	}
	
	if ($_POST['bank'] == "Choose Bank") {
		$account_details['bank_name'] = 'Please choose a Bank';
		} else{
		$post_bank = $_POST['bank'];
		}	
	
	
	if(empty($account_details)){
	
	mysqli_query($connect,"UPDATE lookup_table SET account_name = '".$filtered_acc_name."', account_number = '".$filtered_acc_number."', bank_name = '".$post_bank."' WHERE lookup_username = '".$_SESSION['username']."'") or die(db_conn_error);	
	
	echo '<div class="alert alert-warning alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Details have now been updated </div>';
	
	}					
	
	
	}
					
					
}


if(isset($_SESSION['user_id'])){
	
	$select_bank_details = mysqli_query($connect, "SELECT account_name, account_number, bank_name FROM lookup_table WHERE lookup_username = '".$_SESSION['username']."'") or die(db_conn_error);
	$select_bank_details_array = mysqli_fetch_array($select_bank_details);
			$value_account_name = $select_bank_details_array['account_name'];
			$value_account_number = $select_bank_details_array['account_number'];
			$value_bank = ($select_bank_details_array['bank_name'] == '')?'Choose Bank':$select_bank_details_array['bank_name'];
			
	
	
}




?>

<?php
if(isset($_SESSION['user_id'])){
echo '<div class="row">
<div class="col-xs-12 col-sm-5 col-md-5">
                <a class="list-group-item active list-group-item-danger">Account Details</a>
				
				 <ul class="list-group">
				<form role="form" action="" method="POST">
					<li class="list-group-item">
					<div class="form-group">
						<label for="account_name"><i>Account Name</i></label>';
						 if (array_key_exists('account_name', $account_details)) {echo '<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$account_details['account_name'].'</div>';}
						
						echo'
						<input type="text" placeholder="Account name" class="form-control" name="account_name" id="account_name" value="';if(isset($_POST['account_name'])){ echo $_POST['account_name'];} else {echo $value_account_name;} echo '"/>
						
					</div>';
					
				echo '<div class="form-group">
						<label for="account_number"><i>Account Number</i></label>
						'; if (array_key_exists('account_number', $account_details)) {echo '<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$account_details['account_number'].'</div>';}
						
						echo '<input type="text" placeholder="Account number" class="form-control" name="account_number" id="account_number" value="'; if(isset($_POST['account_number'])){ echo $_POST['account_number'];}else{echo $value_account_number;} echo '"/>
						
					</div>';
					
					$banks = array('Access Bank','Fidelity Bank','FCMB','First Bank','GTBank','Union Bank','UBA','Zenith Bank','Ecobank','Heritage Bank','Keystone Bank','Polaris Bank','Stanbic IBTC','Standard Chartered','Sterling Bank','Unity Bank','Wema Bank');
					
				echo '<div class="form-group">
	<label for="bank">Bank Name</label>';
 if (array_key_exists('bank_name', $account_details)) {echo '<div class="alert alert-warning alert-dismissable"> 
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$account_details['bank_name'].'</div>';}
	echo '<select class="form-control input-sm" name="bank" id="bank">
		 <option ';if($value_bank == ''){ echo 'Selected="selected"'; } echo '>Choose Bank</option>';
			
			foreach($banks as $editoption){	
				if(!isset ($_POST['bank'])){
				$editsel = ($editoption==$value_bank)?"Selected='selected'":"";
				}else{
				$editsel = ($editoption==$_POST['bank'])?"Selected='selected'":"";			
				}
				echo '<option '.$editsel.'>'.$editoption.'</option>';
			}
			
	echo '</select>
	</div>';	
					
					
					
					echo '<div class="form-group">
					<button type="submit" class="btn btn-primary" name="update">Update account</button>
					</div>
					</li>
				</form>
				</ul>
</div></div>';
echo '
<div class="row">
	<div class="col-md-offset-7"></div>
</div>
';
}
?>

<em><b>Step 4:</b> Make a one-time payment of &#8358;3,000 through <a href="https://paystack.com/pay/myshoptwo" class="btn btn-primary active">Paystack</a> or to this account <b>(0037477001 Olusesi Ahmed Oladipupo, Gtbank)</b> and send the screenshot to 09061937121 and also send your username.</em><br><br>


<em><b>Step 5:</b> In a few minutes, you will become a premium user where you start earning and paid.</em><br>


<br><br><br><b>For enquiries or advert:</b><br> Call/Whatsapp: 09061937121<br>Email: info@myshoptwo.com
</div>


</div>
</div>


<?php
include("../incs_shop/footer.php");
?>