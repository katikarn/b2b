<?php
session_start();
include("inc/constant.php");
include("inc/connectionToMysql.php");

	if( isset($_POST['submitAdd']) )
	{
		// echo " ok2<br>";
		//Variable from the user
		if(isset($_POST["user_id"])){
			$user_id = $_POST["user_id"];
		}

		$chkuser_status = $_POST["chkuser_status"];
		$lsbuser_type = $_POST["lsbuser_type"];
		$txbusername = $_POST["txbusername"];
		$txbpassword = $_POST["txbpassword"];
		$txbuser_email = $_POST["txbuser_email"];
		$txbuser_remark = $_POST["txbuser_remark"];
		$LoginByUser = trim($_SESSION['LoginUser']);

		if($_POST['submitAdd'] == 'Insert'){
			$sql = "INSERT INTO tb_user_tr (username, password, user_email, user_type, user_status, user_remark,
			create_datetime, create_by, update_datetime, update_by)
			VALUES ('$txbusername','$txbpassword', '$txbuser_email','$lsbuser_type','$chkuser_status','$txbuser_remark',
			NOW(),'$LoginByUser',NOW(),'$LoginByUser')";
		}else if($_POST['submitAdd'] == 'Update'){
			$sql = "UPDATE tb_user_tr SET
			username='$txbusername',
			password='$txbpassword',
			user_email='$txbuser_email',
			user_type='$lsbuser_type',
			user_status='$chkuser_status',
			user_remark='$txbuser_remark',
			update_datetime=NOW(),
			update_by='$LoginByUser'
			WHERE user_id = '$user_id'";
		}
		echo $sql;
		$result = mysqli_query($_SESSION['conn'] ,$sql);
		//echo $result."<br>";

		if(!$result) {
			 echo "<script>alert('Error: Can not save is duplicate')</script>";
		}else{
			  echo "<script>window.location='user.php'</script>";
		}
	}else{
		  	echo "<script>window.location='agent.php'</script>";
  }

	// Delete Action
	if (isset($_GET['hAction']))   {
		if ($_GET['hAction']=='Delete')	{
			$sql = "DELETE FROM tb_agent_tr WHERE agent_id = '".$_GET['id']."'";
			$result = mysqli_query($_SESSION['conn'] ,$sql);
			if(!$result) {
				echo "<script>alert('Failed to delete.This is already used.!'); window.location='agent.php'</script>";
			}
			echo "<script>window.location='agent.php'</script>";
		}
    }
?>







<!-- <?php
session_start();
include("inc/constant.php");
include("inc/connectionToMysql.php");

	if( isset($_POST['submitAddBooking']) ){
		// echo " ok2<br>";
		//Variable from the user
		if(isset($_POST["agent_id"])){
			$user_id = $_POST["agent_id"];
		} // if(isset($_POST["id"])){


			//รับค่า POST จาก input (Textbox) มาเก็บไว้ในตัวแปร
			$txbagent_name = $_POST["txbagent_name"];
			$txbagent_contact_email = $_POST["txbagent_contact_email"];
			$lsbagentcountry_id = $_POST["lsbagentcountry_id"];
			$lsbagent_section = $_POST["lsbagent_section"];
			$agent_logo_file = $_POST["agent_logo_file"];
			$rdoagent_price_type = $_POST["rdoagent_price_type"];
			$txbagent_contact_name = $_POST["txbagent_contact_name"];
			$txbagent_contact_tel = $_POST["txbagent_contact_tel"];
			$txbagent_contact_line = $_POST["txbagent_contact_line"];
			$txbagent_license = $_POST["txbagent_license"];
			$txbagent_remark = $_POST["txbagent_remark"];
			$txbagent_username = $_POST["txbagent_username"];
			$txbagent_password = $_POST["txbagent_password"];
			$type = $_POST["type"];


			//แสดงค่าที่รับมาจาก input ว่าตัวแปรที่รับมามันมีค่าหรือไม่
			//echo "<b>"."ค่าที่รับมาและเตรียมบันทึกลงฐานข้อมูล"."</b>"."<br>";
			echo $user_id."<br>";
			echo $txbagent_name."<br>";
			echo $txbagent_contact_email."<br>";
			echo $lsbagentcountry_id."<br>";
			echo $lsbagent_section."<br>";
			echo $agent_logo_file."<br>";
			echo $rdoagent_price_type."<br>";
			echo $txbagent_contact_name."<br>";
			echo $txbagent_contact_tel."<br>";
			echo $txbagent_contact_line."<br>";
			echo $txbagent_remark."<br>";
			echo $txbagent_username."<br>";
			echo $txbagent_license."<br>";
			echo $txbagent_password."<br>";
			echo $type."<br>";
			echo "<br>"."<br>"."<hr>";


			if($type == 'add'){ //เอาค่าประเภทที่ส่งผ่านตัวแปรมาตรวจสอบว่ากดปุ่มใดมา Add หรือ Edit

				$sql = "
				INSERT INTO tb_agent_tr (agent_name,agent_contact_email,create_datetime,agentcountry_id)
					VALUE ('$txbagent_name','$txbagent_contact_email',NOW(),'$lsbagentcountry_id')
				";

			}else if($type == 'edit'){

				$sql = "
					UPDATE tb_agent_tr
					SET
						agent_name = '$txbagent_name',
						agent_contact_email = '$txbagent_contact_email',
						update_datetime = NOW(),
						agentcountry_id = '$lsbagentcountry_id'

					WHERE agent_id = '$user_id';

				"; //sql
			} //ปีกกาปิดของ if เช็คประเภทการส่งค่าผ่านปุ่ม

			$result = mysqli_query($conn,$sql); // เก็บค่า connect และค่าของคำสั่ง sql ที่สามารถบันทึกได้


			if($result){ //เช็คว่าบันทึก หรือ update ข้อมูลได้หรือไม่
				//echo "บันทึกข้อมูลเรียบร้อย"; // แสดงค่าเมื่อบันทึกเสร็จเรียบร้อยแล้ว
				echo
					$show_result = "<b>"."<Font size='5' color='GREEN'>"."บันทึกข้อมูลเรียบร้อย"."</Font>"."</b>"."<br>"."$sql";


			}else{
				"ERROR".mysqli_error($conn);
			}




	} // if( isset($_POST['submitAddBooking'])

?> -->
