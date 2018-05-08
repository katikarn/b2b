<?php 
	session_start();
	include('inc/auth.php');
	include('inc/constant.php');
	include('inc/connectionToMysql.php');
	/////////////////////////////////////////////////////////
	//initilize the page
	require_once ("inc/init.php");
	
	//require UI configuration (nav, ribbon, etc.)
	require_once ("inc/config.ui.php");

	$agent_id = trim($_SESSION["LoginUserID_Agent"]);
	/*---------------- PHP Custom Scripts ---------
		
		YOU CAN SET CONFIGURATION VARIABLES HERE BEFORE IT GOES TO NAV, RIBBON, ETC.
	E.G. $page_title = "Custom Title" */
	
	$page_title = "BookingList";
	
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
	 /*float: right;*/
	margin-top: 20px;
	text-align: center;
	white-space: nowrap;
	}
	
	.status span{
		color:#fff;
		border-radius: 4px;
		border: 1px solid #ccc;
		padding: 2px;
	}
	
	label, .mr-20{
	margin-right:	20px;
	}
	
	.center{
	text-align:	center;
	}
	
	input[type=text], select, input[type=email]{
	width: 100%;
	padding: 5px;
	margin: 8px 0px;
	border: 1px solid #ccc;
	border-radius: 4px;
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
					Booking List
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
						<div class="col-sm-4 col-md-4">
							Keywoard<br/>
							<input id="column3_search" type="text" name="column3_search">
						</div>
						<div class="col-sm-2 col-md-2 hidden-xs">
							First Service Date<br/>
							<input id="date_search" placeholder="DD/MM/YYYY" type="text" name="date_search">
						</div>
						<div class="col-xs-8 col-sm-4 col-md-4 status smart-form" style="padding-top: 25px;">
							<div class=" checkbox">
								<div class="col col-4">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusN" value="New" onclick="filterCheckbox();" checked ><i></i><span style="background-color: green;">New</span>
									</label>
								</div>
								<div class="col col-4">
									<label class="checkbox">
										<input type="checkbox" name="status" id="StatusC" value="Confirm" onclick="filterCheckbox();" checked ><i></i><span style="background-color: blue;">Confirm</span>
									</label>
								</div>
							</div>
						</div>
					</div>
					
					<div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
						<div>
							<!-- widget content -->
							<div class="widget-body no-padding">
						        <table id="dt_basic" class="table table-striped table-bordered table-hover" style="margin-top:0px" width="100%">
									<thead>             
										<tr class="header">
											<th data-hide="phone">Booking ID</th>
											<th data-hide="phone">First Service Date</th>											
											<th data-class="expand">Booking Name</th>
											<th data-hide="phone">Pax</th>										
											<th data-hide="phone">Booking Status</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<?PHP
											$sql = "SELECT booking.booking_id, booking.booking_name, min(booking_detail.booking_detail_date) as booking_date, 
											agent.agent_name, booking.booking_status,booking_pax
											FROM booking, booking_detail, agent
											WHERE booking.booking_id>=booking_detail.booking_id 
											AND booking.agent_id=agent.agent_id
											AND booking.agent_id='$agent_id'
											GROUP BY booking.booking_id";
											$result = mysqli_query($conn ,$sql);
											if(mysqli_num_rows($result) > 0){
												//show data for each row
												while($row = mysqli_fetch_assoc($result)){
													if($row['booking_status'] == 'N'){
														$statusUser = '<font color="green">New</font>';
													}else if($row['booking_status'] == 'C'){
														$statusUser = '<font color="blue">Confirm</font>';
													}else{
														$statusUser = '';
													}?>
													<tr>
														<td><?=substr("00000000",1,6-strlen($row['booking_id'])).$row['booking_id'];?></td>
														<td><?=date("d/m/Y", strtotime($row['booking_date']));?></td>														
														<td><?=$row['booking_name']?></td>
														<td class="center"><?=$row['booking_pax']?></td>
														<td><?=$statusUser?></td>
														<td style="text-align: center;">
														<a class="btn btn-small btn-primary bg-color-green" id="m1s" href="booking-history-detail.php?id=<?=$row['booking_id']?>">View</a>
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

		$( "#date_search" ).keyup(function() {
			//alert( "Handler for .keyup() called." );
			table_dtbasic.columns( 2 ).search( this.value ).draw();
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
						console.log('data :'+data);
						console.log('data.username :'+data.username);
						console.log('data.status :'+data.status);
						$('#username').val(data.username);  
						$('#email').val(data.email);  
						$('#password').val(data.password);  
						$('#type').val(data.type);   
						$('#user_id').val(data.userid);
						$('#m_Status' + data.status).prop('checked',true);
						$('#m_type' + data.type).prop('checked',true);
						$('#submitAddUser').val("Update");  
					}else{
						$('#username').val('');  
						$('#email').val('');  
						$('#password').val('');  
						$('#type').val('');    
						$('#user_id').val('');
						$('#m_StatusA').prop('checked',false);
						$('#m_StatusI').prop('checked',false);
						$('#m_StatusC').prop('checked',false);
						$('#m_typeS').prop('checked',false);
						$('#m_typeM').prop('checked',false);
						$('#m_typeA').prop('checked',false);
						$('#submitAddUser').val("Insert");
					}
				},
                error: function(err) {
                    console.log('err : '+err);
					
				}
			});  
		});

		//// Validate
		//// set default 
		$('p[for="username"]').hide();
		$('p[for="password"]').hide();
		$('p[for="status"]').hide();
		$('p[for="type"]').hide();
		$('p[for="email"]').hide();

		$( "#username" ).keyup(function() {
			if($( "#username" ).val().length < 6){
				//console.log('test' + $( "#username" ).val().length);
				$('p[for="username"]').show();
			}else{
				//console.log('test' + $( "#username" ).val().length);
				$('p[for="username"]').hide();
			}
			
			
		});

		$( "#password" ).keyup(function() {
			if($( "#password" ).val().length < 6 ){
				$('p[for="password"]').html("Password must more than 6 character");
				$('p[for="password"]').show();
			}else{
				if($( "#password" ).val().match(/\d/))
				{
					$('p[for="password"]').hide();
				}else{
					$('p[for="password"]').html("Password must more less than 1 number");
					$('p[for="password"]').show();
				}	
			}
		});

		$( "#email" ).keyup(function() {
			if($( "#email" ).val().match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/)){
				$('p[for="email"]').hide();
			}else{
				$('p[for="email"]').show();
			}
		});
		

	});

	/* END BASIC */
	function filterCheckbox(){
		
		var types = $('input:checkbox[name="status"]:checked').map(function() {
    		return '^' + this.value + '\$';
		}).get().join('|');
		//filter in column 0, with an regex, no smart filtering, no inputbox,not case sensitive
		console.log(types);
		otable.fnFilter(types, 4, true, false, false, false);
	}
	
</script>

<?php
	//include footer
	include ("inc/google-analytics.php");
?>																														