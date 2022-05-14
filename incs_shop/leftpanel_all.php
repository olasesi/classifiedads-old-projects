<?php
$select_cat = mysqli_query($connect, "SELECT categories FROM goods, users WHERE user_id = UID AND username = '".$username."' GROUP BY categories") or die(db_conn_error);
$fetching_array = array();
while($fetching = mysqli_fetch_array($select_cat)){
	
	$fetching_array[] = $fetching['categories'];
}
?>

<div class="col-xs-6 col-sm-4 col-md-3">
                
				<?php
				include("../incs_shop/stopwords.php");
				
				if(isset($_SESSION['user_id']) AND $user_id == $_SESSION['user_id']){
				
				echo '<div>
				 <a class="list-group-item active list-group-item-danger">Potential Customers</a>
				 <ul class="list-group">
				 <li class="list-group-item">
				 ';
				
				$post_and_cat = mysqli_query($connect, "SELECT DISTINCT posts, post_city, phone FROM post, goods WHERE UID = '".$_SESSION['user_id']."' AND post_category = categories AND post_state_id = '".$_SESSION['state_local_area']."' ORDER BY post_id DESC LIMIT 0, 15 ") or die(db_conn_error);
				
				if(mysqli_num_rows($post_and_cat) > 0 ){
				while($testing_closeby = mysqli_fetch_array($post_and_cat)){
				
					
					echo '<div class="clearfix" style="margin-bottom:20px;">';
					
					echo '<h5>'.$testing_closeby['posts'].'</h5>';
					echo '<div class="pull-left"><span class="label label-success">'.$testing_closeby['post_city'].'</span></div>';
					echo '<div class="pull-right"><a href="tel:'.$testing_closeby['phone'].'"><span class="label label-info">'.$testing_closeby['phone'].'</span></a></div>';
					
					echo '</div>';
					//echo '<hr>';
				
				}
				}else{
					echo '<small><em>No customers or leads from '.$_SESSION['state_local_area'].' yet. Start uploading your products to get customers.</em></small>';
				}
				
				echo '
				</li>
				</ul>
				</div>';
				
				/*$now_in_array = array();
				$searching_in_goods = mysqli_query($connect, "SELECT DESTINCT categories FROM goods WHERE UID = '".$_SESSION['user_id']."'") or die(db_conn_error); //distinct
				while($array_goods = mysqli_fetch_array($searching_in_goods)){
				$now_in_array[] = $array_goods['categories'];
				}
				
				if(count($now_in_array) >= 1){ 
				$array_sub = $now_in_array;		//whats the number of elements in this array now that it has been substracted?
				
				if(count($array_sub) == 1){
					
				$part1 = "post_category = '".$array_sub[0]."'";	
				
				}elseif(count($array_sub) > 1){
					
					$part1 = "posts LIKE '%".$array_sub[0]."%'";
					for($i=1; $i < count($array_sub); $i++){
					$part1 .= " OR posts LIKE '%".$array_sub[$i]."%'";	
					}
				
				}
				
				
				
				
				
				echo '<div>
				 <a class="list-group-item active list-group-item-danger">Customers</a>
				 <ul class="list-group">
				 <li class="list-group-item">
				 ';
				
				$goods_you_sell_closeby = mysqli_query($connect, "SELECT * FROM post WHERE (post_state_id = '".$_SESSION['state_local_area']."') AND (".$part1.") ORDER BY post_id DESC LIMIT 0, 10 ") or die(db_conn_error);
				
				if(mysqli_num_rows($goods_you_sell_closeby) > 0 ){
				while($testing_closeby = mysqli_fetch_array($goods_you_sell_closeby)){
				
					
					echo '<div class="clearfix" style="margin-bottom:20px;">';
					
					echo '<h4>'.$testing_closeby['posts'].'</h4>';
					echo '<div class="pull-left"><span class="label label-success">'.$testing_closeby['post_city'].'</span></div>';
					echo '<div class="pull-right"><a href="tel:'.$testing_closeby['phone'].'"><span class="label label-info">'.$testing_closeby['phone'].'</span></a></div>';
					
					echo '</div>';
					echo '<hr>';
				
				}
				}else{
					echo '<small><em>No customers or leads from '.$_SESSION['local_area'].' yet. Start posting your products to get customers.</em></small>';
				}
				echo '<hr>';
				
				$goods_you_sell = mysqli_query($connect, "SELECT * FROM post WHERE (post_state_id = '".$_SESSION['state_local_area']."' AND post_city !='".$_SESSION['local_area']."' AND user_id_post != '".$_SESSION['user_id']."') AND (".$part1.") ORDER BY post_id DESC LIMIT 0, 10 ") or die(db_conn_error);
				
				if(mysqli_num_rows($goods_you_sell) > 0 ){
				while($testing = mysqli_fetch_array($goods_you_sell)){
					
					echo '<div class="clearfix" style="margin-bottom:20px;">';
					
					echo '<h4>'.$testing['posts'].'</h4>';					
					echo '<div class="pull-left"><span class="label label-success">'.$testing['post_city'].'</span></div>';
					echo '<div class="pull-right"><a href="tel:'.$testing['phone'].'"><span class="label label-info">'.$testing['phone'].'</span></a></div>';
					
					echo '</div>';
					
					echo '<hr>';
				}
				}else{
					echo '<small><em>No customers or leads outside of '.$_SESSION['local_area'].' yet. Start posting your products to get customers.</em></small>';
				}
				
				echo '
				</li>
				</ul>
				</div>';
				}*/
                
				}
				?>
		
				<?php
				/*
				if(isset($_SESSION['user_id']) AND $user_id == $_SESSION['user_id']){
				$need_form_array_sell = array();
				if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['post_need_sell'])){
					
					if (preg_match ('/^(I sell|I render|We sell|We render)/i', trim($_POST['sell']))) {		//edit		
					if(strlen(trim($_POST['sell'])) <= 50){
					$sell = mysqli_real_escape_string ($connect, trim($_POST['sell']));		//edit	//max lenght of character
					}else{
					$need_form_array_sell['sell'] = 'You must start with <br><b style="color:black;">I/We sell </b>or <b style="color:black;"> I/We render</b>, and must be simple and straightforward. (Maximum characters: 50)';	
					}
					} else {
					$need_form_array_sell['sell'] = 'You must start with <br><b style="color:black;">I/We sell </b>or <b style="color:black;">I/We render</b>, and must be simple and straightforward. (Maximum characters: 50)';	//edit
					}	
					
					//edit
					if ($_POST['post_categories_sell'] == "Categories") {
					$need_form_array_sell['post_categories_sell'] = 'Please choose from the category';			
					}else{
					$postcategory_sell = $_POST['post_categories_sell'];
					}
					//edit
					
					if(isset($_POST['editbonus_sell'])){				
					$editbonus_sell=1;
					}else{
					$editbonus_sell=0;	
					}						
				
					if(isset($_POST['editbonus_sell_gift'])){				
					$editbonus_sell_gift=1;
					}else{
					$editbonus_sell_gift=0;	
					}	
					
					if(isset($_POST['editbonus_sell_extra'])){				
					$editbonus_sell_extra=1;
					}else{
					$editbonus_sell_extra=0;	
					}	
					
					if (preg_match ('/^[0-9]{1,10}$/', trim($_POST['referral_price'])) OR empty($_POST['referral_price'])){						//only numbers are allowed here. no decimals or commas
					$referralprice = mysqli_real_escape_string ($connect,trim($_POST['referral_price']));
					} else {
					$need_form_array_sell['referral_price'] = 'Please enter correct price e.g 3500';
					}
				
				
				
				if(empty($need_form_array_sell)){
					if(preg_match('/(job|jobs|buy|get|want|signup|sign up|register|visit|make money)/i',$sell) OR preg_match('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i',$sell) OR filter_var($sell, FILTER_VALIDATE_URL)){
						echo '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Your products or services are now being advertised.</div>';
					unset($_POST['sell']);
					unset($_POST['post_categories_sell']);
					unset($_POST['editbonus_sell']);
					unset($_POST['editbonus_sell_gift']);
					unset($_POST['editbonus_sell_extra']);
					unset($_POST['referral_price']);
					//	
						// matching urls to guard against spamming
					}else{
					
					$nows_sell = strtotime('now');
					mysqli_query($connect, "INSERT INTO sell(sell_id, user_id_sell, post_city_sell, post_state_id_sell, sell, php_timestamp_sell, post_category_sell, patronage_fee, gift, extra, referral_fee) VALUES 
					('', '".$_SESSION['user_id']."','".$_SESSION['local_area']."', '".$_SESSION['state_local_area']."', '".$sell."', '".$nows_sell."', '".$postcategory_sell."', '".$editbonus_sell."', '".$editbonus_sell_gift."', '".$editbonus_sell_extra."', '".$referralprice."')") or die(db_conn_error);	
					unset($_POST['sell']);
					unset($_POST['post_categories_sell']);
					unset($_POST['editbonus_sell']);
					unset($_POST['editbonus_sell_gift']);
					unset($_POST['editbonus_sell_extra']);
					unset($_POST['referral_price']);
					
										
					echo '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Your products or services are now being advertised.</div>';
					
					//unset($_POST['fee']);
					
					}
					
	
					}
				}
				
				if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['repost_ad'])){
					
					$confirm_last_repost = mysqli_query($connect, "SELECT * FROM sell WHERE user_id_sell = '".$_SESSION['user_id']."' ORDER BY php_timestamp_sell DESC LIMIT 0, 1 ") or die(db_conn_error);
					while($confirm_last_repost_while = mysqli_fetch_array($confirm_last_repost)){
						$most_recent_update = $confirm_last_repost_while['php_timestamp_sell'];
					}
					
					$post_advert_again = mysqli_query($connect, "UPDATE sell SET php_timestamp_sell = '".strtotime('now')."' WHERE user_id_sell = '".$_SESSION['user_id']."' AND php_timestamp_sell = '".$most_recent_update."'") or die(db_conn_error);
					
					echo '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Your products or services has now been advertised again.</div>';
				
				}
				
				
				
				echo '<div>
                <a class="list-group-item active list-group-item-danger">Product or service advert</a>
				 <ul class="list-group">';
				
				echo '<li class="list-group-item">';
				
				$re_advertise = mysqli_query($connect,"SELECT * FROM sell WHERE user_id_sell = '".$_SESSION['user_id']."' ORDER BY php_timestamp_sell DESC LIMIT 0 , 1") or die(db_conn_error);
				if(mysqli_num_rows($re_advertise) >= 1){
				while($re_advertise_while = mysqli_fetch_array($re_advertise)){
				
				echo '<div>';	
					echo '<small><b>My previous ad:</b></small><br>';
					echo $re_advertise_while['sell'].'<br>';
					
					//if($re_advertise_while['patronage_fee'] == 1){
						//echo '<div class="pull-left"><span class="label label-success">patronage fee</span></div>';
					//}
					if($re_advertise_while['gift'] == 1){
						echo '<div class="pull-left"><span class="label label-info">gift</span></div>';
					}
					if($re_advertise_while['extra'] == 1){
						echo '<div class="pull-left"><span class="label label-danger">give extra</span></div>';
					}
					if(!empty($re_advertise_while['referral_fee'])){
						echo '<div class="pull-left"><span class="label label-primary">referral (&#8358;'.number_format($re_advertise_while['referral_fee']).')</span></div>';
					}
				
				
				echo '</div>';
				
				echo '<br>';
				echo '<br>';
				
				echo '<form role="form" action="" method="POST" style="margin-top:10px; display:inline-block;">';
					
					
					echo '<div class="form-group">
					<button type="submit" class="btn btn-primary" name="repost_ad">Repost ad</button>
					</div>';
				
				echo '</form>';
				
				
				
				}
				
				}	
					
					
					echo '<form role="form" action="" method="POST">
					<div class="form-group">
						<br>';
						
					if (array_key_exists('sell', $need_form_array_sell)) {
							
							echo '<div class="alert alert-warning alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$need_form_array_sell['sell'].'</div>';}	
					echo '<input type="text" placeholder="I sell shoes" class="form-control" name="sell" id="need" value="'; if(isset($_POST['sell'])){echo $_POST['sell'];} echo '"/>
					</div>';
					
					
					$categories_array_sell=array('Mobile and Tabs', 'Computers', 'Appliances', 'Clothings', 'Fashion Items', 
					'Kids Accessories', 'Vehicles', 'Vehicle Accessories','Real Estate', 'Pets','Food and Drinks', 'Groceries', 
					'Health', 'Garden', 'Home', 'Fun', 'Art');	
					

					echo '<div class="form-group">';
					
					if (array_key_exists('post_categories_sell', $need_form_array_sell)) {
					echo  '<div class="alert alert-warning alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$need_form_array_sell['post_categories_sell'].'</div>';}
	
	echo '<select class="form-control input-sm" name="post_categories_sell" id="categories">
		 <option>Categories</option>';
			
				if(isset ($_POST['post_categories_sell'])){
					foreach ($categories_array_sell as $option_sell){
						$sel_sell = ($option_sell==$_POST['post_categories_sell'])?"Selected='selected'":"";
						echo '<option '.$sel_sell.'>'.$option_sell.'</option>';}
				}else{
						foreach ($categories_array_sell as $option_sell){
						echo '<option>'.$option_sell.'</option>';
						}
				}
			
	echo '</select>
	</div>';
			
			echo '
			<input type="hidden" name="editbonus_sell" id="product_bonus"/>';	
			
			echo '<div>
			<input type="checkbox" name="editbonus_sell_gift" id="product_bonus_gift"';if(isset($_POST['editbonus_sell_gift'])){ echo 'checked="checked"';}
			echo '/>
			<label for="product_bonus_gift">
			<em><small>Give "gift" if the customer buys from you</small></em>
			</label>
			<br>
			</div><br>';
			
			echo '<div>
			<input type="checkbox" name="editbonus_sell_extra" id="product_bonus_extra"';if(isset($_POST['editbonus_sell_extra'])){ echo 'checked="checked"';}
			echo '/>
			<label for="product_bonus_extra">
			<em><small>Give "extra" if more than one item is bought e.g give one more if three items are bought.</small></em>
			</label>
			<br>
			</div><br>';
			
			echo '<div class="form-group">';
			if (array_key_exists('referral_price', $need_form_array_sell)) {
			echo '<div class="alert alert-warning alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$need_form_array_sell['referral_price'].'</div>';}	
			echo '<input type="text" placeholder="e.g 2500" class="form-control" name="referral_price" id="need" value="'; if(isset($_POST['referral_price'])){echo $_POST['referral_price'];} echo '"/>
			<label><em><small>Give "Referral Bonus" in cash to someone who refers to you and if the person buys.</small></em></label>
			
			</div>';
				
				
				
				
				
				echo '<p class="text-info"><small><b>Note:</b> Users can rate and comment on your truthfulness in your shop overview, so only tick bonuses, gift, etc if you will give out.</small></p>
					
					<div class="form-group">
					
					<button type="submit" class="btn btn-primary" name="post_need_sell">Submit</button>
					</div>
					</li>
				</form>
				</ul>
				
				</div>';
				
				}*/
				?>
		
		
			
				
				
				
				
				
				<?php
				
					
					if(in_array('Mobile and Tabs', $fetching_array) OR in_array('Computers', $fetching_array) OR in_array('Appliances', $fetching_array)){
					
					echo '<div>
					<a class="list-group-item active list-group-item-primary">Electronics
                    </a>
					<ul class="list-group">';
					 if(in_array('Mobile and Tabs', $fetching_array)){ 	
						echo '<a href= "my-shop-mobile-and-tabs.php?brand_username='.$username.'" class="" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item"'; if(isset($active_mobile_and_tabs)){echo 'style="color:#005b95; font-weight:bold;"';}
						echo '>Mobile & Tabs
						<span class="label label-primary pull-right">';
						
						
						$total_mobile = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '".$username."' AND categories = 'Mobile and Tabs'") or die(db_conn_error);
						echo mysqli_num_rows($total_mobile);
						
						
						echo '</span>
                        </li>
					</a>';
					}
					 
					 if(in_array('Computers', $fetching_array)){  
						echo '<a href= "my-shop-computers.php?brand_username='.$username.'" class="" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item"'; if(isset($active_computers)){echo 'style="color:#005b95; font-weight:bold;"';}
						echo '">Computers
                      <span class="label label-success pull-right">';
					  
						$total_computers = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '".$username."' AND categories = 'Computers'") or die(db_conn_error);
						echo mysqli_num_rows($total_computers);
						
					  echo '</span>
                        </li>
                        </a>';
					 }	
					if(in_array('Appliances', $fetching_array)){ 	
						echo '<a href= "my-shop-appliances.php?brand_username='.$username.'" class="" style="font-weight:normal; cursor:pointer;">
						<li class="list-group-item"'; if(isset($active_appliances)){echo 'style="color:#005b95; font-weight:bold;"';}
						echo '>Appliances
                             <span class="label label-info pull-right">';
						
						$total_appliances = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '".$username."' AND categories = 'Appliances'") or die(db_conn_error);
						echo mysqli_num_rows($total_appliances);
						
						echo '</span>
                        </li>
                        </a>';
					}
					
						
                    echo '</ul>
					</div>';
					}
					?>
                <!-- /.div -->
                <?php
				if(in_array('Clothings', $fetching_array) OR in_array('Fashion Items', $fetching_array)){
				echo '<div>
					<a class="list-group-item active list-group-item-success">Fashion
                    </a>
                    <ul class="list-group">';
					if(in_array('Clothings', $fetching_array)){ 	
						echo '<a href= "my-shop-clothings.php?brand_username='.$username.'" class="" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item"'; if(isset($active_clothings)){echo 'style="color:#005b95; font-weight:bold;"';}
						echo '>Clothings
                             <span class="label label-danger pull-right">'; 
						 
						$total_men = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '".$username."' AND categories = 'Clothings'") or die(db_conn_error);
						echo mysqli_num_rows($total_men);
						
						echo '</span>
                        </li>
						</a>';}
                       
						if(in_array('Fashion Items', $fetching_array)){
						echo '<a href= "my-shop-fashion-items.php?brand_username='.$username.'" class="" style="font-weight:normal; cursor:pointer;">
						 <li class="list-group-item"'; if(isset($active_fashion_items)){echo 'style="color:#005b95; font-weight:bold;"';}
						echo '>Fashion Items
                             <span class="label label-danger pull-right">';
						 
						$total_fashion_accessories = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '".$username."' AND categories = 'Fashion Items'") or die(db_conn_error);
						echo mysqli_num_rows($total_fashion_accessories);
						 
						echo '</span>
                        </li>
						</a>';}

                    echo '</ul>
                </div>';
				}
				?>
				<?php
				if(in_array('Kids Accessories', $fetching_array)){
				echo '<div>
                    <a class="list-group-item active list-group-item-primary">Kids & Care
                    </a>
                    <ul class="list-group">';
					
						 if(in_array('Kids Accessories', $fetching_array)){
						 echo '<a href= "my-shop-kids-accessories.php?brand_username='.$username.'" class="" style="font-weight:normal; cursor:pointer;">
						 <li class="list-group-item"'; if(isset($active_kids_accessories)){echo 'style="color:#005b95; font-weight:bold;"';}
						echo '>Kiddies
                             <span class="label label-primary pull-right">';
						  
						$total_kids_accessories = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '".$username."' AND categories = 'Kids Accessories'") or die(db_conn_error);
						echo mysqli_num_rows($total_kids_accessories);
						 
							echo '</span>
                        </li>
						 </a>';}
						
					
                    echo '</ul>
                </div>';
				}?>
                <!-- /.div -->
                 <?php
				 if(in_array('Vehicles', $fetching_array) OR in_array('Vehicle Accessories',$fetching_array)){
				 echo '<div>
                    <a class="list-group-item active list-group-item-info">Vehicles
                    </a>
                    <ul class="list-group">';
                        if(in_array('Vehicles', $fetching_array)){
						echo '<a href= "my-shop-vehicles.php?brand_username='.$username.'" class="" style="font-weight:normal; cursor:pointer;">
						<li class="list-group-item"'; if(isset($active_vehicles)){echo 'style="color:#005b95; font-weight:bold;"';}
						echo '>Vehicles
                             <span class="label label-danger pull-right">';
							
						$total_cars = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '".$username."' AND categories = 'Vehicles'") or die(db_conn_error);
						echo mysqli_num_rows($total_cars);
							  
							echo '</span>
                        </li>
						</a>';}
						
                       if(in_array('Vehicle Accessories', $fetching_array)){
					   echo '<a href= "my-shop-vehicle-accessories.php?brand_username='.$username.'" class="" style="font-weight:normal; cursor:pointer;">
					   <li class="list-group-item"'; if(isset($active_vehicle_accessories)){echo 'style="color:#005b95; font-weight:bold;"';}
						echo '>Vehicle Items
                             <span class="label label-info pull-right">';
						
						$total_vehicle_accessories = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '".$username."' AND categories = 'Vehicle Accessories'") or die(db_conn_error);
						echo mysqli_num_rows($total_vehicle_accessories);
							 
							echo '</span>
                        </li>
				 </a>';} 
                    echo '</ul>
                </div>';
				 }?>
				
				<?php
				 if(in_array('Real Estate', $fetching_array)){
				 echo '<div>
				
                    <a class="list-group-item active list-group-item-danger">Properties & Home
                    </a>
                    <ul class="list-group">';
					if(in_array('Real Estate', $fetching_array)){
					echo '<a href= "my-shop-real-estate.php?brand_username='.$username.'" class="" style="font-weight:normal; cursor:pointer;">
					
                        <li class="list-group-item"'; if(isset($active_real_estate)){echo 'style="color:#005b95; font-weight:bold;"';}
						echo '>Real Estate
                             <span class="label label-warning pull-right">';
							  
						$total_realestate = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '".$username."' AND categories = 'Real Estate'") or die(db_conn_error);
						echo mysqli_num_rows($total_realestate);
							 
							echo '</span>
                        </li>
					</a>';} 
                    echo '</ul>
                </div>';
				 }
				?>
				<?php
				if(in_array('Pets', $fetching_array) OR in_array('Food and Drinks', $fetching_array) OR in_array('Groceries', $fetching_array) OR in_array('Health',$fetching_array)){
				 echo '<div>
				
                    <a class="list-group-item active list-group-item-warning">Care
                    </a>
                    <ul class="list-group">';
                         if(in_array('Pets', $fetching_array)){
						echo '<a href= "my-shop-pets.php?brand_username='.$username.'" class="" style="font-weight:normal; cursor:pointer;">
						<li class="list-group-item"'; if(isset($active_pets)){echo 'style="color:#005b95; font-weight:bold;"';}
						echo '>Pets
                             <span class="label label-danger pull-right">';
							 
						$total_pets = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '".$username."' AND categories = 'Pets'") or die(db_conn_error);
						echo mysqli_num_rows($total_pets);
							 
						echo  '</span>
                        </li>
						</a>';}
						if(in_array('Food and Drinks', $fetching_array)){
						echo '<a href= "my-shop-food-and-drinks.php?brand_username='.$username.'" class="" style="font-weight:normal; cursor:pointer;">
						<li class="list-group-item"'; if(isset($active_food_and_drinks)){echo 'style="color:#005b95; font-weight:bold;"';}
						echo '>Food
                             <span class="label label-warning pull-right">';
							 
						$total_food_drinks = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '".$username."' AND categories = 'Food and Drinks'") or die(db_conn_error);
						echo mysqli_num_rows($total_food_drinks);
							 
						echo  '</span>
                        </li>
						</a>';}
					
                        if(in_array('Groceries', $fetching_array)){
						echo '<a href= "my-shop-groceries.php?brand_username='.$username.'" class="" style="font-weight:normal; cursor:pointer;">
						<li class="list-group-item"'; if(isset($active_groceries)){echo 'style="color:#005b95; font-weight:bold;"';}
						echo '>Groceries
                             <span class="label label-success pull-right">';
							 
						$total_groceries = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '".$username."' AND categories = 'Groceries'") or die(db_conn_error);
						echo mysqli_num_rows($total_groceries);
						 
							echo '</span>
                        </li>
						</a>';}
						
						if(in_array('Health', $fetching_array)){
						echo '<a href= "my-shop-health.php?brand_username='.$username.'" class="" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item"'; if(isset($active_health)){echo 'style="color:#005b95; font-weight:bold;"';}
						echo '>Health
                             <span class="label label-danger pull-right">';
							 
						$total_fitness = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '".$username."' AND categories = 'Health'") or die(db_conn_error);
						echo mysqli_num_rows($total_fitness);
						
							 echo '</span>
                        </li>
						</a>';}
                    echo '</ul>
                </div>';}
				?>
				<?php
				if(in_array('Garden', $fetching_array) OR in_array('Home', $fetching_array)){
				 echo '<div>
				
                    <a class="list-group-item active list-group-item-primary">Home
                    </a>
                    <ul class="list-group">';
                        
					if(in_array('Garden', $fetching_array)){
						echo '<a href= "my-shop-garden.php?brand_username='.$username.'" class="" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item"'; if(isset($active_garden)){echo 'style="color:#005b95; font-weight:bold;"';}
						echo '>Garden
                             <span class="label label-info pull-right">';
						 
						$total_garden = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '".$username."' AND categories = 'Garden'") or die(db_conn_error);
						echo mysqli_num_rows($total_garden);
							 	 
							 echo '</span>
                         </li>
					</a>';}
						
						  if(in_array('Home', $fetching_array)){
						  echo '<a href= "my-shop-home.php?brand_username='.$username.'" class="" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item"'; if(isset($active_home)){echo 'style="color:#005b95; font-weight:bold;"';}
						echo '">Home
                             <span class="label label-warning pull-right">';
						 
						$total_home = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '".$username."' AND categories = 'Home'") or die(db_conn_error);
						echo mysqli_num_rows($total_home);
							 	 
							 echo '</span>
                         </li>
						  </a>';}
                    echo '</ul>
                </div>';}
				?>
				<?php
				if(in_array('Fun', $fetching_array) OR in_array('Art', $fetching_array)){
				 echo '<div>
				
                    <a class="list-group-item active list-group-item-success">Art & Fun
                    </a>
                    <ul class="list-group">';
                       
						 if(in_array('Fun',$fetching_array)){
						 echo '<a href= "my-shop-fun.php?brand_username='.$username.'" class="" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item"'; if(isset($active_fun)){echo 'style="color:#005b95; font-weight:bold;"';}
						echo '">Fun
                             <span class="label label-warning pull-right">';
						 
						$total_fun = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '".$username."' AND categories = 'Fun'") or die(db_conn_error);
						echo mysqli_num_rows($total_fun);
						 	 
							echo '</span>
                         </li>
						 </a>';}
						  if(in_array('Art', $fetching_array)){
						  echo '<a href= "my-shop-art.php?brand_username='.$username.'" class="" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item"'; if(isset($active_art)){echo 'style="color:#005b95; font-weight:bold;"';}
						echo '">Art
                             <span class="label label-warning pull-right">';
						
						$total_art = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '".$username."' AND categories = 'Art'") or die(db_conn_error);
						echo mysqli_num_rows($total_art);
							 	 
							echo '</span>
                         </li>
						  </a>';}
                    echo '</ul>
                </div>';
				}?>
                <!-- /.div -->
				<br />
				<br />
                
				<?php
				include("../incs_shop/shop_review.php");
				?>
				
				</br></br>
				<!--SEARCH USERNAME //////////////// BEGINS-->
				<?php// include("../incs_shop/username_search.php"); ?>
				
				<!--SEARCH USERNAME //////////////// ENDS-->
				<br/>
				<br/>
				<!--POST NEEDS //////////////// BEGINS-->
				
				
				
				
				<!--CUSTOMERS//////////////// ENDS-->
				
				
				
            </div>