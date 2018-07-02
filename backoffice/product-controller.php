<?php
	if(isset($_POST["product_id"])) {
		$product_id = $_POST["product_id"];
    }
	//Variable from the user
	$_supplier_id = $_POST["supplier_id"];
	$_product_status = $_POST["lsbsupplier_id"];
	$_product_name = $_POST["txbproduct_name"];
	$_product_desc = $_POST["txbproduct_desc"];
	$_product_seattype = $_POST["chkproduct_seattype"];
	$_product_transporttype = $_POST["chkproduct_transporttype"];
	$_product_duration = $_POST["txbproduct_duration"];
	$_product_fixedtime = $_POST["chkproduct_fixedtime"];
	$LoginByUser = trim($_SESSION['LoginUser']);
	
	if($product_id == '')  {
		$sql = "INSERT INTO tb_product_tr (supplier_id, product_status, product_name, product_desc, 
           					product_seattype, product_transporttype, product_fixedtime, product_duration,
		   					create_datetime, create_by, update_datetime, update_by) 
		   		VALUES ('$_supplier_id', '$_product_status', '$_product_name', '$_product_desc',
           '$_product_seattype', '$_product_transporttype', '$_product_fixedtime', '$_product_duration', 
			NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
	}else if($product_id <> '')  {
        $sql = "UPDATE tb_product_tr SET 
					product_status = '$_supplier_id', 
					product_name = '$_product_status',
            		product_desc = '$_product_desc',
					product_seattype = '$_product_seattype', 
					product_transporttype = '$_product_transporttype',
            		product_fixedtime = '$_product_fixedtime', 
					product_duration = '$_product_duration',
					update_datetime = NOW(),
					updateby = '$LoginByUser'
			WHERE product_id = '$product_id'";
	}else {
        $sql = "";
    }
	
	if ($sql<>"")   {
        $result = mysqli_query($_SESSION['conn'] ,$sql);
        if($_POST["submitAddProduct"] == 'Insert') {
            header("location: product-a-addedit.php");
        }
	}
	
    // Delete Action
    if (isset($_GET['hAction']))   {
        $sql = "DELETE FROM tb_product_tr WHERE product_id = '".$_GET['product_id']."'";
        $result = mysqli_query($_SESSION['conn'] ,$sql);
        if(!$result) {
            echo "<script>alert('Failed to delete.This product is already used.!'); window.location='product-a-addedit.php'</script>";
        }
    }
?>