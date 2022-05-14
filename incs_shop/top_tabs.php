<?php
if(isset($_SESSION['user_id'])){
					echo '<li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" style="cursor:pointer;">Logout <b class="caret"></b></a>
                        <ul class="dropdown-menu" style="background-color:white;">
                            <li><a href="log-out.php"><i class="fa fa-power-off"></i> Logout now</a></li>
                            
						</ul>
						</li>';
				
				}
				
					if(isset($_SESSION['user_id'])){
					echo '<li>';
					echo '<a href="'.MYSHOPTWO.'"><button type="button" class="btn btn-success">
					Go to Homepage
					</button></a>';
					echo '</li>';
					}
					
					if(isset($_SESSION['user_id']) AND $user_id != $_SESSION['user_id']){
					echo '<li>';
					echo '<a href="'.MYSHOPTWO.'/'.$_SESSION['username'].'.php"><button type="button" class="btn btn-primary">
					Back to e-shop
					</button></a>';
					echo '</li>';
					}
					
					if(!isset($_SESSION['user_id'])){
					echo '<li>';
					echo '<a href="'.MYSHOPTWO.'"><button type="button" class="btn btn-success">
					Go to Homepage
					</button></a>';
					echo '</li>';
					}
?>