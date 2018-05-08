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
	
	$page_title = "Currency";
	
	/* ---------------- END PHP Custom Scripts ------------- */
	
	//include header
	//you can add your custom css in $page_css array.
	//Note: all css files are inside css/ folder
	$page_css[] = "your_style.css";
	include ("inc/header.php");
	
	//include left panel (navigation)
	//follow the tree in inc/config.ui.php
	$page_nav["Setting"]["sub"]["Currency"]["active"] = true;
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
					Currency
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
					</div>
					
					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
						<div>
							<!-- widget content -->
							<div class="widget-body no-padding">
								
						        <table id="dt_basic" class="table table-striped table-bordered table-hover" style="margin-top:0px" width="100%">
									<thead>			                
										<tr class="header">
											<th data-class="expand">Code</th>
											<th data-hide="phone">Name</th>
											<th data-hide="phone">Rate</th>
											<th data-hide="phone">Last Update</th>
											<th data-hide="phone">Update By</th>											
											<th class="center"><button style="padding: 6px 12px;" class="btn btn-primary" id="m1s" data-whatever="" data-toggle="modal" data-target="#myModal" onclick="resetModal()">Add new</button> </th>
										</tr>
									</thead>
									<tbody>
										<script type="text/javascript">
											var storeUsername = [];
										</script>
										<?PHP
											$sql = "SELECT currency_id, currency_code, currency_name, currency_flag, currency_rate, update_datetime, update_by
													FROM tb_currency_ms";
											$result = mysqli_query($conn ,$sql);
											if(mysqli_num_rows($result) > 0){
												//show data for each row
												while($row = mysqli_fetch_assoc($result))	{?>
													<tr>
														<td><?=$row['currency_code']?></td>
														<td><?=$row['currency_name']?></td>
														<td><?=$row['currency_rate']?></td>
														<td><?=date("d/m/Y", strtotime($row['update_datetime']))." ".date("H:i", strtotime($row['update_datetime']))?></td>
														<td><?=$row['update_by']?></td>											
														<td class="center"><a onclick="resetModal();" class="btn btn-small btn-success"
															data-toggle="modal"
															data-target="#myModal"
															data-whatever="<?=$row['currency_id']?>" >Edit</a>
															<a href="mas-currency-controller.php?id=<?=$row['currency_id']?>&hAction=Delete" class="btn btn-small btn-danger">Del</a>
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
					Currency
				</h4>
			</div>
			<div class="modal-body no-padding">
				<form id="user-form" class="smart-form" method="POST" action="mas-currency-controller.php">
					<header>
						Currency
					</header>
					<fieldset>
						<section>
							<div class="row">
								<label class="label col col-2">Currency Code</label>
								<div class="col col-3">
									<label class="input required">
										<input type="text" name="txbcurrency_code" id="txbcurrency_code" maxlength="3">
									</label>
								</div>
								<label class="label col col-2">Currency Name</label>
								<div class="col col-5">
									<label class="input required">
										<input type="text" name="txbcurrency_name" id="txbcurrency_name" maxlength="45">
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-2">Rate</label>
								<div class="col col-3">
									<label class="input required">
										<input type="number" name="txbcurrency_rate" id="txbcurrency_rate"></textarea>
									</label>
								</div>
								<label class="label col col-2">Flag</label>
								<div class="col col-5">
									<label class="input">
										<input type="text" name="txbcurrency_flag" id="txbcurrency_flag" maxlength="45">
									</label>
								</div>

							</div>
						</section>
					</fieldset>
					<footer class="center">
						<input type="hidden" name="currency_id" id="currency_id" />
						<button type="submit" name="submitAdd" onclick="" id="submitAdd" class="btn btn-primary" style="float: unset;font-weight: 400;">
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
			var dataString = 'currency_id=' + recipient;
			console.log('dataString :'+dataString);
            $.ajax({
                
                url: "fetchEdit.php",
				type:"POST",
                data: dataString,
				dataType : 'json',
                
                success: function (data) {
					if(data != null){
						$('#currency_id').val(data.currency_id);
						$('#txbcurrency_code').val(data.currency_code);
						$('#txbcurrency_name').val(data.currency_name);
						$('#txbcurrency_flag').val(data.currency_flag);
						$('#txbcurrency_rate').val(data.currency_rate);
						$('#submitAdd').val("Update");  
					}else{
						$('#currency_id').val('');
						$('#txbcurrency_code').val('');
						$('#txbcurrency_name').val('');
						$('#txbcurrency_flag').val('');
						$('#txbcurrency_rate').val('');
						$('#submitAdd').val("Insert");
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
				txbcurrency_code : {
					required : true,
					rangelength: [3, 3]
				},
				txbcurrency_name :{
					required : true
				},
				txbcurrency_rate :{
					required : true,
					number: true
				}
			},

			// Messages for form validation
			messages : {
				txbcurrency_code : {
					required : 'Please fill Code',
					rangelength : 'Please fill 3 digit of Code'
				},
				txbcurrency_name : {
					required : 'Please fill Name'
				},
				txbcurrency_rate : {
					required : 'Please fill Rate',
					number : 'Please fill Rate number only'
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
	    	var isCheck = $('#submitAdd').val(); 
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