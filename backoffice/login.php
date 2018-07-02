<?php
session_start();
include("inc/constant.php");
include("inc/connectionToMysql.php");

//initilize the page
require_once("inc/init.php");

//require UI configuration (nav, ribbon, etc.)
//require_once("inc/config.ui.php");
//configuration variables

/*---------------- PHP Custom Scripts ---------

YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
E.G. $page_title = "Custom Title" */

$page_title = "Login";

/* ---------------- END PHP Custom Scripts ------------- */

//include header
//you can add your custom css in $page_css array.
//Note: all css files are inside css/ folder
$page_css[] = "your_style.css";
$no_main_header = true;
$page_html_prop = array("id"=>"extr-page", "class"=>"animated fadeInDown");
include("inc/header.php");
?>
<style type="text/css">
	#main, html{
		background: #C33764 !important;  /* fallback for old browsers */
		background: -webkit-linear-gradient(to right, #1D2671, #C33764) !important;  /* Chrome 10-25, Safari 5.1-6 */
		background: linear-gradient(to right, #1D2671, #C33764) !important; /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
	}

	.error{
		margin-top: 6px;
	    padding: 0 1px;
	    font-style: normal;
	    font-size: 11px;
	    line-height: 15px;
	    color: #D56161;
	}
</style>

<header id="header">
	<div id="logo-group">
		<span id="logo"> <img src="<?php echo ASSETS_URL; ?>/img/logo.png" alt="SmartAdmin"> </span>
	</div>
</header>

<div id="main" role="main">
	<!-- MAIN CONTENT -->
	<div id="content" class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-5 col-lg-4">
				<div class="well no-padding">
					<form id="login-form" method="POST" class="smart-form client-form" action="login-controller.php">
						<header>Sign In</header>
						<fieldset>
							<section>
								<label class="label">Username</label>
								<label class="input"> <i class="icon-append fa fa-user"></i>
									<input type="text" name="username" id="username">
									<b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter username</b>
								</label>
							</section>

							<section>
								<label class="label">Password</label>
								<label class="input"> <i class="icon-append fa fa-lock"></i>
									<input type="password" name="password" id="password">
									<b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b>
								</label>
								<div class="note">
									<a href="<?php echo APP_URL; ?>/forgotpassword.php">Forgot password?</a>
								</div>
							</section>
						</fieldset>
						<footer class="text-center">
							<button type="submit" name="submitSignIn" class="btn btn-primary" style="float:none">
								Sign in
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
<!-- PAGE FOOTER -->
<?php
	// include page footer
	include("inc/footer.php");
?>
<!-- END PAGE FOOTER -->

<?php 
	//include required scripts
	include("inc/scripts.php"); 
?>

<script type="text/javascript">
	$(function() {
		$("#login-form").validate({
			rules : {
				username : {
					required : true,
				},
				password : {
					required : true,
				}
			},

			// Messages for form validation
			messages : {
				username : {
					required : 'Please input Username'
				},
				password : {
					required : 'Please input Password'
				}
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
	});

</script>