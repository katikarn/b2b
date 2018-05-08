<?php
session_start();
include("inc/auth.php");
include("inc/constant.php");
include("inc/connectionToMysql.php");

	if(isset($_POST["submitAdd"]))	{
		if(isset($_POST["agentcountry_id"])){
			$agentcountry_id = $_POST["agentcountry_id"];
		}

        //Variable from the user
			$txbagentcountry_code = $_POST["txbagentcountry_code"];
			$txbagentcountry_name = $_POST["txbagentcountry_name"];
    	$LoginByUser = trim($_SESSION['LoginUser']);

		if($_POST['submitAdd'] == 'Insert'){
			$sql = "INSERT INTO tb_agent_country_mas(agentcountry_code, agentcountry_name, create_datetime, create_by, update_datetime, update_by)
					VALUES ('$txbagentcountry_code','$txbagentcountry_name', NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
		}else if($_POST['submitAdd'] == 'Update'){
			$sql = "UPDATE tb_agent_country_mas SET
					agentcountry_code='$txbagentcountry_code',
					agentcountry_name='$txbagentcountry_name',
					update_datetime=NOW(),
					update_by='$LoginByUser'
					WHERE agentcountry_id= '$agentcountry_id'";
		}else{
			$sql="";
		}
		
		$result = mysqli_query($_SESSION['conn'] ,$sql);

		if(!$result) {
			echo "<script>alert('Error: Can not save to database')</script>";
		}else{
			echo "<script>window.location='mas-countryagent.php'</script>";
		}
	}

	// Delete Action
	if (isset($_GET['hAction']))   {
        $sql = "DELETE FROM tb_agent_country_mas WHERE agentcountry_id = '".$_GET['id']."'";
        $result = mysqli_query($_SESSION['conn'] ,$sql);
        if(!$result) {
            echo "<script>alert('Failed to delete.This supplier is already used.!'); window.location='mas-countryagent.php'</script>";
		}
		echo "<script>window.location='mas-countryagent.php'</script>";
    }
?>
