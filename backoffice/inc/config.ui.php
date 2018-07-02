<?php
//Get number of agent transaction
$sql = "SELECT count(*) AS iRow FROM tb_agent_tr WHERE agent_status='W'";
$result = mysqli_query($conn ,$sql);
if(mysqli_num_rows($result) > 0) {
	$row = mysqli_fetch_assoc($result);
	$Total_Agent_Waiting = $row['iRow'];
}
//$sql = "SELECT count(*) AS nrow FROM booking WHERE agent_id='$LoginByUser' and booking_status='C'";
//$result = mysqli_query($conn ,$sql);
//if(mysqli_num_rows($result) > 0) {/
//	$row = mysqli_fetch_assoc($result);
//	$Booking_Confirm_Agent = $row['nrow'];
//}
//CONFIGURATION for SmartAdmin UI
//ribbon breadcrumbs config
//array("Display Name" => "URL");
$breadcrumbs = array(
	"Home" => APP_URL
);

/*navigation array config

ex:
"dashboard" => array(
	"title" => "Display Title",
	"url" => "http://yoururl.com",
	"url_target" => "_self",
	"icon" => "fa-home",
	"label_htm" => "<span>Add your custom label/badge html here</span>",
	"sub" => array() //contains array of sub items with the same format as the parent
)

*/
$page_nav = array(
	"Home" => array(
		"title" => "Home",
		"url" => "index.php",
		"icon" => "fa-home"
	),
	"Reservations" => array(
		"title" => "[1] Reservations",
		"icon" => "fa-book",
		"sub" => array(
			"Shopping Cart" => array(
				"title" => "Reservations List",
				"url" => APP_URL."/#"
			),
			"Booking History" => array(
				"title" => "Wait for Confirm",
				"url" => APP_URL."/#"
			),
		),
	),
	"Operation" => array(
		"title" => "[2] Operation",
		"icon" => "fa-book",
		"sub" => array(
			"Supplier List" => array(
				"title" => "Daily Ticket",
				"url" => APP_URL."/#"
			),
			"Product" => array(
				"title" => "Daily One Day Trip",
				"url" => APP_URL."/#"
			),
			"Day Off" => array(
				"title" => "Daily Transport",
				"url" => APP_URL."/#"
			),
			"Full Product" => array(
				"title" => "Full Product",
				"url" => APP_URL."/mas-supplier-fullproduct.php"
			),
		),
	),
	"E-Wallet" => array(
		"title" => "[3] E-Wallet",
		"url" => "index.php",
		"icon" => "fa-book",
	),
	"Promotion" => array(
		"title" => "[4] Promotion",
		"icon" => "fa-book",
		"sub" => array(
			"On-top Discount" => array(
				"title" => "On-top Discount",
				"url" => APP_URL."/#"
			),
			"Flash Due" => array(
				"title" => "Flash Due (Combo)",
				"url" => APP_URL."/#"
			),
			"Promo Code" => array(
				"title" => "Promo Code",
				"url" => APP_URL."/#"
			),
		),
	),
	"Supplier" => array(
		"title" => "[5] Supplier & Product",
		"icon" => "fa-book",
		"sub" => array(
			"Supplier List" => array(
				"title" => "Supplier & Product List",
				"url" => APP_URL."/supplier.php"
			),
			"Combo Pack List" => array(
				"title" => "Combo Pack List",
				"url" => APP_URL."/combo.php"
			),
			"Master Setup" => array(
				"title" => "Master Setup",
				"sub" => array(
					"Pick-up Point" => array(
						"title" => "Pick-up Point",
						"url" => APP_URL."/mas-pickuppoint.php"
					),
					"Destination" => array(
						"title" => "Destination",
						"url" => APP_URL."/mas-destination.php"
					),
					"Country" => array(
						"title" => "Country",
						"url" => APP_URL."/mas-countrydestination.php"
					),
				),
			),
		),
	),
	"Agent" => array(
		"title" => "[6] Agent",
		"icon" => "fa-book",
		"sub" => array(
			"Registered Agent" => array(
				"title" => "Registered Agent",
				"label_htm" => '<span class="badge bg-color-greenLight pull-right inbox-badge">'.$Total_Agent_Waiting.'</span>',
				"url" => APP_URL."/agent-status.php"
			),			
			"Agent List" => array(
				"title" => "All Agent List",
				"url" => APP_URL."/agent.php"
			),
			"Master Setup" => array(
				"title" => "Master Setup",
				"sub" => array(
					"Country" => array(
						"title" => "Country",
						"url" => APP_URL."/mas-countryagent.php"
					),
				),
			),
		),
	),
	"Accounting" => array(
		"title" => "[7] Accounting",
		"url" => "index.php",
		"icon" => "fa-book",
	),
	"Setting" => array(
		"title" => "[8] System Setting",
		"icon" => "fa-book",
		"sub" => array(
			"User Management" => array(
				"title" => "User Setup",
				"url" => APP_URL."/user.php"
			),
			"Currency" => array(
				"title" => "Currency",
				"url" => APP_URL."/mas-currency.php"
			),
			"All Master" => array(
				"title" => "All Master",
				"sub" => array(
					"All Master" => array(
						"title" => "All Master",
						"url" => APP_URL."/mas-mas.php"
					),
					"Type Of Master" => array(
						"title" => "Type Of Master",
						"url" => APP_URL."/mas-masofmas.php"
					),
				),
			),
			"All Config" => array(
				"title" => "All Config",
				"url" => APP_URL."/mas-config.php",
			),
			"Audit Trail" => array(
				"title" => "Audit Trail",
				"url" => APP_URL."/mas-audittrail.php",
			),
		),
	),
);
?>
