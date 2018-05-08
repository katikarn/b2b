<?PHP
session_start();
include("inc/constant.php");
include("inc/connectionToMysql.php");
include("inc/php-audittrail.php");

	if(isset($_POST['submitSignIn']))	{
		$usernameU = trim($_POST['username']);
		$passwordU = trim($_POST['password']);

		$sql = "SELECT user_id, username, password, user_type 
		FROM tb_user_tr
		WHERE username = '$usernameU' 
		AND password = '$passwordU'
		AND user_status = 'A'";
		$result = mysqli_query($_SESSION['conn'] ,$sql);

		if(mysqli_num_rows($result) > 0)	{
		//show data for each row
			while($row = mysqli_fetch_assoc($result))	{

				$_SESSION["LoginUserID"] = $row["user_id"];
				$_SESSION["LoginUser"] = $row["username"];
				$_SESSION["LOginType"] = $row["user_type"];

				// Generate Audit Trail
				$Message = "Username : ".$_SESSION["LoginUser"]." Type : ".$_SESSION["LOginType"];
				Add_Audit_Trail('Login',$Message);

				// Goto Main Page
				header('Location: index.php');
				exit();
			}
		}else{
			session_write_close();
			echo "<script>alert('Username or Password incorrect'); window.location='login.php'</script>";
			//header("location: login.php");
			exit();
		}		
	}else{
		echo "isset false.";
	};
	ob_end_flush();
?>