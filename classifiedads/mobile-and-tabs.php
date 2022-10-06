<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");
$page_title = 'Mobile and Tabs';
$descript = 'Get the latest phones and tablets at affordable prices. Get extra pay for buying from our e-shop.';

include("../incs_shop/header.php");
?>

   <div class="container">
        <div class="row">
            
            
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <div class="row">
            <?php
			//to show active
			$active_mobile_and_tabs = 1;
			?>
			<?php include("../incs_shop/leftpanel.php");?>
            <?php include ('../incs_shop/paginate.php');?>
		   <?php 
		   
		   $statement = "goods WHERE categories = 'Mobile and Tabs' ORDER BY goods_timestamp DESC"; 
		  
		   ?>
		   <!-- /.col -->
           
			<div class="col-xs-6 col-sm-8 col-md-9">
                 <div>
                   <h2 class="text-center text-primary">Mobiles and Tabs</h2>
                </div>
                <!-- /.div -->
                <div class="row">
                    <div class="btn-group alg-right-pad">
                        <button type="button" class="btn btn-danger" disabled="disabled">
						
						<?php 
						$total_products = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Mobile and Tabs'") or die(db_conn_error);
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
                      <?php echo pagination($statement,$per_page,$page,$url=MYSHOPTWO."/mobile-and-tabs.php?"); ?>
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