<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");

$page_title = 'Search shop';
$descript = 'Search shops for products or services';
include("../incs_shop/header_all_search.php");
?>


 <div class="container">
       <!-- <div class="row">
            <div class="text-center">
                <div class=" col-md-6 col-sm-6 col-xs-6" >
                     <span class="label label-danger">ad</span>
                    <div class="thumbnail product-box">-->
                        <?php
					/*$banner1 = mysqli_query($connect, "SELECT * FROM ad_banner WHERE ad_position = '1'") or die(db_conn_error);
					if(mysqli_num_rows($banner1) == 1){
					while($sponsored1 = mysqli_fetch_array($banner1)){
						
						echo '<a href="'.$sponsored1['ad_link'].'"> <img src="ad/ad-banner/'.$sponsored1['ad_banner_image'].'" alt="" /></a>';
					}	
					}else{
						echo '<a href=""><h1>PLACE AD HERE</h1></a>';		//link page to advertise
					}*/
					?>   
                   <!-- </div>
                </div>
                <div class=" col-md-6 col-sm-6 col-xs-6">
                    <span class="label label-danger">ad</span>
                    <div class="thumbnail product-box">-->
                        <?php
					/*$banner2 = mysqli_query($connect, "SELECT * FROM ad_banner WHERE ad_position = '2'") or die(db_conn_error);
					if(mysqli_num_rows($banner2) == 1){
					while($sponsored2 = mysqli_fetch_array($banner2)){
						
						echo '<a href="'.$sponsored2['ad_link'].'"> <img src="ad/ad-banner/'.$sponsored2['ad_banner_image'].'" alt="'.$sponsored2['ad_name'].'" /></a>';
					}	
					}else{
						echo '<a href=""><h1>PLACE AD HERE</h1></a>';		//link page to advertise
					}*/
					?>   
                  <!--  </div>
                </div>
            </div>
           
        </div>-->
        <!-- /.row -->
        <div class="row">
           <?php include("../incs_shop/leftpanel_all.php");?>
           <?php include ('../incs_shop/paginate.php');?>
		   
		   <?php
			if(isset($_GET['searchquery'])){
				if($_GET['searchquery'] == ''){
				$statement = "users, goods WHERE UID = user_id AND username = '".mysqli_real_escape_string ($connect, $_GET['user'])."' ORDER BY goods_timestamp DESC"; 	
				}else{
				$statement = "users, goods WHERE goods_name LIKE '%".mysqli_real_escape_string ($connect,$_GET['searchquery'])."%' AND UID = user_id AND username = '".mysqli_real_escape_string ($connect, $_GET['user'])."' ORDER BY goods_timestamp DESC"; 
				}
			}
			?> 
            <div class="col-xs-5 col-sm-8 col-md-9">
                <div>
                   <h2 class="text-center text-primary">SEARCH RESULTS</h2>
                </div>
				<br>
                <!-- /.div -->
              
                <!-- /.row -->
                <div class="row">
                   <?php
				include("../incs_shop/products.php");  
                   ?>
                    <!-- /.col -->
                </div>
             
                <div class="row">
                   <?php
				   if(isset($_GET['searchquery'])){
					if($_GET['searchquery'] == ""){
					echo pagination($statement,$per_page,$page,$url=MYSHOPTWO."/search-all.php?user=".$_GET['user']."&searchquery=".$_GET['searchquery']."&");
					}elseif($_GET['searchquery'] != ""){
					echo pagination($statement,$per_page,$page,$url=MYSHOPTWO."/search-all.php?user=".$_GET['user']."&searchquery=".$_GET['searchquery']."&");	
					}   
					   
				   }
				   ?> 
                </div>
               
               
               
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
  
  <?php
include("../incs_shop/footer_all.php");
?>