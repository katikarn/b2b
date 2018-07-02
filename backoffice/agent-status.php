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
	
	$page_title = "Registered Agent";
	
	/* ---------------- END PHP Custom Scripts ------------- */
	
	//include header
	//you can add your custom css in $page_css array.
	//Note: all css files are inside css/ folder
	$page_css[] = "your_style.css";
	include ("inc/header.php");
	
	//include left panel (navigation)
	//follow the tree in inc/config.ui.php
	$page_nav["Agent"]["sub"]["Registered Agent"]["active"] = true;
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
					Agent Management
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
					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
						<header>
							<span class="widget-icon"> <i class="fa fa-table"></i> </span>
							<h2>Registered Agent</h2>
						</header>
						<div>
							<!-- widget content -->
							<div class="widget-body no-padding">
								
						        <table id="dt_basic" class="table table-striped table-bordered table-hover" style="margin-top:0px" width="100%">
									<thead>			                
									<tr class="header">
											<th data-hide="phone">ID</th>
											<th data-class="expand">Name</th>
											<th data-hide="phone">Country</th>
											<th data-hide="phone">Email</th>
											<th data-hide="phone">Tel</th>
											<th >Action</th>
										</tr>
									</thead>
									<tbody>
										<?PHP
											$sql = "SELECT agent_id, agent_status, agent_name, agentcountry_name,
													agent_contact_email, agent_contact_tel
													FROM tb_agent_tr, tb_agent_country_ms
													WHERE tb_agent_tr.agentcountry_id = tb_agent_country_ms.agentcountry_id
													AND agent_status='W'";
											$result = mysqli_query($conn ,$sql);
											if(mysqli_num_rows($result) > 0){
												//show data for each row
												while($row = mysqli_fetch_assoc($result)){
													?>
													<tr>
														<td><a href="agent-addedit.php?id=<?=$row['agent_id']?>">A<?=substr("00000000",1,4-strlen($row['agent_id'])).$row['agent_id']?></a></td>
														<td><?=$row['agent_name']?></td>
														<td><?=$row['agentcountry_name']?></td>
														<td><?=$row['agent_contact_email']?></td>
														<td><?=$row['agent_contact_tel']?></td>
														<td class="center">
															<a href="agent-controller.php?id=<?=$row['agent_id']?>&hAction=Approve" class="btn btn-small bg-color-green txt-color-white">
																<i class="fa fa-check"></i> <span class="hidden-mobile">Approve</span></a>
															<a href="agent-controller.php?id=<?=$row['agent_id']?>&hAction=Unapprove" class="btn btn-small bg-color-orange txt-color-white">
																<i class="fa fa-times"></i> <span class="hidden-mobile">Unapprove</span></a>
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
<!-- ==========================CONTENT ENDS HERE ========================== -->
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-Adduser">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="header">Unapprove</h4>
			</div>
			<form action='agent-controller.php' method='post' id="product-form" class="smart-form">
				<header>
					Reason
				</header>
					<section>
						<div class="row">
							<div class="input" style="padding: 25px 20px 0px 20px;">
								<label class="input">
									<textarea rows="4" name="txbbooking_detail_reject_reason" id="txbbooking_detail_reject_reason"></textarea>
								</label>
							</div>
						</div>
					</section>
				<footer>		
					<div class="row center">
						<input type="hidden" name="id" id="id">
						<input type="hidden" name="hAction" id="hAction" value="Unapprove">
						<button type="submit" class="btn btn-primary" style="float: unset; font-weight: 400;">Unapprove</button>
						<button type="button" class="btn btn-default" style="float: unset; font-weight: 400;" data-dismiss="modal">Cancel</button>
					</div>	
				</footer>		
			</form>
		</div>
	</div>
</div>

<!-- Modal 2-->
<div class="modal fade" id="myModal_Confirm" role="dialog">
    <div class="modal-dialog modal-Adduser">
		
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="header">Approve</h4>
			</div>
			<form action='agent-controller.php' method='post' id="confirm-form" class="smart-form">
				<header>
					Approve Note
				</header>
					<section>
						<div class="row">
							<div class="input" style="padding: 25px 20px 0px 20px;">
									<input type="text" name="txbbooking_detail_confirm" id="txbbooking_detail_confirm">
							</div>
						</div>
					</section>
				<footer>		
					<div class="row center">
						<input type="hidden" name="id" id="id">
						<input type="hidden" name="hAction" id="hAction" value="Approve">
						<button type="submit" class="btn btn-primary" style="float: unset; font-weight: 400;">Approve</button>
						<button type="button" class="btn btn-default" style="float: unset; font-weight: 400;" data-dismiss="modal">Cancel</button>
					</div>	
				</footer>		
			</form>
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
			var dataString = 'booking_detail_id=' + recipient;
			console.log('dataString :'+dataString);
			$.ajax({
				
				url: "fetchEdit.php",
				type:"POST",
				data: dataString,
				dataType : 'json',
					
				success: function (data) {
					$('#booking_detail_id').val(data.booking_detail_id);
				},
				error: function(err) {
					console.log('err : '+err);
				}
			});  
		});

		$('#myModal_Confirm').on('show.bs.modal', function (event) {
			var button = $(event.relatedTarget) // Button that triggered the modal
			var recipient = button.data('whatever') // Extract info from data-* attributes
			var modal = $(this);
			var dataString = 'booking_detail_id=' + recipient;
			console.log('dataString :'+dataString);
			
			$.ajax({
				
				url: "fetchEdit.php",
				type:"POST",
				data: dataString,
				dataType : 'json',

				success: function (data) {
					$('#booking_detail_id2').val(data.booking_detail_id);		
				},
				error: function(err) {
					console.log('err : '+err);
				}
			});  
		});
		//// --------------------------- Validate------------------------------
		var errorClass = 'invalid';
		var errorElement = 'em';

		var $contactForm = $("#confirm-form").validate({
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

				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});

			var $contactForm2 = $("#product-form").validate({
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
					txbbooking_detail_reject_reason : {
						required : true
					}		
				},
				// Messages for form validation
				messages : {
					txbbooking_detail_reject_reason : {
						required : 'Please fill Remark'
					}
				},

				// Do not change code below
				errorPlacement : function(error, element) {
					error.insertAfter(element.parent());
				}
			});
		});

		/* END BASIC */

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