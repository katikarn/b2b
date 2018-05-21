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

	$page_title = "Supplier Dayoff";

	/* ---------------- END PHP Custom Scripts ------------- */

	//include header
	//you can add your custom css in $page_css array.
	//Note: all css files are inside css/ folder
	$page_css[] = "your_style.css";
	include ("inc/header.php");

	//include left panel (navigation)
	//follow the tree in inc/config.ui.php
	$page_nav["Supplier"]["sub"]["Day Off"]["active"] = true;
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
					User
				</h1>
			</div>
			<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">

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
					</div>

					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
						<div>
							<!-- widget content -->
							<div class="widget-body no-padding">

						        <table id="dt_basic" class="table table-striped table-bordered table-hover" style="margin-top:0px" width="100%">
									<thead>
										<tr class="header">
											<th data-hide="expand">Supplier Name</th>
											<th data-class="phone">Dayoff</th>
											<th data-class="phone">Destination</th>
											<th class="center"><button style="padding: 6px 12px;" class="btn btn-primary" id="m1s" data-whatever="" data-toggle="modal" data-target="#myModal" onclick="resetModal()">Add new</button> </th>
										</tr>
									</thead>
									<tbody>
										<script type="text/javascript">
											var storeUsername = [];
										</script>
										<?PHP
											$sql = "SELECT dayoff_id, tb_supplier_tr.supplier_id, dayoff_date, dayoff_message, dayoff_remark, 
													tb_supplier_dayoff_tr.create_datetime, tb_supplier_dayoff_tr.create_by, tb_supplier_dayoff_tr.update_datetime, tb_supplier_dayoff_tr.update_by
													FROM tb_supplier_dayoff_tr, tb_supplier_tr
													WHERE tb_supplier_dayoff_tr.supplier_id = tb_supplier_tr.supplier_id";
											$result = mysqli_query($conn ,$sql);
											if(mysqli_num_rows($result) > 0){
												//show data for each row
												while($row = mysqli_fetch_assoc($result))	{?>
													<tr>
														<td><?=$row['supplier_id']?></td>
														<td><?=date("d/m/Y", strtotime($row['dayoff_date']))?></td>
														<td><?=$row['dayoff_message']?></td>
															<td><?=$row['dayoff_remark']?></td>
														<td class="center"><a onclick="resetModal();" class="btn btn-small btn-success"
															data-toggle="modal"
															data-target="#myModal"
															data-whatever="<?=$row['dayoff_id']?>" >Edit</a>
															<a href="mas-supplier-dayoff.php?id=<?=$row['dayoff_id']?>&hAction=Delete" class="btn btn-small btn-danger">Del</a>
														</td>
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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					<i class="icon-append fa fa-times"></i>
				</button>
				<h4 class="header">
					User
				</h4>
			</div>
			<div class="modal-body no-padding">
				<form id="user-form" class="smart-form" method="POST">
					<header>
						DayOff Info
					</header>
					<fieldset>
						<section>
							<div class="row">
								<label class="label col col-3">Supplier</label>
								<div class="col col-9">
									<label class="input required">
										<select name="lsbsupplier_id" id="lsbsupplier_id">
											<option value="" selected></option>
											<?php
											$sql = "SELECT supplier_id, supplier_name, supplier_destination FROM tb_supplier_tr ORDER BY supplier_name";
											$result = mysqli_query($conn ,$sql);
											if(mysqli_num_rows($result) > 0)	{
												//show data for each row
												while($row = mysqli_fetch_assoc($result))	{
													echo "<option value='".$row['supplier_id']."'";
													echo ">".$row['supplier_destination']." : ".$row['supplier_name']."</option>";
												}
											}?>
										</select>
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-3" type="number">Date</label>
								<div class="col col-7">
									<label class="input required">
										<input type="date" name="txbdayoff_date" id="txbdayoff_date">
									</label>
								</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-3 header">DayOff messages</label>
								<div class="col col-9">
									<label class="input">
										<textarea rows="2" name="txbdayoff_messages" id="txbdayoff_messages"></textarea>
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-3 header">Remark</label>
								<div class="col col-9">
									<label class="input">
										<textarea rows="2" name="txbdayoff_remark" id="txbdayoff_remark"></textarea>
									</label>
								</div>
							</div>
						</section>
					</fieldset>
					<footer class="center">
						<input type="hidden" name="dayoff_id" id="dayoff_id" />
						<button type="submit" name="submitAddDayoff" onclick="" id="submitAddDayoff" class="btn btn-primary" style="float: unset;font-weight: 400;">
							Save</button>
						<button type="button" class="btn btn-default" data-dismiss="modal" style="float: unset;font-weight: 400;">
							Cancel</button>
					</footer>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->



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
			var dataString = 'dayoff_id=' + recipient;
			console.log('dataString :'+dataString);
            $.ajax({

                url: "fetchEdit.php",
				type:"POST",
                data: dataString,
				dataType : 'json',

                success: function (data) {
					if(data != null){
						$('#lsbsupplier_id').val(data.supplier_id);
						$('#dayoff_id').val(data.dayoff_id);
						$('#txbdayoff_date').val(data.dayoff_date);
						$('#txbdayoff_remark').val(data.dayoff_remark);
						$('#submitAddDayoff').val("Update");
					}else{
						$('#lsbsupplier_id').val('');
						$('#txbdayoff_date').val('');
						$('#txbdayoff_remark').val('');
						$('#submitAddDayoff').val("Insert");
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

		var $contactForm = $("#user-form").validate({
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
					required : true
				},
				txbdayoff_date :{
					required : true
				}
			},

			// Messages for form validation
			messages : {
				lsbsupplier_id : {
					required : 'Please select Supplier'
				},
				txbdayoff_date : {
					required : 'Please select Day Off'
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
	    $.validator.addMethod("notEqual", function(value, element, param) {
	    	var check = true;
	    	var isCheck = $('#submitAddDayoff').val();
	    	for (var i = 0; i < storeUsername.length; i++) {
	    		//console.log(storeUsername[i]);
	    		if(value == storeUsername[i] && isCheck == "Insert")
	    		{
	    			check = false;
	    		}
	    	}
		  return check;
		}, "");

	});

	/* END BASIC */
	function resetModal(){
		$( "#user-form" ).find( ".state-error" ).removeClass( "state-error" );
		$( "#user-form" ).find( ".state-success" ).removeClass( "state-success" );
		$( "#user-form" ).find( ".required" ).css("border-left", "7px solid #FF3333");
		$( "em" ).remove();
	}
</script>
