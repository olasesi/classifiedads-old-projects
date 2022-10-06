<?php 
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
		if(isset($page_title)){
			echo($page_title);
		}else{
			echo PAGE_TITLE;
		}
		
	?>
	</title>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content= "<?php echo META_CONTENT;?>" />
	<meta name="description" content="<?php
	if(isset($descript)){
			echo($descript);
		}else{
			//edit start
			echo PAGE_DESCRIPTION;
			//edit end
		}
	?>">
    <meta name="author" content="Classifiedads">
	<!-- i wiiil -->
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
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="border:1px solid #02da11;">	 <!-- edit -->
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
              <?php echo CHRISTMAS_DECOR2; ?>	<a class="navbar-brand" href="<?php echo MYSHOPTWO; ?>" style="padding-left:10px; padding-right:5px;" title="<?php echo MYSHOPTWO; ?>">
				<strong> <?php echo 'CLASSIFIED ADS'; ?> </strong>
				</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				
				<ul class="nav navbar-nav navbar-right">
                
              
				
				<?php 
				if(!isset($_SESSION['user_id'])){
				echo '<li><a href="login-page.php">Login</a></li>
                    <li><a href="signup-page.php">Signup</a></li>';
				}
				?>
				  

                  <!--  <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" style="cursor:pointer;">Contact Myshoptwo<b class="caret"></b></a>
                      
					   <ul class="dropdown-menu" style="background-color:white;">
                            <li><a><strong>Call: </strong><?php //echo CONTACT_NUMBER; ?></a></li>
                           <li><a><strong>Call: </strong>08074574512</a></li>
							<li><a><strong>E-mail: <br></strong>info@<?php //echo BASE_URL_NO_WWW;?></a></li>
                            <li><a><strong>Website: </strong><br> <?php //echo BASE_URL_NO_SLASHES;?></a></li>
							<li class="divider"></li>
                            <li><a><strong>Location: </strong>
                                <div>
                                    <?php //echo ADDRESS; ?>
                                </div>
                            </a></li>
                        </ul>
                    </li>-->
					
					  <?php
				if(isset($_SESSION['user_id'])){
				 echo '<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Logout <b class="caret"></b></a>
                        <ul class="dropdown-menu" style="background-color:white;">
                            <li><a href="log-out.php"><i class="fa fa-power-off"></i> Logout now</a></li>
                            
						</ul>
						</li>';
				
				}
				?>
					
					
					<?php
				if(isset($_SESSION['user_id'])){
				echo '<li>';
				echo '<a href="'.MYSHOPTWO.'/'.$_SESSION['username'].'.php"><button type="button" class="btn btn-success">Back to e-shop</button></a>';
				echo '</li>';
				}
				?>  
					
                </ul>
             
			   <form class="navbar-form navbar-right" role="search" action="search-page.php" method="GET">
					<div class="form-group">
					<label for="selectname"></label>
						<select class="form-control input-sm" name="product_city" id="selectname">
							<?php
							include("../incs_shop/cities_find_products.php");
							?>
						</select>
					</div>
				   <div class="form-group">
                      
						<input type="text" required="required" name="searchquery" placeholder="Search all shops" class="form-control" value="<?php if(isset($_GET['searchquery'])){echo $_GET['searchquery'];}?>" />
                    </div>
                    &nbsp; 
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
