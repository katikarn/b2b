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

	$page_title = "Agent Management";

	/* ---------------- END PHP Custom Scripts ------------- */

	//include header
	//you can add your custom css in $page_css array.
	//Note: all css files are inside css/ folder
	$page_css[] = "your_style.css";
	include ("inc/header.php");

	//include left panel (navigation)
	//follow the tree in inc/config.ui.php
	$page_nav["Agent"]["sub"]["Agent List"]["active"] = true;
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
<div id="main" role="main" >
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

					<div class="row header">
						<div class="col-sm-4 col-md-4 col-lg-4">
							Keywoard<br/>
							<input id="column3_search" type="text" name="googlesearch">
						</div>
						<div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 status smart-form" style="padding-top: 25px;">
							<div class="checkbox"  style="padding-left: 0px;">
								<div class="col-xs-3 col-md-3">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusW" value="Wait for Approve" onclick="filterCheckbox();" checked ><i></i><span style="background-color: teal">Wait for Approve</span></label>
								</div>
								<div class="col-xs-2 col-md-2">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusA" value="Active" onclick="filterCheckbox();" checked ><i></i><span style="background-color: Green">Active</span></label>
								</div>
								<div class="col-xs-2 col-md-2">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusI" value="Inactive" onclick="filterCheckbox();" checked ><i></i><span style="background-color: red">Inactive</span></label>
								</div>
								<div class="col-xs-2 col-md-2">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusC" value="Cancel" onclick="filterCheckbox();" checked ><i></i><span style="background-color: Orange">Cancel</span></label>
								</div>
								<div class="col-xs-2 col-md-2">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusU" value="Unapprove" onclick="filterCheckbox();" checked ><i></i><span style="background-color: purple">Unapprove</span></label>
								</div>
							</div>
						</div>
					</div>
					<div class="jarviswidget jarviswidget-color-orange" id="wid-id-0" data-widget-editbutton="false">
						<header>
								<span class="widget-icon"><i class="fa fa-table"></i> </span>
								<h2>agent List</h2>
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
											<th data-hide="phone">Status</th>
											<th class="center"><a href="agent-addedit.php?type=<?php echo 'add';?>" class="btn btn-small btn-success">Add new</a></th>
										</tr>
									</thead>
									<tbody>
										<?PHP
											$sql = "SELECT agent_id, agent_status, agent_name, agentcountry_name,
													agent_contact_email, agent_contact_tel
													FROM tb_agent_tr, tb_agent_country_ms
													WHERE tb_agent_tr.agentcountry_id = tb_agent_country_ms.agentcountry_id";
											$result = mysqli_query($conn ,$sql);
											if(mysqli_num_rows($result) > 0){
												//show data for each row
												while($row = mysqli_fetch_assoc($result)){
													if($row['agent_status'] == 'A'){
														$statusUser = '<font color="green">Active</font>';
													}else if($row['agent_status'] == 'I'){
														$statusUser = '<font color="red">Inactive</font>';
													}else if($row['agent_status'] == 'C'){
														$statusUser = '<font color="red">Cancel</font>';
													}else if($row['agent_status'] == 'W'){
														$statusUser = '<font color="teal">Wait for Approve</font>';
													}else if($row['agent_status'] == 'U'){
														$statusUser = '<font color="purple">Unapprove</font>';
													}
													?>
													<tr>
														<td>A<?=substr("00000000",1,4-strlen($row['agent_id'])).$row['agent_id']?></td>
														<td><?=$row['agent_name']?></td>
														<td><?=$row['agentcountry_name']?></td>
														<td><?=$row['agent_contact_email']?></td>
														<td><?=$row['agent_contact_tel']?></td>
														<td><?=$row['agent_status']?></td>
														<td class="center">
															<a href="agent-addedit.php?id=<?=$row['agent_id'] ?> &&type=<?='edit';?>" class="btn btn-small btn-success">Edit</a>
															<a href="agent-controller.php?id=<?=$row['agent_id']?>&hAction=Delete" class="btn btn-small btn-danger">Del</a>
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
			"<'dt-toolbar-footer'<'col-sm-2 col-xs-12 hidden-xs'i><'hidden-xs col-sm-6 col-md-4 'l><'col-xs-12 col-sm-6'p>>",
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
			var dataString = 'user_id=' + recipient;
			console.log('dataString :'+dataString);
            $.ajax({

                url: "fetchEdit.php",
				type:"POST",
                data: dataString,
				dataType : 'json',

                success: function (data) {
					if(data != null){
						$('#user_id').val(data.user_id);
						$('#chkuser_status_' + data.user_status).prop('checked',true);
						$('#lsbuser_type').val(data.user_type);
						$('#txbuser_email').val(data.user_email);
						$('#txbusername').val(data.username);
						$('#txbpassword').val(data.password);
						$('#txbuser_remark').val(data.user_remark);
						$('#submitAdd').val("Update");
					}else{
						$('#user_id').val('');
						$('#chkuser_status_A').prop('checked',true);
						$('#lsbuser_type').val('');
						$('#txbuser_email').val('');
						$('#txbusername').val('');
						$('#txbpassword').val('');
						$('#txbuser_remark').val('');
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
				lsbuser_type : {
					required : true,
				},
				username : {
					required : true,
					minlength : 4,
					notEqual: true
				},
				password :{
					required : true,
					minlength : 6,
					haveNumber: true
				},
				txbuser_email :{
					required : true,
					email : true
				}
			},

			// Messages for form validation
			messages : {
				lsbuser_type : {
					required : 'Please select user type',
				},
				username : {
					required : 'Please fill your Username',
					minlength: 'Username must more than 6 character ',
					notEqual: 'Username must not duplicate'
				},
				password :{
					required : 'Please fill your Password',
					minlength: 'Password must more than 6 character',
					haveNumber: 'Password must more less than 1 number'
				},
				txbuser_email :{
					required : 'Please fill your email address',
					email : 'Email format incorrect'
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
	function filterCheckbox(){

		var types = $('input:checkbox[name="status"]:checked').map(function() {
    		return '^' + this.value + '\$';
		}).get().join('|');
		//filter in column 0, with an regex, no smart filtering, no inputbox,not case sensitive
		console.log(types);
		otable.fnFilter(types, 5, true, false, false, false);
	}

	function resetModal(){
		$( "#user-form" ).find( ".state-error" ).removeClass( "state-error" );
		$( "#user-form" ).find( ".state-success" ).removeClass( "state-success" );
		$( "#user-form" ).find( ".required" ).css("border-left", "7px solid #FF3333");
		$( "em" ).remove();
	}
</script>
