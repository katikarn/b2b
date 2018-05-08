<?php
session_start();
include("inc/constant.php");
include("inc/connectionToMysql.php");

	if(isset($_POST["submitAdd"]))	{
		if(isset($_POST["currency_id"])){
			$currency_id = $_POST["currency_id"];
		}
        //Variable from the user
		$txbcurrency_code = $_POST["txbcurrency_code"];
		$txbcurrency_name = $_POST["txbcurrency_name"];
		$txbcurrency_rate = $_POST["txbcurrency_rate"];
		$txbcurrency_flag = $_POST['txbcurrency_flag'];
        $LoginByUser = trim($_SESSION['LoginUser']);
		
		if($_POST['submitAdd'] == 'Insert'){
			$sql = "INSERT INTO tb_currency_ms(currency_code, currency_name, currency_flag, currency_rate,
					create_datetime, create_by, update_datetime, update_by)
					VALUES ('$txbcurrency_code','$txbcurrency_name', '$txbcurrency_flag', '$txbcurrency_rate',
					NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
		}else if($_POST['submitAdd'] == 'Update'){
			$sql = "UPDATE tb_currency_ms SET 
					currency_code='$txbcurrency_code', 
					currency_name='$txbcurrency_name',
					currency_flag='$txbcurrency_flag',
					currency_rate='$txbcurrency_rate',
					update_datetime=NOW(),
					update_by='$LoginByUser' 
					WHERE currency_id = '$currency_id'";
		}else{
			$sql="";
		}
		$result = mysqli_query($_SESSION['conn'] ,$sql);

		if(!$result) {
			echo "<script>alert('Error: Can not save to database')</script>";
		}else{
			echo "<script>window.location='mas-currency.php'</script>";
		} 
	}

	// Delete Action
	if (isset($_GET['hAction']))   {
		if ($_GET['hAction']=='Delete')	{
			$sql = "DELETE FROM tb_currency_ms WHERE currency_id = '".$_GET['id']."'";
			$result = mysqli_query($_SESSION['conn'] ,$sql);
			if(!$result) {
				echo "<script>alert('Failed to delete.This is already used.!'); window.location='mas-currency.php'</script>";
			}
			echo "<script>window.location='mas-currency.php'</script>";
		}
    }
?>