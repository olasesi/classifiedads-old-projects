				
		<?php
		
		
		//mysqli_query($connect, "DELETE FROM ad_referral WHERE ad_time_to_finish < '".strtotime('now')."' AND ad_payment_status = '1'") or die(db_conn_error);
		
		//$shuffling_code = mysqli_query($connect, "SELECT * FROM ad_referral WHERE ad_payment_status = '1' ORDER BY RAND() LIMIT 2") or die(db_conn_error);
		//while($whiling_shuffling_code = mysqli_fetch_array($shuffling_code)){
		
		echo '<div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">';
		echo '<span class="label label-danger">ad</span>';
		echo '<div>';
			echo '<a href="https://wa.me/message/TUVJYV52C5Q6B1"> <img class="center-block" style="width:250px; height:250px;" src="ad/ad-banner/paidad.jpg" alt="designs by blocks"/></a>';
		echo '</div>';
		echo '</div>';
		
		
		echo '<div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">';
		echo '<span class="label label-danger">ad</span>';
		echo '<div>';
			echo '<a href="https://wa.me/message/TUVJYV52C5Q6B1"> <img class="center-block" style="width:250px; height:250px;" src="ad/ad-banner/paidad2.jpg" alt="designs by blocks"/></a>';
		echo '</div>';
		echo '</div>';
		//}
		
		
		
		?>		
				
				
				
				
				<div class=" col-md-12 col-sm-6 col-xs-6" >
                   <!-- <span class="label label-danger">ad</span>-->
                    <div class="">
                    <?php
					/*$banner1 = mysqli_query($connect, "SELECT * FROM ad_banner WHERE ad_position = '1'") or die(db_conn_error);
					if(mysqli_num_rows($banner1) == 1){
					while($sponsored1 = mysqli_fetch_array($banner1)){
						
						echo '<a href="'.$sponsored1['ad_link'].'"> <img class="center-block" style="width:300px; height:250px;" src="ad/ad-banner/'.$sponsored1['ad_banner_image'].'" alt="'.$sponsored1['ad_name'].'" /></a>';
					}	
					}else{
						echo '<a href=""><h3>FOR PAID AD</h3>'.AD_CONTACT_NUMBER.'</a>';		//link page to advertise
					}*/
					?>   
					</div>
                </div>
                <div class=" col-md-12 col-sm-6 col-xs-6">
                  <!--  <span class="label label-danger">ad</span>-->
                    <div class="">
                       <?php
					/*$banner2 = mysqli_query($connect, "SELECT * FROM ad_banner WHERE ad_position = '2'") or die(db_conn_error);
					if(mysqli_num_rows($banner2) == 1){
					while($sponsored2 = mysqli_fetch_array($banner2)){
						
						echo '<a href="'.$sponsored2['ad_link'].'"> <img class="center-block" style="width:300px; height:250px;" src="ad/ad-banner/'.$sponsored2['ad_banner_image'].'" alt="'.$sponsored2['ad_name'].'" /></a>';
					}	
					}else{
						echo '<a href=""><h3>FOR PAID AD</h3>'.AD_CONTACT_NUMBER.'</a>';		//link page to advertise
					}*/
					?>   
                        
                    </div>
                </div>