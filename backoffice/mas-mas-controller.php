<?php
session_start();
include("inc/constant.php");
include("inc/connectionToMysql.php");
include("inc/php-audittrail.php");

	if(isset($_POST["submitAdd"]))	{
		if(isset($_POST["mas_id"])){
			$mas_id = $_POST["mas_id"];
		}

        //Variable from the user
		$txbmas_code = $_POST["txbmas_code"];
		$txbmas_value = $_POST["txbmas_value"];
		$lsbmasofmas_id = $_POST["lsbmasofmas_id"];
        $LoginByUser = trim($_SESSION['LoginUser']);
		echo $_POST['submitAdd'];
		if($_POST['submitAdd'] == 'Insert'){
			$sql = "INSERT INTO tb_mas_ms(mas_code, mas_value, masofmas_id, 
					create_datetime, create_by, update_datetime, update_by)
					VALUES ('$txbmas_code','$txbmas_value', '$lsbmasofmas_id',
					NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
		}else if($_POST['submitAdd'] == 'Update'){
			$sql = "UPDATE tb_mas_ms SET 
					mas_code='$txbmas_code', 
					mas_value='$txbmas_value',
					masofmas_id='$lsbmasofmas_id',
					update_datetime=NOW(),
					update_by='$LoginByUser' 
					WHERE mas_id = '$mas_id'";
		}else{
			$sql="";
		}
		$result = mysqli_query($_SESSION['conn'] ,$sql);

		if(!$result) {
			echo "<script>alert('Error: Can not save to database')</script>";
		}else{
			echo "<script>window.location='mas-mas.php'</script>";
		} 
	}

	// Delete Action
	if (isset($_GET['hAction']))   {
        $sql = "DELETE FROM tb_mas_ms WHERE mas_id = '".$_GET['id']."'";
        $result = mysqli_query($_SESSION['conn'] ,$sql);
        if(!$result) {
            echo "<script>alert('Failed to delete.This supplier is already used.!'); window.location='mas-mas.php'</script>";
		}
		echo "<script>window.location='mas-mas.php'</script>";
    }
?>