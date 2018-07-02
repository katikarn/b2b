<?php
session_start();
include('inc/auth.php');
include("inc/constant.php");
include("inc/connectionToMysql.php");
//Session Value
$LoginByUser = trim($_SESSION['LoginUser']);

	if(isset($_POST['id']))	{
		if($_POST["id"]<>"")	{
			$id = $_POST["id"];
		}else{
			$id = "";
		}
		$txbagent_name = $_POST["txbagent_name"];
		$txbagent_contact_email = $_POST["txbagent_contact_email"];
		$lsbagentcountry_id = $_POST["lsbagentcountry_id"];
		$lsbagent_section = $_POST["lsbagent_section"];
		$rdoagent_price_type = $_POST["rdoagent_price_type"];
		$txbagent_contact_name = $_POST["txbagent_contact_name"];
		$txbagent_contact_tel = $_POST["txbagent_contact_tel"];
		$txbagent_contact_line = $_POST["txbagent_contact_line"];
		$txbagent_license = $_POST["txbagent_license"];
		$txbagent_remark = $_POST["txbagent_remark"];
		$txbagent_username = $_POST["txbagent_username"];
		$txbagent_password = $_POST["txbagent_password"];
		$chkagent_status = $_POST["chkagent_status"];
		//File = Logo File
		$agent_logo_file = $_FILES["txbagent_logo_file"]["name"];
		$Text_agent_logo_file = $_POST["Text_agent_logo_file"];
		//Upload File
		$target_file = $path_folder_Agent.basename($_FILES["txbagent_logo_file"]["name"]);
        $file_status_1 = '';
		if($agent_logo_file != '' && $agent_logo_file != null){
			if (file_exists($target_file)) {
				$file_status_1 .="Sorry, file already exists.";
			}else{
				if (move_uploaded_file($_FILES["txbagent_logo_file"]["tmp_name"], $target_file)) {
					$file_status_1 .= "The file ". basename( $_FILES["txbagent_logo_file"]["name"]). " has been uploaded.";
				} else {
					$file_status_1 .= "Sorry, there was an error uploading your file.";
				}
			}
		}else{
			$file_status_1 .="No have upload.";
		}
		//File = License File
		$agent_license_file = $_FILES["txbagent_license_file"]["name"];
		$Text_agent_license_file = $_POST["Text_agent_license_file"];
		//Upload File
		$target_file = $path_folder_Agent.basename($_FILES["txbagent_license_file"]["name"]);
        $file_status_2 = '';
		if($agent_license_file != '' && $agent_license_file != null){
			if (file_exists($target_file)) {
				$file_status_2 .="Sorry, file already exists.";
			}else{
				if (move_uploaded_file($_FILES["txbagent_license_file"]["tmp_name"], $target_file)) {
					$file_status_2 .= "The file ". basename( $_FILES["txbagent_license_file"]["name"]). " has been uploaded.";
				} else {
					$file_status_2 .= "Sorry, there was an error uploading your file.";
				}
			}
		}else{
			$file_status_2 .="No have upload.";
		}

        if($agent_logo_file != '' || $agent_license_file != '')	{
            echo "<script>alert('1. Logo Files : ".$file_status_1;
            echo "\\n2. License File : ".$file_status_2;
            echo "');</script>";
		}

		if($id == ''){

			$sql = "INSERT INTO tb_agent_tr (agent_status, agent_name, agentcountry_id, agent_contact_name, agent_contact_tel, agent_contact_email, 
								agent_contact_line, agent_license, agent_license_file, agent_section, agent_logo_file, agent_username, 
								agent_password, agent_price_type, agent_remark, create_datetime, create_by, update_datetime, update_by) 
					VALUES ('$chkagent_status', '$txbagent_name', '$lsbagentcountry_id', '$txbagent_contact_name', '$txbagent_contact_tel', '$txbagent_contact_email', 
								'$txbagent_contact_line', '$txbagent_license', '$agent_license_file', '$lsbagent_section', '$agent_logo_file', '$txbagent_username', 
								'$txbagent_password', '$rdoagent_price_type', '$txbagent_remark', NOW(),'$LoginByUser',NOW(),'$LoginByUser')";
		}else if($id <> ''){
			//Delete old file 1
			if (($agent_logo_file == "") && ($Text_agent_logo_file<>""))	{
				$agent_logo_file = $Text_agent_logo_file;
			}else if (($agent_logo_file <> $Text_agent_logo_file) && ($Text_agent_logo_file<>""))	{
				unlink($path_folder_Agent.$Text_agent_logo_file);
			}
			//Delete old file 2
			if (($agent_license_file == "") && ($Text_agent_license_file<>""))	{
				$agent_license_file = $Text_agent_license_file;
			}else if (($agent_license_file <> $Text_agent_license_file) && ($Text_agent_license_file<>""))	{
				unlink($path_folder_Agent.$Text_agent_license_file);
			}
			
			$sql = "UPDATE tb_agent_tr SET
							agent_status = '$chkagent_status',
							agent_name = '$txbagent_name', 
							agentcountry_id = '$lsbagentcountry_id', 
							agent_contact_name = '$txbagent_contact_name', 
							agent_contact_tel = '$txbagent_contact_tel', 
							agent_contact_email = '$txbagent_contact_email', 
							agent_contact_line = '$txbagent_contact_line', 
							agent_license = '$txbagent_license', 
							agent_license_file = '$agent_license_file', 
							agent_section = '$lsbagent_section', 
							agent_logo_file = '$agent_logo_file', 
							agent_username = '$txbagent_username', 
							agent_password = '$txbagent_password', 
							agent_price_type = '$rdoagent_price_type', 
							agent_remark = '$txbagent_remark', 
							update_datetime = NOW(),
							update_by = '$LoginByUser'
					WHERE agent_id = '$id'";
		}
		$result = mysqli_query($_SESSION['conn'] ,$sql);
		//echo $result."<br>";
		if(!$result) {
			 echo "<script>alert('Error: Can not save is duplicate')</script>";
		}else{
			  echo "<script>window.location='agent.php'</script>";
		}
	}

	// Delete Action
	if (isset($_GET['hAction']))   {
		if ($_GET['hAction']=='Delete')	{
			//Delete File
			$sql = "SELECT agent_license_file, agent_logo_file FROM tb_agent_tr WHERE agent_id = '".$_GET['id']."'";
			$result = mysqli_query($conn ,$sql);
			$row = mysqli_fetch_assoc($result);
			if ($row['agent_license_file']<>"")	{
				unlink($path_folder_Agent.$row['agent_license_file']);
			}
			if ($row['agent_logo_file']<>"")	{
				unlink($path_folder_Agent.$row['agent_logo_file']);
			}
			//Delete Record
			$sql = "DELETE FROM tb_agent_tr WHERE agent_id = '".$_GET['id']."'";
			$result = mysqli_query($_SESSION['conn'] ,$sql);
			if(!$result) {
				echo "<script>alert('Failed to delete.This is already used.!'); window.location='agent.php'</script>";
			}
			echo "<script>window.location='agent.php'</script>";
		}
	}
	
	// Approve Action
	if (isset($_GET['hAction']))   {
		if ($_GET['hAction']=='Approve')	{
			//Delete Record
			$sql = "UPDATE tb_agent_tr SET agent_status='A' WHERE agent_id = '".$_GET['id']."'";
			$result = mysqli_query($_SESSION['conn'] ,$sql);
		}
		echo "<script>window.location='agent-status.php'</script>";
	}
	// Approve Action
	if (isset($_GET['hAction']))   {
		if ($_GET['hAction']=='Unapprove')	{
			//Delete Record
			$sql = "UPDATE tb_agent_tr SET agent_status='U' WHERE agent_id = '".$_GET['id']."'";
			$result = mysqli_query($_SESSION['conn'] ,$sql);
		}
		echo "<script>window.location='agent-status.php'</script>";
	}
?>