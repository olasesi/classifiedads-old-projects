	<div class="col-md-4 col-sm-4 col-xs-12">
		
				<?php
				$need_form_array = array();
				if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['post_need'])){
					
					if (preg_match ('/^(I need)/i', trim($_POST['need']))) {		//edit		
					if(strlen(trim($_POST['need'])) <= 50){
					$need = mysqli_real_escape_string ($connect, trim($_POST['need']));		//edit	//max lenght of character
					}else{
					$need_form_array['need'] = 'You must start with <br><b style="color:black;">I need</b>, and must be simple and straightforward. (Maximum characters: 50)';	
					}
					} else {
					$need_form_array['need'] = 'You must start with <br><b style="color:black;">I need</b>, and must be simple and straightforward. (Maximum characters: 50)';	//edit
					}	
					
					//edit
					if ($_POST['post_categories'] == "Categories") {
					$need_form_array['post_categories'] = 'Please choose from the category';			
					}else{
					$postcategory = $_POST['post_categories'];
					}
					//edit
					
					if (preg_match ('/0\d{10}/', trim($_POST['phone']))) {		//edit
					if(strlen(trim($_POST['phone'])) == 11){		//edit
					$phone = mysqli_real_escape_string ($connect, trim($_POST['phone']));		//edit
					}else{
						$need_form_array['phone'] = 'Enter a valid phone number';
					}
					} else {
					$need_form_array['phone'] = 'Enter a valid phone number';
					}
					
					if ($_POST['city'] == "Choose Area"){
					$need_form_array['goods_category'] = 'Please choose your location';			
					}else{
					$product_city = $_POST['city'];
					}
					
					
				
				if(empty($need_form_array)){
					if(preg_match('/(job|jobs|buy|get|want|signup|sign up|register|visit|i need to|i need 2|sell|customer|customers)/i',$need) OR preg_match('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i',$need) OR filter_var($need, FILTER_VALIDATE_URL)){
						echo '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Your request has been sent, and you can now choose from the several shops that will contact you.</div>';
					unset($_POST['need']);
					unset($_POST['city']);
					unset($_POST['phone']);
					unset($_POST['post_categories']);
					//	
						// matching urls to guard against spamming
					}else{
					$users_and_nonusers = (isset($_SESSION['user_id']))?$_SESSION['user_id']:0;
					$find_state_name = mysqli_query($connect, "SELECT state_name FROM local_area WHERE area = '".$product_city."'") or die(db_conn_error);
						
						while($result_state=mysqli_fetch_array($find_state_name)){
							$input_state = $result_state['state_name'];
						}
					

					
					$nows = strtotime('now');
					mysqli_query($connect, "INSERT INTO post(post_id, user_id_post, post_city, post_state_id, posts, phone, php_timestamp, post_category) VALUES ('', '".$users_and_nonusers."','".$product_city."', '".$input_state."', '".$need."', '".$phone."', '".$nows."', '".$postcategory."' )") or die(db_conn_error);	
					unset($_POST['need']);
					unset($_POST['city']);
					unset($_POST['phone']);
					unset($_POST['post_categories']);
					
					echo '<div class="alert alert-success alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Your request has been sent, and you can now choose from the several shops that will contact you.</div>';
					
					//unset($_POST['fee']);
					
					}
					
					}
				}
				?>
				
				
				<div>
                <a class="list-group-item active list-group-item-danger">I need ...</a>
				 <ul class="list-group">
				
				<form role="form" action="" method="POST">
					<li class="list-group-item">
					<div class="form-group">
						<br>
						
					<?php if (array_key_exists('need', $need_form_array)) {
							
							echo '<div class="alert alert-warning alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$need_form_array['need'].'</div>';}?>	
						<small>Format: <b>"I need"</b></small><small style="float:right;" id=""></small>
						<input onkeydown="" type="text" placeholder="I need a female leather bag." class="form-control" name="need" id="need" value="<?php if(isset($_POST['need'])){echo $_POST['need'];} ?>"/>
					</div>
					
					<?php
					//edit
					$categories_array=array('Mobile and Tabs', 'Computers', 'Appliances', 'Clothings', 'Fashion Items', 
					'Kids Accessories', 'Vehicles', 'Vehicle Accessories','Real Estate', 'Pets','Food and Drinks', 'Groceries', 
					'Health', 'Garden', 'Home', 'Fun', 'Art');	
					?>

					<div class="form-group">
					
					<?php if (array_key_exists('post_categories', $need_form_array)) {
					echo  '<div class="alert alert-warning alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$need_form_array['post_categories'].'</div>';}?>
	
	<select class="form-control input-sm" name="post_categories" id="categories">
		 <option>Categories</option>
			<?php
				if(isset ($_POST['post_categories'])){
					foreach ($categories_array as $option){
						$sel = ($option==$_POST['post_categories'])?"Selected='selected'":"";
						echo '<option '.$sel.'>'.$option.'</option>';}
				}else{
						foreach ($categories_array as $option){
						echo '<option>'.$option.'</option>';
						}
				}
			?>
	</select>
	</div>
			<!--edit-->		
					
					<div class="form-group">
						
						<?php if (array_key_exists('goods_category', $need_form_array)) {
						 echo '<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$need_form_array['goods_category'].'</div>';}?>
						<select class="form-control input-sm" name="city" id="name">
							<?php
							include("../incs_shop/cities_signup.php");
							?>
						</select>
					</div>
					<div>
					<div class="form-group">
						
						<?php if (array_key_exists('phone', $need_form_array)) {
							echo '<div class="alert alert-warning alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$need_form_array['phone'].'</div>';}?>
						<input type="text" placeholder="08012345678" class="form-control" name="phone" id="phone" value="<?php if(isset($_POST['phone'])){echo $_POST['phone'];} ?>"/>
						
					</div>
					</div>
					
					<!--edit-->
					
					<!--<p class="text-info"><small>After you submit this form, several shops will contact you, and you may ask for "Patronage bonus" from them. "Patronage bonus" is the money you are given by the shop owner if you buy from them. It is 7% of the price of what you bought. So if given, search the username of the shop, comment, and then rate it. Well rated shops get more patronage, and not all shops give patronage bonus.</small></p>-->
					
					<div class="form-group">
					
					<button type="submit" class="btn btn-primary" name="post_need">Submit</button>
					</div>
					</li>
				</form>
				</ul>
				
				</div>
				
		
		
		
			</div>
		
					
			<div class="col-md-8 col-sm-8 col-xs-12">
				<div>
                <a class="list-group-item active list-group-item-danger">What people need</a>
				
				<ul class="list-group">
				 <li class="list-group-item">
				 <div class="box_loading"><div id="loading"></div></div>
				<?php
				echo '<center>';
				echo '<div class="center-block">';
				
				echo ("<button id='getrecordsabia' type='button' class='btn btn-primary btn-xs'>Abia</button>");
				echo ("<button id='getrecordsadamawa' type='button' class='btn btn-primary btn-xs'>Adamawa</button>");
				echo ("<button id='getrecordsakwaibom' type='button' class='btn btn-primary btn-xs'>Akwa Ibom</button>");
				echo ("<button id='getrecordsanambra' type='button' class='btn btn-primary btn-xs'>Anambra</button>");
				echo ("<button id='getrecordsbauchi' type='button' class='btn btn-primary btn-xs'>Bauchi</button>");
				echo ("<button id='getrecordsbayelsa' type='button' class='btn btn-primary btn-xs'>Bayelsa</button>");
				echo ("<button id='getrecordsbenue' type='button' class='btn btn-primary btn-xs'>Benue</button>");
				echo ("<button id='getrecordsborno' type='button' class='btn btn-primary btn-xs'>Borno</button>");
				echo ("<button id='getrecordscrossriver' type='button' class='btn btn-primary btn-xs'>Cross River</button>");
				echo ("<button id='getrecordsdelta' type='button' class='btn btn-primary btn-xs'>Delta</button>");
				
				echo ("<button id='getrecordsebonyi' type='button' class='btn btn-primary btn-xs'>Ebonyi</button>");
				echo ("<button id='getrecordsedo' type='button' class='btn btn-primary btn-xs'>Edo</button>");
				echo ("<button id='getrecordsekiti' type='button' class='btn btn-primary btn-xs'>Ekiti</button>");
				echo ("<button id='getrecordsenugu' type='button' class='btn btn-primary btn-xs'>Enugu</button>");
				echo ("<button id='getrecordsgombe' type='button' class='btn btn-primary btn-xs'>Gombe</button>");
				echo ("<button id='getrecordsimo' type='button' class='btn btn-primary btn-xs'>Imo</button>");
				echo ("<button id='getrecordsjigawa' type='button' class='btn btn-primary btn-xs'>Jigawa</button>");
				echo ("<button id='getrecordskaduna' type='button' class='btn btn-primary btn-xs'>Kaduna</button>");
				echo ("<button id='getrecordskano' type='button' class='btn btn-primary btn-xs'>Kano</button>");
				echo ("<button id='getrecordskatsina' type='button' class='btn btn-primary btn-xs'>Katsina</button>");
				echo ("<button id='getrecordskebbi' type='button' class='btn btn-primary btn-xs'>Kebbi</button>");
				echo ("<button id='getrecordskogi' type='button' class='btn btn-primary btn-xs'>Kogi</button>");
				echo ("<button id='getrecordskwara' type='button' class='btn btn-primary btn-xs'>Kwara</button>");
				echo ("<button id='getrecordslagos' type='button' class='btn btn-primary btn-xs'>Lagos</button>");
				echo ("<button id='getrecordsnasarawa' type='button' class='btn btn-primary btn-xs'>Nasarawa</button>");
				echo ("<button id='getrecordsniger' type='button' class='btn btn-primary btn-xs'>Niger</button>");
				echo ("<button id='getrecordsogun' type='button' class='btn btn-primary btn-xs'>Ogun</button>");
				echo ("<button id='getrecordsondo' type='button' class='btn btn-primary btn-xs'>Ondo</button>");
				echo ("<button id='getrecordsosun' type='button' class='btn btn-primary btn-xs'>Osun</button>");
				echo ("<button id='getrecordsoyo' type='button' class='btn btn-primary btn-xs'>Oyo</button>");
				echo ("<button id='getrecordsplateau' type='button' class='btn btn-primary btn-xs'>Plateau</button>");
				echo ("<button id='getrecordsrivers' type='button' class='btn btn-primary btn-xs'>Rivers</button>");
				echo ("<button id='getrecordssokoto' type='button' class='btn btn-primary btn-xs'>Sokoto</button>");
				echo ("<button id='getrecordstaraba' type='button' class='btn btn-primary btn-xs'>Taraba</button>");
				echo ("<button id='getrecordsyobe' type='button' class='btn btn-primary btn-xs'>Yobe</button>");
				echo ("<button id='getrecordszamfara' type='button' class='btn btn-primary btn-xs'>Zamfara</button>");
				echo ("<button id='getrecordsfct' type='button' class='btn btn-primary btn-xs'>FCT</button>");
				
				
				echo '</div>';
				echo '</center>';
				
				$need_sell_post = mysqli_query($connect,"SELECT * FROM post ORDER BY php_timestamp DESC LIMIT 0 , 3") or die(db_conn_error);
			echo("<div class='box_after_header_post'>");
				while($whileneed_sell_post = mysqli_fetch_array($need_sell_post)){	
					
					echo '<div class="clearfix" style="margin-bottom:20px;">';
					
					echo '<h5>'.$whileneed_sell_post['posts'].'</h5>';
					echo '<div class="pull-left"><span class="label label-success">'.$whileneed_sell_post['post_state_id'].'</span></div>';
					echo '<div class="pull-right"><a href="tel:'.$whileneed_sell_post['phone'].'" title="'.$whileneed_sell_post['phone'].'"><span class="label label-info">Call now</span></a></div>';
					
					echo '</div>';
			}
			echo "</div>";
			?>
				</li>
				</ul>
				</div>
			
			</div>
		
			
			
			
			<!--<div class="col-md-5 col-sm-5 col-xs-12">
				<div>
                <a class="list-group-item active list-group-item-danger">Marketplace</a>
				<ul class="list-group">
				 <li class="list-group-item">
				  <div class="box_loading"><div id="loading"></div></div>-->
				 <?php
				/*echo '<center>';
				echo '<div class="center-block">';
				
				echo ("<button id='getrecordsabiasell' type='button' class='btn btn-primary btn-xs'>Abia</button>");
				echo ("<button id='getrecordsadamawasell' type='button' class='btn btn-primary btn-xs'>Adamawa</button>");
				echo ("<button id='getrecordsakwaibomsell' type='button' class='btn btn-primary btn-xs'>Akwa Ibom</button>");
				echo ("<button id='getrecordsanambrasell' type='button' class='btn btn-primary btn-xs'>Anambra</button>");
				echo ("<button id='getrecordsbauchisell' type='button' class='btn btn-primary btn-xs'>Bauchi</button>");
				echo ("<button id='getrecordsbayelsasell' type='button' class='btn btn-primary btn-xs'>Bayelsa</button>");
				echo ("<button id='getrecordsbenuesell' type='button' class='btn btn-primary btn-xs'>Benue</button>");
				echo ("<button id='getrecordsbornosell' type='button' class='btn btn-primary btn-xs'>Borno</button>");
				echo ("<button id='getrecordscrossriversell' type='button' class='btn btn-primary btn-xs'>Cross River</button>");
				echo ("<button id='getrecordsdeltasell' type='button' class='btn btn-primary btn-xs'>Delta</button>");
				
				echo ("<button id='getrecordsebonyisell' type='button' class='btn btn-primary btn-xs'>Ebonyi</button>");
				echo ("<button id='getrecordsedosell' type='button' class='btn btn-primary btn-xs'>Edo</button>");
				echo ("<button id='getrecordsekitisell' type='button' class='btn btn-primary btn-xs'>Ekiti</button>");
				echo ("<button id='getrecordsenugusell' type='button' class='btn btn-primary btn-xs'>Enugu</button>");
				echo ("<button id='getrecordsgombesell' type='button' class='btn btn-primary btn-xs'>Gombe</button>");
				echo ("<button id='getrecordsimosell' type='button' class='btn btn-primary btn-xs'>Imo</button>");
				echo ("<button id='getrecordsjigawasell' type='button' class='btn btn-primary btn-xs'>Jigawa</button>");
				echo ("<button id='getrecordskadunasell' type='button' class='btn btn-primary btn-xs'>Kaduna</button>");
				echo ("<button id='getrecordskanosell' type='button' class='btn btn-primary btn-xs'>Kano</button>");
				echo ("<button id='getrecordskatsinasell' type='button' class='btn btn-primary btn-xs'>Katsina</button>");
				echo ("<button id='getrecordskebbisell' type='button' class='btn btn-primary btn-xs'>Kebbi</button>");
				echo ("<button id='getrecordskogisell' type='button' class='btn btn-primary btn-xs'>Kogi</button>");
				echo ("<button id='getrecordskwarasell' type='button' class='btn btn-primary btn-xs'>Kwara</button>");
				echo ("<button id='getrecordslagossell' type='button' class='btn btn-primary btn-xs'>Lagos</button>");
				echo ("<button id='getrecordsnasarawasell' type='button' class='btn btn-primary btn-xs'>Nasarawa</button>");
				echo ("<button id='getrecordsnigersell' type='button' class='btn btn-primary btn-xs'>Niger</button>");
				echo ("<button id='getrecordsogunsell' type='button' class='btn btn-primary btn-xs'>Ogun</button>");
				echo ("<button id='getrecordsondosell' type='button' class='btn btn-primary btn-xs'>Ondo</button>");
				echo ("<button id='getrecordsosunsell' type='button' class='btn btn-primary btn-xs'>Osun</button>");
				echo ("<button id='getrecordsoyosell' type='button' class='btn btn-primary btn-xs'>Oyo</button>");
				echo ("<button id='getrecordsplateausell' type='button' class='btn btn-primary btn-xs'>Plateau</button>");
				echo ("<button id='getrecordsriverssell' type='button' class='btn btn-primary btn-xs'>Rivers</button>");
				echo ("<button id='getrecordssokotosell' type='button' class='btn btn-primary btn-xs'>Sokoto</button>");
				echo ("<button id='getrecordstarabasell' type='button' class='btn btn-primary btn-xs'>Taraba</button>");
				echo ("<button id='getrecordsyobesell' type='button' class='btn btn-primary btn-xs'>Yobe</button>");
				echo ("<button id='getrecordszamfarasell' type='button' class='btn btn-primary btn-xs'>Zamfara</button>");
				echo ("<button id='getrecordsfctsell' type='button' class='btn btn-primary btn-xs'>FCT</button>");
				
				
				echo '</div>';
				echo '</center>';
				
				
				$need_sell_post_ad = mysqli_query($connect,"SELECT * FROM sell, users WHERE user_id_sell = user_id ORDER BY php_timestamp_sell DESC LIMIT 0 , 5") or die(db_conn_error);
			echo("<div class='box_after_header_postsell'>");
				while($whileneed_sell_post_ad = mysqli_fetch_array($need_sell_post_ad)){	
					
					echo '<div class="clearfix" style="margin-bottom:20px;">';
					
					echo '<a href="'.$whileneed_sell_post_ad['username'].'.php" style="text-decoration:underline;"><h5>'.$whileneed_sell_post_ad['sell'].'</h5></a>';
					
					echo '<div>';
				if($whileneed_sell_post_ad['gift'] == 1 OR $whileneed_sell_post_ad['extra'] == 1 OR !empty($whileneed_sell_post_ad['referral_fee'])){	
					echo '<div class="pull-left"><b><small>We give >>> </small></b></div><br> ';
					
					if($whileneed_sell_post_ad['gift'] == 1){
						echo '<div class="pull-left"><span class="label label-info">gift</span></div>';
					}
					if($whileneed_sell_post_ad['extra'] == 1){
						echo '<div class="pull-left"><span class="label label-danger">extra</span></div>';
					}
					if(!empty($whileneed_sell_post_ad['referral_fee'])){
						echo '<div class="pull-left"><span class="label label-primary">referral fee(&#8358;'.number_format($whileneed_sell_post_ad['referral_fee']).')</span></div>';
					}
				}	
					echo '</div><br><br>';
					
					echo '<div class="pull-left" style="margin-top:5px; display:inline-block;"><span class="label label-success">'.$whileneed_sell_post_ad['post_state_id_sell'].'</span></div>';
					echo '<div class="pull-right" style="margin-top:5px; display:inline-block;"><a href="tel:'.$whileneed_sell_post_ad['phone1'].'"><span class="label label-info">Call</span></a></div>';
					
					echo '</div>';
			}
			echo "</div>";*/
				?>
				 
				
				<!-- </li>
				</ul>
				</div>
			</div>-->
		
		