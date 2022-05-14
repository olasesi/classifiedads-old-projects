<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");
$page_title = PAGE_TITLE;
//edit start
$descript = PAGE_DESCRIPTION;
//edit end
include("../incs_shop/header.php");
?>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="well well-lg offer-box text-center">
				<?php echo CHRISTMAS_DECOR; ?>

<?php
if(!isset($_SESSION['user_id'])){
			
			echo 'Are you searching for a product or service? Please enter the product you need in the form below and the sellers will contact you.<br> Sign up now if you want to get more customers.';  
			//echo 'Sign up and get a free e-shop for your business. Start getting customers on your e-shop and also start earning a living. Please signup to begin.';
		}
/*$header = mysqli_query($connect, "SELECT * FROM ad_header, users WHERE username = username_header AND active ='1' AND payment = '1'") or die(db_conn_error);	
	//The query above may not be correct. It was made for paid ad
	if(mysqli_num_rows($header) == 1){
	while($while_header = mysqli_fetch_array($header)){
		echo '<span class="label label-danger">ad</span> ';
		echo $while_header['header'];			//Headline info for only registered users
		}
	}else{
		//edit start
		//echo "Sign up now to start earning thousands of naira. Click the top right button to begin.";
		
		
		//edit end
	}*/
       if(isset($_SESSION['user_id'])){
			echo "To return to your e-shop or dashboard, click the top right button.";
		}                    
 ?>             
              
                </div>
                
				<div id="myCarousel" class="carousel slide" data-ride="carousel"> <!-- Carousel indicators --> 
					<ol class="carousel-indicators"> 
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li> 
					<li data-target="#myCarousel" data-slide-to="1"></li> 
					<li data-target="#myCarousel" data-slide-to="2"></li> 
					</ol> <!-- Carousel items --> 
					
					<div class="carousel-inner"> 
						<div class="item active"> 
						<?php
						
					
	
						 echo '<a href="'.MYSHOPTWO.'/signup-page.php"><img style="width:100%; " src="assets/vectors/slide1.jpg" alt="myshoptwo cover"></a>';
						
						
						
					
						
							?>	 
						</div> 
					<div class="item"> 
						<?php
						
						
	
						 echo '<a href="'.MYSHOPTWO.'/signup-page.php"><img style="width:100%;" src="assets/vectors/slide2.jpg" alt="myshoptwo cover"></a>';
						
					
							?>	
					</div> 
					<div class="item"> 
						<?php
						
						
	
						 echo '<a href="'.MYSHOPTWO.'/signup-page.php"><img style="width:100%;" src="assets/vectors/slide3.jpg" alt="myshoptwo cover"></a>';
						
					
							?>	
					</div> 
					</div> <!-- Carousel nav --> 
					<a class="carousel-control-prev" href="#myCarousel" data-slide="prev" role="button">
					<span class="carousel-control-prev-icon" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
					
					</a> 
					
					
					<a class="carousel-control-next" href="#myCarousel" data-slide="next" role="button">
					<span class="carousel-control-next-icon" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
					</a> 
				</div>
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				
				<!--<div class="main box-border">
                    <span class="label label-danger">Ad</span>
					<div id="mi-slider" class="mi-slider">-->
                        <?php
						/*
						$selecting_sliders = mysqli_query($connect, "SELECT * FROM ad_header_slide LIMIT 0, 4") or die(db_conn_error);
						if(mysqli_num_rows($selecting_sliders) > 0){
						echo '<ul>';
						while ($array_slider = mysqli_fetch_array($selecting_sliders)){
	
						 echo '<li><a href="'.$array_slider['ad_username_slide'].'.php">
                             <img src="ad/ad-slider/'.$array_slider['ad_images'].'" alt="'.$array_slider['ad_goods_slide'].'"><h4>'.$array_slider['ad_goods_slide'].'</h4></a></li>';
						
						}
						echo '</ul>';
					}else{
						//if no ad slide has been uploaded yet
					}
						
						
						$selecting_sliders2 = mysqli_query($connect, "SELECT * FROM ad_header_slide LIMIT 4, 4") or die(db_conn_error);
						if(mysqli_num_rows($selecting_sliders2) > 0){
						echo '<ul>';
						while ($array_slider2 = mysqli_fetch_array($selecting_sliders2)){
	
						 echo '<li><a href="'.$array_slider2['ad_username_slide'].'.php">
                             <img src="ad/ad-slider/'.$array_slider2['ad_images'].'" alt="'.$array_slider2['ad_goods_slide'].'"><h4>'.$array_slider2['ad_goods_slide'].'</h4></a></li>';
						
						}
						echo '</ul>';
					}
						
						
						
						$selecting_sliders3 = mysqli_query($connect, "SELECT * FROM ad_header_slide LIMIT 8, 4") or die(db_conn_error);
						if(mysqli_num_rows($selecting_sliders3) > 0){
						echo '<ul>';
						while ($array_slider3 = mysqli_fetch_array($selecting_sliders3)){
	
						 echo '<li><a href="'.$array_slider3['ad_username_slide'].'.php">
                             <img src="ad/ad-slider/'.$array_slider3['ad_images'].'" alt="'.$array_slider3['ad_goods_slide'].'"><h4>'.$array_slider3['ad_goods_slide'].'</h4></a></li>';
						
						}
						echo '</ul>';
					}
						
							
						
						$selecting_sliders4 = mysqli_query($connect, "SELECT * FROM ad_header_slide LIMIT 12, 4") or die(db_conn_error);
						if(mysqli_num_rows($selecting_sliders4) > 0){
						echo '<ul>';
						while ($array_slider4 = mysqli_fetch_array($selecting_sliders4)){
	
						 echo '<li><a href="'.$array_slider4['ad_username_slide'].'.php">
                             <img src="ad/ad-slider/'.$array_slider4['ad_images'].'" alt="'.$array_slider4['ad_goods_slide'].'"><h4>'.$array_slider4['ad_goods_slide'].'</h4></a></li>';
						
						}
						echo '</ul>';
					}
						
							
                        $selecting_circle = mysqli_query($connect, "SELECT * FROM ad_header_slide") or die(db_conn_error);
						$circle = mysqli_num_rows($selecting_circle);*/
						?>
						
						<nav>
                           <?php
						
						
						/* if(0 < $circle){
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
						 }*/
						  
						?> 
                          
							
                        </nav>
                   <!-- </div>
                    
                </div>-->
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
        <div class="row">
		<?php include("../incs_shop/need_marketplace.php"); ?>
		</div>
		
		 <?php //include("../incs_shop/shuffling-ads.php");?>
		
		
		<div class="row">
            <?php include("../incs_shop/leftpanel.php");?>
           

		   <?php include ('../incs_shop/paginate.php');?>
		   <?php $statement = "goods WHERE file_name_goods != 'goods_serv_pix.jpg' ORDER BY goods_timestamp DESC"; ?>
		   <!-- /.col -->
            <div class="col-xs-12 col-sm-8 col-md-9">
                <div>
                    <ol class="breadcrumb">
                        <li class="active">Products</li>
                    </ol>
                </div>
                <!-- /.div -->
                <div class="row">
                    <div class="btn-group alg-right-pad">
                       <div class="btn-group">
                        <!--<button type="button" class="btn btn-danger disabled">-->
                        <?php 
						//$total_products = mysqli_query($connect, "SELECT * FROM goods") or die(db_conn_error);
						//echo mysqli_num_rows($total_products).' items';
						?> 
						
						<!--</button>-->
                            
                          
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <div class="row">
                    <?php
					$per_page = 3; 
				include("../incs_shop/products.php");  
                   ?>
                </div>
                <!-- /.row -->
               
				
				<div class="row">
                    <?php //echo pagination($statement,$per_page,$page,$url=MYSHOPTWO."/?"); ?>
				</div>
                <!-- /.row -->
              
               
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
   
  
   
   
   
   

  <?php
include("../incs_shop/footer.php");
?>


