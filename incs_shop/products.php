<?php
$page = (int)(!isset($_GET["page"]) ? 1 : $_GET["page"]);
if ($page <= 0) $page = 1;

$per_page = 12; 								// Set how many records do you want to display per page.

$startpoint = ($page * $per_page) - $per_page;
 
$results = mysqli_query($connect,"SELECT goods_id, UID, goods_name, goods_price, file_name_goods, description, categories, goods_phone_number, bonus_fee, local_area_id, goods_timestamp FROM ".$statement." LIMIT $startpoint, $per_page") or die(db_conn_error);

if (mysqli_num_rows($results) != 0){
	 while ($row = mysqli_fetch_array($results)) {
	 $goods_no = $row['goods_id'];
	 
	 echo '<div class="col-md-4 text-center col-sm-6 col-xs-12">
                        <div>
						<div class="thumbnail product-box">
                          <a href="full-details.php?details='.$goods_no.'"><img style="height:150px; width:200px;" src="assets/ItemSlider/images/'.$row['file_name_goods'].'" alt="'.$row['goods_name'].'" /></a>		
                            <div class="caption">
                                <h4><a href="full-details.php?details='.$goods_no.'">'.$row['goods_name'].'</a></h4>
                                <p>Price : <strong>&#8358;'.number_format((int)$row['goods_price']).'</strong></p>
                                <p><a href="tel:'.$row['goods_phone_number'].'" class="btn btn-success" role="button">Call</a> <a href="full-details.php?details='.$goods_no.'" class="btn btn-primary" role="button">Details</a></p>
                            ';		//goods link to carry on to description
    //edit                
	/*if(isset($_SESSION['user_id'])){
		if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['repost'.$goods_no])){
		$post_now = strtotime("now");
		mysqli_query($connect,"UPDATE goods SET goods_timestamp = ".$post_now." WHERE goods_id = '".mysqli_real_escape_string($connect, $goods_no)."'") or die(db_conn_error);		//this is for repost
		
		echo '<div class="alert alert-warning alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Product will be moved to the top in the homepage</div>';
		}
	   }*/
	
	
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
	$select_rating=mysqli_query($connect,"SELECT ratings FROM rating WHERE goods_id_to_rate='".$goods_no."' AND ip_goods_rater = '0'") or die(db_conn_error);
		$total=mysqli_num_rows($select_rating);
		$ratingar = array();

		while($row=mysqli_fetch_array($select_rating, MYSQLI_ASSOC)){
	
		$ratingar[]=$row['ratings'];
		}

		if($total==0){				//or shall i use if $total_rating has become very less than 0.000001? No because at least 1 person as rated and that will show in the display.
		$total_rating=0;		 
		}else{
		$total_rating=(array_sum($ratingar)/$total);
		}

			
		echo '<div>';
		
			for($x=1;$x<=$total_rating;$x++){	
			echo('<img src="assets/vectors/star.png" id="rate1" class="rate"/>');
			}
			while ($x<=5){
			echo('<img src="assets/vectors/star2.png" id="" class="rate"/>');
			$x++;
			}

		echo '<div><small>'.custom_number_format($total).' Vote(s)<br><em></em></small></div>';
		
		echo '</div>';
		
		
		//------------------------------------------------------------------------------------------------
		
		
	/*	$select_rating_bl=mysqli_query($connect,"SELECT ratings FROM rating WHERE goods_id_to_rate='".$goods_no."' AND ip_goods_rater != '0'") or die(db_conn_error);
		$total_bl=mysqli_num_rows($select_rating_bl);
		$ratingar_bl = array();

		while($row_bl=mysqli_fetch_array($select_rating_bl, MYSQLI_ASSOC)){
	
		$ratingar_bl[]=$row_bl['ratings'];
		}

		if($total_bl==0){				//or shall i use if $total_rating has become very less than 0.000001? No because at least 1 person as rated and that will show in the display.
		$total_rating_bl=0;		 
		}else{
		$total_rating_bl=(array_sum($ratingar_bl)/$total_bl);
		}

			
		echo '<div>';
		
			for($x_bl=1;$x_bl<=$total_rating_bl;$x_bl++){	
			echo '<i class="fa fa-star"></i>';
			//echo('<img src="assets/vectors/star.png" id="rate1" class="rate"/>');
			}
			while ($x_bl<=5){
			echo '<i class="fa fa-star-o"></i>';
			//echo('<img src="assets/vectors/star2.png" id="" class="rate"/>');
			$x_bl++;
			}

		echo '<div><small>'.custom_number_format($total_bl).' Vote(s)<br><em>(By guest users)</em></small></div>';
		
		echo '</div>';*/
		
		
		
		
		if(isset($_SESSION['user_id']) AND isset($user_id)){
			if($user_id == $_SESSION['user_id']){
			echo '<a href="edit-shop-slider.php?goods_no='.$goods_no.'"><i class="fa fa-edit"></i></a></a></li>';				
		}
		}
		
		
		
		
		echo '</div>';
		echo '</div>';
		echo '</div>';
		echo '</div>';
	
}
}else{
	
	echo '<h3 class="text-center">No result</h3>';
} // and when there are no goods yet on the website?
?>
    