<?php
	//fetch.php
	include("inc/connectionToMysql.php");

	if(isset($_POST["user_id"]))
	{
		$query = "SELECT * FROM tb_user_tr WHERE user_id = '".$_POST["user_id"]."'";
		$result = mysqli_query($_SESSION['conn'], $query);
		$row = mysqli_fetch_array($result);
		echo json_encode($row);
	}

	if(isset($_POST["conf_id"]))
	{
		$query = 	"SELECT * FROM tb_conf_ms WHERE conf_id = '".$_POST["conf_id"]."'";
		$result = mysqli_query($_SESSION['conn'], $query);
		$row = mysqli_fetch_array($result);
		echo json_encode($row);
	}

	if(isset($_POST["masofmas_id"]))
	{
		$query = 	"SELECT * FROM tb_masofmas_ms WHERE masofmas_id = '".$_POST["masofmas_id"]."'";
		$result = mysqli_query($_SESSION['conn'], $query);
		$row = mysqli_fetch_array($result);
		echo json_encode($row);
	}

	if(isset($_POST["mas_id"]))
	{
		$query = 	"SELECT * FROM tb_mas_ms WHERE mas_id = '".$_POST["mas_id"]."'";
		$result = mysqli_query($_SESSION['conn'], $query);
		$row = mysqli_fetch_array($result);
		echo json_encode($row);
	}

	if(isset($_POST["agentcountry_id"]))
	{
		$query = 	"SELECT * FROM tb_agent_country_mas WHERE agentcountry_id = '".$_POST["agentcountry_id"]."'";
		$result = mysqli_query($_SESSION['conn'], $query);
		$row = mysqli_fetch_array($result);
		echo json_encode($row);
	}

	if(isset($_POST["currency_id"]))  
	{  
		$query = 	"SELECT * FROM tb_currency_ms WHERE currency_id = '".$_POST["currency_id"]."'";
		$result = mysqli_query($_SESSION['conn'], $query);  
		$row = mysqli_fetch_array($result);  
		echo json_encode($row);
	}

/*
	if(isset($_POST["supplier_id"]))
	{
		$query = "SELECT * FROM `supplier` WHERE `supplier_id` = '".$_POST["supplier_id"]."'";
		$result = mysqli_query($_SESSION['conn'], $query);
		$row = mysqli_fetch_array($result);
		echo json_encode($row);
	}

	if(isset($_POST["agent_id"]))
	{
		$query = "SELECT * FROM `agent` WHERE `agent_id` = '".$_POST["agent_id"]."'";
		$result = mysqli_query($_SESSION['conn'], $query);
		$row = mysqli_fetch_array($result);
		echo json_encode($row);
	}

	if(isset($_POST["product_id"]))
	{
		$query = "SELECT * FROM `product` WHERE `product_id` = '".$_POST["product_id"]."'";
		$result = mysqli_query($_SESSION['conn'], $query);
		$row = mysqli_fetch_array($result);
		echo json_encode($row);
	}

	if(isset($_POST["booking_id"]))
	{
		$query = "SELECT * FROM `booking` WHERE `booking_id` = '".$_POST["booking_id"]."'";
		$result = mysqli_query($_SESSION['conn'], $query);
		$row = mysqli_fetch_array($result);
		echo json_encode($row);
	}

	if(isset($_POST["booking_detail_id"]))
	{
		$query = 	"SELECT * FROM booking_detail, product, supplier WHERE
					booking_detail.product_id = product.product_id and
					product.supplier_id = supplier.supplier_id and
					booking_detail.booking_detail_id = '".$_POST["booking_detail_id"]."'";
		$result = mysqli_query($_SESSION['conn'], $query);
		$row = mysqli_fetch_array($result);
		echo json_encode($row);
	}

	if(isset($_POST["dayoff_id"]))
	{
		$query = 	"SELECT * FROM supplier_dayoff WHERE dayoff_id = '".$_POST["dayoff_id"]."'";
		$result = mysqli_query($_SESSION['conn'], $query);
		$row = mysqli_fetch_array($result);
		echo json_encode($row);
	}*/

?>
