<?php 
	session_start();
	include('inc/auth.php');
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
	
	$page_title = "Supplier Management";
	
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
					Supplier
				</h1>
			</div>
		</div>
		<!-- widget grid -->
		<section id="widget-grid" class="">
			<!-- row -->
			<div class="row">
				<!-- NEW WIDGET START -->
				<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="row header">
						<div class="col-sm-4 col-md-4 col-lg-4">
							Keyword<br/>
							<input id="column3_search" type="text" name="googlesearch">
						</div>
						<div class="hidden-md col-lg-2">
							<!-- Date<br/>
							<input id="date_search" placeholder="DD/MM/YYYY" type="text" name="date_search"> -->
						</div>
						<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 status smart-form" style="padding-top: 25px;">
							<div class="checkbox"  style="padding-left: 0px;">
								<div class="col-xs-3 col-md-3">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusA" value="Active" onclick="filterCheckbox();" checked ><i></i><span style="background-color: green">Active</span>
									</label>
								</div>
								<div class="col-xs-3 col-md-3">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusI" value="Inactive" onclick="filterCheckbox();" checked ><i></i><span style="background-color: red">Inactive</span>
									</label>
								</div>
								<div class="col-xs-3 col-md-3">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusC" value="Cancel" onclick="filterCheckbox();" checked ><i></i><span style="background-color: orange">Cancel</span>
									</label>
								</div>
							</div>
						</div>
					</div>
					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2>Supplier</h2>
						</header>
						<div>
							<!-- widget content -->
							<div class="widget-body no-padding">
						        <table id="dt_basic" class="table table-striped table-bordered table-hover" style="margin-top:0px" width="100%">
									<thead>			                
										<tr class="header">
											<th data-hide="phone">ID</th>
											<th data-class="expand">Name</th>
											<th data-hide="phone">Type</th>
											<th data-hide="phone">Destination</th>
											<th data-hide="phone">Status</th>
											<th class="center">Setting</th>											
											<th class="center">
												<a href="supplier-addedit.php" class="btn btn-small btn-success"><i class="fa fa-plus"></i> 
												<span class="hidden-mobile">New Supplier</span></a>
											</th>
										</tr>
									</thead>
									<tbody>
										<?PHP
											$sql = "SELECT supplier_id, supplier_name, supplier_type, dest_name, supplier_status 
													FROM tb_supplier_tr LEFT JOIN tb_dest_ms ON tb_supplier_tr.dest_id = tb_dest_ms.dest_id";
											$result = mysqli_query($conn ,$sql);
											if(mysqli_num_rows($result) > 0){
												//show data for each row
												while($row = mysqli_fetch_assoc($result)){
													$SupplierName = $row['supplier_name'];
													if($row['supplier_status'] == 'A'){
														$SupplierStatus = '<font color="green">Active</font>';
													}else if($row['supplier_status'] == 'I'){
														$SupplierStatus = '<font color="red">Inactive</font>';
													}else if($row['supplier_status'] == 'C'){
														$SupplierStatus = '<font color="orange">Cancel</font>';
													}else {
														$SupplierStatus = '';
													}
													if($row['supplier_type'] == 'A'){
														$SupplierType = 'Attraction & Show';
													}else if($row['supplier_type'] == 'D'){
														$SupplierType = 'Day Trip';
													}else if($row['supplier_type'] == 'T'){
														$SupplierType = 'Transport';
													}else {
														$SupplierType = ''; 
													}?>
													<tr>
													<td>S<?=substr("00000000",1,4-strlen($row['supplier_id'])).$row['supplier_id']?></td>
														<td><?=$SupplierName?></td>
														<td><?=$SupplierType?></td>
														<td><?=$row['dest_name']?></td>
														<td><?=$SupplierStatus?></td>
														<td class="center">
															<a href="product.php?supplier_id=<?=$row['supplier_id']?>" class="btn btn-primary"><i class="fa fa-gear"></i> <span class="hidden-mobile">Product</span></a>
															<a href="supplier-dayoff.php?supplier_id=<?=$row['supplier_id']?>" class="btn btn-warning"><i class="fa fa-pause"></i> <span class="hidden-mobile">Day Off</span></a>
														</td>														
														<td class="center">
															<a href="supplier-addedit.php?supplier_id=<?=$row['supplier_id']?>" class="btn btn-small btn-success"><i class="fa fa-pencil"></i> <span class="hidden-mobile">Edit</span></a>
															<a href="supplier-controller.php?supplier_id=<?=$row['supplier_id']?>&hAction=Delete" class="btn btn-small btn-danger"><i class="fa fa-trash-o"></i> <span class="hidden-mobile">Del</span></a>
														</td>
													</tr>
													<?PHP
												}}
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
					<h4 class="header">Supplier</h4>
				</div>
				<div class="modal-body no-padding">
					<form action='supplier-management.php' method='post' id="supplier-form" class="smart-form" enctype="multipart/form-data">
						<header>
							General Info
						</header>
						<fieldset>
							<section>
								<div class="row">
									<label class="label col col-3 header">Status</label>
									<div class="col col-9">
										<label class="input status">
											<div class="inline-group">
												<label class="radio">
													<input type="radio" name="rdosupplier_status" value="A" id="id_supplier_status_A" checked=true>
													<i></i><span style="background-color: green">Active</span></label>
												<label class="radio">
													<input type="radio" name="rdosupplier_status" value="I" id="id_supplier_status_I">
													<i></i><span style="background-color: red">Inactive</span></label>
												<label class="radio">
													<input type="radio" name="rdosupplier_status" value="C" id="id_supplier_status_C">
													<i></i><span style="background-color: orange">Cancel</span></label>
											</div>
										</label>
									</div>
								</div>
								<div class="row">
									<label class="label col col-3 header">Type</label>
									<div class="col col-9">
										<label class="input required">
											<select name="lsbsupplier_type" id="lsbsupplier_type">
												<option value="" selected></option>
    											<option value="A">Adventure</option>
    											<option value="S">Show</option>
    											<option value="D">Day Tip</option>
												<option value="T">Transport</option>
												<option value="M">Meal</option>
												<option value="O">Other</option>
  											</select>
										</label>
									</div>
								</div>
								<div class="row">
									<label class="label col col-3 header">Destination</label>
									<div class="col col-9">
										<label class="input required">
											<select name="lsbsupplier_destination" id="lsbsupplier_destination">
												<option value="" selected></option>
    											<option value="Phuket">Phuket</option>
    											<option value="Krabi">Krabi</option>
    											<option value="Samui">Samui</option>
  											</select>
										</label>
									</div>
								</div>
								<div class="row">
									<label class="label col col-3 header">Company Name</label>
									<div class="col col-9">
										<label class="input required">
											<input type="text" name="txbsupplier_name" id="txbsupplier_name" maxlength="100">
										</label>
									</div>
								</div>
								<div class="row">
									<label class="label col col-3 header">Accounting Name</label>
									<div class="col col-9">
										<label class="input required">
											<input type="text" name="txbsupplier_name_acc" id="txbsupplier_name_acc" maxlength="100">
										</label>
									</div>
								</div>
								<div class="row">
									<label class="label col col-3 header">Address</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="txbsupplier_address" id="txbsupplier_address" maxlength="250">
										</label>
									</div>
								</div>
								<div class="row">
									<label class="label col col-3 header">Tel</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="txbsupplier_tel" id="txbsupplier_tel" onkeypress="return event.charCode >= 48 && event.charCode <= 57">
										</label>
									</div>
								</div>
								<div class="row">
									<label class="label col col-3 header">Website</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="txbsupplier_website" id="txbsupplier_website"  maxlength="250">
										</label>
									</div>
								</div>
								<div class="row">
									<label class="label col col-3 header">Google Map</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="txbsupplier_googlemap" id="txbsupplier_googlemap"  maxlength="250">
										</label>
									</div>
								</div>
								<div class="row">
									<label class="label col col-3 header">Contract File</label>
									<div class="input input-file col col-9">
										<span class="button"><input type="file" id="txbsupplier_contract_file" name="txbsupplier_contract_file" onchange="this.parentNode.nextSibling.value = this.value; showFile(this.id);">Browse</span><input type="text" id="show_contract_file"  placeholder="contract files" readonly="">
										<a id="show_txbsupplier_contract_file" target="_blank" style="display: none"></a>
										<input type="hidden" id="Text_contract_file" name="Text_contract_file"/> 
									</div>
								</div>
								<div class="row">
									<label class="label col col-3 header">Logo Image</label>
									<div class="input input-file col col-9">
										<span class="button"><input type="file" id="txbsupplier_other_file" name="txbsupplier_other_file" onchange="this.parentNode.nextSibling.value = this.value; showFile(this.id);">Browse</span><input type="text" id="show_other_file" placeholder="Other files" readonly="">
										<a id="show_txbsupplier_other_file" target="_blank" style="display: none"></a>
										<input type="hidden" id="Text_other_file" name="Text_other_file"/>
									</div>
								</div>
								<div class="row">
									<label class="label col col-3 header">Image 1</label>
									<div class="input input-file col col-9">
										<span class="button"><input type="file" id="txbsupplier_image1" name="txbsupplier_image1" onchange="this.parentNode.nextSibling.value = this.value; showFile(this.id);">Browse</span><input type="text" id="show_image1" placeholder="Image files 1" readonly="">
										<a id="show_txbsupplier_image1" target="_blank" style="display: none"></a>
										<input type="hidden" id="Text_Image1_file" name="Text_Image1_file"/>
									</div>
								</div>
								<div class="row">
									<label class="label col col-3 header">Image 2</label>
									<div class="input input-file col col-9">
										<span class="button"><input type="file" id="txbsupplier_image2" name="txbsupplier_image2" onchange="this.parentNode.nextSibling.value = this.value; showFile(this.id);">Browse</span><input type="text" id="show_image2" placeholder="Image files 2" readonly="">
										<a id="show_txbsupplier_image2" target="_blank" style="display: none"></a>
										<input type="hidden" id="Text_Image2_file" name="Text_Image2_file"/>
									</div>
								</div>
								<div class="row">
									<label class="label col col-3 header">Image 3</label>
									<div class="input input-file col col-9">
										<span class="button"><input type="file" id="txbsupplier_image3" name="txbsupplier_image3" onchange="this.parentNode.nextSibling.value = this.value; showFile(this.id);">Browse</span><input type="text" id="show_image3" placeholder="Image files 3" readonly="">
										<a id="show_txbsupplier_image3" target="_blank" style="display: none"></a>
										<input type="hidden" id="Text_Image3_file" name="Text_Image3_file"/>
									</div>
								</div>
							</section>
						</fieldset>
						<header>
							Finance
						</header>
						<fieldset>
							<section>
								<div class="row">
									<label class="label col col-3 header">Pay Type</label>
									<div class="col col-9">
										<label class="input">
											<div class="inline-group">
												<label class="radio">
													<input type="radio" name="lsbsupplier_paytype" value="T" id="id_supplier_paytype_T" checked>
													<i></i>Cash transfer</label>
												<label class="radio">
													<input type="radio" name="lsbsupplier_paytype" value="C" id="id_supplier_paytype_C">
													<i></i>Credit</label>													
												<label class="radio">
													<input type="radio" name="lsbsupplier_paytype" value="D" id="id_supplier_paytype_D">
													<i></i>Deposit</label>
											</div>
										</label>
									</div>
								</div>
								<div class="row">
									<label class="label col col-3 header">Credit Term</label>
									<div class="col col-9">
										<label class="input">
											<input type="number" step="1" name="txbsupplier_max_credit" id="txbsupplier_max_credit">
										</label>
									</div>
								</div>
								<div class="row">
									<label class="label col col-3 header">Credit Amount</label>
									<div class="col col-9">
										<label class="input">
											<input type="number" step=".25" name="txbsupplier_credit_term" id="txbsupplier_credit_term">
										</label>
									</div>
								</div>
							</section>
						</fieldset>
						<header>
							Contract - Sales
						</header>
						<fieldset>
							<section>
								<div class="row">
									<label class="label col col-3 header">Name</label>
									<div class="col col-9">
										<label class="input required">
											<input type="text" name="txbsupplier_sales_name" id="txbsupplier_sales_name" maxlength="50">
										</label>
									</div>
									<label class="label col col-3 header">Tel</label>
									<div class="col col-9">
										<label class="input required">
											<input type="text" name="txbsupplier_sales_tel" id="txbsupplier_sales_tel" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="15">
										</label>
									</div>
									<label class="label col col-3 header">Email</label>
									<div class="col col-9">
										<label class="input required">
											<input type="text" name="txbsupplier_sales_email" id="txbsupplier_sales_email" maxlength="50">
										</label>
									</div>
									<label class="label col col-3 header">Line or WhatApp</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="txbsupplier_sales_line" id="txbsupplier_sales_line" maxlength="50">
										</label>
									</div>
								</div>
							</section>	
						</fieldset>
						<header>
							Contract - Reservation
						</header>
						<fieldset>
							<section>
								<div class="row">
									<label class="label col col-3 header">Name</label>
									<div class="col col-9">
										<label class="input required">
											<input type="text" name="txbsupplier_reserv_name" id="txbsupplier_reserv_name" maxlength="50">
										</label>
									</div>
									<label class="label col col-3 header">Tel</label>
									<div class="col col-9">
										<label class="input required">
											<input type="text" name="txbsupplier_reserv_tel" id="txbsupplier_reserv_tel" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="15">
										</label>
									</div>
									<label class="label col col-3 header">Email</label>
									<div class="col col-9">
										<label class="input required">
											<input type="text" name="txbsupplier_reserv_email" id="txbsupplier_reserv_email" maxlength="50">
										</label>
									</div>
									<label class="label col col-3 header">Line or WhatApp</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="txbsupplier_reserv_line" id="txbsupplier_reserv_line" maxlength="50">
										</label>
									</div>
									<label class="label col col-3 header">Fax</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="txbsupplier_reserv_fax" id="txbsupplier_reserv_fax" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="15">
										</label>
									</div>
									<label class="label col col-3 header">Main Contract</label>
									<div class="col col-9">
										<label class="input">
											<select name="lsbsupplier_reserv_main" id="lsbsupplier_reserv_main">
												<option value="" selected></option>
    											<option value="T">Tel</option>
    											<option value="F">Fax</option>
    											<option value="E">Email</option>
												<option value="L">Line or WhatApp</option>
  											</select>
										</label>
									</div>
								</div>
							</section>	
						</fieldset>
						<header>
							Contract - Account
						</header>
						<fieldset>
							<section>
								<div class="row">
									<label class="label col col-3 header">Name</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="txbsupplier_account_name" id="txbsupplier_account_name" maxlength="50">
										</label>
									</div>
								</div>
								<div class="row">
									<label class="label col col-3 header">Tel</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="txbsupplier_account_tel" id="txbsupplier_account_tel" onkeypress="return event.charCode >= 48 && event.charCode <= 57" maxlength="15">
										</label>
									</div>
								</div>								
								<div class="row">
									<label class="label col col-3 header">Email</label>
									<div class="col col-9">
										<label class="input">
											<input type="text" name="txbsupplier_account_email" id="txbsupplier_account_email" maxlength="50">
										</label>
									</div>
								</div>
							</section>	
						</fieldset>
						<header>
							Remark
						</header>
						<fieldset>
							<section>
								<div class="row">
									<label class="label col col-3 header">Detail</label>
									<div class="col col-9">
										<label class="input">
											<textarea type="text" rows="4" name="txbsupplier_remark" id="txbsupplier_remark" maxlength="250"></textarea>
										</label>
									</div>
								</div>
							</section>
						</fieldset>
						<footer class="center">
							<input type="hidden" name="supplier_id" id="supplier_id" />
							<button type="submit" name="submitAddSupplier" id="submitAddSupplier" class="btn btn-primary" style="float: unset;font-weight: 400;">
								Save</button>
							<button type="button" class="btn btn-default" data-dismiss="modal" style="float: unset;font-weight: 400;">
								Cancel</button>
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
			"<'dt-toolbar-footer'<'col-sm-3 col-xs-6 hidden-xs'i><'col-sm-3 col-xs-6 hidden-xs'l><'col-xs-12 col-sm-6'p>>",
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
			var dataString = 'supplier_id=' + recipient;
			console.log('dataString :'+dataString);
            $.ajax({
                
                url: "fetchEdit.php",
				type:"POST",
                data: dataString,
				dataType : 'json',
                
                success: function (data) {
					if(data != null){
						$('#id_supplier_status_' + data.supplier_status).prop('checked',true);
						$('#lsbsupplier_type').val(data.supplier_type);
						$('#lsbsupplier_destination').val(data.supplier_destination);
						$('#txbsupplier_name').val(data.supplier_name);
						$('#txbsupplier_name_acc').val(data.supplier_name_acc);
						$('#txbsupplier_address').val(data.supplier_address);
						$('#txbsupplier_tel').val(data.supplier_tel);
						$('#txbsupplier_website').val(data.supplier_website);
						$('#txbsupplier_googlemap').val(data.supplier_googlemap);
						//console.log('data.supplier_contract_file'+ data.supplier_contract_file);
						//$('#txbsupplier_contract_file').val('upload/supplier/' + data.supplier_contract_file);
						$('#show_contract_file').val(data.supplier_contract_file);
						$('#Text_contract_file').val(data.supplier_contract_file);
						$('#show_txbsupplier_contract_file').html(data.supplier_contract_file);
						$('#show_txbsupplier_contract_file').attr('href','<?=$path_folder_Supplier ?>' + data.supplier_contract_file);
						$('#show_txbsupplier_contract_file').css("display","block");
						//$('#txbsupplier_other_file').val(data.supplier_other_file);
						$('#show_other_file').val(data.supplier_other_file);
						$('#Text_other_file').val(data.supplier_other_file);
						$('#show_txbsupplier_other_file').html(data.supplier_other_file);
						$('#show_txbsupplier_other_file').attr('href','<?=$path_folder_Supplier ?>' + data.supplier_other_file);
						$('#show_txbsupplier_other_file').css("display","block");
						//$('#txbsupplierimage1').val(data.supplier_image1);
						$('#show_image1').val(data.supplier_image1);
						$('#Text_Image1_file').val(data.supplier_image1);
						$('#show_txbsupplier_image1').html(data.supplier_image1);
						$('#show_txbsupplier_image1').attr('href','<?=$path_folder_Supplier ?>' + data.supplier_image1);
						$('#show_txbsupplier_image1').css("display","block");
						//$('#txbsupplierimage2').val(data.supplier_image2);
						$('#show_image2').val(data.supplier_image2);
						$('#Text_Image2_file').val(data.supplier_image2);
						$('#show_txbsupplier_image2').html(data.supplier_image2);
						$('#show_txbsupplier_image2').attr('href','<?=$path_folder_Supplier ?>' + data.supplier_image2);
						$('#show_txbsupplier_image2').css("display","block");
						//$('#txbsupplierimage3').val(data.supplier_image3);
						$('#show_image3').val(data.supplier_image3);
						$('#Text_Image3_file').val(data.supplier_image3);
						$('#show_txbsupplier_image3').html(data.supplier_image3);
						$('#show_txbsupplier_image3').attr('href','<?=$path_folder_Supplier ?>' + data.supplier_image3);
						$('#show_txbsupplier_image3').css("display","block");


						$('#id_supplier_paytype_' + data.status).prop('checked',true);
						$('#txbsupplier_max_credit').val(data.supplier_max_credit);
						$('#txbsupplier_credit_term').val(data.supplier_credit_term);
						$('#txbsupplier_sales_name').val(data.supplier_sales_name);
						$('#txbsupplier_sales_tel').val(data.supplier_sales_tel);
						$('#txbsupplier_sales_email').val(data.supplier_sales_email);
						$('#txbsupplier_sales_line').val(data.supplier_sales_line);	
						$('#txbsupplier_reserv_name').val(data.supplier_reserv_name);
						$('#txbsupplier_reserv_tel').val(data.supplier_reserv_tel);
						$('#txbsupplier_reserv_email').val(data.supplier_reserv_email);
						$('#txbsupplier_reserv_line').val(data.supplier_reserv_line);
						$('#txbsupplier_reserv_fax').val(data.supplier_reserv_fax);
						$('#lsbsupplier_reserv_main').val(data.supplier_reserv_main);
						$('#txbsupplier_account_name').val(data.supplier_account_name);
						$('#txbsupplier_account_tel').val(data.supplier_account_tel);
						$('#txbsupplier_account_email').val(data.supplier_account_email);
						$('#txbsupplier_remark').val(data.supplier_remark);
						$('#supplier_id').val(data.supplier_id);
						$('#submitAddSupplier').val("Update");
					}else{
						$('#id_supplier_status_A').prop('checked',true);
						//$('#id_supplier_status_I').prop('checked',true);
						//$('#id_supplier_status_C').prop('checked',true);
						$('#lsbsupplier_type').val('');
						$('#lsbsupplier_destination').val('');				
						$('#txbsupplier_name').val('');
						$('#txbsupplier_name_acc').val('');
						$('#txbsupplier_address').val('');
						$('#txbsupplier_tel').val('');
						$('#txbsupplier_website').val('');
						$('#txbsupplier_googlemap').val('');
						$('#id_supplier_paytype_T').prop('checked',true);
						//$('#id_supplier_paytype_C' + data.status).prop('checked',true);
						//$('#id_supplier_paytype_D' + data.status).prop('checked',true);
						//$('#id_supplier_paytype_C' + data.status).prop('checked',true);
						//$('#id_supplier_paytype_D' + data.status).prop('checked',true);
						$('#show_txbsupplier_contract_file').html('');
						$('#show_txbsupplier_contract_file').attr('href','');
						$('#show_txbsupplier_contract_file').css("display","none");
						$('#txbsupplier_contract_file').val('');
						$('#show_contract_file').val('');
						$('#Text_contract_file').val('');

						$('#show_txbsupplier_other_file').html('');
						$('#show_txbsupplier_other_file').attr('href','');
						$('#show_txbsupplier_other_file').css("display","none");
						$('#txbsupplier_other_file').val('');
						$('#show_other_file').val('');
						$('#Text_other_file').val('');

						$('#show_txbsupplier_image1').html('');
						$('#show_txbsupplier_image1').attr('href','');
						$('#show_txbsupplier_image1').css("display","none");
						$('#txbsupplier_image1').val('');
						$('#show_image1').val('');
						$('#Text_Image1_file').val('');

						$('#show_txbsupplier_image2').html('');
						$('#show_txbsupplier_image2').attr('href','');
						$('#show_txbsupplier_image2').css("display","none");
						$('#txbsupplier_image2').val('');
						$('#show_image2').val('');
						$('#Text_Image2_file').val('');

						$('#show_txbsupplier_image3').html('');
						$('#show_txbsupplier_image3').attr('href','');
						$('#show_txbsupplier_image3').css("display","none");
						$('#txbsupplier_image3').val('');
						$('#show_image3').val('');
						$('#Text_Image3_file').val('');

						$('#txbsupplier_max_credit').val('');
						$('#txbsupplier_credit_term').val('');
						$('#txbsupplier_sales_name').val('');
						$('#txbsupplier_sales_tel').val('');	
						$('#txbsupplier_sales_email').val('');
						$('#txbsupplier_sales_line').val('');	
						$('#txbsupplier_reserv_name').val('');
						$('#txbsupplier_reserv_tel').val('');
						$('#txbsupplier_reserv_email').val('');
						$('#txbsupplier_reserv_line').val('');
						$('#txbsupplier_reserv_fax').val('');
						$('#lsbsupplier_reserv_main').val('');
						$('#txbsupplier_account_name').val('');
						$('#txbsupplier_account_tel').val('');
						$('#txbsupplier_account_email').val('');
						$('#txbsupplier_remark').val('');
						$('#supplier_id').val('');
						$('#submitAddSupplier').val("Insert");
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
		var $contactForm = $("#supplier-form").validate({
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
				lsbsupplier_type : {
					required : true
				},
				lsbsupplier_destination : {
					required : true
				},
				txbsupplier_name : {
					required : true
				},
				txbsupplier_name_acc : {
					required : true
				},
				txbsupplier_sales_name	: {
					required : true
				},
				txbsupplier_sales_tel	: {
					required : true
				},
				txbsupplier_sales_email : {
					required : true,
					email : true
				},
				txbsupplier_reserv_email : {
					email : true
				},
				txbsupplier_account_email : {
					email : true
				},
				txbsupplier_reserv_name : {
					required : true
				},
				txbsupplier_reserv_tel : {
					required : true
				}
			},

			// Messages for form validation
			messages : {
				lsbsupplier_type : {
					required : 'Please select Type'
				},
				lsbsupplier_destination : {
					required : 'Please select Destination'
				},
				txbsupplier_name : {
					required : 'Please fill Company Name'
				},
				txbsupplier_name_acc : {
					required : 'Please fill Company Account Name'
				},
				txbsupplier_sales_name : {
					required : 'Please fill Sales contract name'
				},
				txbsupplier_sales_tel : {
					required : 'Please fill Sales contract Tel'
				},
				txbsupplier_sales_email : {
					required : 'Please fill Sales Email',
					email : 'Sales Email format incorrect'
				},
				txbsupplier_reserv_email : {
					email : 'Reservation Email format incorrect'
				},
				txbsupplier_account_email : {
					email : 'Account Email format incorrect'
				},
				txbsupplier_reserv_name : {
					required : 'Please fill Supplier Name'
				},
				txbsupplier_reserv_tel : {
					required : 'Please fill Reservation Tel'
				},
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});	

	});

	/* END BASIC */
	function showFile(inputID){
		console.log('inputID' + inputID);
		console.log($("#"+ inputID)[0].files[0].name);
		var fileName = $("#" + inputID)[0].files[0].name;
		var pathFile = $("#" + inputID).val();
		$("#show_" + inputID ).css("display","block");
		$("#show_" + inputID).html(fileName);
		$("#show_" + inputID).attr("href", pathFile);
	}

	function filterCheckbox(){
		
		var types = $('input:checkbox[name="status"]:checked').map(function() {
    		return '^' + this.value + '\$';
		}).get().join('|');
		//filter in column 0, with an regex, no smart filtering, no inputbox,not case sensitive
		//console.log(types);
		otable.fnFilter(types, 3, true, false, false, false);
	}

	function resetModal(){
		$( "#supplier-form" ).find( ".state-error" ).removeClass( "state-error" );
		$( "#supplier-form" ).find( ".state-success" ).removeClass( "state-success" );
		$( "#supplier-form" ).find( ".required" ).css("border-left", "7px solid #FF3333");
		$( "em" ).remove();
	}

</script>