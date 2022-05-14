<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");


			echo("<div class='box_after_header_postsell'>");
			$need_sell_post_ad_query = mysqli_query($connect,"SELECT * FROM sell, users WHERE user_id_sell = user_id AND post_state_id_sell = 'Benue' ORDER BY php_timestamp_sell DESC LIMIT 0 , 5") or die(db_conn_error);	
				
				while($whileneed_sell_post_ad_query = mysqli_fetch_array($need_sell_post_ad_query)){	
					
					echo '<div class="clearfix" style="margin-bottom:20px;">';
					
					echo '<a href="'.$whileneed_sell_post_ad_query['username'].'.php"><h5>'.$whileneed_sell_post_ad_query['sell'].'</h5></a>';
					
					echo '<div>';
				if($whileneed_sell_post_ad_query['patronage_fee'] == 1 OR $whileneed_sell_post_ad_query['gift'] == 1 OR $whileneed_sell_post_ad_query['extra'] == 1 OR !empty($whileneed_sell_post_ad_query['referral_fee'])){	
					echo '<div class="pull-left"><b><small>We give >>> </small></b></div><br> ';
					if($whileneed_sell_post_ad_query['patronage_fee'] == 1){
						echo '<div class="pull-left"><span class="label label-success">patronage fee</span></div>';
					}
					if($whileneed_sell_post_ad_query['gift'] == 1){
						echo '<div class="pull-left"><span class="label label-info">gift</span></div>';
					}
					if($whileneed_sell_post_ad_query['extra'] == 1){
						echo '<div class="pull-left"><span class="label label-danger">extra</span></div>';
					}
					if(!empty($whileneed_sell_post_ad_query['referral_fee'])){
						echo '<div class="pull-left"><span class="label label-primary">referral fee(&#8358;'.number_format($whileneed_sell_post_ad_query['referral_fee']).')</span></div>';
					}
				}	
					echo '</div><br><br>';
					
					echo '<div class="pull-left" style="margin-top:5px; display:inline-block;"><span class="label label-success">'.$whileneed_sell_post_ad_query['post_state_id_sell'].'</span></div>';
					echo '<div class="pull-right" style="margin-top:5px; display:inline-block;"><a href="tel:'.$whileneed_sell_post_ad_query['phone1'].'"><span class="label label-info">'.$whileneed_sell_post_ad_query['phone1'].'</span></a></div>';
					
					echo '</div>';
			}
			echo "</div>";
?>
