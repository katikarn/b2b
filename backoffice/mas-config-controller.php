<?php
session_start();
include("inc/constant.php");
include("inc/connectionToMysql.php");
include("inc/php-audittrail.php");

	if(isset($_POST["submitAdd"]))	{
		if(isset($_POST["conf_id"])){
			$conf_id = $_POST["conf_id"];
		}
        //Variable from the user
		$txbconf_name = $_POST["txbconf_name"];
		$txbconf_value = $_POST["txbconf_value"];
		$txbconf_remark = $_POST["txbconf_remark"];
        $LoginByUser = trim($_SESSION['LoginUser']);
		
		if($_POST['submitAdd'] == 'Insert'){
			$sql = "INSERT INTO tb_conf_ms(conf_name, conf_value, conf_remark, 
					create_datetime, create_by, update_datetime, update_by)
					VALUES ('$txbconf_name','$txbconf_value', '$txbconf_remark',
					NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
		}else if($_POST['submitAdd'] == 'Update'){
			$sql = "UPDATE tb_conf_ms SET 
					conf_name='$txbconf_name', 
					conf_value='$txbconf_value',
					conf_remark='$txbconf_remark',
					update_datetime=NOW(),
					update_by='$LoginByUser' 
					WHERE conf_id = '$conf_id'";
		}else{
			$sql="";
		}
		$result = mysqli_query($_SESSION['conn'] ,$sql);

		if(!$result) {
			echo "<script>alert('Error: Can not save to database')</script>";
		}else{
			echo "<script>window.location='mas-config.php'</script>";
		} 
	}

	// Delete Action
	if (isset($_GET['hAction']))   {
        $sql = "DELETE FROM tb_conf_ms WHERE conf_id = '".$_GET['id']."'";
        $result = mysqli_query($_SESSION['conn'] ,$sql);
        if(!$result) {
            echo "<script>alert('Failed to delete.This supplier is already used.!'); window.location='mas-config.php'</script>";
		}
		echo "<script>window.location='mas-config.php'</script>";
    }
?>