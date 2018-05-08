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
	
	$id = $_GET['id'];
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
	$page_nav["My Booking"]["sub"]["Booking History"]["active"] = true;
	include ("inc/nav.php");

	if($id<>"")	{
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
											<section class="col col-8">
												<label class="label">Booking Name</label>
												<label class="input required"><b><?=$_booking_name;?></b></label>
											</section>										
											<section class="col col-4">
												<label class="label">Pax</label>
												<label class="input required"><b><?=$_booking_pax;?></b></label>
											</section>
										</div>
										<div class="row">
										<section class="col col-4">
											<label class="label">Nationality</label>
											<label class="input"><b><?php if ($_booking_nat=="")	{ echo "-";}else{ echo $_booking_nat;}?></b></label>
										</section>
										<section class="col col-4">
											<label class="label">Tel</label>
											<label class="input"><b><?php if ($_booking_tel=="")	{ echo "-";}else{ echo $_booking_tel;}?></b></label>
										</section>
										<section class="col col-4">
											<label class="label">Whatapp or Line</label>
											<label class="input"><b><?php if ($_booking_line=="")	{ echo "-";}else{ echo $_booking_line;}?></b></label>
											</section>
										</div>
										<section>
											<label class="label">Note (Special Request)</label>
											<label class="textarea"><b><?php if ($_booking_remark=="")	{ echo "-";}else{ echo $_booking_remark;}?></b></label>
										</section>
									</fieldset>
									<footer>
										<section class="col col-10">
											<label><?php 
											if ($row['booking_status']=="D")	{
												echo "Status : <span class='label bg-color-blueLight txt-color-white text-align-center'>Draft</span>";
											}else if ($row['booking_status']=="N")	{
												echo "Status : <span class='label bg-color-blue txt-color-white text-align-center'>Submited</span>";
											}else if ($row['booking_status']=="C")	{
												echo "Status : <span class='label bg-color-greenLight txt-color-white text-align-center'>Confirm</span>";
											}?></label>
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
<?php if ($id<>""){	?>
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
													<th data-hide="phone">No</th>
													<th data-hide="phone">Service DateTime</th>
													<th data-class="expand">Product Name</th>
													<th data-hide="phone">Pax</th>
													<th data-hide="phone">Price</th>
													<th data-hide="phone">Amount</th>
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
													<td><?=date("d/m/Y", strtotime($row['booking_detail_date']))."  -  ".date("H:i", strtotime($row['booking_detail_time']))?></td>
													<td><?=$product_sum?></td>
													<td class="center"><?=number_format($row['booking_detail_qty'],0)?></td>													
													<td align="right"><?=number_format(($row['booking_detail_price']+$row['booking_detail_vat']),2)?></td>
													<td align="right"><b><?=number_format($booking_detail_total_amount,2)?></b></td>
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
<!-- END MAIN PANEL -->
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-Adduser">
      	<!-- Modal content-->
      	<div class="modal-content">
	        <div class="modal-header">
	          	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="icon-append fa fa-times"></i>
				</button>
	          	<h4 class="header">Booking Information</h4>
	        </div>
	        <div class="modal-body no-padding">
		  		<form action="shopping-info-controller.php" method='post' id="product-form" class="smart-form" enctype="multipart/form-data">
		  			<fieldset>
					  <section>
							<div class="row">
								<label class="label col col-2" type="number">Date</label>
								<div class="col col-4">
									<label class="input required">
										<input type="date" name="txbbooking_detail_date" id="txbbooking_detail_date">
									</label>
								</div>
								<label class="label col col-2" type="number">Time</label>
								<div class="col col-4">
									<label class="input required">
										<input type="time" name="txbbooking_detail_time" id="txbbooking_detail_time">
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-2" type="number">Pax</label>
								<div class="col col-3">
									<label class="input required">
										<input type="number" step="1" name="txbbooking_detail_qty" id="txbbooking_detail_qty">
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
	 				</fieldset>
					<footer class="center">
						<input type="hidden" name="booking_detail_id" id="booking_detail_id">
						<input type="hidden" name="product_price_l1" id="product_price_l1">
						<input type="hidden" name="product_price_l2" id="product_price_l2">
						<input type="hidden" name="product_oversea_price" id="product_oversea_price">
						<input type="hidden" name="hAction" id="hAction" value="Up_P">
						<button type="submit" class="btn btn-primary" name="submitBookingDetail" id="submitBookingDetail" style="float: unset;font-weight: 400;">Update</button>
						<button type="button" class="btn btn-default" data-dismiss="modal" style="float: unset;font-weight: 400;">Cancel</button>
					</footer>
				</form>
        	</div>
      	</div>
    </div>
</div>

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
						//$('#lsbsupplier_id').val(data.supplier_id);
						//$('#lsbproduct_id').val(data.product_id);
						//$('#txbbooking_detail_price').val(data.booking_detail_price);
						//$('#txbbooking_detail_vat').val(data.booking_detail_vat);
						//$('#txbbooking_detail_total_amount').val(data.booking_detail_total_amount);
						$('#txbbooking_detail_date').val(data.booking_detail_date);
						$('#txbbooking_detail_time').val(data.booking_detail_time);
						$('#txbbooking_detail_qty').val(data.booking_detail_qty);
						$('#txbbooking_detail_note').val(data.booking_detail_note);
						$('#booking_detail_id').val(data.booking_detail_id);
						$('#hAction').val("Up_P");
						//$('#chkbooking_detail_status_' + data.booking_detail_status).proop('checked',true);
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
		
		var $contactForm = $("#product-form").validate({
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
				txbbooking_detail_date : {
					required : true
				},
				txbbooking_detail_time : {
					required : true
				},
				txbbooking_detail_qty	: {
					required : true,
					min : 1
				}	
			},
			// Messages for form validation
			messages : {
				txbbooking_detail_date : {
					required : 'Please fill Your Service Date'
				},
				txbbooking_detail_time : {
					required : 'Please fill Your Service Time'
				},
				txbbooking_detail_qty	: {
					required : 'Please select pax',
					min : 'Please select pax more than 0'
				}
			},
		// Do not change code below
		errorPlacement : function(error, element) {
			error.insertAfter(element.parent());
		}
	});



		var $contactForm = $("#contact-form").validate({
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
		      if (confirm("Do you want submit this booking ?")) {
		        form.submit();
		      }
		    },
		// Rules for form validation
		rules : {
			txbbooking_name : {
				required : true,
			},
			txbbooking_pax : {
				required : true,
				min : 1
			}
		},
		// Messages for form validation
		messages : {
			txbbooking_name : {
				required : 'Please fill Booking Name',
			},
			txbbooking_pax : {
				required : 'Please select Pax',
				min : 'Please select Pax more than 0'
			}
		},

		// Do not change code below
		errorPlacement : function(error, element) {
			error.insertAfter(element.parent());
		}
	});
})

		function ConfirmCheckbox(){
			var types = $('input:checkbox[name="conf"]:checked').map(function() {
				return this.value;
			}).get().join('|');
			//filter in column 0, with an regex, no smart filtering, no inputbox,not case sensitive
			//console.log(types);
			if (types=='Confirm')	{
				document.getElementById('submitAddBooking').disabled=false;
			}else{
				document.getElementById('submitAddBooking').disabled=true;
			}
		}
</script>

<?php
	//include footer
	include ("inc/google-analytics.php");
?>																														