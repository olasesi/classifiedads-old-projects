  <!--Footer -->
    <br><br><br>
	<div class="col-md-12 footer-box">
	
        <div class="row">
            <div class="col-md-4">
                <strong>Send a Quick Query </strong>
                <hr>
<?php 

$footer_request_array = array();
if($_SERVER['REQUEST_METHOD'] == 'POST' AND isset($_POST['send_request'])){
	
	if (preg_match ('/^[A-Z ]{3,30}$/i', $_POST['quick_name'])) {		
    $quick_name_var = mysqli_real_escape_string ($connect, $_POST['quick_name']);
	
	} else {
     $footer_request_array['name'] = 'Invalid Input';
	}
	
	if (filter_var($_POST['quick_email'], FILTER_VALIDATE_EMAIL)) {
     $quick_email_var = mysqli_real_escape_string ($connect, $_POST['quick_email']);			
	
	} else {
     $footer_request_array['email'] = 'Please enter a valid email address';
	}
	
	if (preg_match ('/^.{3,255}+$/i', trim($_POST['quick_message']))) {		
		$quick_message = mysqli_real_escape_string ($connect, trim($_POST['quick_message']));
		} else {
		$footer_request_array['message'] = '3 to 255 characters only.';
		}
	
	if(empty($footer_request_array)){
	
	$body =  $quick_name_var.'<br>'. $quick_email_var.'<br><br>'.$quick_message;
		
		$headers = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: info@classifiedads.com' . "\r\n";
		$headers .= 'Reply-To: info@classifiedads.com' . "\r\n";
		$headers .= 'Return-Path: info@classifiedads.com' . "\r\n";
		$headers .= 'BCC: info@classifiedads.com' . "\r\n";
		$headers .= 'X-Priority: 3' . "\r\n";
		$headers .= 'X-Mailer: PHP/'. phpversion() . "\r\n";
		
		mail('info@classifiedads.com', 'Classified ads - Message to Classified ads', $body, $headers);
		$_POST = array();
		
	
		echo '<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Your message has been successfully sent.</div>';
	}
					
					
}
?>
				
                <form action="" method="post">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                            <?php if(array_key_exists('name', $footer_request_array)) {
							echo '<div class="alert alert-warning alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$footer_request_array['name'].'</div>';}?>	 
								<input type="text" class="form-control" required="required" placeholder="Name" name="quick_name" value="<?php if(isset($_POST['quick_name'])){ echo $_POST['quick_name'];} ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                              <?php if(array_key_exists('email', $footer_request_array)) {
							echo '<div class="alert alert-warning alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$footer_request_array['email'].'</div>';}?>  
								<input type="text" class="form-control" required="required" placeholder="Email address" name="quick_email" value="<?php if(isset($_POST['quick_email'])){ echo $_POST['quick_email'];} ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12">
                            <div class="form-group">
                                <?php if(array_key_exists('message', $footer_request_array)) {
							echo '<div class="alert alert-warning alert-dismissable">
							<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.$footer_request_array['message'].'</div>';}?>
								<textarea name="quick_message" id="message" required="required" class="form-control" rows="3" placeholder="Message"><?php if(isset($_POST['quick_message'])){ echo $_POST['quick_message'];}?></textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="send_request">Submit Request</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-4">
                <strong>Our Location</strong>
                <hr>
                <p>
                   <?php echo ADDRESS; ?><br />
                    Call: <?php echo CONTACT_NUMBER; ?><br>
                    Email: <?php echo "info@classifiedads.com"; ?><br>
                </p>

               
            </div>
            <div class="col-md-4 social-box">
                <strong>We are Social </strong>
                <hr>
                <a href="#"><i class="fa fa-facebook-square fa-3x "></i></a>
                <!--<a href="#"><i class="fa fa-twitter-square fa-3x "></i></a>-->
				<p>
                   Follow us on social media. 
                </p>
            </div>
        </div>
        <hr>
    </div>
    <!-- /.col -->
   <?php include("../incs_shop/footer_part.php"); ?>