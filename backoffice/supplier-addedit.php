<?php
	session_start();
	include("inc/auth.php");
	include("inc/constant.php");
	include("inc/connectionToMysql.php");
	/////////////////////////////////////////////////////////
	//initilize the page
	require_once ("inc/init.php");

	//require UI configuration (nav, ribbon, etc.)
	require_once ("inc/config.ui.php");

	/*---------------- PHP Custom Scripts ---------

		YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */

	$page_title = "Supplier Information";

	/* ---------------- END PHP Custom Scripts ------------- */

	//include header
	//you can add your custom css in $page_css array.
	//Note: all css files are inside css/ folder
	$page_css[] = "your_style.css";
	include ("inc/header.php");

	//include left panel (navigation)
	//follow the tree in inc/config.ui.php
	$page_nav["Supplier"]["sub"]["Supplier List"]["active"] = true;
	include ("inc/nav.php");

	//Get data from database

	if(isset($_GET['id']))	{
	/*	$sql = "SELECT agent_id, agent_status, agent_name, agentcountry_id, 
		agent_contact_name, agent_contact_tel, agent_contact_email, agent_contact_line, 
		agent_license, agent_license_file, agent_section, agent_logo_file, agent_username, 
		agent_password, agent_price_type, agent_remark, create_datetime, create_by, update_datetime, update_by
		FROM tb_agent_tr
		WHERE agent_id = '".$_GET['id']."'";
		$result = mysqli_query($conn ,$sql);
		$row = mysqli_fetch_assoc($result);

		if (mysqli_num_rows($result) > 0)	{
			$_agent_id = $row['agent_id'];
			$_agent_status = $row['agent_status'];
			$_agent_name = $row['agent_name'];
			$_agentcountry_id = $row['agentcountry_id'];
			$_agent_contact_name = $row['agent_contact_name'];
			$_agent_contact_tel = $row['agent_contact_tel'];
			$_agent_contact_email = $row['agent_contact_email'];
			$_agent_contact_line = $row['agent_contact_line'];
			$_agent_license = $row['agent_license'];
			$_agent_license_file = $row['agent_license_file'];
			$_agent_section = $row['agent_section'];
			$_agent_logo_file = $row['agent_logo_file'];
			$_agent_username = $row['agent_username'];
			$_agent_password = $row['agent_password'];
			$_agent_price_type = $row['agent_price_type'];
			$_agent_remark = $row['agent_remark'];
			$_create_datetime = $row['create_datetime'];
			$_create_by = $row['create_by'];
			$_update_datetime = $row['update_datetime'];
			$_update_by = $row['update_by'];
		}*/
	}else{
		$_agent_id = '';
		$_agent_status = '';
		$_agent_name = '';
		$_agentcountry_id = '';
		$_agent_contact_name = '';
		$_agent_contact_tel = '';
		$_agent_contact_email = '';
		$_agent_contact_line = '';
		$_agent_license = '';
		$_agent_license_file = '';
		$_agent_section = '';
		$_agent_logo_file = '';
		$_agent_username = '';
		$_agent_password = '';
		$_agent_price_type = '';
		$_agent_remark = '';
		$_create_datetime = '';
		$_create_by = '';
		$_update_datetime = '';
		$_update_by = '';
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
		//$breadcrumbs["Booking"] = "";
		include("inc/ribbon.php");
	?>
	<!-- MAIN CONTENT -->
	<div id="content">
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="header">
					Supplier Information
				</h1>
			</div>
		</div>
		<section id="widget-grid">
			<div class="row">
				<article class="col-sm-12 col-md-12 col-lg-12">
					<div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-custombutton="false">
						<header>
							<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
							<h2><?php
								if ($_agent_id<>"")	{
									echo "Supplier Code : <b>S".substr("00000000",1,4-strlen($_agent_id));
									echo $_agent_id."</b>";
									echo " <i>(Last update : ".$_update_by." ".$_update_datetime.")</i>";
								}else{
									echo "Supplier Information : << New Supplier >>";
								} ?></h2>
						</header>
						<div>
							<form action="supplier-controller.php" method="post" id="detail-form" class="smart-form">
								<fieldset>
									<section class="col col-6">
										<label class="label">Destination</label>
										<label class="select required">
											<select name="lsbagentcountry_id" id="lsbagentcountry_id" class="input-sm">
												<option value="" selected></option>
												<?php
												$sql = "SELECT agentcountry_id, agentcountry_name FROM tb_agent_country_ms ORDER BY agentcountry_name";
												$result = mysqli_query($conn ,$sql);
												if(mysqli_num_rows($result) > 0)	{
													//show data for each row
													while($row = mysqli_fetch_assoc($result))	{
														echo "<option value='".$row['agentcountry_id']."'";
														if ($row['agentcountry_id']==$_agentcountry_id)	{
															echo " selected ";
														}
														echo ">".$row['agentcountry_name']."</option>";
													}
												}?>
											</select> <i></i>
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Supplier Type</label>
										<label class="select required">
											<select name="lsbagent_section" id="lsbagent_section" class="input-sm">
												<option value="" selected></option>
												<?php
												$sql = "SELECT mas_id, mas_value from tb_mas_ms, tb_masofmas_ms 
														WHERE tb_mas_ms.masofmas_id = tb_masofmas_ms.masofmas_id 
														AND tb_masofmas_ms.masofmas_name='SUPPLIER_TYPE'";
												$result = mysqli_query($conn ,$sql);
												if(mysqli_num_rows($result) > 0)	{
													//show data for each row
													while($row = mysqli_fetch_assoc($result))	{
														echo "<option value='".$row['mas_id']."'";
														if ($row['mas_id']==$_agent_section)	{
															echo " selected ";
														}
														echo ">".$row['mas_value']."</option>";
													}
												}?>
											</select> <i></i>
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Supplier Name</label>
										<label class="input required">
											<input type="text" name="txbagent_name" id="txbagent_name" maxlength="100" value="<?=$_agent_name;?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Contract File</label>
										<div class="input input-file">
												<span class="button"><input type="file" id="agent_logo_file" name="agent_logo_file" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly="">
										</div>
									</section>
									<section class="col col-6">
										<label class="label">Google Map</label>
										<label class="input">
											<input type="text" name="txbagent_contact_line" id="txbagent_contact_line" maxlength="100" value="<?=$_agent_contact_line;?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Tel</label>
										<label class="input">
											<input type="text" name="txbagent_contact_tel" id="txbagent_contact_tel" maxlength="100" value="<?=$_agent_contact_tel;?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Website</label>
										<label class="input">
											<input type="text" name="txbagent_contact_line" id="txbagent_contact_line" maxlength="100" value="<?=$_agent_contact_line;?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Address</label>
										<label class="input">
											<input type="text" name="txbagent_contact_line" id="txbagent_contact_line" maxlength="100" value="<?=$_agent_contact_line;?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">File Logo</label>
										<div class="input input-file">
												<span class="button"><input type="file" id="agent_logo_file" name="agent_logo_file" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly="">
										</div>
									</section>
									<section class="col col-6">
										<label class="label">Brochure (PDF)</label>
										<div class="input input-file">
												<span class="button"><input type="file" id="agent_logo_file" name="agent_logo_file" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly="">
										</div>
									</section>
									<section class="col col-6">
										<label class="label">Image File 1</label>
										<div class="input input-file">
												<span class="button"><input type="file" id="agent_logo_file" name="agent_logo_file" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly="">
										</div>
									</section>
									<section class="col col-6">
										<label class="label">Image File 2</label>
										<div class="input input-file">
												<span class="button"><input type="file" id="agent_logo_file" name="agent_logo_file" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly="">
										</div>
									</section>
									<section class="col col-6">
										<label class="label">Image File 3</label>
										<div class="input input-file">
												<span class="button"><input type="file" id="agent_logo_file" name="agent_logo_file" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly="">
										</div>
									</section>
									<section class="col col-6">
										<label class="label">Image File 4</label>
										<div class="input input-file">
												<span class="button"><input type="file" id="agent_logo_file" name="agent_logo_file" onchange="this.parentNode.nextSibling.value = this.value">Browse</span><input type="text" placeholder="Include some files" readonly="">
										</div>
									</section>
								</fieldset>
								<fieldset>
									<section>
									<header>
										<b>Sales Contact</b>
									</header>
									</section>
									<section class="col col-6">
										<label class="label">Contact Person</label>
										<label class="input">
											<input type="text" name="txbagent_contact_name" id="txbagent_contact_name" maxlength="100" value="<?=$_agent_contact_name;?>">
										</label>
									</section>									
									<section class="col col-6">
										<label class="label">Email</label>
										<label class="input">
											<input type="text" name="txbagent_contact_email" id="txbagent_contact_email" maxlength="100" value="<?=$_agent_contact_email;?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Tel</label>
										<label class="input">
											<input type="text" name="txbagent_contact_tel" id="txbagent_contact_tel" maxlength="100" value="<?=$_agent_contact_tel;?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Line or WhatApp</label>
										<label class="input">
											<input type="text" name="txbagent_contact_line" id="txbagent_contact_line" maxlength="100" value="<?=$_agent_contact_line;?>">
										</label>
									</section>
								</fieldset>
								<fieldset>
									<section>
									<header>
										<b>Reservation Contact</b>
									</header>
									</section>
									<section class="col col-6">
										<label class="label">Contact Person</label>
										<label class="input">
											<input type="text" name="txbagent_contact_name" id="txbagent_contact_name" maxlength="100" value="<?=$_agent_contact_name;?>">
										</label>
									</section>									
									<section class="col col-6">
										<label class="label">Email</label>
										<label class="input">
											<input type="text" name="txbagent_contact_email" id="txbagent_contact_email" maxlength="100" value="<?=$_agent_contact_email;?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Tel</label>
										<label class="input">
											<input type="text" name="txbagent_contact_tel" id="txbagent_contact_tel" maxlength="100" value="<?=$_agent_contact_tel;?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Fax</label>
										<label class="input">
											<input type="text" name="txbagent_contact_tel" id="txbagent_contact_tel" maxlength="100" value="<?=$_agent_contact_tel;?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Line or WhatApp</label>
										<label class="input">
											<input type="text" name="txbagent_contact_line" id="txbagent_contact_line" maxlength="100" value="<?=$_agent_contact_line;?>">
										</label>
									</section>
								</fieldset>
								<fieldset>
									<section>
									<header>
										<b>Accounting Contact</b>
									</header>
									</section>
									<section class="col col-6">
									<label class="label">Pay Type</label>
										<label class="input">
											<div class="inline-group">
												<label class="radio">
													<input type="radio" name="lsbsupplier_paytype" value="T" id="id_supplier_paytype_T" checked>
													<i></i>Cash Transfer</label>
												<label class="radio">
													<input type="radio" name="lsbsupplier_paytype" value="C" id="id_supplier_paytype_C">
													<i></i>Credit</label>
											</div>
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Credit Limit</label>
										<label class="input">
											<input type="number" step=".25" name="txbsupplier_credit_term" id="txbsupplier_credit_term">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Company Register Name</label>
										<label class="input">
											<input type="text" name="txbagent_contact_name" id="txbagent_contact_name" maxlength="100" value="<?=$_agent_contact_name;?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Contact Person</label>
										<label class="input">
											<input type="text" name="txbagent_contact_line" id="txbagent_contact_line" maxlength="100" value="<?=$_agent_contact_line;?>">
										</label>
									</section>							
									<section class="col col-6">
										<label class="label">Email</label>
										<label class="input">
											<input type="text" name="txbagent_contact_email" id="txbagent_contact_email" maxlength="100" value="<?=$_agent_contact_email;?>">
										</label>
									</section>
									<section class="col col-6">
										<label class="label">Tel</label>
										<label class="input">
											<input type="text" name="txbagent_contact_tel" id="txbagent_contact_tel" maxlength="100" value="<?=$_agent_contact_tel;?>">
										</label>
									</section>
								</fieldset>
								<fieldset>
									<section>
										<label class="label">Note</label>
										<label class="input">
											<textarea rows="4" name="txbagent_remark" id="txbagent_remark"><?=$_agent_remark?></textarea>
										</label>
									</section>
								</fieldset>
								<footer>
									<section class="col col-10"  style="padding-left: 0px;">
										<input type="radio" name="chkagent_status" id="chkagent_status_A" value="A" <?php if ($_agent_status=="A")    { echo " checked "; }?>>
										<i></i><span style="background-color: Green; color: #ffffff">Active</span>
										<input type="radio" name="chkagent_status" id="chkagent_status_I" value="I" <?php if ($_agent_status=="I")    { echo " checked "; }?>>
										<i></i><span style="background-color: red; color: #ffffff">Inactive</span>
										<input type="radio" name="chkagent_status" id="chkagent_status_C" value="C" <?php if ($_agent_status=="C")    { echo " checked "; }?>>
										<i></i><span style="background-color: Orange; color: #ffffff">Cancel</span>
									</section>
									<section class="col col-2">
										<button type="submit" class="btn btn-primary" name="submitAddBooking" id="submitAddBooking">Save</button>
										<input type="hidden" name="id" id="id" value="<?=$_agent_id;?>"/>
									</section>
								</footer>
							</form>
						</div>
					</div>
				</article>	
			</div>
		</section>
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
<!-- PAGE RELATED PLUGIN(S) -->
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.colVis.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.tableTools.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>/js/plugin/datatable-responsive/datatables.responsive.min.js"></script>
<script type="text/javascript">
	//// --------------------------- Validate------------------------------
	var errorClass = 'invalid';
		var errorElement = 'em';
		var $contactForm = $("#detail-form").validate({
			errorClass		: errorClass,
			errorElement	: errorElement,
			highlight: function(element) {
		        $(element).parent().removeClass('state-success').addClass('state-error');
		        //$(element).parent().addClass("required");
		        if($(element).parent().hasClass( "required" )){
		        	 $(element).parent().css("border-left", "7px solid #FF3333");
		        }
		        $(element).removeClass('valid');
		    },
		    unhighlight: function(element) {
		        $(element).parent().removeClass('state-error').addClass('state-success');
		        //$(element).parent().removeClass("required");
		        if($(element).parent().hasClass( "required" )){
		        	$(element).parent().css("border-left", "7px solid #047803");
		        }
		        $(element).addClass('valid');
		    },
		    submitHandler : function(form) {
		      if (confirm("Do you want to save the data?")) {
		        form.submit();
		      }
		    },
		// Rules for form validation
		rules : {
			txbagent_name : {
				required : true,
			},
			lsbagentcountry_id : {
				required : true,
			},
			lsbagent_section : {
				required : true,
			}
		},
		// Messages for form validation
		messages : {
			txbagent_name : {
				required : 'Please fill Agent Name',
			},
			lsbagentcountry_id : {
				required : 'Please select Country',
			},
			lsbagent_section : {
				required : 'Please select Agent Type',
			}
		},

		// Do not change code below
		errorPlacement : function(error, element) {
			error.insertAfter(element.parent());
		}
	});

})
</script>
<?php
	//include footer
	include ("inc/google-analytics.php");
?>