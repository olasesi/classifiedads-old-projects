<div>
				
               <a class="list-group-item active list-group-item-danger">Shop's review</a>
				 <ul class="list-group">
				<li class="list-group-item">
				<div>
				<?php
				if (isset($_POST['rate_shop']) AND isset($_POST['rate'])){
				
				$getting_ip_double = getuserip();
				$choosing_rater = (isset($_SESSION['user_id']))?$_SESSION['user_id']:$getting_ip_double;		
				$entering_ip = (isset($_SESSION['user_id']))? 0 :$getting_ip_double;		
				
				$finding_if_rated_double = mysqli_query($connect, "SELECT * FROM shop_rating WHERE rater = '".$choosing_rater."' AND shop_id = '".$user_id."'") or die(db_conn_error);
				if(mysqli_num_rows($finding_if_rated_double) == 0){
				
				$rate_time = strtotime('now');
				$insert_rating=mysqli_query($connect,"INSERT INTO shop_rating (shop_rating_id, shop_id, rater, rate_value, ip_address, timestamp_rate) VALUES ('', '".$user_id."', '".$choosing_rater."', '".$_POST['rate']."', '".$entering_ip."', '".$rate_time."')") or die(db_conn_error);
				echo ('<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Thank you for Rating!!!</div>');
				}
				
				}elseif(isset($_POST['rate_shop']) AND !isset($_POST['rate'])){
				echo ('<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Please choose a rating</div>');
					
				}
				
				
				
				?>
				</div>
				
				<div>
				<?php
				$select_rating = mysqli_query($connect, "SELECT * FROM shop_rating WHERE shop_id = '".$user_id."' AND ip_address = '0'") or die(db_conn_error);
				
				$total=mysqli_num_rows($select_rating);
				$ratingar = array();

				while($row=mysqli_fetch_array($select_rating, MYSQLI_ASSOC)){
	
				$ratingar[]=$row['rate_value'];
				}

				if($total==0){				
				$total_rating=0;		 
				}else{
				$total_rating=(array_sum($ratingar)/$total);
				}

			
				echo("<center><div>");
				echo "<br><small>By other shop owners</small><br>";
				
				for($x=1;$x<=$total_rating;$x++){	
				echo("<img src='assets/vectors/star.png' id='' class=''/>");
				}
				while ($x<=5){
				echo("<img src='assets/vectors/star2.png' id='' class=''/>");
				$x++;
				}

				echo ("<br><small>".custom_number_format($total)." Vote(s) </small>");
				echo "</div></center>";
				
				?>
				
				</div>
				<div>
				<?php
				$select_rating_un = mysqli_query($connect, "SELECT * FROM shop_rating WHERE shop_id = '".$user_id."' AND ip_address != '0'") or die(db_conn_error);
				
				$total_un=mysqli_num_rows($select_rating_un);
				$ratingar_un = array();

				while($row_un=mysqli_fetch_array($select_rating_un, MYSQLI_ASSOC)){
	
				$ratingar_un[]=$row_un['rate_value'];
				}

				if($total_un==0){				
				$total_rating_un=0;		 
				}else{
				$total_rating_un=(array_sum($ratingar_un)/$total_un);
				}

			
				echo("<center><div class='rating_box'>");
				echo "<br><small>By guest users</small><br>";
				
				for($x_un=1;$x_un<=$total_rating_un;$x_un++){	
				echo '<i class="fa fa-star"></i>';
				//echo("<img src='assets/vectors/star.png' id='rate1' class='rate'/>");
				}
				while ($x_un<=5){
				echo '<i class="fa fa-star-o"></i>';
				//echo("<img src='assets/vectors/star2.png' id='' class='rate'/>");
				$x_un++;
				}

				echo ("<br><small>".custom_number_format($total_un)." Vote(s) </small>");
				echo "</div></center>";
				echo "<br>";
				?>
				
				</div>
				<?php
								
				$getting_ip = getuserip();
				$userid_or_ipaddress = (isset($_SESSION['user_id']))?$_SESSION['user_id']:$getting_ip;
								
				$finding_if_rated = mysqli_query($connect, "SELECT * FROM shop_rating WHERE rater = '".$userid_or_ipaddress."' AND shop_id = '".$user_id."'") or die(db_conn_error);
				
				if(mysqli_num_rows($finding_if_rated) == 0){
				
				echo 
				'<form role="form" action="" method="POST">
					<div class="form-group">
						<label for="search_username"><i>Rate by shop reliability</i></label><br>
						
						<label class="radio-inline">
						<input type="radio" name="rate" value="5">A
						</label>
						<label class="radio-inline">
						<input type="radio" name="rate" value="4">B
						</label>
						<label class="radio-inline">
						<input type="radio" name="rate" value="3">C
						</label>
						<label class="radio-inline">
						<input type="radio" name="rate" value="2">D
						</label>
						<label class="radio-inline">
						<input type="radio" name="rate" value="1">E
						</label>
					
					</div>
					<div class="form-group">
					<button type="submit" name="rate_shop" class="btn btn-primary">Rate</button>
					</div>
				</form>';
				
				}
				
				echo '<hr>';
				
				
				
				
				
				
				
				
				echo '<label><i>Comments on Shop</i></label>';
				
				$select_shop_comment = mysqli_query($connect, "SELECT * FROM shop_comment WHERE user_id_comment = '".$user_id."' ORDER BY shop_comment_id DESC LIMIT 0, 10") or die(db_conn_error);
				if(mysqli_num_rows($select_shop_comment) > 0){
				
				while($select_shop_comment_arr = mysqli_fetch_array($select_shop_comment)){
					
					echo '<p><i class="fa fa-square"></i> <small><em>'.$select_shop_comment_arr['shop_comment'].'</em></small></p>';
					
				}
				}else{
					echo '<em><br><small>No comments on Shop</small></em>';
				}
				
				
				$need_form_array_comment = array();
				if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['comment'])){
					
					if (preg_match ('/^[A-Z0-9\040\'.\- ,\(\)]{3,100}+$/i', $_POST['write_comment'])) {		
					$comment = mysqli_real_escape_string ($connect, $_POST['write_comment']);				//max lenght of character 
					} else {
					$need_form_array_comment['comment'] = 'Please only 3 to 100 characters. No invalid characters allowed';
					}	
					
					
				if(empty($need_form_array_comment)){
				
				$getting_ip_comment = getuserip();													
				$entering_ip_comment = (isset($_SESSION['user_id']))?$_SESSION['user_id']:$getting_ip_comment;
				$entering_comment = (isset($_SESSION['user_id']))? 0 : $getting_ip_comment;															
						
				$result_comment = mysqli_query($connect, "SELECT * FROM shop_comment WHERE user_id_comment = '".$user_id."' AND commenter = '".$entering_ip_comment."'") or die(db_conn_error);
				if(mysqli_num_rows($result_comment) == 0){
				
				mysqli_query($connect, "INSERT INTO shop_comment(shop_comment_id, user_id_comment, commenter, shop_comment, comment_ipaddress, shop_comment_time) VALUES ('', '".$user_id."','".$entering_ip_comment."', '".$comment."', '".$entering_comment."', '".strtotime('now')."')") or die(db_conn_error);		
				
				echo '<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button> Comment has been submitted!!! </div>';
				}	
				
				}
				}
				
				$getting_ip_comment_re = getuserip();													
				$entering_ip_comment_re = (isset($_SESSION['user_id']))?$_SESSION['user_id']:$getting_ip_comment_re;
								
				$result_comment = mysqli_query($connect, "SELECT * FROM shop_comment WHERE user_id_comment = '".$user_id."' AND commenter = '".$entering_ip_comment_re."'") or die(db_conn_error);
				if(mysqli_num_rows($result_comment) == 0){
				
				if (array_key_exists('comment', $need_form_array_comment)) {echo '<div class="alert alert-warning alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$need_form_array_comment['comment'].'</div>';}
				
				
				echo '
				<form role="form" action="" method="POST">
					<div class="form-group">
						
						<input type="text" placeholder="Write comment" class="form-control" name="write_comment" 
						value="';
						if(isset($_POST['write_comment'])){echo $_POST['write_comment'];}
				echo	'"/>
					</div>
					<div class="form-group">
					<button type="submit" name="comment" class="btn btn-primary">Comment</button>
					</div>
				
				</form>';
				}
				?>
				
				</li>
			</ul>	
</div>