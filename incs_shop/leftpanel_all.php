<?php
$select_cat = mysqli_query($connect, "SELECT categories FROM goods, users WHERE user_id = UID AND username = '" . $username . "' GROUP BY categories") or die(db_conn_error);
$fetching_array = array();
while ($fetching = mysqli_fetch_array($select_cat)) {

	$fetching_array[] = $fetching['categories'];
}
?>

<div class=" col-sm-4 col-md-3">

	<?php
	include("../incs_shop/stopwords.php");

	if (isset($_SESSION['user_id']) and $user_id == $_SESSION['user_id']) {

		echo '<div>
				 <a class="list-group-item active list-group-item-danger">Potential Customers</a>
				 <ul class="list-group">
				 <li class="list-group-item">
				 ';

		$post_and_cat = mysqli_query($connect, "SELECT DISTINCT posts, post_city, phone FROM post, goods WHERE UID = '" . $_SESSION['user_id'] . "' AND post_category = categories AND post_state_id = '" . $_SESSION['state_local_area'] . "' ORDER BY post_id DESC LIMIT 0, 15 ") or die(db_conn_error);

		if (mysqli_num_rows($post_and_cat) > 0) {
			while ($testing_closeby = mysqli_fetch_array($post_and_cat)) {


				echo '<div class="clearfix" style="margin-bottom:20px;">';

				echo '<h5>' . $testing_closeby['posts'] . '</h5>';
				echo '<div class="pull-left"><span class="label label-success">' . $testing_closeby['post_city'] . '</span></div>';
				echo '<div class="pull-right"><a href="tel:' . $testing_closeby['phone'] . '"><span class="label label-info">' . $testing_closeby['phone'] . '</span></a></div>';

				echo '</div>';
				//echo '<hr>';

			}
		} else {
			echo '<small><em>No customers or leads from ' . $_SESSION['state_local_area'] . ' yet. Start uploading your products to get customers.</em></small>';
		}

		echo '
				</li>
				</ul>
				</div>';
	}
	?>


	<?php


	if (in_array('Mobile and Tabs', $fetching_array) or in_array('Computers', $fetching_array) or in_array('Appliances', $fetching_array)) {

		echo '<div>
					<a class="list-group-item active list-group-item-primary">Electronics
                    </a>
					<ul class="list-group">';
		if (in_array('Mobile and Tabs', $fetching_array)) {
			echo '<a href= "my-shop-mobile-and-tabs.php?brand_username=' . $username . '" class="" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item"';
			if (isset($active_mobile_and_tabs)) {
				echo 'style="color:#005b95; font-weight:bold;"';
			}
			echo '>Mobile & Tabs
						<span class="label label-primary pull-right">';


			$total_mobile = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '" . $username . "' AND categories = 'Mobile and Tabs'") or die(db_conn_error);
			echo mysqli_num_rows($total_mobile);


			echo '</span>
                        </li>
					</a>';
		}

		if (in_array('Computers', $fetching_array)) {
			echo '<a href= "my-shop-computers.php?brand_username=' . $username . '" class="" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item"';
			if (isset($active_computers)) {
				echo 'style="color:#005b95; font-weight:bold;"';
			}
			echo '">Computers
                      <span class="label label-success pull-right">';

			$total_computers = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '" . $username . "' AND categories = 'Computers'") or die(db_conn_error);
			echo mysqli_num_rows($total_computers);

			echo '</span>
                        </li>
                        </a>';
		}
		if (in_array('Appliances', $fetching_array)) {
			echo '<a href= "my-shop-appliances.php?brand_username=' . $username . '" class="" style="font-weight:normal; cursor:pointer;">
						<li class="list-group-item"';
			if (isset($active_appliances)) {
				echo 'style="color:#005b95; font-weight:bold;"';
			}
			echo '>Appliances
                             <span class="label label-info pull-right">';

			$total_appliances = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '" . $username . "' AND categories = 'Appliances'") or die(db_conn_error);
			echo mysqli_num_rows($total_appliances);

			echo '</span>
                        </li>
                        </a>';
		}


		echo '</ul>
					</div>';
	}
	?>
	<!-- /.div -->
	<?php
	if (in_array('Clothings', $fetching_array) or in_array('Fashion Items', $fetching_array)) {
		echo '<div>
					<a class="list-group-item active list-group-item-success">Fashion
                    </a>
                    <ul class="list-group">';
		if (in_array('Clothings', $fetching_array)) {
			echo '<a href= "my-shop-clothings.php?brand_username=' . $username . '" class="" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item"';
			if (isset($active_clothings)) {
				echo 'style="color:#005b95; font-weight:bold;"';
			}
			echo '>Clothings
                             <span class="label label-danger pull-right">';

			$total_men = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '" . $username . "' AND categories = 'Clothings'") or die(db_conn_error);
			echo mysqli_num_rows($total_men);

			echo '</span>
                        </li>
						</a>';
		}

		if (in_array('Fashion Items', $fetching_array)) {
			echo '<a href= "my-shop-fashion-items.php?brand_username=' . $username . '" class="" style="font-weight:normal; cursor:pointer;">
						 <li class="list-group-item"';
			if (isset($active_fashion_items)) {
				echo 'style="color:#005b95; font-weight:bold;"';
			}
			echo '>Fashion Items
                             <span class="label label-danger pull-right">';

			$total_fashion_accessories = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '" . $username . "' AND categories = 'Fashion Items'") or die(db_conn_error);
			echo mysqli_num_rows($total_fashion_accessories);

			echo '</span>
                        </li>
						</a>';
		}

		echo '</ul>
                </div>';
	}
	?>
	<?php
	if (in_array('Kids Accessories', $fetching_array)) {
		echo '<div>
                    <a class="list-group-item active list-group-item-primary">Kids & Care
                    </a>
                    <ul class="list-group">';

		if (in_array('Kids Accessories', $fetching_array)) {
			echo '<a href= "my-shop-kids-accessories.php?brand_username=' . $username . '" class="" style="font-weight:normal; cursor:pointer;">
						 <li class="list-group-item"';
			if (isset($active_kids_accessories)) {
				echo 'style="color:#005b95; font-weight:bold;"';
			}
			echo '>Kiddies
                             <span class="label label-primary pull-right">';

			$total_kids_accessories = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '" . $username . "' AND categories = 'Kids Accessories'") or die(db_conn_error);
			echo mysqli_num_rows($total_kids_accessories);

			echo '</span>
                        </li>
						 </a>';
		}


		echo '</ul>
                </div>';
	} ?>
	<!-- /.div -->
	<?php
	if (in_array('Vehicles', $fetching_array) or in_array('Vehicle Accessories', $fetching_array)) {
		echo '<div>
                    <a class="list-group-item active list-group-item-info">Vehicles
                    </a>
                    <ul class="list-group">';
		if (in_array('Vehicles', $fetching_array)) {
			echo '<a href= "my-shop-vehicles.php?brand_username=' . $username . '" class="" style="font-weight:normal; cursor:pointer;">
						<li class="list-group-item"';
			if (isset($active_vehicles)) {
				echo 'style="color:#005b95; font-weight:bold;"';
			}
			echo '>Vehicles
                             <span class="label label-danger pull-right">';

			$total_cars = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '" . $username . "' AND categories = 'Vehicles'") or die(db_conn_error);
			echo mysqli_num_rows($total_cars);

			echo '</span>
                        </li>
						</a>';
		}

		if (in_array('Vehicle Accessories', $fetching_array)) {
			echo '<a href= "my-shop-vehicle-accessories.php?brand_username=' . $username . '" class="" style="font-weight:normal; cursor:pointer;">
					   <li class="list-group-item"';
			if (isset($active_vehicle_accessories)) {
				echo 'style="color:#005b95; font-weight:bold;"';
			}
			echo '>Vehicle Items
                             <span class="label label-info pull-right">';

			$total_vehicle_accessories = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '" . $username . "' AND categories = 'Vehicle Accessories'") or die(db_conn_error);
			echo mysqli_num_rows($total_vehicle_accessories);

			echo '</span>
                        </li>
				 </a>';
		}
		echo '</ul>
                </div>';
	} ?>

	<?php
	if (in_array('Real Estate', $fetching_array)) {
		echo '<div>
				
                    <a class="list-group-item active list-group-item-danger">Properties & Home
                    </a>
                    <ul class="list-group">';
		if (in_array('Real Estate', $fetching_array)) {
			echo '<a href= "my-shop-real-estate.php?brand_username=' . $username . '" class="" style="font-weight:normal; cursor:pointer;">
					
                        <li class="list-group-item"';
			if (isset($active_real_estate)) {
				echo 'style="color:#005b95; font-weight:bold;"';
			}
			echo '>Real Estate
                             <span class="label label-warning pull-right">';

			$total_realestate = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '" . $username . "' AND categories = 'Real Estate'") or die(db_conn_error);
			echo mysqli_num_rows($total_realestate);

			echo '</span>
                        </li>
					</a>';
		}
		echo '</ul>
                </div>';
	}
	?>
	<?php
	if (in_array('Pets', $fetching_array) or in_array('Food and Drinks', $fetching_array) or in_array('Groceries', $fetching_array) or in_array('Health', $fetching_array)) {
		echo '<div>
				
                    <a class="list-group-item active list-group-item-warning">Care
                    </a>
                    <ul class="list-group">';
		if (in_array('Pets', $fetching_array)) {
			echo '<a href= "my-shop-pets.php?brand_username=' . $username . '" class="" style="font-weight:normal; cursor:pointer;">
						<li class="list-group-item"';
			if (isset($active_pets)) {
				echo 'style="color:#005b95; font-weight:bold;"';
			}
			echo '>Pets
                             <span class="label label-danger pull-right">';

			$total_pets = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '" . $username . "' AND categories = 'Pets'") or die(db_conn_error);
			echo mysqli_num_rows($total_pets);

			echo  '</span>
                        </li>
						</a>';
		}
		if (in_array('Food and Drinks', $fetching_array)) {
			echo '<a href= "my-shop-food-and-drinks.php?brand_username=' . $username . '" class="" style="font-weight:normal; cursor:pointer;">
						<li class="list-group-item"';
			if (isset($active_food_and_drinks)) {
				echo 'style="color:#005b95; font-weight:bold;"';
			}
			echo '>Food
                             <span class="label label-warning pull-right">';

			$total_food_drinks = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '" . $username . "' AND categories = 'Food and Drinks'") or die(db_conn_error);
			echo mysqli_num_rows($total_food_drinks);

			echo  '</span>
                        </li>
						</a>';
		}

		if (in_array('Groceries', $fetching_array)) {
			echo '<a href= "my-shop-groceries.php?brand_username=' . $username . '" class="" style="font-weight:normal; cursor:pointer;">
						<li class="list-group-item"';
			if (isset($active_groceries)) {
				echo 'style="color:#005b95; font-weight:bold;"';
			}
			echo '>Groceries
                             <span class="label label-success pull-right">';

			$total_groceries = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '" . $username . "' AND categories = 'Groceries'") or die(db_conn_error);
			echo mysqli_num_rows($total_groceries);

			echo '</span>
                        </li>
						</a>';
		}

		if (in_array('Health', $fetching_array)) {
			echo '<a href= "my-shop-health.php?brand_username=' . $username . '" class="" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item"';
			if (isset($active_health)) {
				echo 'style="color:#005b95; font-weight:bold;"';
			}
			echo '>Health
                             <span class="label label-danger pull-right">';

			$total_fitness = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '" . $username . "' AND categories = 'Health'") or die(db_conn_error);
			echo mysqli_num_rows($total_fitness);

			echo '</span>
                        </li>
						</a>';
		}
		echo '</ul>
                </div>';
	}
	?>
	<?php
	if (in_array('Garden', $fetching_array) or in_array('Home', $fetching_array)) {
		echo '<div>
				
                    <a class="list-group-item active list-group-item-primary">Home
                    </a>
                    <ul class="list-group">';

		if (in_array('Garden', $fetching_array)) {
			echo '<a href= "my-shop-garden.php?brand_username=' . $username . '" class="" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item"';
			if (isset($active_garden)) {
				echo 'style="color:#005b95; font-weight:bold;"';
			}
			echo '>Garden
                             <span class="label label-info pull-right">';

			$total_garden = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '" . $username . "' AND categories = 'Garden'") or die(db_conn_error);
			echo mysqli_num_rows($total_garden);

			echo '</span>
                         </li>
					</a>';
		}

		if (in_array('Home', $fetching_array)) {
			echo '<a href= "my-shop-home.php?brand_username=' . $username . '" class="" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item"';
			if (isset($active_home)) {
				echo 'style="color:#005b95; font-weight:bold;"';
			}
			echo '">Home
                             <span class="label label-warning pull-right">';

			$total_home = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '" . $username . "' AND categories = 'Home'") or die(db_conn_error);
			echo mysqli_num_rows($total_home);

			echo '</span>
                         </li>
						  </a>';
		}
		echo '</ul>
                </div>';
	}
	?>
	<?php
	if (in_array('Fun', $fetching_array) or in_array('Art', $fetching_array)) {
		echo '<div>
				
                    <a class="list-group-item active list-group-item-success">Art & Fun
                    </a>
                    <ul class="list-group">';

		if (in_array('Fun', $fetching_array)) {
			echo '<a href= "my-shop-fun.php?brand_username=' . $username . '" class="" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item"';
			if (isset($active_fun)) {
				echo 'style="color:#005b95; font-weight:bold;"';
			}
			echo '">Fun
                             <span class="label label-warning pull-right">';

			$total_fun = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '" . $username . "' AND categories = 'Fun'") or die(db_conn_error);
			echo mysqli_num_rows($total_fun);

			echo '</span>
                         </li>
						 </a>';
		}
		if (in_array('Art', $fetching_array)) {
			echo '<a href= "my-shop-art.php?brand_username=' . $username . '" class="" style="font-weight:normal; cursor:pointer;">
                        <li class="list-group-item"';
			if (isset($active_art)) {
				echo 'style="color:#005b95; font-weight:bold;"';
			}
			echo '">Art
                             <span class="label label-warning pull-right">';

			$total_art = mysqli_query($connect, "SELECT * FROM goods, users WHERE user_id = UID AND username = '" . $username . "' AND categories = 'Art'") or die(db_conn_error);
			echo mysqli_num_rows($total_art);

			echo '</span>
                         </li>
						  </a>';
		}
		echo '</ul>
                </div>';
	} ?>
	<!-- /.div -->
	<br />
	<br />

	<?php
	include("../incs_shop/shop_review.php");
	?>

	</br></br>
	<!--SEARCH USERNAME //////////////// BEGINS-->


	<!--SEARCH USERNAME //////////////// ENDS-->
	<br />
	<br />
	<!--POST NEEDS //////////////// BEGINS-->




	<!--CUSTOMERS//////////////// ENDS-->



</div>