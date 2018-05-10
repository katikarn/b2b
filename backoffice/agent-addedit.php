<?php
	session_start();
	include('inc/auth.php');
	include("inc/connectionToMysql.php");
	include("bookingList-info-controller.php");
	/////////////////////////////////////////////////////////
	//initilize the page
	require_once ("inc/init.php");

	//require UI configuration (nav, ribbon, etc.)
	require_once ("inc/config.ui.php");

	/*---------------- PHP Custom Scripts ---------

		YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */

	$page_title = "Booking Information";

	/* ---------------- END PHP Custom Scripts ------------- */

	//include header
	//you can add your custom css in $page_css array.
	//Note: all css files are inside css/ folder
	$page_css[] = "your_style.css";
	include ("inc/header.php");

	//include left panel (navigation)
	//follow the tree in inc/config.ui.php
	$page_nav["Booking"]["sub"]["Booking List"]["active"] = true;
	include ("inc/nav.php");

	//Get data from database

	if( isset($_GET['id']) )	{
		$sql = "SELECT booking_id, booking_status, agent_id, booking_name, booking_pax, booking_nat, 
		booking_tel, booking_line, booking_remark, createdatetime, createby, updatedatetime, updateby
		FROM booking
		WHERE booking_id = '".$_GET['id']."'";
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
					Booking Information
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
				<a class="btn btn-default" style="margin-right: 10px;" href="bookingList-Itinerary.php?id=<?=$row['booking_id']?>">
					<i style="margin-right: 5px;" class="icon-append fa fa-file-o"></i>Itinerary</a>
				<a class="btn btn-default" style="margin-right: 10px;" href="bookingList-PickupCard.php?id=<?=$row['booking_id']?>">
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
								echo $_booking_id."</b>";
								echo " (Last update : ".$_updateby." ".$_updatedatetime.")";
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
								<form action="bookingList-info-controller-main.php" method="post" id="contact-form" class="smart-form">
									<!-- <header>Contacts form</header> -->
									<fieldset>
										<section>
											<label class="label">Agent</label>
											<label class="input required">
												<select name="lsbagent_id" id="lsbagent_id">
													<option value="" selected></option>
													<?php
													$sql = "SELECT `agent_id`, `agent_name` FROM `agent` ORDER BY `agent_name` ";
													$result = mysqli_query($conn ,$sql);
													if(mysqli_num_rows($result) > 0)	{
														//show data for each row
														while($row = mysqli_fetch_assoc($result))	{
															echo "<option value='".$row['agent_id']."'";
															if ($row['agent_id']==$_agent_id)	{
																echo " selected ";
															}
															echo ">".$row['agent_name']."</option>";
														}
													}?>
												</select>
											</label>
										</section>
										<div class="row">
											<section class="col col-8">
												<label class="label">Booking Name</label>
												<label class="input required">
													<i class="icon-append fa fa-user"></i>
													<input type="text" name="txbbooking_name" id="txbbooking_name" maxlength="100" value="<?=$_booking_name;?>">
												</label>
											</section>
											<section class="col col-4">
												<label class="label">Pax</label>
												<label class="input required">
													<i class="icon-append fa  fa-group"></i>
													<input type="number" step="1" name="txbbooking_pax" id="txbbooking_pax" value="<?=$_booking_pax;?>">
												</label>
											</section>
										</div>
										<div class="row">
										<section class="col col-4">
											<label class="label">Nationality</label>
											<label class="input">
												<i class="icon-append fa fa-flag-checkered"></i>
												<input type="text" name="txbbooking_nat" id="txbbooking_nat" maxlength="50" value="<?=$_booking_nat;?>">
											</label>
										</section>
										<section class="col col-4">
											<label class="label">Tel</label>
											<label class="input">
												<i class="icon-append fa fa-phone"></i>
												<input type="text" name="txbbooking_tel" id="txbbooking_tel" maxlength="50" value="<?=$_booking_tel;?>">
											</label>
										</section>
										<section class="col col-4">
											<label class="label">Whatapp or Line</label>
											<label class="input">
												<i class="icon-append fa fa-wechat"></i>
												<input type="text" name="txbbooking_line" id="txbbooking_line" maxlength="50" value="<?=$_booking_line;?>">
											</label>
											</section>
										</div>
										<section>
											<label class="label">Note (Special Request)</label>
											<label class="textarea">
												<i class="icon-append fa fa-comment"></i>
												<textarea rows="2" name="txbbooking_remark" id="txbbooking_remark" maxlength="500"><?=$_booking_remark;?></textarea>
											</label>
										</section>
									</fieldset>
									<footer>
										<section class="col col-8">
											<label>Status</label>
											<input type="radio" name="chkbooking_status" id="chkbooking_status_D" value="D" checked>
                                           	<i></i>Draft</label>
                                            <input type="radio" name="chkbooking_status" id="chkbooking_status_N" value="N" <?php if ($_booking_status=="N")    { echo " checked "; }?>>
                                            <i></i>New</label>
                                            <input type="radio" name="chkbooking_status" id="chkbooking_status_C" value="C" <?php if ($_booking_status=="C")    { echo " checked "; }?>>
                                            <i></i>Confirm</label>
                                            <input type="radio" name="chkbooking_status" id="chkbooking_status_P" value="P" <?php if ($_booking_status=="P")    { echo " checked "; }?>>
                                            <i></i>Paid</label>
										</section>
										<section class="col col-4">
											<button type="submit" class="btn btn-primary" name="submitAddBooking" id="submitAddBooking">Save</button>
											<input type="hidden" name="id" id="id" value="<?=$_booking_id;?>" />
										</section>
									</footer>
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
<?php if (isset($_GET['id'])){	?>
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
							<h2>Booking Detail</h2>
						</header>
						<!-- widget div-->
						<div>
							<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
								<div>
									<!-- widget content -->
									<div class="widget-body no-padding">
						        		<table id="dt_basic" class="table table-striped table-bordered table-hover" style="margin-top:0px" width="100%">
											<thead>
												<tr class="header">
													<th>No</th>
													<th>Service DateTime</th>
													<th>Product Name</th>
													<th>Price x Pax</th>
													<th>Amount</th>
													<th>Status</th>
													<th>
														<div style="text-align: center">
															<button class="btn btn-primary bg-color-green"  data-whatever="" data-toggle="modal" data-target="#myModal" >
															<i style="margin-right: 10px;" class="icon-append fa fa-plus"></i>Add new</button>
														</div>
													</th>
												</tr>
											</thead>
											<tbody>
												<?PHP
												$sql = "SELECT 	booking_detail_id, booking_detail_status, booking_detail_date,
												booking_detail_time, booking_detail_price, booking_detail_vat, booking_detail_qty,
												booking_detail_total_amount, booking_detail_reject_reason, booking_detail_confirm,
												product_name, product_desc, product_seat, product_for, product_showtime, product_duration,
												product_car_type, product_meal_type,
												supplier_name
												FROM booking_detail, product, supplier
												WHERE booking_detail.product_id = product.product_id
												    and product.supplier_id = supplier.supplier_id
													and booking_detail.booking_id = '$_booking_id'
												ORDER BY booking_detail_date, booking_detail_time";
												$result = mysqli_query($conn ,$sql);

												if(mysqli_num_rows($result) > 0){
												//show data for each row
													$numRow=0;
													while($row = mysqli_fetch_assoc($result)){
														$numRow++;
														if($row['product_for'] == 'A'){
															$product_for = 'Adult';
														}else if($row['product_for'] == 'I'){
															$product_for = 'Chident';
														}else if($row['product_for'] == 'C'){
															$product_for = 'Senier';
														}else{
															$product_for = 'All';
														}
														$product_sum = $row['product_name']." ".$row['product_showtime']." ".$product_for." <br>(".$row['supplier_name'].")";
														$pricepax = number_format(($row['booking_detail_price']+$row['booking_detail_vat']),2)." x ".number_format($row['booking_detail_qty'],0);
														$booking_detail_total_amount = ($row['booking_detail_price']+$row['booking_detail_vat'])*$row['booking_detail_qty'];

														if($row['booking_detail_status'] == 'N'){
															$statusUser = '<font color="green">New</font>';
														}else if($row['booking_detail_status'] == 'R'){
															$statusUser = '<font color="red">Reject</font> <i class="fa fa-info-circle" title="'.$row['booking_detail_reject_reason'].'"></i>';
														}else if($row['booking_detail_status'] == 'C'){
															if ($row['booking_detail_confirm']<>"")	{
																$conf=$row['booking_detail_confirm'];
															}else{
																$conf="-";
															}
															$statusUser = '<font color="blue">Confirm</font><br><b>'.$conf.'</b>';
														}else{
															$statusUser = '';
														}
												?>
												<tr>
													<td><?=$numRow;?>.</td>
													<td><?=date("d/m/Y", strtotime($row['booking_detail_date']))." ".date("H:i", strtotime($row['booking_detail_time']))?></td>
													<td><?=$product_sum?></td>
													<td><?=$pricepax?></td>
													<td><?=number_format($booking_detail_total_amount,2)?></td>
													<td><?=$statusUser?></td>
													<td class="center"><a onclick="resetModal();" class="btn btn-small btn-primary bg-color-green"
															data-toggle="modal"
															data-target="#myModal"
															data-whatever="<?=$row['booking_detail_id']?>">Edit</a>
															<a href="bookingList-info.php?booking_detail_id=<?=$row['booking_detail_id']?>&hAction=Delete&booking_id=<?=$_booking_id?>" class="btn btn-small btn-danger">Del</a>
													</td>
												</tr>
												<?PHP }}?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- end widget content -->
						</div>
					</div>
					<!-- end widget -->
				</article>
				<!-- END COL -->
			</div>
			<!-- END ROW -->
		</section>
		<!-- end widget grid -->
<?php }?>
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							<i class="icon-append fa fa-times"></i>
						</button>
						<h4 class="header">
							Product Detail
							<!-- <img src="<?php echo ASSETS_URL; ?>/img/logo.png" width="150" alt="SmartAdmin"> -->
						</h4>
					</div>
					<div class="modal-body no-padding"> <!--Product detail-->
						<form action='bookingList-info.php' method='get' id="detail-form" class="smart-form">
							<fieldset>
								<section>
									<div class="row">
										<label class="label col col-2">Supplier</label>
										<div class="col col-10">
											<label class="input required">
												<select name="lsbsupplier_id" id="lsbsupplier_id" onchange="showProduct_default(this.value)">
													<?php
													$sql = "SELECT supplier_id, supplier_name, supplier_destination 
															FROM supplier ORDER BY supplier_destination,supplier_name";
													$result = mysqli_query($conn ,$sql);
													while($row = mysqli_fetch_assoc($result))	{ ?>
														<option value="<?php echo $row['supplier_id']; ?>"> 
															<?php echo $row['supplier_destination']." : ".$row['supplier_name']; ?>
														</option>
													<?php } ?>
												</select>
											</label>
										</div>
									</div>
								</section>
								<section>
									<div class="row">
										<label class="label col col-2">Product</label>
											<div class="col col-10">
												<label class="input required">
													<div id="txtHint" >
														<select name="lsbproduct_id" id="lsbproduct_id">
														<?php
														//if ($_supplier_id<>"")	{
                                                    		$sql = "SELECT product_id, product_name, product_for, product_desc,
																	product_showtime, product_car_type, product_meal_type, 
																	product_normal_price, product_oversea_price, product_price_l1, 
																	product_price_l2, supplier_type
																	FROM product, supplier
																	WHERE product.supplier_id=supplier.supplier_id
																	AND supplier.supplier_id='".$row['supplier_id']."'
																	ORDER BY supplier.supplier_id, product.product_name";
															$result = mysqli_query($conn ,$sql);
															if(mysqli_num_rows($result) > 0)	{
																while($row = mysqli_fetch_assoc($result))	{
																	echo "<option value='".$row['product_id']."'";
																	echo " ><strong>".$row['product_name']."</strong>  (";
																	if ($row['supplier_type']=='A')	{
																		echo "Time: ".date("H:i", strtotime($row['product_showtime']))." ";																		
																		echo "Type: ".$row['product_for']." ";
																	}else if ($row['supplier_type']=='S')	{
																		echo "Time: ".date("H:i", strtotime($row['product_showtime']))." ";																		
																		echo "Type: ".$row['product_for']." ";
																	}else if ($row['supplier_type']=='D')	{
																		echo "Time: ".$row['product_desc']." ";																		
																		echo "Type: ".$row['product_for']." ";
																	}else if ($row['supplier_type']=='T')	{
																		echo "Time: ".$row['product_desc']." ";																		
																		echo "Type: ";
																		if ($row['product_car_type']=="C")	{
																			echo "Car";
																		}else if ($row['product_car_type']=="V")	{
																			echo "Van";
																		}else if ($row['product_car_type']=="B")	{
																			echo "Bus";
																		}
																	}else if ($row['supplier_type']=='M')	{
																		echo "Type: ";
																		if ($row['product_meal_type']=="1")	{
																			echo "Buffet:Veg+Non-Veg";
																		}else if ($row['product_meal_type']=="2")	{
																			echo "Buffet:Non-Veg";
																		}else if ($row['product_meal_type']=="3")	{
																			echo "Buffet:Veg";
																		}else if ($row['product_meal_type']=="4")	{
																			echo "Lunch Box:Non-Veg";
																		}
																	}
																	echo") </option>";
																}
															}
														//}
														?>
															<option value="" selected></option>
														</select>
													</div>
												</label>
										</div>
									</div>
								</section>
								<section>
									<div class="row">
										<label class="label col col-2" type="number">QTY</label>
										<div class="col col-10">
											<label class="input required">

												<?php
											/*	$sql = "SELECT * FROM booking a
																INNER JOIN booking_detail b
																ON a.booking_id = b.booking_id
																WHERE b.booking_id = $_GET[id]";
												$result = mysqli_query($conn ,$sql);
												if(mysqli_num_rows($result) > 0)	{
													//show data for each row
													while($row = mysqli_fetch_assoc($result))	{
													echo	$row['booking_detail_qty'];
													}
												}*/
												?>
												<input type="number" step="1" name="txbbooking_detail_qty" id="txbbooking_detail_qty" value="">
											</label>
										</div>
									</div>
								</section>
								<section>
									<div class="row">
										<label class="label col col-2">Unit Price</label>
										<div class="col col-3">
											<label class="input required">
												<input type="number" step="0.25" name="txbbooking_detail_price" id="txbbooking_detail_price">
											</label>
										</div>
										<label class="label col col-1">VAT</label>
										<div class="col col-2">
											<label class="input required">
												<!--<input type="number" step="0.25" name="txbbooking_detail_vat" id="txbbooking_detail_vat" value="10">-->
												<input type="number" step="0.25" name="txbbooking_detail_vat" id="txbbooking_detail_vat" value="7"  >

											</label>
										</div>
										<label class="label col col-1">Total</label>
										<div class="col col-3">
											<label class="input required">
												<input type="number" step="0.25" name="txbbooking_detail_total_amount" id="txbbooking_detail_total_amount">
											</label>
										</div>
									</div>
								</section>
								<section>
									<div class="row">
										<label class="label col col-2" type="number">Date</label>
										<div class="col col-5">
											<label class="input required">
												<input type="date" name="txbbooking_detail_date" id="txbbooking_detail_date">
											</label>
										</div>
										<label class="label col col-1" type="number">Time</label>
										<div class="col col-4">
											<label class="input">
												<input type="time" name="txbbooking_detail_time" id="txbbooking_detail_time">
											</label>
										</div>
									</div>
								</section>

								<section>
									<div class="row">
										<label class="label col col-2">Remark</label>
										<div class="col col-10">
											<label class="input">
												<textarea rows="3" name="txbbooking_detail_note" id="txbbooking_detail_note"></textarea>
											</label>
										</div>
									</div>
								</section>

								<section>
									<div class="row">
										<label class="label col col-2">Status</label>
										<div class="col col-10">
											<label class="input">
												<div class="inline-group">
													<label class="radio">
														<input type="radio" name="chkbooking_detail_status" id="chkbooking_detail_status_N" value="N" checked=""><i></i>New
													</label>
													<label class="radio">
														<input type="radio" name="chkbooking_detail_status" id="chkbooking_detail_status_C" value="C"><i></i>Confirm
													</label>
												</div>
											</label>
										</div>
									</div>
								</section>
							</fieldset>
							<footer class="center">
								<input type="hidden" name="booking_id" id="booking_id" value="<?=$_booking_id?>">
								<input type="hidden" name="booking_detail_id" id="booking_detail_id">
								<input type="hidden" name="hAction" id="hAction">
								<button type="submit" name="submitBookingDetail" class="btn btn-primary" id="submitBookingDetail" style="float: unset;font-weight: 400;">Save</button>
								<button type="button" class="btn btn-default" data-dismiss="modal" style="float: unset;font-weight: 400;">Cancel</button>
							</footer>
						</form>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
	</div>
	<!-- END MAIN CONTENT -->
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

	// DO NOT REMOVE : GLOBAL FUNCTIONS!
	var otable;
	$(document).ready(function() {

		/* BASIC ;*/
		var responsiveHelper_dt_basic = undefined;

		var breakpointDefinition = {
			tablet : 1024,
			phone : 480
		};

		$('#dt_basic').dataTable({
			"sDom":
			"t"+
			"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_dt_basic) {
					responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_dt_basic.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_dt_basic.respond();
			}
		});
		/* Custom Search box*/
		var table_dtbasic = $('#dt_basic').DataTable();
		otable = $('#dt_basic').dataTable();

		$( "#column3_search" ).keyup(function() {
			//alert( "Handler for .keyup() called." );
			table_dtbasic.search( this.value ).draw();
		});

		$( "#date_search" ).keyup(function() {
			//alert( "Handler for .keyup() called." );
			table_dtbasic.columns( 2 ).search( this.value ).draw();
		});
		$('#myModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipient = button.data('whatever') // Extract info from data-* attributes
			var modal = $(this);
			var dataString = 'booking_detail_id=' + recipient;

			//console.log('dataString :'+dataString);
            $.ajax({

                url: "fetchEdit.php",
				type:"POST",
                data: dataString,
				dataType : 'json',

                success: function (data) {
					if(data != null){
						$('#lsbsupplier_id').val(data.supplier_id);
						$('#lsbproduct_id').val(data.product_id);
						$('#txbbooking_detail_qty').val(data.booking_detail_qty);
						$('#txbbooking_detail_price').val(data.booking_detail_price);
						$('#txbbooking_detail_vat').val(data.booking_detail_vat);
						//$('#txbbooking_detail_total_amount').val(data.booking_detail_total_amount);
						//$('#cal1').val(data.booking_detail_price);
						$('#txbbooking_detail_total_amount').val(data.booking_detail_total_amount);
						$('#txbbooking_detail_date').val(data.booking_detail_date);
						$('#txbbooking_detail_time').val(data.booking_detail_time);
						$('#txbbooking_detail_note').val(data.booking_detail_note);
						$('#booking_detail_id').val(data.booking_detail_id);
						$('#hAction').val("Update");
						//$('#chkbooking_detail_status_' + data.booking_detail_status).proop('checked',true);
						showProduct(data.supplier_id,data.product_id);
					}else{
						$('#lsbsupplier_id').val('');
						$('#lsbproduct_id').val('');
						$('#txbbooking_detail_qty').val('');
						$('#txbbooking_detail_price').val('');
						$('#txbbooking_detail_vat').val('');
						$('#txbbooking_detail_total_amount').val('');
						$('#txbbooking_detail_date').val('');
						$('#txbbooking_detail_time').val('');
						$('#txbbooking_detail_note').val('');
						$('#booking_detail_id').val('');
						$('#hAction').val("Insert");
						//$('#chkbooking_detail_status_C').proop('checked',true);
					}
				},
                error: function(err) {
                    console.log('err : '+err);

				}
			});
		});
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
			lsbsupplier_id : {
				required : true,
			},
			lsbproduct_id : {
				required : true,
			},
			txbbooking_detail_qty : {
				required : true,
			},
			txbbooking_detail_price : {
				required : true,
			},
			txbbooking_detail_vat : {
				required : true,
			},
			txbbooking_detail_total_amount : {
				required : true,
			},
			txbbooking_detail_date : {
				required : true,
			}
		},
		// Messages for form validation
		messages : {
			lsbsupplier_id : {
				required : 'Please select supplier',
			},
			lsbproduct_id : {
				required : 'Please select product',
			},
			txbbooking_detail_qty : {
				required : 'Please fill QTY',
			},
			txbbooking_detail_price : {
				required : 'Please fill price',
			},
			txbbooking_detail_vat : {
				required : 'Please fill VAT',
			},
			txbbooking_detail_total_amount : {
				required : 'Please fill total amount',
			},
			txbbooking_detail_date : {
				required : 'Please fill date',
			}
		},

		// Do not change code below
		errorPlacement : function(error, element) {
			error.insertAfter(element.parent());
		}
	});

})

function showProduct(str,str2) { // 1. สร้างตัวแปรชื่อ str จาก Select box แรก
    if (str == "") { // 2. ตรวจสอบว่ตัวแปร str ว่ามีการเลือกค่ามาแล้วหรือไม่ ถ้าเลือกแล้วมันจะเก็บค่า "value" ของ Select ที่เลือกมา
        document.getElementById("txtHint").innerHTML = ""; // =====> ไม่มีการเลือก
        return;
    } else {  // ======> มีการเลือกค่า
        if (window.XMLHttpRequest) { //3. ระบบใน php นี้มันจะตรวจสอบว่าโปรเจคนี้มีคลาสนี้หรือยัง XMLHttpRequest
            xmlhttp = new XMLHttpRequest(); // ====> ถ้ามีมันจะกำนดค่าคลาสให้สร้างคลาสใหม่เพื่อที่จะทำการขอส่งข้อมูลผ่าน http หรือส่งข้อมูลออกไป
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() { // 3.1 เมื่อมีคลาสแล้วมันจะพร้อมทำการส่งข้อมูล
            if (this.readyState == 4 && this.status == 200) { // 3.2 ตรวจสอบสถานะ 200 คือพร้อมใช้งาน 4=ส่งในรูปแบบที่4 (จำไม่ได้ว่าคืออะไร 5555)
                document.getElementById("txtHint").innerHTML = this.responseText; // 3.3 มันจะรับค่าจาก id txtHint  จาก DIV บรรทัดที่ 38
                                                                                      // เพื่อที่จะแสดงว่ามันทำงานอยู๋
            }
        };
        xmlhttp.open("GET","get_product.php?supplier_id="+str+"&product_id="+str2,true); //4. ส่งการทำงานไปในไฟล์ getuer.php ตามด้วยตัวแปร q บวกด้วยตัวแปร str ที่เก็บค่าจาก select box
        xmlhttp.send(); // 5. ส่งข้อมูลไปในไฟล์ getuser.php
    }
}

function showProduct_default(str) { // 1. สร้างตัวแปรชื่อ str จาก Select box แรก
    if (str == "") { // 2. ตรวจสอบว่ตัวแปร str ว่ามีการเลือกค่ามาแล้วหรือไม่ ถ้าเลือกแล้วมันจะเก็บค่า "value" ของ Select ที่เลือกมา
        document.getElementById("txtHint").innerHTML = ""; // =====> ไม่มีการเลือก
        return;
    } else {  // ======> มีการเลือกค่า
        if (window.XMLHttpRequest) { //3. ระบบใน php นี้มันจะตรวจสอบว่าโปรเจคนี้มีคลาสนี้หรือยัง XMLHttpRequest
            xmlhttp = new XMLHttpRequest(); // ====> ถ้ามีมันจะกำนดค่าคลาสให้สร้างคลาสใหม่เพื่อที่จะทำการขอส่งข้อมูลผ่าน http หรือส่งข้อมูลออกไป
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() { // 3.1 เมื่อมีคลาสแล้วมันจะพร้อมทำการส่งข้อมูล
            if (this.readyState == 4 && this.status == 200) { // 3.2 ตรวจสอบสถานะ 200 คือพร้อมใช้งาน 4=ส่งในรูปแบบที่4 (จำไม่ได้ว่าคืออะไร 5555)
                document.getElementById("txtHint").innerHTML = this.responseText; // 3.3 มันจะรับค่าจาก id txtHint  จาก DIV บรรทัดที่ 38
                                                                                      // เพื่อที่จะแสดงว่ามันทำงานอยู๋
            }
        };
        xmlhttp.open("GET","get_product.php?supplier_id="+str,true); //4. ส่งการทำงานไปในไฟล์ getuer.php ตามด้วยตัวแปร q บวกด้วยตัวแปร str ที่เก็บค่าจาก select box
        xmlhttp.send(); // 5. ส่งข้อมูลไปในไฟล์ getuser.php
    }
}
</script>

<?php
	//include footer
	include ("inc/google-analytics.php");
?>
