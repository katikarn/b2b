<?php
	session_start();
	include('inc/auth.php');
	include("inc/constant.php");
	include("inc/connectionToMysql.php");

	$AgentPriceType=$_SESSION["AgentPriceType"];
/////////////////////////////////////////////////////////
	//initilize the page
	require_once ("inc/init.php");

	//require UI configuration (nav, ribbon, etc.)
	require_once ("inc/config.ui.php");

	/*---------------- PHP Custom Scripts ---------
		
		YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */
	
	$page_title = "Adventure";
	
	/* ---------------- END PHP Custom Scripts ------------- */
	//include header
	//you can add your custom css in $page_css array.
	//Note: all css files are inside css/ folder
	$page_css[] = "your_style.css";
	include ("inc/header.php");
	
	//include left panel (navigation)
	//follow the tree in inc/config.ui.php
	$page_nav["Product"]["sub"]["Product Category"]["sub"]["[2] Show"]["active"] = true;
	include ("inc/nav.php");
?>
<style>
	.header{
		font-weight:bold !important;
	}
	
	.row{
		margin-bottom:10px;
	}
	
	#dt_basic{
		margin-top: 0px !important;
	}
	
	.status span{
		color:#fff;
		border-radius: 4px;
		border: 1px solid #ccc;
		padding: 2px;
	}
	
	.modal-header{
		background-color: #FF6699;
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
		border-radius: 0px !important;
	}

	.error{
		color: red;
		font-weight: bold;
	}

	.required{
		border-left: 7px solid #FF3333;
	}
	
	@media only screen and (max-width: 320px) {
	    label.radio {
	        margin-right: 15px !important;
	    }
	}

</style>
<!-- ==========================CONTENT STARTS HERE ========================== -->
<!-- MAIN PANEL -->
<div id="main" role="main">
	<?php
		//configure ribbon (breadcrumbs) array("name"=>"url"), leave url empty if no url
		//$breadcrumbs["New Crumb"] => "http://url.com"
		$breadcrumbs["Setup"] = "";
		include("inc/ribbon.php");
	?>
	<!-- MAIN CONTENT -->
	<div id="content">
		<div class="row">
			<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
				<h1 class="header">
					Product : [2] Show
				</h1>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8 text-right">
				<a href="shopping-info.php" class="btn btn-default shop-btn">
					<i class="fa fa-3x fa-shopping-cart"></i>
				</a>
			</div>
		</div>
		<!-- widget grid -->
		<section id="widget-grid" class="">
			<!-- row -->
			<div class="row">
				<!-- NEW WIDGET START -->
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="row header">
						<div class="col-sm-4 col-md-4 col-lg-4">Keyword<br/>
							<input id="column3_search" type="text" name="googlesearch">
						</div>
						<div class="col-sm-2 col-md-2 col-lg-2">Destination<br/>
							<select name="lsbsupplier_destination" id="lsbsupplier_destination" onchange="filterCheckbox();">
								<option value="" selected>-- All --</option>
    							<option value="Phuket">Phuket</option>
    							<option value="Krabi">Krabi</option>
    							<option value="Samui">Samui</option>
  							</select>
						</div>
						<div class="hidden-md col-lg-2">
							<!-- Date<br/>
							<input id="date_search" placeholder="DD/MM/YYYY" type="text" name="date_search"> -->
						</div>
					</div>
					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
						<div>
							<!-- widget content -->
							<div class="widget-body no-padding">
						        <table id="dt_basic" class="table table-striped table-bordered table-hover" style="margin-top:0px" width="100%">
									<thead>			                
										<tr class="header">
											<th data-hide="phone">Destination</th>								
											<th data-hide="phone">Supplier</th>
											<th data-class="expand">Product</th>
											<th data-hide="phone">Passenger Type</th>
											<th date-hide="phone">WalkIn Price</th>
											<th date-hide="phone">Agent Price</th>
											<th data-hide="phone"></th>
										</tr>
									</thead>
									<tbody>
										<?PHP
											$sql = "SELECT product_id, product_status, product_name, product_seat, product_desc,
											product_for, TIME_FORMAT(product_showtime, '%H:%i') as product_showtime,
											TIME_FORMAT(product_starttime, '%H:%i') as product_starttime, supplier_googlemap,
											TIME_FORMAT(product_endtime, '%H:%i') as product_endtime,
											TIME_FORMAT(product_endtime, '%H:%i') as product_endtime, supplier_name , 
											supplier_type, product_car_type, supplier_destination, product_normal_price,
											product_oversea_price, product_price_l1, product_price_l2, product_remark, supplier_remark
											FROM product,supplier 
											where supplier.supplier_id = product.supplier_id
											AND supplier.supplier_status='A'
											AND supplier.supplier_type='S'";
											$result = mysqli_query($conn ,$sql);
											if(mysqli_num_rows($result) > 0){
												//show data for each row
												while($row = mysqli_fetch_assoc($result))	{
													// Production Option wording
													if($row['product_for'] == 'S'){
														$product_for = "Senior";
													}else if($row['product_for'] == 'A'){
														$product_for = "Adult";
													}else if($row['product_for'] == 'C'){
														$product_for = "Child";
													}else if($row['product_for'] == 'I'){
														$product_for = "Infant";
													}else{
														$product_for = "";
													}
													$product_showtime = $row['product_showtime'];
												?>
												<tr>
													<td><?=$row['supplier_destination']?></td>
													<td>
														<img src="../phukettimetour/upload/product/<?=$row['supplier_other_file']?>" height="60" width="60">
														<?=$row['supplier_name']?>
														<?php if ($row['supplier_remark']<>"")	{?> 
															<i class="fa fa-info-circle" title="<?=$row['supplier_remark']?>"></i>
														<?php }?>
													</td>
													<td><?=$row['product_name']?> <b><?php 
														if ($product_showtime<>"00:00")	{
															echo "(ShowTime : ".$product_showtime.")";
														}?></b><?php if ($row['product_remark']<>"")	{?> 
														<i class="fa fa-info-circle" title="<?=$row['product_remark']?>"></i><?php }?>
														<br>TripTime : <?=$row['product_starttime'];?> - <?=$row['product_endtime'];?> 
														<br><a target="_blank" href="../phukettimetour/upload/product/<?=$row['supplier_contract_file']?>" class="btn btn-primary btn-xs btn-success">Itenery</a>
														<a target="_blank" href="../phukettimetour/upload/product/<?=$row['supplier_contract_file']?>" class="btn btn-primary btn-xs btn-warning">Image</a>
														<a target="_blank" href="<?=$row['supplier_googlemap']?>" class="btn btn-primary btn-xs btn-info">Location</a>
														</td>													
													<td><?=$product_for?></td>
													<td align="right"><strike><?=number_format($row['product_normal_price'],2)?></strike></td>													
													<td align="right"><b><?php 													
													if ($AgentPriceType=="A")	{
														echo number_format($row['product_price_l1'],2);
													}else if ($AgentPriceType=="B")	{
														echo number_format($row['product_price_l2'],2);
													}else if ($AgentPriceType=="O")	{
														echo number_format($row['product_oversea_price'],2);
													}else	{
														echo number_format($row['product_normal_price'],2);
													} ?></b></td>
													<td class="center"><a onclick="resetModal();" class="btn btn-small btn-primary"
															data-toggle="modal"
															data-target="#myModal"
															data-whatever="<?=$row['product_id']?>">Add to Cart</a></td>
												</tr>
												<?PHP
												}
											} 
										?>
									</tbody>
								</table>								
							</div>					
						</div>
					</div>
				</article>
			</div>
		</section>		
	</div>
</div>
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
						<input type="hidden" name="product_id" id="product_id">
						<input type="hidden" name="product_price_l1" id="product_price_l1">
						<input type="hidden" name="product_price_l2" id="product_price_l2">
						<input type="hidden" name="product_oversea_price" id="product_oversea_price">
						<input type="hidden" name="hAction" id="hAction">
						<button type="submit" class="btn btn-primary" name="submitBookingDetail" id="submitBookingDetail" style="float: unset;font-weight: 400;">Add to Cart</button>
						<button type="button" class="btn btn-default" data-dismiss="modal" style="float: unset;font-weight: 400;">Cancel</button>
					</footer>
				</form>
        	</div>
      	</div>
    </div>
</div>
<!-- ==========================CONTENT ENDS HERE ========================== -->
<?php //include required scripts
include ("inc/scripts.php");
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

		$('#myModal').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipient = button.data('whatever') // Extract info from data-* attributes
			var modal = $(this);
			var dataString = 'product_id=' + recipient;
			console.log('dataString :'+dataString);
			$.ajax({
				
				url: "fetchEdit.php",
				type:"POST",
				data: dataString,
				dataType : 'json',
					
				success: function (data) {
					if(data != null) {
						$('#product_id').val(data.product_id);
						$('#txbbooking_detail_time').val(data.product_starttime);
						$('#product_oversea_price').val(data.product_oversea_price);
						$('#product_price_l1').val(data.product_price_l1);
						$('#product_price_l2').val(data.product_price_l2);
						$('#hAction').val("Add_P");
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
		});

		/* END BASIC */
		function showFile(inputID){
			//console.log('inputID' + inputID);
			//console.log($("#"+ inputID)[0].files[0].name);
			var fileName = $("#" + inputID)[0].files[0].name;
			var pathFile = $("#" + inputID).val();
			$("#show_" + inputID ).css("display","block");
			$("#show_" + inputID).html(fileName);
			$("#show_" + inputID).attr("href", pathFile);
		}

		function filterCheckbox(){
			var types = $('#lsbsupplier_destination').val();
			//	return '^' + this.value + '\$';
			//}).get().join('|');
			//alert(this.value);
			//filter in column 0, with an regex, no smart filtering, no inputbox,not case sensitive
			//console.log(types);
			otable.fnFilter(types, 0, true, false, false, false);
		}

		function resetModal(){
			$( "#product-form" ).find( ".state-error" ).removeClass( "state-error" );
			$( "#product-form" ).find( ".state-success" ).removeClass( "state-success" );
			$( "#product-form" ).find( ".required" ).css("border-left", "7px solid #FF3333");
			$( "em" ).remove();
		}
	</script>

	<?php
	//include footer
	include ("inc/google-analytics.php");
	?>