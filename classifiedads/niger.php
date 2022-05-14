<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");

echo("<div class='box_after_header_post'>");
		
	$post = mysqli_query($connect,"SELECT * FROM post WHERE post_state_id = 'Niger'  ORDER BY php_timestamp DESC LIMIT 0 , 5") or die(db_conn_error);
		
	while($post_question = mysqli_fetch_array($post)){
			
	echo('<div class="clearfix" style="margin-bottom:20px;">');
				
		echo('<h5>'.$post_question['posts'].'<h5>');
		echo '<div class="pull-left"><span class="label label-success">'.$post_question['post_city'].'</span></div>';
		echo '<div class="pull-right"><a href="tel:'.$post_question['phone'].'"><span class="label label-info">'.$post_question['phone'].'</span></a></div>';
			
	echo("</div>");
			
			}

echo("</div>");
?>
