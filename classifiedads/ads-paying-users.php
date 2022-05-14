<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
if(!isset($_SESSION['user_id']) && !isset($_SESSION['user_admin'])){
header("Location:".MYSHOPTWO);
exit();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['withdraw$id_of_user_in_lookup'])){
	
	$withdrawn_cash = $_POST['withdraw$id_of_user_in_lookup'];
	mysqli_query($connect, "UPDATE lookup_table SET total_cash_to_withdraw = '0' WHERE id_lookup_table = '".$withdrawn_cash."'") or die(db_conn_error);
}

include("../incs_shop/header.php");
?>

<div class="container">
<div class="row">
<?php
$withdrawcash = mysqli_query($connect, "SELECT * FROM lookup_table WHERE total_cash_to_withdraw >= '1000' LIMIT 0, 30") or die(db_conn_error);
while($whiling_cash_withdraw = mysqli_fetch_array($withdrawcash)){
	echo '<div class="col-md-4 text-center col-sm-6 col-xs-12">';
	echo 'Cash payment:'.$whiling_cash_withdraw['total_cash_to_withdraw'];
	
	
	
	$id_of_user_in_lookup = $whiling_cash_withdraw['id_lookup_table'];
	echo '<form action="" method="POST">';
		echo ('<input type="hidden" name="withdraw$id_of_user_in_lookup" value="'.$id_of_user_in_lookup.'"/>');
		echo ('<button type="submit" class="btn btn-danger">Pay user</button>');
	echo '</form>';
	
	
	echo '</div>';

	
}

?>



</div>
</div>

<?php include("../incs_shop/footer.php"); ?>
