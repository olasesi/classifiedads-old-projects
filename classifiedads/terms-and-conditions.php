<?php
require("../incs_shop/config.php");
require("../incs_shop/serv_con.inc.php");
include("../incs_shop/cookie_for_most.php");

$page_title = 'Terms and Conditions';					//Name of the page
$descript = 'Sign up to own your own website page and advertise your goods and services. Come see those who need your goods now, and also, get paid whenever you buy a product ot service. ';
include("../incs_shop/header.php");
?>

<div class="container">
<div row="">
<?php
echo '
<br><h1 class="text-center">TERMS AND CONDITIONS</h1></br>

<div style="margin-left:12px; margin-right:8px;margin-bottom:8px">
<h3 class="">Disclaimer</h3>
<p>All the information on this website is published in good faith and for general information purpose only. '.CAPITALIZED_NAME.' does not make any warranties about the completeness, 
reliability and accuracy of the information on this site.
Any action you take upon the information you find on this website ('.BASE_URL_NO_SLASHES.') is strictly at your own risk. We will not be liable for any losses or damages.
From our website, you can visit other websites by following hyperlinks to such external sites. While we strive to provide only quality links to useful and ethical websites, we have no control over 
the content and nature of these websites.
</p>
</br>

<h3>Personal identification information</h3>
<p>We may collect personal identification information from users in a variety of ways, including, but not limited to, when users visit our site, fill out a form and in connection with
other activities, services, features or resources we make available on our site. Users may be asked for names,  email address,  mailing address,  phone numbers, etc. </p>
<p>We will collect personal identification information from users only if they voluntarily submit such information to us. Users can always refuse to supply personal identification 
information, except that it may prevent them from engaging in certain site related activities.</p>

</br>
<h3 class="">Web browser cookies</h3>
<p>Our site may use "cookies" to enhance user experience. Users web browser places cookies on their hard drive for record-keeping purposes and sometimes to track information about 
them. User may choose to set their web browser to refuse cookies, or to alert you when cookies are being sent. If they do so, note that some parts of the site may not function 
properly.</p>

</br>
<h3 class="">How we protect your information</h3>
<p>We adopt appropriate data collection, storage and processing practices and security measures to protect against unauthorized access, alteration, disclosure or destruction of your 
personal information, username, password, and data stored on our site.</p>

</br>
<h3 class="">Changes to the privacy policy</h3>
<p>'.CAPITALIZED_NAME.' has the discretion to change or update any part of the website including the terms and conditions at any time. We encourage users to frequently check this page for any changes to stay informed about how we are 
helping to protect the personal information we collect. You acknowledge and agree that it is your responsibility to review these terms and conditions periodically and become aware of 
modifications.
</p>

</br>
<h3 class="">Your acceptance of these terms</h3>
<p>By using this site, you signify your acceptance of this policy and terms of use</a>. If you do not agree to this policy, please do not use our site. Your continued use of the site 
following the posting of changes to this policy will be deemed your acceptance of those changes.</p>

</br>
<h3 class="">Contacting us</h3>
<p>If you have any questions about this policy, the practices of this site, or your dealings with this site, please contact us at: info@'.BASE_URL_NO_WWW.'</p>


</div>

';
?>
</div>
</div>

 <?php
include("../incs_shop/footer.php");
?>