<?php
	if(isset($_POST["submitAddDayoff"]))	{
		if(isset($_POST["dayoff_id"])){
			$dayoff_id = $_POST["dayoff_id"];
		}
        //Variable from the user
        $lsbsupplier_id = $_POST["lsbsupplier_id"];
        $txbdayoff_date = $_POST["txbdayoff_date"];
        $txbdayoff_remark = $_POST["txbdayoff_remark"];
        $LoginByUser = trim($_SESSION['LoginUser']);

		if($_POST['submitAddDayoff'] == 'Insert'){
			$sql = "INSERT INTO supplier_dayoff (supplier_id, dayoff_date, dayoff_remark,
					createdate, createby, updatedate, updateby)
					VALUES ('$lsbsupplier_id','$txbdayoff_date', '$txbdayoff_remark',
					NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
		}else if($_POST['submitAddDayoff'] == 'Update'){
			$sql = "UPDATE supplier_dayoff SET
					supplier_id='$lsbsupplier_id',
					dayoff_date='$txbdayoff_date',
					dayoff_remark='$txbdayoff_remark',
					updatedate=NOW(),
					updateby='$LoginByUser'
					WHERE dayoff_id = '$dayoff_id'";
		}else{
			$sql="";
		}
		$result = mysqli_query($_SESSION['conn'] ,$sql);
		 //echo $result."<br>";

		if(!$result) {
			 echo "<script>alert('Error: Can not save Username is duplicate')</script>";
		}else{
			  echo "<script>window.location='mas-supplier-dayoff.php'</script>";
		}
	}else{
		// echo "not ok";
	}

	if (isset($_GET['hAction']))   {
        $sql = "DELETE FROM supplier_dayoff WHERE dayoff_id = '".$_GET['id']."'";
        $result = mysqli_query($_SESSION['conn'] ,$sql);
        if(!$result) {
					echo "<script>alert('Failed to delete.This is already used.!'); window.location='mas-supplier-dayoff.php'</script>";
				}
				echo "<script>window.location='mas-supplier-dayoff.php'</script>";
			}

	?>
