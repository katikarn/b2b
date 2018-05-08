<?php

require_once("inc/init.php");
require_once("inc/config.ui.php");

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
			<span id="logo"> <img src="img/logo.png" alt="SmartAdmin"> </span>
		</div>
	</header>

	<div id="main" role="main">
		<!-- MAIN CONTENT -->
		<div id="content" class="container">
			<div class="row">
					<div class="well no-padding" style="width: 50%;margin-left: auto;margin-right: auto;">
						<form action="changePassword.php" method='post' id="password-form" class="smart-form client-form">
							<header>
								Change New Password
							</header>
							<fieldset>								
								<section>
									<label class="label">Enter new password</label>
									<label class="input">
										<input type="password" name="n_password" id="n_password">
									</label>
								</section>
								<section>
									<label class="label">Re-Enter new password</label>
									<label class="input">	
										<input type="password" name="r_password" id="r_password">
									</label>
									<div class="note">
										<a href="<?php echo APP_URL; ?>/login.php">I remembered my password!</a>
									</div>
								</section>
							</fieldset>
							<footer>
								<button type="submit" class="btn btn-primary" name="change_Password">
									<i class="fa fa-refresh"></i> Reset Password
								</button>
							</footer>
						</form>
				</div>
			</div>
		</div>

	</div>
<script type="text/javascript">
	$(function() {
		$("#password-form").validate({
			submitHandler : function(form) {
		      if (confirm("Do you want to change password ?")) {
		        form.submit();
		      }
		    },
			rules : {
				n_password : {
					required : true,
					minlength : 6,
					haveNumber: true
				},
				r_password :{
					required : true,
					equalTo: "#n_password"
				}
			},

			// Messages for form validation
			messages : {
				n_password : {
					required : 'Please enter your Password',
					minlength: 'Password must more than 6 character',
					haveNumber: 'Password must more less than 1 number'
				},
				r_password : {
					required : 'Please Re-enter your Password',
					equalTo : 'Re-Password not match'
				}
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
		$.validator.addMethod('haveNumber', function(value, element) {
	        return value.match(/\d/)
	    }, '');
	});
	
</script>
<?php 
	include("inc/scripts.php"); 
?>
