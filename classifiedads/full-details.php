<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");
if(!isset($_GET['details']) OR empty($_GET['details'])){
header("Location:".MYSHOPTWO);
	exit();		
}
include("../incs_shop/header_all.php");
?>

<div class="container">
<div class="row">
<div class="col-sm-4 col-md-4">
 

 <?php
$results = mysqli_query($connect,"SELECT goods_id, UID, goods_name, goods_price, file_name_goods, description, categories, goods_phone_number, bonus_fee, local_area_id, goods_timestamp FROM goods WHERE goods_id = '".mysqli_real_escape_string($connect, $_GET['details'])."'") or die(db_conn_error);

if (mysqli_num_rows($results) == 1) {
	 while ($row = mysqli_fetch_array($results)) {
	 echo '<div><h2 class="text-center text-primary">'.$row['goods_name'].'</h2></div>';

	$goods_no = $_GET['details'];
	 
	 echo '<div class="text-center">
                        <div class="thumbnail product-box">
                           <a href="full-details.php?details='.$goods_no.'"> <img src="assets/ItemSlider/images/'.$row['file_name_goods'].'" alt="'.$row['goods_name'].'" /></a>		
                            <div class="caption">
                                <h3><a href="full-details.php?details='.$goods_no.'">'.$row['goods_name'].'</a></h3>
                                <p>Price : <strong>&#8358;'.number_format((int)$row['goods_price']).'</strong></p>
                                <p><a href="Tel:'.$row['goods_phone_number'].'" class="btn btn-success" role="button">Tel : '.$row['goods_phone_number'].'</a></p>';		//goods link to carry on to description
                    
	  //edit                
	if(isset($_SESSION['user_id'])){
		if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['repost'.$goods_no])){
		$post_now = strtotime("now");
		mysqli_query($connect,"UPDATE goods SET goods_timestamp = ".$post_now." WHERE goods_id = '".mysqli_real_escape_string($connect, $goods_no)."'") or die(db_conn_error);		//this is for repost
		
		echo '<div class="alert alert-warning alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Product will be moved to the top in the homepage</div>';
		}
	   }
	
	
	if (isset($_SESSION['user_id'])) {	
			
			if($_SESSION['user_id']==$row['UID']){
				echo '<form action="" method="POST">';
					echo ('<input type="hidden" name="repost'.$goods_no.'" value="" />');					
					echo ('<button type="submit" class="btn btn-danger">Repost</button>');
					
				echo '</form>';
				echo '<br>';
			}
		}
	
	//edit

		
		
		if(isset($_SESSION['user_id']) AND isset($user_id)){
			if($user_id == $_SESSION['user_id']){
			echo '<a href="edit-shop-slider.php?goods_no='.$goods_no.'"><i class="fa fa-edit"></i></a></a></li>';				
		}
		}
		
		echo '</div>';
		echo '</div>';
		echo '</div>';
		
		echo '<div>
		
				<a class="list-group-item active list-group-item-danger">Details</a>
                <ul class="list-group">
				<li class="list-group-item">
				';

			
				if(empty($row['description'])){
					echo '<em><small>No further details</small></em>';
				}else{
				echo '<p>'.$row['description'].'</p>';
				}
				
		echo '
		</li>
		</ul>
		</div>';
		
		
		
		
		
		
	
}
}  
?>
 </div>


 
 
 <div class="col-sm-4 col-md-4">
  <a class="list-group-item active list-group-item-danger">Product Review</a>
 <ul class="list-group">
				<li class="list-group-item">
               
				<div>
				<?php
				if (isset($_POST['product_rate_shop']) AND isset($_POST['product_rate'])){
				
				$product_getting_ip_double = getuserip();
				$product_choosing_rater = (isset($_SESSION['user_id']))?$_SESSION['user_id']:$product_getting_ip_double;
				$product_entering_ip = (isset($_SESSION['user_id']))? 0 : $product_getting_ip_double;
				
				$product_finding_if_rated_double = mysqli_query($connect, "SELECT * FROM rating WHERE user_id_rating_goods = '".$product_choosing_rater."' AND goods_id_to_rate = '".$goods_no."'") or die(db_conn_error);
				if(mysqli_num_rows($product_finding_if_rated_double) == 0){
				
				$product_rate_time = strtotime('now');
				$product_insert_rating=mysqli_query($connect,"INSERT INTO rating (rating_id, goods_id_to_rate, user_id_rating_goods, ratings, ip_goods_rater, time_goods_rating) VALUES ('', '".$goods_no."', '".$product_choosing_rater."', '".$_POST['product_rate']."', '".$product_entering_ip."','".$product_rate_time."')") or die(db_conn_error);
				echo ('<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Thank you for Rating!!!</div>');
				}
				
				}elseif(isset($_POST['product_rate_shop']) AND !isset($_POST['product_rate'])){
				echo ('<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Please choose a rating</div>');
					
				}
				
				
				
				?>
				</div>
				
				<div>
				<?php
				$product_select_rating = mysqli_query($connect, "SELECT * FROM rating WHERE goods_id_to_rate = '".$goods_no."' AND ip_goods_rater = '0'") or die(db_conn_error);
				
				$product_total = mysqli_num_rows($product_select_rating);
				$product_ratingar = array();

				while($product_row=mysqli_fetch_array($product_select_rating, MYSQLI_ASSOC)){
	
				$product_ratingar[]=$product_row['ratings'];
				}

				if($product_total==0){				
				$product_total_rating=0;		 
				}else{
				$product_total_rating=(array_sum($product_ratingar)/$product_total);
				}

			
				echo("<center><div>");
				echo "<br><small>Product rating by other shop owners</small><br>";
				
				for($product_x=1;$product_x<=$product_total_rating;$product_x++){	
				echo("<img src='assets/vectors/star.png' id='' class=''/>");
				}
				while ($product_x<=5){
				echo("<img src='assets/vectors/star2.png' id='' class=''/>");
				$product_x++;
				}

				echo ("<br><small>".custom_number_format($product_total)." Vote(s) </small>");
				echo "</div></center>";
				
				?>
				
				</div>
				
				
				
				<div>
				<?php
				$product_select_rating_un = mysqli_query($connect, "SELECT * FROM rating WHERE goods_id_to_rate = '".$goods_no."' AND ip_goods_rater != '0'") or die(db_conn_error);
				
				$product_total_un=mysqli_num_rows($product_select_rating_un);
				$product_ratingar_un = array();

				while($product_row_un=mysqli_fetch_array($product_select_rating_un, MYSQLI_ASSOC)){
	
				$product_ratingar_un[]=$product_row_un['ratings'];
				}

				if($product_total_un==0){				
				$product_total_rating_un=0;		 
				}else{
				$product_total_rating_un=(array_sum($product_ratingar_un)/$product_total_un);
				}

			
				echo("<center><div class='rating_box'>");
				echo "<br><small>Product rating by guest users</small><br>";
				
				for($product_x_un=1;$product_x_un<=$product_total_rating_un;$product_x_un++){	
				echo '<i class="fa fa-star"></i>';
				//echo("<img src='assets/vectors/star.png' id='product_rate1' class='rate'/>");
				}
				while ($product_x_un<=5){
				echo '<i class="fa fa-star-o"></i>';
				//echo("<img src='assets/vectors/star2.png' id='' class='rate'/>");
				$product_x_un++;
				}

				echo ("<br><small>".custom_number_format($product_total_un)." Vote(s) </small>");
				echo "</div></center>";
				echo "<br>";
				?>
				
				</div>
				<?php
				
				$product_getting_ip = getuserip();
				$product_userid_or_ipaddress = (isset($_SESSION['user_id']))?$_SESSION['user_id']:$product_getting_ip;
				
				$product_finding_if_rated = mysqli_query($connect, "SELECT * FROM rating WHERE user_id_rating_goods = '".$product_userid_or_ipaddress."' AND goods_id_to_rate = '".$goods_no."'") or die(db_conn_error);
				
				if(mysqli_num_rows($product_finding_if_rated) == 0){
				
				echo 
				'<form role="form" action="" method="POST">
					<div class="form-group">
						<label for="product_search_username"><i>Rate by shop reliability</i></label><br>
						
						<label class="radio-inline">
						<input type="radio" name="product_rate" value="5">A
						</label>
						<label class="radio-inline">
						<input type="radio" name="product_rate" value="4">B
						</label>
						<label class="radio-inline">
						<input type="radio" name="product_rate" value="3">C
						</label>
						<label class="radio-inline">
						<input type="radio" name="product_rate" value="2">D
						</label>
						<label class="radio-inline">
						<input type="radio" name="product_rate" value="1">E
						</label>
					
					</div>
					<div class="form-group">
					<button type="submit" name="product_rate_shop" class="btn btn-primary">Rate</button>
					</div>
				</form>';
				
				}
				
				echo '<hr>';
				
				
				
				
				
				
				echo '<label><i>Comments on Product</i></label>';
				
				$product_select_shop_comment = mysqli_query($connect, "SELECT * FROM goods_comment WHERE UID_of_goods_in_comment_table = '".$goods_no."' ORDER BY id_goods_comment DESC LIMIT 0, 10") or die(db_conn_error);
				if(mysqli_num_rows($product_select_shop_comment) > 0){
				
				while($product_select_shop_comment_arr = mysqli_fetch_array($product_select_shop_comment)){
					
					echo '<p><i class="fa fa-square"></i> <small><i>'.$product_select_shop_comment_arr['comment_on_goods'].'</i></small></p>';
					
				}
				}else{
					echo '<br><em><small>No comments on Product</small></em>';
				}
				
				/*
				################
				POSTING COMMENTS
				################
				*/
				$product_need_form_array_comment = array();
				if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['product_comment'])){
					if (preg_match ('/^[A-Z0-9\'.\-, \(\)&]{3,100}$/i', $_POST['product_write_comment'])) {		
					$product_comment = mysqli_real_escape_string ($connect, $_POST['product_write_comment']);				//max lenght of character 
					
					} else {
					$product_need_form_array_comment['product_comment'] = 'Please only 3 to 100 characters. No invalid characters allowed';
					
					}	
					
				if(empty($product_need_form_array_comment)){
				
				$product_getting_ip_comment = getuserip();													
				$product_entering_ip_comment = (isset($_SESSION['user_id']))?$_SESSION['user_id']:$product_getting_ip_comment;	
				$product_choosing_rater_comment = (isset($_SESSION['user_id']))?0:$product_getting_ip_comment;		
				
				
				$product_result_comment = mysqli_query($connect, "SELECT * FROM goods_comment WHERE UID_of_goods_in_comment_table = '".$goods_no."' AND user_id_of_commenter = '".$product_entering_ip_comment."'") or die(db_conn_error);
				if(mysqli_num_rows($product_result_comment) == 0){
				
				
				mysqli_query($connect, "INSERT INTO goods_comment(id_goods_comment, UID_of_goods_in_comment_table, user_id_of_commenter, comment_on_goods, ip_address_goods_commenter, time_goods_commenter) VALUES ('', '".$goods_no."','".$product_entering_ip_comment."', '".$product_comment."', '".$product_choosing_rater_comment."', '".strtotime('now')."')") or die(db_conn_error);		
				
				echo '<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Comment has been submitted!!! </div>';
				
				}	
				
				}
				
				
				
				
				
				}
				
				$product_getting_ip_comment_re = getuserip();													
				$product_entering_ip_comment_re = (isset($_SESSION['user_id']))?$_SESSION['user_id']:$product_getting_ip_comment_re;
				
				$product_result_comment = mysqli_query($connect, "SELECT * FROM goods_comment WHERE UID_of_goods_in_comment_table = '".$goods_no."' AND user_id_of_commenter = '".$product_entering_ip_comment_re."'") or die(db_conn_error);
				if(mysqli_num_rows($product_result_comment) == 0){
				
				if (array_key_exists('product_comment', $product_need_form_array_comment)) {echo '<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$product_need_form_array_comment['product_comment'].'</div>';}
				
				
				echo '
				<form role="form" action="" method="POST">
					<div class="form-group">
						
						<input type="text" placeholder="Write comment" class="form-control" name="product_write_comment" 
						value="';
						if(isset($_POST['product_write_comment'])){echo $_POST['product_write_comment'];}
				echo	'"/>
					</div>
					<div class="form-group">
					<button type="submit" name="product_comment" class="btn btn-primary">Comment</button>
					</div>
				
				</form>';
				}
				?>
				
				</li>
				
				</ul>
</div>
 
 <div class="col-sm-4 col-md-4">
<?php
include("../incs_shop/shop_review.php");
?>
</div>
 
 
 
</div>
</div>




<?php include("../incs_shop/footer_all.php"); ?>

