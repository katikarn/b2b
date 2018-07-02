<?php
	session_start();
	include("inc/auth.php");
	include("inc/constant.php");
	include("inc/connectionToMysql.php");

	if (isset($_GET['supplier_id']))	{
		
		$_supplier_id = $_GET['supplier_id'];
		$sql = "SELECT supplier_status, supplier_type, supplier_name, supplier_open, supplier_close, dest_name, mas_code, mas_value 
				FROM tb_supplier_tr, tb_dest_ms, tb_mas_ms, tb_masofmas_ms
				WHERE tb_supplier_tr.dest_id = tb_dest_ms.dest_id
                AND tb_supplier_tr.supplier_type = tb_mas_ms.mas_code
				AND tb_mas_ms.masofmas_id = tb_masofmas_ms.masofmas_id
				AND tb_masofmas_ms.masofmas_name = 'SUPPLIER_TYPE'
				AND tb_supplier_tr.supplier_id = '".$_supplier_id."'";

		$result = mysqli_query($conn ,$sql);
		mysqli_num_rows($result);
		$row = mysqli_fetch_assoc($result);
		
		$_supplier_status = $row['supplier_status'];
		$_supplier_type = $row['supplier_type'];
		$_supplier_name = $row['supplier_name'];
		$_supplier_open = date("H:i",strtotime($row['supplier_open']));
		$_supplier_close = date("H:i",strtotime($row['supplier_close']));
		$_dest_name = $row['dest_name'];
		$_mas_value = $row['mas_value'];
	}
	/////////////////////////////////////////////////////////
	//initilize the page
	require_once ("inc/init.php");

	//require UI configuration (nav, ribbon, etc.)
	require_once ("inc/config.ui.php");

	/*---------------- PHP Custom Scripts ---------

		YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */

	$page_title = "Porduct Information";

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

	if(isset($_GET['product_id']))	{
		$_product_id = $_GET['product_id'];
		$sql = "SELECT product_status, product_name, product_desc, product_seattype, 
						product_transporttype, product_duration, product_fixedtime
				FROM tb_product_tr
				WHERE product_id = '".$_product_id."'";
		$result = mysqli_query($conn ,$sql);
		mysqli_num_rows($result);
		$row = mysqli_fetch_assoc($result);

		if (mysqli_num_rows($result) > 0)	{
			$_product_status = $row['product_status'];
			$_product_name = $row['product_name'];
			$_product_desc = $row['product_desc'];
			$_product_seattype = $row['product_seattype'];
			$_product_transporttype = $row['product_transporttype'];
			$_product_duration = $row['product_duration'];
			$_product_fixedtime = $row['product_fixedtime'];
		}
	}else{
		$_product_id = '';
		$_product_status = '';
		$_product_name = '';
		$_product_desc = '';
		$_product_seattype = '';
		$_product_transporttype = '';
		$_product_duration = '';
		$_product_fixedtime = '';
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
					Product Information
				</h1>
			</div>
		</div>
		<section id="widget-grid">
			<div class="row">
				<article class="col-sm-12 col-md-12 col-lg-12">
					<div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-custombutton="false">
						<header>
							<span class="widget-icon"> <i class="fa fa-ticket"></i> </span>
							<h2><strong><?php 
									echo $_supplier_name;
							?></strong></h2>
						</header>
						<header>
							<span class="widget-icon"> <i class="fa fa-globe"></i> </span>
							<h2><?php
									echo $_dest_name;
								?></h2>
						</header>
						<header>
							<span class="widget-icon"> <i class="fa fa-institution"></i> </span>
							<h2><?php 
									echo $_mas_value;
								?></h2>
						</header>
					</div>
				</article>
			</div>
		</section>
		<section id="widget-grid">
			<div class="row">
				<article class="col-sm-12 col-md-12 col-lg-12">
					<div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false" data-widget-custombutton="false">
						<header>
							<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
							<h2><?php
								if ($_product_id<>"")	{
									echo "Product Code : <b>P".substr("00000000",1,4-strlen($_product_id));
									echo $_product_id."</b>";
									echo " <i>(Last update : ".$_update_by." ".$_update_datetime.")</i>";
								}else{
									echo "Product Information : << New Product >>";
								} ?></h2>
						</header>
						<div>
							<form action="product-a-addedit-controller.php" method="post" id="detail-form" name="detail-form" class="smart-form" enctype="multipart/form-data">
								<fieldset>
									<div class="row">
										<section class="col col-4">
											<label class="label">Product Name</label>
											<label class="input required">
												<input type="text" name="txbproduct_name" id="txbproduct_name" maxlength="100" value="<?=$_product_name;?>">
											</label>
										</section>
										<section class="col col-2">
											<label class="label">Duration (Hours)</label>
											<label class="input col-12"><i class="icon-append fa fa-clock-o"></i>
												<input type="text" name="txbproduct_duration" id="txbproduct_duration" maxlength="100" value="<?=$_product_duration;?>">
											</label>
										</section>
										<section class="col col-3">
											<label class="label">Seat Type</label>
											<label class="input">
												<div class="inline-group">
													<label class="radio">
														<input type="radio" name="chkproduct_seattype" value="N" id="chkproduct_seattype_N" checked>
														<i></i>No</label>
													<label class="radio">
														<input type="radio" name="chkproduct_seattype" value="Y" id="chkproduct_seattype_Y" <?php 
															if ($_product_seattype=="Y")	{ 
																echo " checked";
															}?>>
														<i></i>Fixed</label>
												</div>
											</label>
										</section>
										<section class="col col-3">
											<label class="label">Transport</label>
											<label class="input">
												<div class="inline-group">
													<label class="radio">
														<input type="radio" name="chkproduct_transporttype" value="N" id="chkproduct_seat_N" checked>
														<i></i>No</label>
													<label class="radio">
														<input type="radio" name="chkproduct_transporttype" value="J" id="chkproduct_seat_J" <?php 
															if ($_product_transporttype=="J")	{ 
																echo " checked";
															}?>>
														<i></i>Join</label>
													<label class="radio">
														<input type="radio" name="chkproduct_seat" value="P" id="chkproduct_seat_P"<?php 
															if ($_product_transporttype=="P")	{ 
																echo " checked";
															}?>>
														<i></i>Private</label>
												</div>
											</label>
										</section>
									</div>
									<div class="row">
										<section class="col col-6">
											<label class="label">Condition/Inclusive</label>
											<label class="input">
												<textarea rows="10" name="txbproduct_desc" id="txbproduct_desc"><?=$_product_desc?></textarea>
											</label>
										</section>
										<section class="col col-6">
											<label class="label"><u><b>Price</b></u></label>
												<div class="field" id="showPrice"><?php include("product-a-addedit-price.php");?></div>
										</section>
									</div>
									<div class="row">
										<section class="col col-6">
											<label class="label">Fixed Time <i><b>(Operating <?=$_supplier_open?> - <?=$_supplier_close?>)</b></i></label>
												<div class="inline-group">
													<label class="radio">
														<input type="radio" name="chkproduct_fixedtime" value="N" id="chkproduct_fixedtime_N" checked onclick="hide_plan()">
														<i></i>No</label>
													<label class="radio">
														<input type="radio" name="chkproduct_fixedtime" value="Y" id="chkproduct_fixedtime_Y" <?php if ($_product_fixedtime == "Y")	{ echo "checked"; }?> onclick="show_plan()">
														<i></i>Yes</label>
												</div><br>
											<div id="schedule_plan" style="display: <?php if ($_product_fixedtime == "Y")	{ echo ""; }else{ echo "none"; }?>">
												<label class="label"><u><b>Schedule Plan</b></u></label>
												<div class="field" id="showPlan">
													<?php include("product-a-addedit-plan.php");?>
												</div>
											</div>
										</section>
									</div>
								</fieldset>
								<footer>
									<section class="col col-10"  style="padding-left: 0px;">
										<input type="radio" name="chkproduct_status" id="chkproduct_status_A" value="A" checked >
										<i></i><span style="background-color: Green; color: #ffffff">Active</span>
										<input type="radio" name="chkproduct_status" id="chkproduct_status_I" value="I" <?php if ($_product_status=="I")    { echo " checked "; }?>>
										<i></i><span style="background-color: red; color: #ffffff">Inactive</span>
										<input type="radio" name="chkproduct_status" id="chkproduct_status_C" value="C" <?php if ($_product_status=="C")    { echo " checked "; }?>>
										<i></i><span style="background-color: Orange; color: #ffffff">Cancel</span>
									</section>
									<section class="col col-2">
										<button type="submit" class="btn btn-primary" name="submitAddBooking" id="submitAddBooking">Save</button>
										<input type="hidden" name="supplier_id" id="supplier_id" value="<?=$_supplier_id;?>"/>
										<input type="hidden" name="product_id" id="product_id" value="<?=$_product_id;?>"/>
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
	txbproduct_name : {
		required : true,
	}
},
// Messages for form validation
messages : {
	txbproduct_name : {
		required : 'Please fill Product Name',
	}
},

// Do not change code below
errorPlacement : function(error, element) {
	error.insertAfter(element.parent());
}
});

function show_plan() {
    var x = document.getElementById("schedule_plan");
	x.style.display = "block";
}

function hide_plan() {
    var x = document.getElementById("schedule_plan");
	x.style.display = "none";
}

</script>
<?php
	//include footer
	include ("inc/google-analytics.php");
?>