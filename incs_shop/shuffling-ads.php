<?php
	/*	
		echo '<div class="row">';
		mysqli_query($connect, "DELETE FROM ad_referral WHERE ad_time_to_finish < '".strtotime('now')."' AND ad_payment_status = '1'") or die(db_conn_error);
		
		$shuffling_code = mysqli_query($connect, "SELECT * FROM ad_referral WHERE ad_payment_status = '1' ORDER BY RAND() LIMIT 2") or die(db_conn_error);
		while($whiling_shuffling_code = mysqli_fetch_array($shuffling_code)){
		
		echo '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">';
		echo '<center><span class="label label-danger">ad</span></center>';
		echo '<div>';
			echo '<a href="'.$whiling_shuffling_code['referral_ad_link'].'"> <img class="center-block" style="width:300px; height:250px;" src="ad/ad-banner/'.$whiling_shuffling_code['referral_id_image'].'" alt="'.$whiling_shuffling_code['ad_name'].'"/></a>';
		echo '</div>';
		echo '</div>';
		}
		
		echo '</div>';
		*/
		?>