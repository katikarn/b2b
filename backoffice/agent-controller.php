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
		 echo "not ok";
    }
?>