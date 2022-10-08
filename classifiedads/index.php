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


				<?php
				if (!isset($_SESSION['user_id'])) {

					echo 'Are you searching for the best product or service? <br> Sign up now to get the best deals';
				}

				if (isset($_SESSION['user_id'])) {
					echo "To return to your e-shop or dashboard, click the top right button.";
				}
				?>

			</div>


			<div class="row">
				<div class="col-md-8">

					<div id="myCarousel" class="carousel slide" data-ride="carousel">
						<!-- Carousel indicators -->
						<ol class="carousel-indicators">
							<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
							<li data-target="#myCarousel" data-slide-to="1"></li>
							<li data-target="#myCarousel" data-slide-to="2"></li>
						</ol> <!-- Carousel items -->

						<div class="carousel-inner">
							<div class="item active">
								<?php
								echo '<a href="#"><img style="width:100%; " src="assets/vectors/slide1.jpg" alt="myshoptwo cover"></a>';
								?>
							</div>
							<div class="item">
								<?php
								echo '<a href="#"><img style="width:100%;" src="assets/vectors/slide2.jpg" alt="myshoptwo cover"></a>';
								?>
							</div>
							<div class="item">
								<?php
								echo '<a href="#"><img style="width:100%;" src="assets/vectors/slide3.jpg" alt="myshoptwo cover"></a>';
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
				</div>

				<div class="col-md-4">
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">

							<div>
								<img class="center-block" style="width:230px; height:145px; margin-top:7px;" src="ad/ad-banner/banner1.jpg" alt="designs by blocks" />
							</div>
						</div>


						<div class="col-xs-12 col-sm-6 col-md-12 col-lg-12">

							<div>
								<img class="center-block" style="width:230px; height:145px; margin-top:7px;" src="ad/ad-banner/banner2.jpg" alt="designs by blocks" />
							</div>
						</div>




					</div>

				</div>




			</div>

			<br />
		</div>




		<div>
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

	<?php //include("../incs_shop/shuffling-ads.php");
	?>


	<div class="row">
		<?php include("../incs_shop/leftpanel.php"); ?>


		<?php include('../incs_shop/paginate.php'); ?>
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
				<?php echo pagination($statement,$per_page,$page,$url=MYSHOPTWO."/?"); 
				?>
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