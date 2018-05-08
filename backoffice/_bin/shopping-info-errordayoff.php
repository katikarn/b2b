<?php 
	session_start();
	include("inc/constant.php");
	include('inc/auth.php');
	include("inc/connectionToMysql.php");
	/////////////////////////////////////////////////////////
	$agent_id = trim($_SESSION["LoginUserID_Agent"]);
	$LoginByUser = trim($_SESSION['LoginUser']);
	$AgentName = trim($_SESSION["AgentName"]);
    $AgentVatType = trim($_SESSION["AgentVatType"]);
    $AgentPayType = trim($_SESSION["AgentPayType"]);
    $AgentPriceType = trim($_SESSION["AgentPriceType"]);
	//initilize the page
	require_once ("inc/init.php");
	
	//require UI configuration (nav, ribbon, etc.)
	require_once ("inc/config.ui.php");
	
	/*---------------- PHP Custom Scripts ---------
		
		YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */
	
	$page_title = "My Booking";
	
	/* ---------------- END PHP Custom Scripts ------------- */
	
	//include header
	//you can add your custom css in $page_css array.
	//Note: all css files are inside css/ folder
	$page_css[] = "your_style.css";
	include ("inc/header.php");
	
	//include left panel (navigation)
	//follow the tree in inc/config.ui.php
	$page_nav["My Booking"]["sub"]["Shopping Cart"]["active"] = true;
	include ("inc/nav.php");

	//Get data from database
	if (isset($_GET["booking_id"])) {
		$id=$_GET["booking_id"];
		$sql = "SELECT booking_id, booking_status, booking_name, booking_pax, agent_id, 
		booking_nat, booking_tel, booking_line, booking_remark, createdatetime, createby, updatedatetime, updateby
		FROM booking
		WHERE booking_id = '$id'";
		$result = mysqli_query($conn ,$sql);
		$row = mysqli_fetch_assoc($result);

		if (mysqli_num_rows($result) > 0)	{
			$_booking_id = $row['booking_id'];
			$_booking_status = $row['booking_status'];
			$_agent_id = $row['agent_id'];
			$_booking_name = $row['booking_name'];
			$_booking_pax = $row['booking_pax'];
			$_booking_nat = $row['booking_nat'];
			$_booking_tel = $row['booking_tel'];
			$_booking_line = $row['booking_line'];
			$_booking_remark = $row['booking_remark'];
			$_createdatetime = $row['createdatetime'];
			$_createby = $row['createby'];
			$_updatedatetime = $row['updatedatetime'];
			$_updateby = $row['updateby'];
		}
	}else{
		$_booking_id = "";
		$_booking_status = "";
		$_agent_id = "";
		$_booking_name = "";
		$_booking_pax = "";
		$_booking_nat = "";
		$_booking_tel = "";
		$_booking_line = "";
		$_booking_remark = "";
		$_createdatetime = "";
		$_createby = "";
		$_updatedatetime = "";
		$_updateby = "";
	}
?>

<style>
	.header{
	font-weight:bold;
	}
	
	.row{
	margin-bottom:10px;
	}
	
	#dt_basic{
	margin-top: 0px !important;
	}
	
	.filterbar{
	// float: right;
	margin-top: 20px;
	text-align: center;
	white-space: nowrap;
	}
	
	.status label{
	color:#fff;
	margin-right: 20px;
	border-radius: 4px;
	border: 1px solid #ccc;
	padding: 2px;
	}
	
	label, .mr-20{
	margin-right:	20px;
	}
	
	.modal-header{
	background-color: royalblue;
	color: #fff;
	}
	
	.center{
	text-align:	center;
	}
	
	input[type=text], select, input[type=email], textarea{
	width: 100%;
	padding: 5px;
	margin: 8px 0px;
	border: 1px solid #ccc;
	border-radius: 4px;
	}
	
	textarea{
	resize:none;
	}
	
	.sectionHead
	{
	width: 100%;
	font-weight: bolder;
	font-size: 15px;
	margin-bottom: 11px;
	}
	
	.madalContent{
	border-left: 7px solid #3276b1;
	border-radius: 5px;
	display: flow-root;
	background-color: #fafafa;
	margin-bottom: 10px;
	padding: 5px 0px;
	box-shadow: 2px 2px #eee;
	}
	.error{
		color: red;
		font-weight: bold;
	}

	.required{
		border-left: 7px solid #FF3333;
	}
	
</style>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Booking"] = "";
		include("inc/ribbon.php");
	?>
	<!-- MAIN CONTENT -->
	<div id="content">
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="header">
				Step 4 : Submit
				</h1>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8" style="text-align: right;">
			<?php if ($_booking_status=="C")	{ ?>
				<a href="bookingList-invoice.php" target="_blank" class="btn btn-default" style="margin-right: 10px;"> 
					<i style="margin-right: 5px;" class="icon-append fa fa-print"></i>Print Invoice</a>
			<?php }?>
			<?php if ($_booking_status=="P")	{ ?>
				<a href="bookingList.php" class="btn btn-default" style="margin-right: 10px;"> 
					<i style="margin-right: 5px;" class="icon-append fa fa-send"></i>Send Confirmation</a>
				<a class="btn btn-default" style="margin-right: 10px;">
					<i style="margin-right: 5px;" class="icon-append fa fa-file-o"></i>Itinerary</a>					
				<a class="btn btn-default" style="margin-right: 10px;">
					<i style="margin-right: 5px;" class="icon-append fa fa-car"></i>Pickup Card</a>
			<?php }?>
			</div>
		</div>
		<!-- widget grid -->
		<section id="widget-grid" class="">
			<!-- START ROW -->
			<div class="row">
				<!-- NEW COL START -->
				<article class="col-sm-12 col-md-12 col-lg-12">
					<!-- Widget ID (each widget will need unique ID)-->
					<div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-custombutton="false">
						<header>
							<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
							<h2>Booking No : <?php
							if ($_booking_id<>"")	{
								echo "<b>".substr("00000000",1,6-strlen($_booking_id));
								echo "$_booking_id</b> Booking By : <b>$AgentName</b> ";
								echo " <i>(Last update : ".$_updateby." ".$_updatedatetime.")</i>";
							}else{
								echo "<< New booking >>";
							} ?></h2>
						</header>
						<!-- widget div-->
						<div>
							<!-- widget edit box -->
							<div class="jarviswidget-editbox">
								<!-- This area used as dropdown edit box -->
							</div>
							<!-- end widget edit box -->
							<!-- widget content -->
							<div class="widget-body no-padding">
								<form action="shopping-info-controller.php" method="post" id="contact-form" class="smart-form">
									<!-- <header>Contacts form</header> -->
									<fieldset>
										<div class="row">
											<div class="form-bootstrapWizard">
												<ul class="bootstrapWizard form-wizard">
													<li data-target="#step1">
														<span class="step">1</span> <span class="title">Add product</span>
													</li>
													<li data-target="#step2">
														<span class="step">2</span> <span class="title">Guest Info</span>
													</li>
													<li data-target="#step3">
														<span class="step">3</span> <span class="title">Review</span>
													</li>
													<li class="active" data-target="#step4">
														<span class="step">4</span> <span class="title">Submit</span>
													</li>
												</ul>
												<div class="clearfix"></div>
											</div>
										</div>
										<div class="row">
											<div>
												<br><br><br><br>
												<h1 class="text-center text-red"><strong><i class="fa fa-recheck fa-lg"></i> Error : This day is dayoff.</strong></h1>
												<br>
												<h4 class="text-center">Click close to add new product</h4>
												<br><br><br><br><br><br><br>
											</div>
										</div>
										<div class="form-actions">
											<div class="row">
												<div class="col-sm-11">
													<ul class="pager wizard no-margin">
														<li class="next">
															<a href="index.php" class="btn btn-lg txt-color-darken"> Close </a>
														</li>
													</ul>
												</div>
											</div>
										</div>
									</fieldset>
								</form>
							</div>
							<!-- end widget content -->
						</div>
						<!-- end widget div -->
					</div>
					<!-- end widget -->								
				</article>
				<!-- END COL -->		
			</div>
			<!-- END ROW -->
		</section>
		<!-- end widget grid -->

</div>
<!-- END MAIN PANEL -->
<!-- ==========================CONTENT ENDS HERE ========================== -->

<!-- PAGE FOOTER -->
<!-- END PAGE FOOTER -->

<?php 
	//include required scripts
	include("inc/scripts.php"); 
?>

<?php
	//include footer
	include ("inc/google-analytics.php");
?>																														