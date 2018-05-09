<?php
session_start();
include("inc/constant.php");
include("inc/connectionToMysql.php");

	if(isset($_POST["submitAdd"]))	{
		if(isset($_POST["audit_id"])){
			$conf_id = $_POST["audit_id"];
		}
        //Variable from the user
		$txbaudit_type = $_POST["txbaudit_type"];
		$txbaudit_detrail = $_POST["txbaudit_detrail"];
		$txbaudit_ip = $_POST["txbaudit_ip"];
        $LoginByUser = trim($_SESSION['LoginUser']);

		if($_POST['submitAdd'] == 'Insert'){
			$sql = "INSERT INTO tb_auditlog_tr(audit_type, audit_detail, audit_ip,create_datetime, create_by)
					VALUES ('$txbaudit_type','$txbaudit_detail', '$txbaudit_ip',
					NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
		}else if($_POST['submitAdd'] == 'Update'){
			$sql = "UPDATE tb_conf_ms SET
				audit_type='$txbaudit_type',
				audit_detail='$txbaudit_detail',
				audit_ip='$txbaudit_ip',
					update_datetime=NOW(),
					update_by='$LoginByUser'
					WHERE audit_id = '$audit_id'";
		}else{
			$sql="";
		}
		$result = mysqli_query($_SESSION['conn'] ,$sql);

		if(!$result) {
			echo "<script>alert('Error: Can not save to database')</script>";
		}else{
			echo "<script>window.location='mas-audittrail.php'</script>";
		}
	}

	// Delete Action
	if (isset($_GET['hAction']))   {
		if ($_GET['hAction']=='Delete')	{
			$sql = "DELETE FROM tb_auditlog_tr WHERE audit_id = '".$_GET['id']."'";
			$result = mysqli_query($_SESSION['conn'] ,$sql);
			if(!$result) {
				echo "<script>alert('Failed to delete.This is already used.!'); window.location='mas-audittrail.php'</script>";
			}
			echo "<script>window.location='mas-audittrail.php'</script>";
		}
    }
?>
