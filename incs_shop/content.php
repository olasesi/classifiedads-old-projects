   <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="well well-lg offer-box text-center">
<?php echo CHRISTMAS_DECOR; ?>
	

	
<?php
	if(isset($_SESSION['user_id']) AND $user_id == $_SESSION['user_id']){
	/*	
	$if_referral_exist1 = mysqli_query($connect,"SELECT * FROM lookup_table WHERE lookup_username = '".$_SESSION['username']."'") or die(db_conn_error);
	$confirm_rows_referrals1 = mysqli_num_rows($if_referral_exist1);
	if($confirm_rows_referrals1 == 0){
	
	//This is for those that came on their own or has invalid referral. They will have NR		
			$nows1 = strtotime('now');
			mysqli_query($connect, "INSERT INTO lookup_table (id_lookup_table, lookup_username, account_name, account_number, bank_name, payment_status, total_cash_to_withdraw, lookup_timestamp) VALUES ('','".$_SESSION['username']."','','','','0','0','".$nows1."')") or die(db_conn_error);
				$search_id_of_lookup_wrong = mysqli_query($connect, "SELECT id_lookup_table FROM lookup_table WHERE lookup_username = '".$_SESSION['username']."'") or die(db_conn_error);		//to know the id of the lookup_table
				$value_id_of_lookup_wrong = mysqli_fetch_array($search_id_of_lookup_wrong);
				
				//searching for the last group value
				$max_value_wrong = mysqli_query($connect, "SELECT MAX(ref_group) AS maximum FROM referral");
				$max_value_array_wrong = mysqli_fetch_array($max_value_wrong);
				$max_group_value_wrong = $max_value_array_wrong['maximum'] + 1;
				//
				
				mysqli_query($connect, "INSERT INTO referral (ref_id, id_lookup_table2, ref_referrer, ref_username, ref_group, ref_level, ref_total_cash, ref_withdrawal, ref_timestamp) VALUES ('', '".$value_id_of_lookup_wrong['id_lookup_table']."','NR','".$_SESSION['username']."','".$max_group_value_wrong."','1','0','0','".$nows1."')") or die(db_conn_error);	
		
	}
	*/

		if(empty($_SESSION['headline'])){
		//edit
		echo 'Welcome to '.$brand_name;
		}else{
		echo $_SESSION['headline'];
		
		}	
		
		
	}else{
		if(empty($headline)){
		echo 'Welcome to '.$brand_name;
		}else{
		echo $headline;
		}	
	}
                                   
 ?>             
              
                </div>
        
				
				<div class="main box-border">
                    <div id="mi-slider" class="mi-slider">
					
						
							
							<?php
						
						$selecting_sliders = mysqli_query($connect, "SELECT * FROM slider WHERE user_id_slider = '".$user_id."' ORDER BY slide_timestamp DESC LIMIT 0, 4") or die(db_conn_error);
						if(mysqli_num_rows($selecting_sliders) > 0){
						echo '<ul>';
						while ($array_slider = mysqli_fetch_array($selecting_sliders)){
	
						 echo '<li><a href="full-details-slide.php?details='.$array_slider['id_slider'].'">
                             <img src="assets/ItemSlider/images/'.$array_slider['slider_image'].'" alt="'.$array_slider['slide_goods_name'].'"><h4>'.$array_slider['slide_goods_name'].'</h4>';
						
						if(isset($_SESSION['user_id']) AND $user_id == $_SESSION['user_id']){
							
							 echo '<a href="'.MYSHOPTWO.'/edit-shop-slider-top.php?goods_no='.$array_slider['id_slider'].'"><i class="fa fa-edit"></i></a></a></li>';
							 
							 }else{
							echo '</a></li>'; 
								 
							 }
						
						}
						echo '</ul>';
					}else{
						//if no slide has been uploaded yet
					}
						
							?>	
						
						
                       
                        
						<?php
						
						$selecting_sliders2 = mysqli_query($connect, "SELECT * FROM slider WHERE user_id_slider = '".$user_id."' ORDER BY slide_timestamp DESC LIMIT 4, 4") or die(db_conn_error);
						if(mysqli_num_rows($selecting_sliders2) > 0){
						echo '<ul>';
						while ($array_slider2 = mysqli_fetch_array($selecting_sliders2)){
	
						 echo '<li><a href="full-details-slide.php?details='.$array_slider2['id_slider'].'">
                             <img src="assets/ItemSlider/images/'.$array_slider2['slider_image'].'" alt="'.$array_slider2['slide_goods_name'].'"><h4>'.$array_slider2['slide_goods_name'].'</h4>';
						
						if(isset($_SESSION['user_id']) AND $user_id == $_SESSION['user_id']){
							
							 echo '<a href="'.MYSHOPTWO.'/edit-shop-slider.top.php?goods_no='.$array_slider2['id_slider'].'"><i class="fa fa-edit"></i></a></a></li>';
							 
							 }else{
							echo '</a></li>'; 
								 
							 }
						
						}	
						echo '</ul>';
						
					
					}
						
							?>	
						
						
						
                           <?php
						$selecting_sliders3 = mysqli_query($connect, "SELECT * FROM slider WHERE user_id_slider = '".$user_id."' ORDER BY slide_timestamp DESC LIMIT 8, 4") or die(db_conn_error);
						if(mysqli_num_rows($selecting_sliders3) > 0){
						echo '<ul>';
						while ($array_slider3 = mysqli_fetch_array($selecting_sliders3)){
	
						 echo '<li><a href="full-details-slide.php?details='.$array_slider3['id_slider'].'">
                             <img src="assets/ItemSlider/images/'.$array_slider3['slider_image'].'" alt="'.$array_slider3['slide_goods_name'].'"><h4>'.$array_slider3['slide_goods_name'].'</h4>';
						
						if(isset($_SESSION['user_id']) AND $user_id == $_SESSION['user_id']){
							
							 echo '<a href="'.MYSHOPTWO.'/edit-shop-slider-top.php?goods_no='.$array_slider3['id_slider'].'"><i class="fa fa-edit"></i></a></a></li>';
							 
							 }else{
							echo '</a></li>'; 
								 
							 }
						
						
						
						
						
						}	
						echo '</ul>';
					
					}
						
							?>	
                       
                       
					   
                            <?php
						$selecting_sliders4 = mysqli_query($connect, "SELECT * FROM slider WHERE user_id_slider = '".$user_id."' ORDER BY slide_timestamp DESC LIMIT 12, 4") or die(db_conn_error);
						if(mysqli_num_rows($selecting_sliders4) > 0){
						echo '<ul>';
						while ($array_slider4 = mysqli_fetch_array($selecting_sliders4)){
	
						 echo '<li><a href="full-details-slide.php?details='.$array_slider4['id_slider'].'">
                             <img src="assets/ItemSlider/images/'.$array_slider4['slider_image'].'" alt="'.$array_slider4['slide_goods_name'].'"><h4>'.$array_slider4['slide_goods_name'].'</h4>';
						
						if(isset($_SESSION['user_id']) AND $user_id == $_SESSION['user_id']){
							
							 echo '<a href="'.MYSHOPTWO.'/edit-shop-slider-top.php?goods_no='.$array_slider4['id_slider'].'"><i class="fa fa-edit"></i></a></a></li>';
							 
							 }else{
							echo '</a></li>'; 
								 
							 }
						
						}
						echo '</ul>';
					}
						
						?>	
                       <?php 
                        
						if(isset($user_id)){		//uploading is possible between 0-16	 AND $circle < 16
						$selecting_circle = mysqli_query($connect, "SELECT * FROM slider WHERE user_id_slider = '".$user_id."'") or die(db_conn_error);
						$circle = mysqli_num_rows($selecting_circle);
						
						if(isset($_SESSION['user_id'])){
							if($user_id == $_SESSION['user_id']){
						
							echo '<ul>
							<li><a href="upload-slide-product.php">
                             <i class="fa fa-upload fa-5x"></i><h4>Upload Products or Services</h4></a></li> 
							</ul>';
						}
						}
						
						}
						?>
						<nav>
                          <?php
						
						
						 if(0 < $circle){
							 echo '<a href="#"><i class="fa fa-circle"></i></a>';
						 } 
						 
						 if($circle > 4){
							 echo '<a href="#"><i class="fa fa-circle"></i></a>';
						 }
						 
						  if($circle > 8){
							 echo '<a href="#"><i class="fa fa-circle"></i></a>';
						 } 
						 
						 if($circle > 12){
							 echo '<a href="#"><i class="fa fa-circle"></i></a>';
						 }
						  
						
						 if(isset($_SESSION['user_id'])){		//uploading is possible between 0-16
						if($user_id == $_SESSION['user_id']){
						echo '<a href="#"><i class="fa fa-circle"></i></a>';
						}
						 }
						?> 
                          
							
                        </nav>
                    </div>
                    
                </div>
                <br />
            </div>
            <!-- /.col -->
           
            <div class="col-md-3 text-center">
               <?php 
				include("../incs_shop/homepage_ad.php");
				?>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <?php include("../incs_shop/shuffling-ads.php");?>
		<!-- <div class="row">-->
			<?php //include("../incs_shop/need_marketplace.php"); ?>
		<!--</div>-->
		
		<div class="row">
            <?php include("../incs_shop/leftpanel_all.php");?>
            <?php include ('../incs_shop/paginate.php');?>
		   <?php $statement = "goods WHERE UID = '".$user_id."' ORDER BY goods_timestamp DESC"; ?>
		   <!-- /.col -->
           
			<div class=" col-sm-8 col-md-9">
                <div>
                    <ol class="breadcrumb">
                        
                        <li class="active">Latest Products</li>
                    </ol>
                </div>
                <!-- /.div -->
                <div class="row">
                    <div class="btn-group alg-right-pad">
                        <button type="button" class="btn btn-danger" disabled="disabled">
						
						<?php 
						$total_products = mysqli_query($connect, "SELECT * FROM goods WHERE UID = '".$user_id."'") or die(db_conn_error);
						echo mysqli_num_rows($total_products);
						?> 
						items</button>
                       
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <?php
				include("../incs_shop/products.php");  
                   ?>
                </div>
                <!-- /.row -->
                <div class="row">
                    <?php echo pagination($statement,$per_page,$page,$url=MYSHOPTWO."/".$username.".php?"); ?>
                </div>
                <!-- /.row -->
              
               
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
   
