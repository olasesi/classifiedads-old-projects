
<div class="col-xs-12 col-sm-4 col-md-3">
                <div class="panel-group" id="accordion"> 
				<div class="panel panel-primary"> 
				<div>
                <div class="panel-heading"> 
				<h4 class="panel-title"> 
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="list-group-item active list-group-item-primary">Electronics
				</a> 
				</h4> 
				</div> 
				
				<div id="collapseOne" class="panel-collapse collapse out"> 
					<div class="panel-body"> 
				<ul class="list-group">
						<a href= "mobile-and-tabs.php" class="" style="font-weight:normal; cursor:pointer; " >
                        <li class="list-group-item" <?php if(isset($active_mobile_and_tabs)){echo 'style="color:#005b95; font-weight:bold;"';}?>>Mobile & Tabs
						<span class="label label-primary pull-right">
						
						<?php 
						//$total_mobile = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Mobile and Tabs'") or die(db_conn_error);
						//echo mysqli_num_rows($total_mobile);
						?>
						
						</span>
                        </li>
						 </a>
						 <a  href ="computers.php" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item" <?php if(isset($active_computers)){echo 'style="color:#005b95; font-weight:bold;"';}?>>Computers
                      <span class="label label-success pull-right">
					  <?php 
						//$total_computers = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Computers'") or die(db_conn_error);
						//echo mysqli_num_rows($total_computers);
						?>
					  </span>
                        </li>
                        </a>
						
						<a  href ="appliances.php" style="font-weight:normal; cursor:pointer;">
						<li class="list-group-item"  <?php if(isset($active_appliances)){echo 'style="color:#005b95; font-weight:bold;"';}?>>Appliances
                             <span class="label label-info pull-right">
						<?php 
						//$total_appliances = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Appliances'") or die(db_conn_error);
						//echo mysqli_num_rows($total_appliances);
						?>
							 </span>
                        </li>
                        </a>
					
						
                    </ul>
					</div> 
				</div> 
					
                </div>
				</div>
                <!-- /.div -->
               <div class="panel panel-success"> 
				
			   <div>
					 <div class="panel-heading"> 
				<h4 class="panel-title"> 
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="list-group-item active list-group-item-success">Fashion
				</a> 
				</h4> 
				</div> 
				
					
					<div id="collapseTwo" class="panel-collapse collapse out"> 
					<div class="panel-body"> 
                    <ul class="list-group">
						<a  href="clothings.php" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item" <?php if(isset($active_clothings)){echo 'style="color:#005b95; font-weight:bold;"';}?>>Clothings
                             <span class="label label-info pull-right"> 
						<?php 
						//$total_men = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Clothings'") or die(db_conn_error);
						//echo mysqli_num_rows($total_men);
						?></span>
                        </li>
						</a>
                       

						 <a  href="fashion-items.php" style="font-weight:normal; cursor:pointer;">
						 <li class="list-group-item" <?php if(isset($active_fashion_accessories)){echo 'style="color:#005b95; font-weight:bold;"';}?>>Fashion Items
                             <span class="label label-primary pull-right">
						 <?php 
						//$total_fashion_accessories = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Fashion Items'") or die(db_conn_error);
						//echo mysqli_num_rows($total_fashion_accessories);
						?>	 
							 </span>
                        </li>
						</a>

                    </ul>
                </div>
				</div>
				</div>
				</div>
				
				 <div class="panel panel-primary"> 
				 <div>
				 
				  <div class="panel-heading"> 
				<h4 class="panel-title"> 
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="list-group-item active list-group-item-primary">Kids & Care
				</a> 
				</h4> 
				</div> 
				 
				 <div id="collapseThree" class="panel-collapse collapse out"> 
					<div class="panel-body"> 
				  <ul class="list-group">
                      
												
						<a  href="kids-accessories.php" style="font-weight:normal; cursor:pointer;">
						<li class="list-group-item" <?php if(isset($active_kiddies)){echo 'style="color:#005b95; font-weight:bold;"';}?>>Kiddies
                             <span class="label label-primary pull-right">
							<?php 
						//$total_kids_accessories = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Kids Accessories'") or die(db_conn_error);
						//echo mysqli_num_rows($total_kids_accessories);
						?>	  
							 </span>
                        </li>
						</a>
                      
                    </ul>
				 </div>
				 </div>
				 
				 
				 </div>
				 </div>
				
				
				<div class="panel panel-info"> 
				 <div>
				 
				  <div class="panel-heading"> 
				<h4 class="panel-title"> 
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" class="list-group-item active list-group-item-info">Vehicles
				</a> 
				</h4> 
				</div> 
				
				
				 <div id="collapseFour" class="panel-collapse collapse out"> 
					<div class="panel-body"> 
					    <ul class="list-group">
                        <a href="vehicles.php" style="font-weight:normal; cursor:pointer;">
						<li class="list-group-item" <?php if(isset($active_vehicles)){echo 'style="color:#005b95; font-weight:bold;"';}?>>Vehicles
                             <span class="label label-danger pull-right">
							<?php 
						//$total_vehicles = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Vehicles'") or die(db_conn_error);
						//echo mysqli_num_rows($total_vehicles);
						?>	  
							 </span>
                        </li>
						</a>
						
                       <a  href="vehicle-accessories.php" style="font-weight:normal; cursor:pointer;">
					   <li class="list-group-item" <?php if(isset($active_vehicle_items)){echo 'style="color:#005b95; font-weight:bold;"';}?>>Vehicle items
                             <span class="label label-info pull-right">
							 <?php 
						//$total_vehicle_accessories = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Vehicle Accessories'") or die(db_conn_error);
						//echo mysqli_num_rows($total_vehicle_accessories);
						?>	 
							 </span>
                        </li>
                       </a> 
                    </ul>
					
					</div>
				</div>
				
				
				
				</div>
				</div>
				
              <div class="panel panel-danger"> 
				 <div>
				 
				  <div class="panel-heading"> 
				<h4 class="panel-title"> 
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" class="list-group-item active list-group-item-danger">Properties & Home
				</a> 
				</h4> 
				</div> 
				
				 <div id="collapseFive" class="panel-collapse collapse out"> 
					<div class="panel-body"> 
				 <ul  class="list-group">
					<a href="real-estate.php" style="font-weight:normal; cursor:pointer;">
					
                        <li class="list-group-item" <?php if(isset($active_real_estate)){echo 'style="color:#005b95; font-weight:bold;"';}?>>Real Estate
                             <span class="label label-warning pull-right">
							 <?php 
						//$total_realestate = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Real Estate'") or die(db_conn_error);
						//echo mysqli_num_rows($total_realestate);
						?>	 
							 </span>
                        </li>
                      </a> 
                    </ul>
				
				</div>
				</div>
				
				</div>
				</div>
			  
			    <div class="panel panel-warning"> 
				 <div>
				 
				  <div class="panel-heading"> 
				<h4 class="panel-title"> 
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseSix" class="list-group-item active list-group-item-warning">Care
				</a> 
				</h4> 
				</div> 
				
				 <div id="collapseSix" class="panel-collapse collapse out"> 
					<div class="panel-body"> 
				<ul class="list-group">
                          <a  href="pets.php" style="font-weight:normal; cursor:pointer;">
						<li class="list-group-item" <?php if(isset($active_pets)){echo 'style="color:#005b95; font-weight:bold;"';}?>>Pets
                             <span class="label label-danger pull-right">
							<?php 
						//$total_pets = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Pets'") or die(db_conn_error);
						//echo mysqli_num_rows($total_pets);
						?>	  
							 </span>
                        </li>
						</a>
						<a  href="food-and-drinks.php" style="font-weight:normal; cursor:pointer;">
						<li class="list-group-item" <?php if(isset($active_food)){echo 'style="color:#005b95; font-weight:bold;"';}?>>Food
                             <span class="label label-warning pull-right">
							 <?php 
						//$total_food = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Food and Drinks'") or die(db_conn_error);
						//echo mysqli_num_rows($total_food);
						?>	 
							 </span>
                        </li>
						</a>
                       
						<a href="groceries.php" style="font-weight:normal; cursor:pointer;">
						<li class="list-group-item" <?php if(isset($active_groceries)){echo 'style="color:#005b95; font-weight:bold;"';}?>>Groceries
                             <span class="label label-success pull-right">
							 <?php 
						//$total_groceries = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Groceries'") or die(db_conn_error);
						//echo mysqli_num_rows($total_groceries);
						?>	 
							 </span>
                        </li>
						</a>
						<a  href="health.php" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item" <?php if(isset($active_health)){echo 'style="color:#005b95; font-weight:bold;"';}?>>Health
                             <span class="label label-info pull-right">
							 <?php 
						//$total_body_care = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Health'") or die(db_conn_error);
						//echo mysqli_num_rows($total_body_care);
						?>	 
							 </span>
                        </li>
						</a>
						
                    </ul>
				
				
				</div>
				</div>
				</div>
				</div>
				
				
				  <div class="panel panel-primary"> 
				 <div>
				 
				  <div class="panel-heading"> 
				<h4 class="panel-title"> 
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" class="list-group-item active list-group-item-primary">Home
				</a> 
				</h4> 
				</div> 
				
				 <div id="collapseSeven" class="panel-collapse collapse out"> 
					<div class="panel-body"> 
					
					 <ul class="list-group">
                       
						<a href="garden.php" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item" <?php if(isset($active_garden)){echo 'style="color:#005b95; font-weight:bold;"';}?>>Garden
                             <span class="label label-info pull-right">
						<?php 
						//$total_garden = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Garden'") or die(db_conn_error);
						//echo mysqli_num_rows($total_garden);
						?>	 	 
							 </span>
                         </li>
						 </a>
						
						 <a  href="home.php" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item" <?php if(isset($active_home)){echo 'style="color:#005b95; font-weight:bold;"';}?>>Home
                             <span class="label label-warning pull-right">
						<?php 
						//$total_home = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Home'") or die(db_conn_error);
						//echo mysqli_num_rows($total_home);
						?>	 	 
							 </span>
                         </li>
						 </a>
						 
                    </ul>
					
					</div>
					</div>
					</div>
					</div>
				
				
				 <div class="panel panel-success"> 
				 <div>
				 
				  <div class="panel-heading"> 
				<h4 class="panel-title"> 
				<a data-toggle="collapse" data-parent="#accordion" href="#collapseEight" class="list-group-item active list-group-item-success">Art & Fun
				</a> 
				</h4> 
				</div> 
				
				 <div id="collapseEight" class="panel-collapse collapse out"> 
					<div class="panel-body"> 
					<ul class="list-group">
                        <a  href="fun.php" style="font-weight:normal; cursor:pointer;">
						<li class="list-group-item" <?php if(isset($active_fun)){echo 'style="color:#005b95; font-weight:bold;"';}?>>Fun
                             <span class="label label-warning pull-right">
							 <?php 
						//$total_books = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Fun'") or die(db_conn_error);
						//echo mysqli_num_rows($total_books);
						?>	 
							 </span>
                        </li>
						</a>
						
						<a  href="art.php" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item" <?php if(isset($active_art)){echo 'style="color:#005b95; font-weight:bold;"';}?>>Art
                             <span class="label label-danger pull-right">
						<?php 
						//$total_art = mysqli_query($connect, "SELECT * FROM goods WHERE categories = 'Art'") or die(db_conn_error);
						//echo mysqli_num_rows($total_art);
						?>	 	 
							 </span>
                         </li>
						 </a>
						 
                    </ul>
					
					
					</div>
					</div>
					</div>
					</div>
				
				
				
                <!-- /.div -->
				<br />
				<br />
               

				 <?php //include("../incs_shop/username_search.php"); ?>
				
				
				
				
				
				<?php if(isset($_SESSION['user_id']) && isset($_SESSION['user_admin'])){
				
				
				
				echo '<div>
                 <ul class="list-group">
				<li class="list-group-item">
                <button type="button" class="btn btn-danger btn-lg btn-block" disabled="disabled">Admin</button>
				';
				
				//edit start
				$number_users = mysqli_query($connect, "SELECT * FROM users WHERE active = '1' AND payment = '1'") or die(db_conn_error);		
				echo '<p class="text-center">Registered Users: '.mysqli_num_rows($number_users).'</p>';
				//edit end
				
				//echo '<a href="payment-confirmation.php" class="active"><button type="button" class="btn btn-primary btn-block">Shop payment</button></a>';
				echo '<a href="ad-header.php" class="active"><button type="button" class="btn btn-primary btn-block">Advertisement header</button></a>';
				echo '<a href="ad-slider.php" class="active"><button type="button" class="btn btn-primary btn-block">Advertisement slide</button></a>';
				echo '<a href="ad-banner.php" class="active"><button type="button" class="btn btn-primary btn-block">Advertisement banner</button></a>';
				echo '<a href="ad-referral.php" class="active"><button type="button" class="btn btn-primary btn-block">Referral pay</button></a>';
				echo '<a href="ads-for-referral.php" class="active"><button type="button" class="btn btn-primary btn-block">Ads for referral</button></a>';
				echo '<a href="ads-paying-users.php" class="active"><button type="button" class="btn btn-primary btn-block">Paying users</button></a>';
				echo '<a href="ad-free-first.php" class="active"><button type="button" class="btn btn-primary btn-block">First free ad</button></a>';
				echo '</li>
				</ul>
				</div>';
				}
				
				?>
				
				
				
				
				
				
				
				
				
				
				<br />
				<br />
				
				
				
				
               
               
 






</div>
 </div>
  
 