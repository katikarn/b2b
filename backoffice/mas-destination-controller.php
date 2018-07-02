<?php
	session_start();
	include("inc/auth.php");
	include("inc/constant.php");
	include("inc/connectionToMysql.php");
	$LoginByUser = trim($_SESSION['LoginUser']);

	if(isset($_POST["submitAdd"]))	{
		if(isset($_POST["dest_id"])){
			$dest_id = $_POST["dest_id"];
		}
        //Variable from the user
		$txbdest_name = $_POST["txbdest_name"];
		$lsbdestcoun_id = $_POST["lsbdestcoun_id"];
		$txbdest_desc = $_POST["txbdest_desc"];
    	
		if($_POST['submitAdd'] == 'Insert'){
			$sql = "INSERT INTO tb_dest_ms(dest_name, destcoun_id, dest_desc, 
								create_datetime, create_by, update_datetime, update_by)
					VALUES ('$txbdest_name', '$lsbdestcoun_id', '$txbdest_desc', 
								NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
		}else if($_POST['submitAdd'] == 'Update'){
			$sql = "UPDATE tb_dest_ms SET
							dest_name='$txbdest_name',
							destcoun_id='$lsbdestcoun_id',
							dest_desc='$txbdest_desc',
							update_datetime=NOW(),
							update_by='$LoginByUser'
					WHERE dest_id= '$dest_id'";
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
		if ($_GET['hAction']=="Delete")	{
			$sql = "DELETE FROM tb_dest_ms WHERE dest_id = '".$_GET['id']."'";
			$result = mysqli_query($_SESSION['conn'] ,$sql);
			if(!$result) {
				echo "<script>alert('Failed to delete.This supplier is already used.!'); window.location='mas-destination.php'</script>";
			}
			echo "<script>window.location='mas-destination.php'</script>";
		}
    }
?>
