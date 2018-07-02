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

	if(isset($_GET['supplier_id']))	{
		$_supplier_id = $_GET['supplier_id'];
		$sql = "SELECT supplier_name, dest_id, supplier_type, supplier_description, supplier_logo_file, supplier_address, 
				supplier_googlemap, supplier_website, supplier_tel, supplier_brochure_file, supplier_other_file, supplier_remark,
				supplier_sales_name, supplier_sales_tel, supplier_sales_email, supplier_sales_line, supplier_reserv_name, 
				supplier_reserv_email, supplier_reserv_tel, supplier_reserv_fax, supplier_reserv_line, supplier_account_name, 
				supplier_account_tel, supplier_account_email, supplier_name_acc, supplier_status, create_datetime, create_by, 
				update_datetime, update_by, supplier_open, supplier_close, supplier_operate_remark, 
				supplier_contract_file, supplier_image1_file, supplier_image2_file, supplier_image3_file, supplier_image4_file
				FROM tb_supplier_tr
				WHERE supplier_id = '".$_GET['supplier_id']."'";
				$result = mysqli_query($conn ,$sql);
				$row = mysqli_fetch_assoc($result);

		if (mysqli_num_rows($result) > 0)	{
			$_supplier_name = $row['supplier_name'];
			$_dest_id = $row['dest_id'];
			$_supplier_type = $row['supplier_type'];
			$_supplier_description = $row['supplier_description'];
			$_supplier_logo_file = $row['supplier_logo_file'];
			$_supplier_address = $row['supplier_address'];
			$_supplier_googlemap = $row['supplier_googlemap'];
			$_supplier_website = $row['supplier_website'];
			$_supplier_tel = $row['supplier_tel'];
			$_supplier_brochure_file = $row['supplier_brochure_file'];
			$_supplier_other_file = $row['supplier_other_file'];
			$_supplier_remark = $row['supplier_remark'];
			$_supplier_sales_name = $row['supplier_sales_name'];
			$_supplier_sales_tel = $row['supplier_sales_tel'];
			$_supplier_sales_email = $row['supplier_sales_email'];
			$_supplier_sales_line = $row['supplier_sales_line'];
			$_supplier_reserv_name = $row['supplier_reserv_name'];
			$_supplier_reserv_email = $row['supplier_reserv_email'];
			$_supplier_reserv_tel = $row['supplier_reserv_tel'];
			$_supplier_reserv_fax = $row['supplier_reserv_fax'];
			$_supplier_reserv_line = $row['supplier_reserv_line'];
			$_supplier_account_name = $row['supplier_account_name'];
			$_supplier_account_tel = $row['supplier_account_tel'];
			$_supplier_account_email = $row['supplier_account_email'];
			$_supplier_name_acc = $row['supplier_name_acc'];
			$_supplier_status = $row['supplier_status'];
			$_create_datetime = $row['create_datetime'];
			$_create_by = $row['create_by'];
			$_update_datetime = $row['update_datetime'];
			$_update_by = $row['update_by'];
			$_supplier_open = $row['supplier_open'];
			$_supplier_close = $row['supplier_close'];
			$_supplier_operate_remark = $row['supplier_operate_remark'];
			$_supplier_contract_file = $row['supplier_contract_file'];
			$_supplier_image1_file = $row['supplier_image1_file'];
			$_supplier_image2_file = $row['supplier_image2_file'];
			$_supplier_image3_file = $row['supplier_image3_file'];
			$_supplier_image4_file = $row['supplier_image4_file'];
		}
	}else{
		$_supplier_id = '';
		$_supplier_name = '';
		$_dest_id = '';
		$_supplier_type = '';
		$_supplier_description = '';
		$_supplier_logo_file = '';
		$_supplier_address = '';
		$_supplier_googlemap = '';
		$_supplier_website = '';
		$_supplier_tel = '';
		$_supplier_brochure_file = '';
		$_supplier_other_file = '';
		$_supplier_remark = '';
		$_supplier_sales_name = '';
		$_supplier_sales_tel = '';
		$_supplier_sales_email = '';
		$_supplier_sales_line = '';
		$_supplier_reserv_name = '';
		$_supplier_reserv_email = '';
		$_supplier_reserv_tel = '';
		$_supplier_reserv_fax = '';
		$_supplier_reserv_line = '';
		$_supplier_account_name = '';
		$_supplier_account_tel = '';
		$_supplier_account_email = '';
		$_supplier_name_acc = '';
		$_supplier_status = '';
		$_create_datetime = '';
		$_create_by = '';
		$_update_datetime = '';
		$_update_by = '';
		$_supplier_open = '';
		$_supplier_close = '';
		$_supplier_operate_remark = '';
		$_supplier_contract_file = '';
		$_supplier_image1_file = '';
		$_supplier_image2_file = '';
		$_supplier_image3_file = '';
		$_supplier_image4_file = '';
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
								if ($_supplier_id<>"")	{
									echo "Supplier Code : <b>S".substr("00000000",1,4-strlen($_supplier_id));
									echo $_supplier_id."</b>";
									echo " <i>(Last update : ".$_update_by." ".$_update_datetime.")</i>";
								}else{
									echo "Supplier Information : << New Supplier >>";
								} ?></h2>
						</header>
						<div>
							<form action="supplier-controller.php" method="post" id="detail-form" name="detail-form" class="smart-form" enctype="multipart/form-data">
								<fieldset>
									<div class="row">
										<section class="col col-6">
											<label class="label">Supplier Name</label>
											<label class="input required"><i class="icon-append fa fa-briefcase"></i>
												<input type="text" name="txbsupplier_name" id="txbsupplier_name" maxlength="100" value="<?=$_supplier_name;?>">
											</label>
										</section>
										<section class="col col-4">
											<label class="label">Destination</label>
											<label class="select required">
												<select name="lsbdest_id" id="lsbdest_id" class="input-sm">
													<option value="" selected></option>
													<?php
													$sql = "SELECT dest_id, dest_name FROM tb_dest_ms ORDER BY dest_name";
													$result = mysqli_query($conn ,$sql);
													if(mysqli_num_rows($result) > 0)	{
														//show data for each row
														while($row = mysqli_fetch_assoc($result))	{
															echo "<option value='".$row['dest_id']."'";
															if ($row['dest_id']==$_dest_id)	{
																echo " selected ";
															}
															echo ">".$row['dest_name']."</option>";
														}
													}?>
												</select> <i></i>
											</label>
										</section>
										<section class="col col-2">
											<label class="label">Supplier Type</label>
											<label class="select required">
												<select name="lsbsupplier_type" id="lsbsupplier_type" class="input-sm">
													<option value="" selected></option>
													<?php
													$sql = "SELECT mas_code, mas_value from tb_mas_ms, tb_masofmas_ms 
															WHERE tb_mas_ms.masofmas_id = tb_masofmas_ms.masofmas_id 
															AND tb_masofmas_ms.masofmas_name='SUPPLIER_TYPE'";
													$result = mysqli_query($conn ,$sql);
													if(mysqli_num_rows($result) > 0)	{
														//show data for each row
														while($row = mysqli_fetch_assoc($result))	{
															echo "<option value='".$row['mas_code']."'";
															if ($row['mas_code']==$_supplier_type)	{
																echo " selected ";
															}
															echo ">".$row['mas_value']."</option>";
														}
													}?>
												</select> <i></i>
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6">
											<label class="label">Short Description</label>
											<label class="input">
												<textarea rows="3" name="txbsupplier_description" id="txbsupplier_description"><?=$_supplier_description?></textarea>
											</label>
										</section>
										<section class="col col-1">
											<label class="label">Open</label>
											<label class="input">
												<input type="time" name="txbsupplier_open" id="txbsupplier_open" value="<?=$_supplier_open;?>">
											</label>
										</section>
										<section class="col col-1">
											<label class="label">Close</label>
											<label class="input">
												<input type="time" name="txbsupplier_close" id="txbsupplier_close" value="<?=$_supplier_close;?>">
											</label>
										</section>
										<section class="col col-4">
											<label class="label">Operating Hours Remark</label>
											<label class="input">
												<input type="text" name="txbsupplier_operate_remark" id="txbsupplier_operate_remark" maxlength="100" value="<?=$_supplier_operate_remark;?>">
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-3">
											<label class="label">Address</label>
											<label class="input">
												<textarea rows="3" name="txbsupplier_address" id="txbsupplier_address"><?=$_supplier_address?></textarea>
											</label>
										</section>
										<section class="col col-3">
											<label class="label">Google Map</label>
											<label class="input">
												<textarea rows="3" name="txbsupplier_googlemap" id="txbsupplier_googlemap"><?=$_supplier_googlemap?></textarea>
											</label>
										</section>
										<section class="col col-3">
											<label class="label">Tel</label>
											<label class="input"> <i class="icon-prepend fa fa-phone"></i>
												<input type="text" name="txbsupplier_tel" id="txbsupplier_tel" maxlength="100" value="<?=$_supplier_tel;?>">
											</label>
										</section>
										<section class="col col-3">
											<label class="label">Website</label>
											<label class="input"> <i class="icon-append fa fa-globe"></i>
												<input type="url" name="txbsupplier_website" id="txbsupplier_website" maxlength="100" value="<?=$_supplier_website;?>">
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-3">
											<label class="label">File Logo</label>
											<div class="input input-file">
												<input type="file" id="txbsupplier_logo_file" name="txbsupplier_logo_file" onchange="this.parentNode.nextSibling.value = this.value; showFile(this.id);">											
												<a href="<?=$path_folder_Supplier.$_supplier_logo_file?>" id="show_txbsupplier_logo_file" target="_blank" style="display: <?php 
													if ($_supplier_logo_file=="")	{
														echo "none"; 
													}else{ 
														echo "block";
													}?>"><?=$_supplier_logo_file?></a>
												<input type="hidden" id="Text_supplier_logo_file" name="Text_supplier_logo_file" value="<?=$_supplier_logo_file?>"/> 
											</div>
										</section>
										<section class="col col-3">
											<label class="label">Last Contract File</label>
											<div class="input input-file">
												<input type="file" id="txbsupplier_contract_file" name="txbsupplier_contract_file" onchange="this.parentNode.nextSibling.value = this.value; showFile(this.id);">											
												<a href="<?=$path_folder_Supplier.$_supplier_contract_file?>" id="show_txbsupplier_contract_file" target="_blank" style="display: <?php 
													if ($_supplier_brochure_file=="")	{
														echo "none";
													}else{
														echo "block";
													}?>"><?=$_supplier_contract_file?></a>
												<input type="hidden" id="Text_supplier_contract_file" name="Text_supplier_contract_file" value="<?=$_supplier_contract_file?>"/> 
											</div>
										</section>
										<section class="col col-3">
											<label class="label">Brochure (PDF)</label>
											<div class="input input-file">
												<input type="file" id="txbsupplier_brochure_file" name="txbsupplier_brochure_file" onchange="this.parentNode.nextSibling.value = this.value; showFile(this.id);">											
												<a href="<?=$path_folder_Supplier.$_supplier_brochure_file?>" id="show_txbsupplier_brochure_file" target="_blank" style="display: <?php 
													if ($_supplier_brochure_file=="")	{
														echo "none"; 
													}else{ 
														echo "block";
													}?>"><?=$_supplier_brochure_file?></a>
												<input type="hidden" id="Text_supplier_brochure_file" name="Text_supplier_brochure_file" value="<?=$_supplier_brochure_file?>"/> 
											</div>
										</section>
										<section class="col col-3">
											<label class="label">Other File (PDF)</label>
											<div class="input input-file">
												<input type="file" id="txbsupplier_other_file" name="txbsupplier_other_file" onchange="this.parentNode.nextSibling.value = this.value; showFile(this.id);">											
												<a href="<?=$path_folder_Supplier.$_supplier_other_file?>" id="show_txbsupplier_other_file" target="_blank" style="display: <?php 
													if ($_supplier_brochure_file=="")	{
														echo "none"; 
													}else{ 
														echo "block";
													}?>"><?=$_supplier_other_file?></a>
												<input type="hidden" id="Text_supplier_other_file" name="Text_supplier_other_file" value="<?=$_supplier_other_file?>"/> 
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col col-3">
											<label class="label"><u><b>Image File</b></u></label>
											<div class="input input-file">
												<input type="file" id="txbsupplier_image1_file" name="txbsupplier_image1_file" onchange="this.parentNode.nextSibling.value = this.value; showFile(this.id);">											
												<a href="<?=$path_folder_Supplier_Image.$_supplier_image1_file?>" id="show_txbsupplier_image1_file" target="_blank" style="display: <?php 
													if ($_supplier_brochure_file=="")	{
														echo "none"; 
													}else{ 
														echo "block";
													}?>"><?=$_supplier_image1_file?></a>
												<input type="hidden" id="Text_supplier_image1_file" name="Text_supplier_image1_file" value="<?=$_supplier_image1_file?>"/> 
											</div>
										</section>
										<section class="col col-3">
											<label class="label">&nbsp;</label>
											<div class="input input-file">
												<input type="file" id="txbsupplier_image2_file" name="txbsupplier_image2_file" onchange="this.parentNode.nextSibling.value = this.value; showFile(this.id);">											
												<a href="<?=$path_folder_Supplier_Image.$_supplier_image2_file?>" id="show_txbsupplier_image2_file" target="_blank" style="display: <?php 
													if ($_supplier_brochure_file=="")	{
														echo "none"; 
													}else{ 
														echo "block";
													}?>"><?=$_supplier_image2_file?></a>
												<input type="hidden" id="Text_supplier_image2_file" name="Text_supplier_image2_file" value="<?=$_supplier_image2_file?>"/> 
											</div>
										</section>
										<section class="col col-3">
											<label class="label">&nbsp;</label>
											<div class="input input-file">
												<input type="file" id="txbsupplier_image3_file" name="txbsupplier_image3_file" onchange="this.parentNode.nextSibling.value = this.value; showFile(this.id);">											
												<a href="<?=$path_folder_Supplier_Image.$_supplier_image3_file?>" id="show_txbsupplier_image3_file" target="_blank" style="display: <?php 
													if ($_supplier_brochure_file=="")	{
														echo "none"; 
													}else{ 
														echo "block";
													}?>"><?=$_supplier_image3_file?></a>
												<input type="hidden" id="Text_supplier_image3_file" name="Text_supplier_image3_file" value="<?=$_supplier_image3_file?>"/> 
											</div>
										</section>
										<section class="col col-3">
											<label class="label">&nbsp;</label>
											<div class="input input-file">
												<input type="file" id="txbsupplier_image4_file" name="txbsupplier_image4_file" onchange="this.parentNode.nextSibling.value = this.value; showFile(this.id);">											
												<a href="<?=$path_folder_Supplier_Image.$_supplier_image4_file?>" id="show_txbsupplier_image4_file" target="_blank" style="display: <?php 
													if ($_supplier_brochure_file=="")	{
														echo "none"; 
													}else{ 
														echo "block";
													}?>"><?=$_supplier_image4_file?></a>
												<input type="hidden" id="Text_supplier_image4_file" name="Text_supplier_image4_file" value="<?=$_supplier_image4_file?>"/> 
											</div>
										</section>
									</div>
									<div class="row">
										<section class="col col-6">
											<label class="label"><font color="gray"><i>Note (Not show)</i></font></label>
											<label class="input">
												<textarea rows="3" name="txbsupplier_remark" id="txbsupplier_remark"><?=$_supplier_remark?></textarea>
											</label>
										</section>
									</div>
								</fieldset>
								<fieldset>
									<section>
									<header>
										<b>Sales Contact</b>
									</header>
									</section>
									<section class="col col-3">
										<label class="label">Contact Person</label>
										<label class="input"><i class="icon-append fa fa-user"></i>
											<input type="text" name="txbsupplier_sales_name" id="txbsupplier_sales_name" maxlength="100" value="<?=$_supplier_sales_name;?>">
										</label>
									</section>									
									<section class="col col-3">
										<label class="label">Email</label>
										<label class="input"> <i class="icon-prepend fa fa-envelope-o"></i>
											<input type="email" name="txbsupplier_sales_email" id="txbsupplier_sales_email" maxlength="100" value="<?=$_supplier_sales_email;?>">
										</label>
									</section>
									<section class="col col-3">
										<label class="label">Tel</label>
										<label class="input"> <i class="icon-prepend fa fa-phone"></i>
											<input type="Tel" name="txbsupplier_sales_tel" id="txbsupplier_sales_tel" maxlength="100" value="<?=$_supplier_sales_tel;?>">
										</label>
									</section>
									<section class="col col-3">
										<label class="label">Line or WhatApp</label>
										<label class="input">
											<input type="text" name="txbsupplier_sales_line" id="txbsupplier_sales_line" maxlength="100" value="<?=$_supplier_sales_line;?>">
										</label>
									</section>
								</fieldset>
								<fieldset>
									<section>
									<header>
										<b>Reservation Contact</b>
									</header>
									</section>
									<section class="col col-3">
										<label class="label">Contact Person</label>
										<label class="input"><i class="icon-append fa fa-user"></i>
											<input type="text" name="txbsupplier_reserv_name" id="txbsupplier_reserv_name" maxlength="100" value="<?=$_supplier_reserv_name;?>">
										</label>
									</section>									
									<section class="col col-3">
										<label class="label">Email</label>
										<label class="input"><i class="icon-prepend fa fa-envelope-o"></i>
											<input type="email" name="txbsupplier_reserv_email" id="txbsupplier_reserv_email" maxlength="100" value="<?=$_supplier_reserv_email;?>">
										</label>
									</section>
									<section class="col col-3">
										<label class="label">Tel</label>
										<label class="input"><i class="icon-prepend fa fa-phone"></i>
											<input type="Tel" name="txbsupplier_reserv_tel" id="txbsupplier_reserv_tel" maxlength="100" value="<?=$_supplier_reserv_tel;?>">
										</label>
									</section>
									<section class="col col-3">
										<label class="label">Fax</label>
										<label class="input">
											<input type="text" name="txbsupplier_reserv_fax" id="txbsupplier_reserv_fax" maxlength="100" value="<?=$_supplier_reserv_fax;?>">
										</label>
									</section>
									<section class="col col-3">
										<label class="label">Line or WhatApp</label>
										<label class="input">
											<input type="text" name="txbsupplier_reserv_line" id="txbsupplier_reserv_line" maxlength="100" value="<?=$_supplier_reserv_line;?>">
										</label>
									</section>
								</fieldset>
								<fieldset>
									<section>
									<header>
										<b>Accounting Contact</b>
									</header>
									</section>
									<section class="col col-3">
										<label class="label">Contact Person</label>
										<label class="input"><i class="icon-append fa fa-user"></i>
											<input type="text" name="txbsupplier_account_name" id="txbsupplier_account_name" maxlength="100" value="<?=$_supplier_account_name;?>">
										</label>
									</section>							
									<section class="col col-3">
										<label class="label">Email</label>
										<label class="input"><i class="icon-prepend fa fa-envelope-o"></i>
											<input type="email" name="txbsupplier_account_email" id="txbsupplier_account_email" maxlength="100" value="<?=$_supplier_account_email;?>">
										</label>
									</section>
									<section class="col col-3">
										<label class="label">Tel</label>
										<label class="input"><i class="icon-prepend fa fa-phone"></i>
											<input type="Tel" name="txbsupplier_account_tel" id="txbsupplier_account_tel" maxlength="100" value="<?=$_supplier_account_tel;?>">
										</label>
									</section>
									<section class="col col-3">
										<label class="label">Company Name</label>
										<label class="input"><i class="icon-append fa fa-briefcase"></i>
											<input type="text" name="txbsupplier_name_acc" id="txbsupplier_name_acc" maxlength="100" value="<?=$_supplier_name_acc;?>">
										</label>
									</section>
								</fieldset>
								<footer>
									<section class="col col-10"  style="padding-left: 0px;">
										<input type="radio" name="chksupplier_status" id="chksupplier_status_A" value="A" checked >
										<i></i><span style="background-color: Green; color: #ffffff">Active</span>
										<input type="radio" name="chksupplier_status" id="chksupplier_status_I" value="I" <?php if ($_supplier_status=="I")    { echo " checked "; }?>>
										<i></i><span style="background-color: red; color: #ffffff">Inactive</span>
										<input type="radio" name="chksupplier_status" id="chksupplier_status_C" value="C" <?php if ($_supplier_status=="C")    { echo " checked "; }?>>
										<i></i><span style="background-color: Orange; color: #ffffff">Cancel</span>
									</section>
									<section class="col col-2">
										<button type="submit" class="btn btn-primary" name="submitAddBooking" id="submitAddBooking">Save</button>
										<input type="hidden" name="supplier_id" id="supplier_id" value="<?=$_supplier_id;?>"/>
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
var $contactForm = $("#detail-form").validate(	{
	errorClass		: errorClass,
	errorElement	: errorElement,
	highlight: function(element) {
        $(element).parent().removeClass('state-success').addClass('state-error');
        if($(element).parent().hasClass( "required" ))	{
        	 $(element).parent().css("border-left", "7px solid #FF3333");
        }
		$(element).removeClass('valid');
	},
	unhighlight: function(element) {
	$(element).parent().removeClass('state-error').addClass('state-success');
	if($(element).parent().hasClass( "required" ))	{
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
	txbsupplier_name : {
		required : true,
	},
	lsbdest_id : {
		required : true,
	},
	lsbsupplier_type : {
		required : true,
	}
},
// Messages for form validation
messages : {
	txbsupplier_name : {
		required : 'Please fill Supplier Name',
	},
	lsbdest_id : {
		required : 'Please select Destination',
	},
	lsbsupplier_type : {
		required : 'Please select Supplier Type',
	}
},

// Do not change code below
errorPlacement : function(error, element) {
	error.insertAfter(element.parent());
}
});

</script>
<?php
	//include footer
	include ("inc/google-analytics.php");
?>