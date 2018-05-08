<?php
//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
require_once("inc/config.ui.php");

/*---------------- PHP Custom Scripts ---------

$page_title = "Forgot Password";

/* ---------------- END PHP Custom Scripts ------------- */

$page_css[] = "your_style.css";
$no_main_header = true;
$page_html_prop = array("id"=>"extr-page", "class"=>"animated fadeInDown");
include("inc/header.php");

?>

<?php
	
	if( isset($_POST['forgot_password']) )
	{
		$email = $_POST["email"];
		echo "<script>alert('". $email ."');</script>";

		$to = 'katikarn@gmail.com'; // note the comma

		// Subject
		$subject = 'Birthday Reminders for August';

		// Message
		$message = '
		<html>
		<head>
		  <title>Birthday Reminders for August</title>
		</head>
		<body>
		  <p>Here are the birthdays upcoming in August!</p>
		  <table>
		    <tr>
		      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
		    </tr>
		    <tr>
		      <td>Johny</td><td>10th</td><td>August</td><td>1970</td>
		    </tr>
		    <tr>
		      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
		    </tr>
		  </table>
		</body>
		</html>
		';

		// To send HTML mail, the Content-type header must be set
		$headers = "From: natapon.boss@gmail.com"."\r\n". 
               "MIME-Version: 1.0" . "\r\n" . 
               "Content-type: text/html; charset=UTF-8" . "\r\n";

		// Mail it
		mail($to, $subject, $message, $headers);

	}
	
?>
<style type="text/css">
	#main, html{

		background: #C33764 !important;  /* fallback for old browsers */
		background: -webkit-linear-gradient(to right, #1D2671, #C33764) !important;  /* Chrome 10-25, Safari 5.1-6 */
		background: linear-gradient(to right, #1D2671, #C33764) !important; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
	}
</style>
<!-- ==========================CONTENT STARTS HERE ========================== -->
		<!-- possible classes: minified, no-right-panel, fixed-ribbon, fixed-header, fixed-width-->
		<header id="header">

			<div id="logo-group">
				<span id="logo"> <img src="img/logo.png" alt="SmartAdmin"> </span>

			</div>

		</header>

		<div id="main" role="main">

			<!-- MAIN CONTENT -->
			<div id="content" class="container">

				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-7 col-lg-8 hidden-xs hidden-sm">

					</div>
					<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
						<div class="well no-padding">
							<form action="forgotpassword.php" method='post' id="login-form" class="smart-form client-form">
								<header>
									Forgot Password
								</header>

								<fieldset>
									
									<section>
										<label class="label">Enter your email address</label>
										<label class="input"> <i class="icon-append fa fa-envelope"></i>
											<input type="email" name="email" id="email">
											<b class="tooltip tooltip-top-right"><i class="fa fa-envelope txt-color-teal"></i> Please enter email address for password reset</b></label>
									</section>
									<section>
										<span class="timeline-seperator text-center text-primary"> <span class="font-sm">OR</span> 
									</section>
									<section>
										<label class="label">Your Username</label>
										<label class="input"> <i class="icon-append fa fa-user"></i>
											<input type="text" name="username">
											<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Enter your username</b> </label>
										<div class="note">
											<a href="<?php echo APP_URL; ?>/login.php">I remembered my password!</a>
										</div>
									</section>

								</fieldset>
								<footer>
									<button type="submit" class="btn btn-primary" name="forgot_password">
										<i class="fa fa-refresh"></i> Reset Password
									</button>
								</footer>
							</form>

						</div>
						
					</div>
				</div>
			</div>

		</div>

<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->


<?php 
	//include required scripts
	include("inc/scripts.php"); 
?>

<script type="text/javascript">
	// runAllForms();

</script>
