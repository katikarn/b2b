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

	$page_title = "Country Of Agent";

	/* ---------------- END PHP Custom Scripts ------------- */

	//include header
	//you can add your custom css in $page_css array.
	//Note: all css files are inside css/ folder
	$page_css[] = "your_style.css";
	include ("inc/header.php");

	//include left panel (navigation)
	//follow the tree in inc/config.ui.php
	$page_nav["Agent"]["sub"]["Master Setup"]["sub"]["Country"]["active"] = true;
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
				Country of Agent
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
							Keyword<br/> <!--เริ่มทำโปรเจค-->
							<input id="column3_search" type="text" name="googlesearch">
						</div>
					</div>

					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
						<header>
								<span class="widget-icon"><i class="fa fa-table"></i> </span>
								<h2>Country of Agent</h2>
							</header>
						<div>
							<!-- widget content -->
							<div class="widget-body no-padding">

						        <table id="dt_basic" class="table table-striped table-bordered table-hover" style="margin-top:0px" width="100%">
									<thead>
										<tr class="header">
											<th data-class="expand">Country Code</th> <!--เพิ่ม-->
											<th data-hide="phone">Country Name</th> <!--ซ่อน-->
											<th data-hide="phone">Datetime</th>
											<th data-hide="phone">Update By</th>
											<th class="center"><button style="padding: 6px 12px;" class="btn btn-primary" id="m1s" data-whatever="" data-toggle="modal" data-target="#myModal" onclick="resetModal()"><i class="fa fa-plus"></i> <span class="hidden-mobile">Add New</span></button> </th>
										</tr>
									</thead>
									<tbody>
										<script type="text/javascript">
											var storeUsername = [];
										</script>
										<?PHP
											$sql = "SELECT agentcountry_id, agentcountry_code, agentcountry_name, update_by,update_datetime,create_by FROM tb_agent_country_ms";
											$result = mysqli_query($conn ,$sql);
											if(mysqli_num_rows($result) > 0){
												//show data for each row
												while($row = mysqli_fetch_assoc($result))	{?>
													<tr>
														<td><?=$row['agentcountry_code']?></td>
														<td><?=$row['agentcountry_name']?></td>
														<td><?=date("d/m/Y", strtotime($row['update_datetime']))." ".date("H:i", strtotime($row['update_datetime']))?></td>
														<td><?=$row['update_by']?></td>
														<td class="center"><a onclick="resetModal();" class="btn btn-small btn-success"
															data-toggle="modal"
															data-target="#myModal"
															data-whatever="<?=$row['agentcountry_id']?>" ><i class="fa fa-pencil"></i> <span class="hidden-mobile">Edit</span></a>
															<a href="mas-countryagent-controller.php?id=<?=$row['agentcountry_id']?>&hAction=Delete" class="btn btn-small btn-danger"><i class="fa fa-trash-o"></i> <span class="hidden-mobile">Del</span></a>
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
				<form id="user-form" class="smart-form" method="POST" action="mas-countryagent-controller.php">
					<header>
					Country Of agent
					</header>
					<fieldset>
						<section>
							<div class="row">
								<label class="label col col-2">code</label>
								<div class="col col-10">
									<label class="input required">
										<input type="text" name="txbagentcountry_code" id="txbagentcountry_code" maxlength="3">
									</label>
								</div>
							</div>
						</section>
						<section>
							<div class="row">
								<label class="label col col-2">Name</label>
								<div class="col col-10">
									<label class="input required">
										<input type="text" name="txbagentcountry_name" id="txbagentcountry_name" maxlength="45">
									</label>
								</div>
							</div>
						</section>
					<!--<section>
							<div class="row">
								<label class="label col col-2">Remark</label>
								<div class="col col-10">
									<label class="input">
										<textarea rows="3" name="txbconf_remark" id="txbconf_remark"></textarea>
									</label>
								</div>
							</div>
						</section>-->
					</fieldset>
					<footer class="center">
						<input type="hidden" name="agentcountry_id" id="agentcountry_id" />
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
			var dataString = 'agentcountry_id=' + recipient;
			console.log('dataString :'+dataString);
            $.ajax({

                url: "fetchEdit.php",
				type:"POST",
                data: dataString,
				dataType : 'json',

                success: function (data) {
					if(data != null)	{
						$('#agentcountry_id').val(data.agentcountry_id);
						$('#txbagentcountry_code').val(data.agentcountry_code);
						$('#txbagentcountry_name').val(data.agentcountry_name);
						$('#submitAdd').val('Update');
					}else{
						$('#agentcountry_id').val('');
						$('#txbagentcountry_code').val('');
						$('#txbagentcountry_name').val('');
						$('#submitAdd').val('Insert');
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
				txbagentcountry_code : {
					required : true
				},
				txbagentcountry_name :{
					required : true
				}
			},

			// Messages for form validation
			messages : {
				txbagentcountry_code : {
					required : 'Please fill agentcountry code'
				},
				txbagentcountry_name : {
					required : 'Please fill agentcountry name'
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
