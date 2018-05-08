<?php
//$LoginByUser = trim($_SESSION['LoginUserID_Agent']);
//Get number of agent transaction
//$sql = "SELCT count(*) AS nrow FROM booking WHERE agent_id='$LoginByUser'";
//$result = mysqli_query($conn ,$sql);
//if(mysqli_num_rows($result) > 0) {
//	$row = mysqli_fetch_assoc($result);
//	$Booking_All_Agent = $row['nrow'];
//}
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
	"E-Wallet" => array(
		"title" => "[2] E-Wallet",
		"url" => "index.php",
		"icon" => "fa-book",
	),
	"Promotion" => array(
		"title" => "[3] Promotion",
		"icon" => "fa-book",
		"sub" => array(
			"Promo Code" => array(
				"title" => "Promo Code",
				"url" => APP_URL."/#"
			),
			"Deal" => array(
				"title" => "Deal",
				"url" => APP_URL."/#"
			),			
		),
	),
	"Supplier" => array(
		"title" => "[4] Supplier",
		"icon" => "fa-book",
		"sub" => array(
			"Supplier List" => array(
				"title" => "Supplier List",
				"url" => APP_URL."/#"
			),
			"Product" => array(
				"title" => "Product",
				"url" => APP_URL."/#"
			),
			"Day Off" => array(
				"title" => "Day Off",
				"url" => APP_URL."/#"
			),
			"Full Product" => array(
				"title" => "Full Product",
				"url" => APP_URL."/#"
			),	
		),
	),
	"Service &  Operation" => array(
		"title" => "[6] Service & Operation",
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
		),
	),
	"Accounting" => array(
		"title" => "[7] Accounting",
		"url" => "index.php",
		"icon" => "fa-book",
	),
	"Support to Agent" => array(
		"title" => "[8] Support to Agent",
		"icon" => "fa-book",
		"sub" => array(
			"Supplier List" => array(
				"title" => "Inbox",
				"url" => APP_URL."/#"
			),
			"Product" => array(
				"title" => "Send Message",
				"url" => APP_URL."/#"
			),
		),
	),
	"Setting" => array(
		"title" => "[9] Setting",
		"icon" => "fa-book",
		"sub" => array(
			"User Setup" => array(
				"title" => "User Setup",
				"url" => APP_URL."/#"
			),
			"Master of Supplier" => array(
				"title" => "Master of Supplier",
				"sub" => array(
					"Destination" => array(
						"title" => "Destination",
						"url" => APP_URL."/#"
					),
					"Country of Destination" => array(
						"title" => "Country of Destination",
						"url" => APP_URL."/#"
					),
				),
			),
			"Master of Agent" => array(
				"title" => "Master of Agent",
				"sub" => array(
					"Country of Agent" => array(
						"title" => "Country of Agent",
						"url" => APP_URL."/#"
					),
				),
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
				"url" => APP_URL."/#",
			),
		),
	),
);
?>