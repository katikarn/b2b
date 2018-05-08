<?php
session_start();
include("inc/constant.php");
include("inc/connectionToMysql.php");
include("inc/php-audittrail.php");

	if(isset($_POST["submitAdd"]))	{
		if(isset($_POST["masofmas_id"])){
			$masofmas_id = $_POST["masofmas_id"];
		}
        //Variable from the user
		$txbmasofmas_name = $_POST["txbmasofmas_name"];
        $LoginByUser = trim($_SESSION['LoginUser']);
		
		if($_POST['submitAdd'] == 'Insert'){
			$sql = "INSERT INTO tb_masofmas_ms(masofmas_name,
					create_datetime, create_by, update_datetime, update_by)
					VALUES ('$txbmasofmas_name',
					NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
		}else if($_POST['submitAdd'] == 'Update'){
			$sql = "UPDATE tb_masofmas_ms SET 
					conf_name='$txbmasofmas_name',
					update_datetime=NOW(),
					update_by='$LoginByUser' 
					WHERE masofmas_id = '$masofmas_id'";
		}else{
			$sql="";
		}
		$result = mysqli_query($_SESSION['conn'] ,$sql);

		if(!$result) {
			echo "<script>alert('Error: Can not save to database')</script>";
		}else{
			echo "<script>window.location='mas-masofmas.php'</script>";
		} 
	}

	// Delete Action
	if (isset($_GET['hAction']))   {
        $sql = "DELETE FROM tb_masofmas_ms WHERE masofmas_id = '".$_GET['id']."'";
        $result = mysqli_query($_SESSION['conn'] ,$sql);
        if(!$result) {
            echo "<script>alert('Failed to delete.This supplier is already used.!'); window.location='mas-masofmas.php'</script>";
		}
		echo "<script>window.location='mas-masofmas.php'</script>";
    }
?>