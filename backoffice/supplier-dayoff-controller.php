<?php
	session_start();
	include('inc/auth.php');
	include("inc/constant.php");
    include("inc/connectionToMysql.php");

	if(isset($_POST["dayoff_id"])){
		$dayoff_id = $_POST["dayoff_id"];
        $lsbsupplier_id = $_POST["lsbsupplier_id"];
        $txbdayoff_date = $_POST["txbdayoff_date"];
        $txbdayoff_remark = $_POST["txbdayoff_remark"];
        $LoginByUser = trim($_SESSION['LoginUser']);

		if($dayoff_id <> ""){
			$sql = "UPDATE tb_supplier_dayoff_tr SET
					dayoff_date='$txbdayoff_date',
					dayoff_remark='$txbdayoff_remark',
					update_datetime=NOW(),
					update_by='$LoginByUser'
                    WHERE dayoff_id = '$dayoff_id'";
        }else{       
			$sql = "INSERT INTO tb_supplier_dayoff_tr (supplier_id, dayoff_date, dayoff_remark,
					create_datetime, create_by, update_datetime, update_by)
					VALUES ('$lsbsupplier_id','$txbdayoff_date', '$txbdayoff_remark',
					NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
        }
		$result = mysqli_query($_SESSION['conn'] ,$sql);
		 //echo $result."<br>";
		if(!$result) {
			 echo "<script>alert('Error: Can not save is duplicate')</script>";
		}else{
			  echo "<script>window.location='supplier-dayoff.php?supplier_id=$lsbsupplier_id'</script>";
		}
	}

	if (isset($_GET['hAction']))   {
        if ($_GET['hAction']=="delete") {
            $sql = "DELETE FROM tb_supplier_dayoff_tr WHERE dayoff_id = '".$_GET['id']."'";
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            if(!$result) {
                echo "<script>alert('Failed to delete.This is already used.!'); window.location='mas-supplier-dayoff.php'</script>";
            }
        }
		echo "<script>window.location='supplier-dayoff.php?supplier_id=".$_GET['lsbsupplier_id']."'</script>";
	}
?>