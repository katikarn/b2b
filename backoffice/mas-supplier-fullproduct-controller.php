<?php
	if(isset($_POST["submitAddfullproduct"]))	{
		if(isset($_POST["product_id"])){
			$dayoff_id = $_POST["product_id"];
		}
        //Variable from the user
        $lsbproduct_id = $_POST["lsbproduct_id"];
        $txbfull_date = $_POST["txbfull_date"];
        $txbfull_remark = $_POST["txbfull_remark"];
        $LoginByUser = trim($_SESSION['LoginUser']);

		if($_POST['submitAddfullproduct'] == 'Insert'){
			$sql = "INSERT INTO tb_product_full_tr (full_id, product_id, full_date, full_remark,
					createdate, createby, updatedate, updateby)
					VALUES ('$lsbproduct_id','$txbfull_date', '$txbfull_remark',
					NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
		}else if($_POST['submitAddfullproduct'] == 'Update'){
			$sql = "UPDATE tb_product_full_tr SET
				product_id='$lsbproduct_id',
				full_date='$txbfull_date',
				full_remark='$txbfull_remark',
					updatedate=NOW(),
					updateby='$LoginByUser'
					WHERE product_id = '$product_id'";
		}else{
			$sql="";
		}
		$result = mysqli_query($_SESSION['conn'] ,$sql);
		 //echo $result."<br>";

		if(!$result) {
			 echo "<script>alert('Error: Can not save Username is duplicate')</script>";
		}else{
			  echo "<script>window.location='mas-supplier-fullproduct.php'</script>";
		}
	}else{
		// echo "not ok";
	}

	if (isset($_GET['hAction']))   {
        $sql = "DELETE FROM tb_product_full_tr WHERE product_id = '".$_GET['id']."'";
        $result = mysqli_query($_SESSION['conn'] ,$sql);
        if(!$result) {
					echo "<script>alert('Failed to delete.This is already used.!'); window.location='mas-supplier-fullproduct.php'</script>";
				}
				echo "<script>window.location='mas-supplier-fullproduct.php'</script>";
			}

	?>
