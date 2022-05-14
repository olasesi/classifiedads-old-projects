<div>
                <a class="list-group-item active list-group-item-danger">Search Username</a>
				
				 <ul class="list-group">
				<form role="form" action="" method="POST">
					<li class="list-group-item">
					<div class="form-group">
						<label for="search_username"><i>Search Username</i></label>
						<?php if (array_key_exists('users', $username_search_array)) {echo '<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$username_search_array['users'].'</div>';}
						
						
						if (array_key_exists('notfound', $username_search_array)) {echo '<div class="alert alert-warning alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$username_search_array['notfound'].'</div>';}
						
						?>
						
						<input type="text" placeholder="search" class="form-control" name="users" id="search_username" value="<?php if(isset($_POST['users'])){echo $_POST['users'];} ?>"/>
						
					</div>
					<div class="form-group">
					<button type="submit" class="btn btn-primary">Search</button>
					</div>
					</li>
				</form>
				</ul>
			</div>