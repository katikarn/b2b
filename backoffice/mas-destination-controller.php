<?php
session_start();
include("inc/auth.php");
include("inc/constant.php");
include("inc/connectionToMysql.php");

	if(isset($_POST["submitAdd"]))	{
		if(isset($_POST["dest_id"])){
			$agentcountry_id = $_POST["dest_id"];
		}

        //Variable from the user
			$txbdest_name = $_POST["txbdest_name"];
			$lsbdest_id = $_POST["lsbdest_id"];
    	$LoginByUser = trim($_SESSION['LoginUser']);

		if($_POST['submitAdd'] == 'Insert'){
			$sql = "INSERT INTO tb_dest_ms(dest_name, destcoun_id, create_datetime, create_by, update_datetime, update_by)
					VALUES ('$txbdest_name','$lsbdest_id', NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
		}else if($_POST['submitAdd'] == 'Update'){
			$sql = "UPDATE tb_dest_ms SET
					dest_name='$txbdest_name',
					dest_id='$lsbdest_id',
					update_datetime=NOW(),
					update_by='$LoginByUser'
					WHERE dest_id= '$lsbdest_id'";
		}else{
			$sql="";
		}

		$result = mysqli_query($_SESSION['conn'] ,$sql);

		if(!$result) {
			echo "<script>alert('Error: Can not save to database')</script>";
		}else{
			echo "<script>window.location='mas-destination.php'</script>";
		}
	}

	// Delete Action
	if (isset($_GET['hAction']))   {
        $sql = "DELETE FROM tb_dest_ms WHERE dest_id = '".$_GET['id']."'";
        $result = mysqli_query($_SESSION['conn'] ,$sql);
        if(!$result) {
           echo "<script>alert('Failed to delete.This supplier is already used.!'); window.location='mas-destination.php'</script>";
		}
		echo "<script>window.location='mas-destination.php'</script>";
    }
?>
