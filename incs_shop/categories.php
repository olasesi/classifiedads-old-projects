<?php

$categories_array=array('Categories','Mobile and Tabs', 'Computers', 'Appliances and Games', 'Constructions', 'Men Wears', 'Women Wears', 'Shoes', 'Bags', 'Fashion Accessories', 'Pets', 'Kids Wears', 'Toys', 
				'Kids Accessories', 'Cars', 'Trucks', 'Motorcycles', 'Machines and Tools', 'Vehicle Accessories', 'Real Estate', 'Food and Drinks', 'Poultry and Livestock', 'Groceries', 
				'Body Care', 'Fitness and Health', 'Furniture', 'Garden', 'Kitchen', 'Home', 'Books', 'Music', 'Sport', 'Art');	


echo "<option>Categories</option>";
			
				if(isset ($_POST['product_city'])){
					foreach ($categories_array as $local_area_LGA){
						$sel = ($local_area_LGA==$_GET['product_city'])?"Selected='selected'":"";
						echo "<option $sel>$local_area_LGA</option>";}
				}else{
						foreach ($categories_array as $local_area_LGA){
						echo "<option>$local_area_LGA</option>";
						}
				}
				
?>