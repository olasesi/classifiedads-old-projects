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
<div class="col-sm-6 col-md-6">
 <?php
$results = mysqli_query($connect,"SELECT id_slider, user_id_slider, slide_goods_name, slide_goods_price, slide_goods_cat, slide_goods_number, slide_goods_desc, slide_bonus_fee, slider_image, slide_local_area, slide_timestamp FROM slider WHERE id_slider = '".mysqli_real_escape_string($connect, $_GET['details'])."'") or die(db_conn_error);

if (mysqli_num_rows($results) == 1) {
	 while ($row = mysqli_fetch_array($results)) {
	
 echo '<div><h2 class="text-center text-primary">'.$row['slide_goods_name'].'</h2></div>';

	$goods_no = $_GET['details'];
	 
	 echo '<div class="text-center ">
                        <div class="thumbnail product-box">
                           <a href="full-details-slide.php?details='.$goods_no.'"> <img src="assets/ItemSlider/images/'.$row['slider_image'].'" alt="'.$row['slide_goods_name'].'" /></a>		
                            <div class="caption">
                                <h3><a href="full-details-slide.php?details='.$goods_no.'">'.$row['slide_goods_name'].'</a></h3>
                                <p>Price : <strong>&#8358;'.number_format($row['slide_goods_price']).'</strong></p>
                                <p><a href="tel:'.$row['slide_goods_number'].'" class="btn btn-success" role="button">Tel : '.$row['slide_goods_number'].'</a></p>
                            ';		//goods link to carry on to description
       
if(isset($_SESSION['user_id'])){
		if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['repost'.$goods_no])){
		$post_now = strtotime("now");
		mysqli_query($connect,"UPDATE goods SET goods_timestamp = ".$post_now." WHERE goods_id = '".mysqli_real_escape_string($connect, $goods_no)."'") or die(db_conn_error);		//this is for repost
		
		echo '<div class="alert alert-warning alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Product will be moved to the front</div>';
		}
	   }
	
	
	if (isset($_SESSION['user_id'])) {	
			
			if($_SESSION['user_id']==$row['user_id_slider']){
				echo '<form action="" method="POST">';
					echo ('<input type="hidden" name="repost'.$goods_no.'" value="" />');					
					echo ('<button type="submit" class="btn btn-danger">Repost</button>');
					
				echo '</form>';
				echo '<br>';
			}
		}

	   
	
	if(isset($_SESSION['user_id']) AND isset($user_id)){
			if($user_id == $_SESSION['user_id']){
			echo '<a href="edit-shop-slider-top.php?goods_no='.$goods_no.'"><i class="fa fa-edit"></i></a></a></li>';				
		}
		}
	
	
		echo '</div>';
		echo '</div>';
		echo '</div>';
	
	
		echo '<div class="">
		<a class="list-group-item active list-group-item-danger">Details</a>
		<ul class="list-group">
				<li class="list-group-item">
                ';

			
				if(empty($row['slide_goods_desc'])){
					echo '<em><small>No further details</small></em>';
				}else{
				echo '<p>'.$row['slide_goods_desc'].'</p>';
				}
				
		echo '</li>
		</ul>
		</div>';
	
	
	
}
}  
?>
</div>




<div class="col-sm-6 col-md-6">
<?php
include("../incs_shop/shop_review.php");
?>

</div>




</div>




</div>

<?php include("../incs_shop/footer_all.php"); ?>

