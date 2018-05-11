<?php
session_start();
include("inc/auth.php");
include("inc/constant.php");
include("inc/connectionToMysql.php");

	if(isset($_POST["submitAdd"]))	{
		if(isset($_POST["destcoun_id"])){
			$destcoun_id = $_POST["destcoun_id"];
		}

		//Variable from the user
	$txbdestcoun_name = $_POST["txbdestcoun_name"];
	$txbdestcoun_code = $_POST["txbdestcoun_code"];
	$LoginByUser = trim($_SESSION['LoginUser']);

if($_POST['submitAdd'] == 'Insert'){
	$sql = "INSERT INTO tb_dest_country_ms(destcoun_name, destcoun_id, create_datetime, create_by, update_datetime, update_by)
			VALUES ('$txbdestcoun_name','$lsbdestcoun_id', NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
}else if($_POST['submitAdd'] == 'Update'){
	$sql = "UPDATE tb_dest_country_ms SET
			destcoun_name='$txbdestcoun_name',
			destcoun_code='$txbdestcoun_code',
			update_datetime=NOW(),
			update_by='$LoginByUser'
			WHERE destcoun_code= '$txbdestcoun_code'";
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
        $sql = "DELETE FROM tb_dest_country_ms WHERE destcoun_id = '".$_GET['id']."'";
        $result = mysqli_query($_SESSION['conn'] ,$sql);
        if(!$result) {
         echo "<script>alert('Failed to delete.This supplier is already used.!'); window.location='mas-countrydestination.php'</script>";
		}
					echo "<script>window.location='mas-countrydestination.php'</script>";
    }
?>
