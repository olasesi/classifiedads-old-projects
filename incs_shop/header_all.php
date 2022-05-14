<?php 
$confirm_file = pathinfo($_SERVER['PHP_SELF'], PATHINFO_FILENAME);		//this header is for pages of usernames 
$find_brand=mysqli_query($connect, "SELECT * FROM users WHERE username='".$confirm_file."' AND active='1' AND payment = '1'") or die(db_conn_error);		//and if payment has been made
if(mysqli_num_rows($find_brand) == 1){
	while($while_find_brand = mysqli_fetch_array($find_brand)){
	$user_id = $while_find_brand['user_id'];
	$username = $while_find_brand['username'];
	$brand_name = $while_find_brand['brand_username_name'];
	$address = $while_find_brand['address'];
	$phone1 = $while_find_brand['phone1'];
	$phone2 = $while_find_brand['phone2'];
	$bus_email = $while_find_brand['bus_email'];
	$bus_descr = $while_find_brand['bus_description'];
	$headline = $while_find_brand['headline'];
	$url_facebook = $while_find_brand['facebook_link'];
	$url_instagram = $while_find_brand['instagram_link'];
	$url_twitter = $while_find_brand['twitter_link'];
}
}elseif(isset($_SESSION['user_id']) AND ($confirm_file == "edit-shop" OR $confirm_file == "edit-shop-slider" OR $confirm_file == "upload-slide-product" OR $confirm_file == "edit-shop-slider-top")){
	$user_id = $_SESSION['user_id'];
	$username = $_SESSION['username'];
	$brand_name = $_SESSION['brand_username_name'];
	$address = $_SESSION['address'];
	$phone1 = $_SESSION['phone1'];
	$phone2 = $_SESSION['phone2'];
	$bus_email = $_SESSION['bus_email'];
	$bus_descr = $_SESSION['bus_description'];
	$headline = $_SESSION['headline'];
	$url_facebook = $_SESSION['facebook_link'];
	$url_instagram = $_SESSION['instagram_link'];
	$url_twitter = $_SESSION['twitter_link'];

}elseif($confirm_file == "full-details"){
	$username_of_good = mysqli_query($connect,"SELECT * FROM goods, users WHERE goods_id = '".mysqli_real_escape_string ($connect, $_GET['details'])."' AND UID = user_id AND active = 1 AND payment = 1") or die(db_conn_error);
	if(mysqli_num_rows($username_of_good) == 1){
	while($while_username_of_good = mysqli_fetch_array($username_of_good)){
	
	$user_id = $while_username_of_good['user_id'];
	$username = $while_username_of_good['username'];
	$brand_name = $while_username_of_good['brand_username_name'];
	$address = $while_username_of_good['address'];
	$phone1 = $while_username_of_good['phone1'];
	$phone2 = $while_username_of_good['phone2'];
	$bus_email = $while_username_of_good['bus_email'];	
	$bus_descr = $while_username_of_good['bus_description'];
	$headline = $while_username_of_good['headline'];
	$url_facebook = $while_username_of_good['facebook_link'];
	$url_instagram = $while_username_of_good['instagram_link'];
	$url_twitter = $while_username_of_good['twitter_link'];
	}	
	}else{
	header("Location:".MYSHOPTWO);
	exit();	
	}
	
	//the search from the get variable and if not found back to the homepage
	//and what if the username of the user is full-details
}elseif($confirm_file == "full-details-slide"){
	$username_of_good_slide = mysqli_query($connect,"SELECT * FROM slider, users WHERE id_slider = '".mysqli_real_escape_string ($connect, $_GET['details'])."' AND user_id_slider = user_id AND active = 1 AND payment = 1") or die(db_conn_error);
	if(mysqli_num_rows($username_of_good_slide) == 1){
	while($while_username_of_good = mysqli_fetch_array($username_of_good_slide)){
	
	$user_id = $while_username_of_good['user_id'];
	$username = $while_username_of_good['username'];
	$brand_name = $while_username_of_good['brand_username_name'];
	$address = $while_username_of_good['address'];
	$phone1 = $while_username_of_good['phone1'];
	$phone2 = $while_username_of_good['phone2'];
	$bus_email = $while_username_of_good['bus_email'];	
	$bus_descr = $while_username_of_good['bus_description'];
	$headline = $while_username_of_good['headline'];
	$url_facebook = $while_username_of_good['facebook_link'];
	$url_instagram = $while_username_of_good['instagram_link'];
	$url_twitter = $while_username_of_good['twitter_link'];
	}	
	}else{
	header("Location:".MYSHOPTWO);
	exit();	
	}
	
}elseif(
$confirm_file == "my-shop-mobile-and-tabs" OR $confirm_file == "my-shop-computers" OR $confirm_file == "my-shop-appliances" OR 
$confirm_file == "my-shop-clothings" OR $confirm_file == "my-shop-fashion-items" OR $confirm_file == "my-shop-kids-accessories" OR 
$confirm_file == "my-shop-vehicles" OR $confirm_file == "my-shop-vehicle-accessories" OR $confirm_file == "my-shop-real-estate" OR 
$confirm_file == "my-shop-pets" OR $confirm_file == "my-shop-food-and-drinks" OR $confirm_file == "my-shop-groceries" OR 
$confirm_file == "my-shop-health" OR $confirm_file == "my-shop-garden" OR $confirm_file == "my-shop-home" OR $confirm_file == "my-shop-fun" OR $confirm_file == "my-shop-art"){
	if(isset($_GET['brand_username'])){
	
	$username_categories = mysqli_query($connect,"SELECT * FROM users WHERE username = '".mysqli_real_escape_string ($connect, $_GET['brand_username'])."' AND active = 1 AND payment = 1") or die(db_conn_error);
	if(mysqli_num_rows($username_categories) == 1){
	while($while_username_categories = mysqli_fetch_array($username_categories)){
	
	$user_id = $while_username_categories['user_id'];
	$username = $while_username_categories['username'];
	$brand_name = $while_username_categories['brand_username_name'];
	$address = $while_username_categories['address'];
	$phone1 = $while_username_categories['phone1'];
	$phone2 = $while_username_categories['phone2'];
	$bus_email = $while_username_categories['bus_email'];	
	$bus_descr = $while_username_categories['bus_description'];
	$headline = $while_username_categories['headline'];
	$url_facebook = $while_username_categories['facebook_link'];
	$url_instagram = $while_username_categories['instagram_link'];
	$url_twitter = $while_username_categories['twitter_link'];
	}	
	}else{
	header("Location:".MYSHOPTWO);
	exit();	
	}
	
}else{
	header("Location:".MYSHOPTWO);
	exit();
}
	
	
}else{
header("Location:".MYSHOPTWO);
exit();
}


include("../incs_shop/search_username.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
 <script data-ad-client="ca-pub-3577313515371324" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> 
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-148404208-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-148404208-1');
</script>

    <title>
	<?php
		echo $brand_name." - ".PAGE_TITLE;
	?>
	</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="<?php echo META_CONTENT;?>"/>
	<meta name="description" content="<?php
	echo $bus_descr;
	?>">
    <meta name="author" content="">
    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!-- Fontawesome core CSS -->
    <link href="assets/css/font-awesome.min.css" rel="stylesheet" />
    <!--GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!--Slide Show Css -->
    <link href="assets/ItemSlider/css/main-style.css" rel="stylesheet" />
    <!-- custom CSS here -->
    <link href="assets/css/style.css" rel="stylesheet" />
	 <!--Theme login css -->
    <link rel="stylesheet" href="assets/css/login.css" />
	<link rel="icon" type="image/png" href="assets/vectors/favicon.png"/>
</head>
<body>
    <nav class="navbar navbar-default" role="navigation" >
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="border:1px solid #02da11;">	<!--edit-->
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
               
				<?php echo CHRISTMAS_DECOR2; ?>
				<a class="navbar-brand" href="<?php 
				
				echo MYSHOPTWO.'/'.$username.'.php';
				
				?>" style="padding-left:10px; padding-right:5px;">
				<strong>
				<?php
				echo $brand_name;	
				?>
				</strong>
				</a>
            </div>
			<!--</li>-->	
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				
                <ul class="nav navbar-nav navbar-right">
                   <!-- <li><a href="#">Track Order</a></li>-->
                 
				  <?php
				if(!isset($_SESSION['user_id'])){
				echo '<li><a href="login-page.php">Login</a></li>
                    <li><a href="signup-page.php">Signup</a></li>';
				}
				?>
				 

                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" style="cursor:pointer;">Contact this e-shop<b class="caret"></b></a>
                        <ul class="dropdown-menu" style="background-color:white;">
                            <?php 
							if(isset($_SESSION['user_id']) AND $user_id == $_SESSION['user_id']){
							//echo '<li><a href="edit-shop-slider.php"><i class="fa fa-edit"></i> Edit slider</a></li> ';
							echo '<li><a href="edit-shop.php"><i class="fa fa-edit"></i> Edit</a></li> ';
							}
							
							?>
							
							<li><a disabled="disabled"><strong>Call: </strong><?php echo $phone1; ?></a></li>
                             <li><a disabled="disabled"><strong>Call: </strong><?php echo $phone2; ?></a></li>
							<li><a disabled="disabled"><strong>E-mail: </strong><br><?php echo $bus_email; ?></a></li>
                            <li><a disabled="disabled"><strong>Link: </strong><br><?php echo MYSHOPTWO.'/'.$username.'.php'; ?></a></li>
							<li class="divider"></li>
                            <li><a disabled="disabled"><strong>Location: </strong>
                                <div>
                                    <?php echo $address; ?>
                                </div>
                            </a></li>
                        </ul>
                    </li>
                
					
					
					  <?php
					include("../incs_shop/top_tabs.php");
					?>
				
				</ul>
                <form class="navbar-form navbar-right" role="search" action="search-all.php" method="GET">
                    <div class="form-group">
                     <input type="hidden" name="user" placeholder="" value= "<?php echo $username; ?>" class="form-control">
					 <input type="text" name="searchquery" placeholder="<?php echo 'Search '.$brand_name;?>" class="form-control">
                    </div>
                    &nbsp; 
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
				
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
