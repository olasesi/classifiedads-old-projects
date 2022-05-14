<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");
$page_title = 'Appliances - Myshoptwo';
$descript = 'Get the latest electronics at affordable prices. Get extra pay for buying from our e-shop.';

include("../incs_shop/header_all.php");
?>

  <div class="container">
        <div class="row">
           <div class="text-center">
                <div class=" col-md-6 col-sm-6 col-xs-6" >
                     <span class="label label-danger">ad</span>
                    <div class="thumbnail product-box">
                    <?php
					$banner1 = mysqli_query($connect, "SELECT * FROM ad_banner WHERE ad_position = '1'") or die(db_conn_error);
					if(mysqli_num_rows($banner1) == 1){
					while($sponsored1 = mysqli_fetch_array($banner1)){
						
						echo '<a href="'.$sponsored1['ad_link'].'"> <img src="ad/ad-banner/'.$sponsored1['ad_banner_image'].'" alt="" /></a>';
					}	
					}else{
						echo '<a href=""><h1>PLACE AD HERE</h1></a>';		//link page to advertise
					}
					?>   
					   
					   
                       
                    </div>
                </div>
                <div class=" col-md-6 col-sm-6 col-xs-6">
                     <span class="label label-danger">ad</span>
                    <div class="thumbnail product-box">
                       <?php
					$banner2 = mysqli_query($connect, "SELECT * FROM ad_banner WHERE ad_position = '2'") or die(db_conn_error);
					if(mysqli_num_rows($banner2) == 1){
					while($sponsored2 = mysqli_fetch_array($banner2)){
						
						echo '<a href="'.$sponsored2['ad_link'].'"> <img src="ad/ad-banner/'.$sponsored2['ad_banner_image'].'" alt="'.$sponsored2['ad_name'].'" /></a>';
					}	
					}else{
						echo '<a href=""><h1>PLACE AD HERE</h1></a>';		//link page to advertise
					}
					?>   
                        
                    </div>
                </div>
            </div>
           
            
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <?php
			//to show active
			$active_appliances = 1;
			?>
			<?php include("../incs_shop/leftpanel_all.php");?>
            <?php include ('../incs_shop/paginate.php');?>
		   <?php 
		   
		   $statement = "goods WHERE categories = 'Appliances' AND UID = '".$user_id."' ORDER BY goods_timestamp DESC"; 
		  
		   ?>
		   <!-- /.col -->
           
			<div class="col-xs-6 col-sm-8 col-md-9">
                 <div>
                   <h2 class="text-center text-primary">Appliances</h2>
                </div>
                <!-- /.div -->
                <div class="row">
                    <div class="btn-group alg-right-pad">
                        <button type="button" class="btn btn-danger" disabled="disabled">
						
						<?php 
						$total_products = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Appliances' AND UID = '".$user_id."'") or die(db_conn_error);
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
                      <?php echo pagination($statement,$per_page,$page,$url=MYSHOPTWO."/my-shop-appliances.php?brand_username=".$username."&"); ?>
                </div>
                <!-- /.row -->
              
               
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
   
 <?php
include("../incs_shop/footer_all.php");
?>