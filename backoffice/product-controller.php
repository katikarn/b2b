<?php
	if( isset($_POST["submitAddProduct"]) )	{
        if(isset($_POST["product_id"])) {
			$product_id = $_POST["product_id"];
        }
        //Variable from the user
        $supplier_id = $_POST["lsbsupplier_id"];
        $product_status = $_POST["chkproduct_status"];
        $product_name = $_POST["txbproduct_name"];
        $product_desc = $_POST["txbproduct_desc"];
        $product_detail = $_POST["txbproduct_detail"];
        $product_confirm_class = $_POST["chkproduct_confirm_class"];
        $product_seat = $_POST["chkproduct_seat"];
        $product_for = $_POST["chkproduct_for"];
		$product_showtime = $_POST["txbproduct_showtime"];
		$product_starttime = $_POST["txbproduct_starttime"];
        $product_endtime = $_POST["txbproduct_endtime"];
        $product_duration = $_POST["txbproduct_duration"];
        $product_car_type = $_POST["lsbproduct_car_type"];
        $product_meal_type = $_POST["lsbproduct_meal_type"];
        $product_cost_price = $_POST["txbproduct_cost_price"];
        $product_normal_price = $_POST["txbproduct_normal_price"];
        $product_oversea_price = $_POST["txbproduct_oversea_price"];
        $product_price_l1 = $_POST["txbproduct_price_l1"];
        $product_price_l2 = $_POST["txbproduct_price_l2"];
        $product_remark = $_POST["txbproduct_remark"];
        $LoginByUser = trim($_SESSION['LoginUser']);

		//////////// Attach File ////////////
		$Text_txbproduct_file1 = $_POST["Text_txbproduct_file1"];
		$Text_txbproduct_file2 = $_POST["Text_txbproduct_file2"];
		$Text_txbproduct_file3 = $_POST["Text_txbproduct_file3"];
		
        $product_file1 = $_FILES["txbproduct_file1"]["name"];
        $product_file2 = $_FILES["txbproduct_file2"]["name"];
        $product_file3 = $_FILES["txbproduct_file3"]["name"];
		//echo "Input File : ".$_FILES["txbproduct_file1"]["name"]."<br>";
		//echo "Input Text_txbproduct_file1 : ".$Text_txbproduct_file1."<br>";
		
		//////////// upload file ////////////
		$target_dir = "upload/product/";
        //echo "Input File : ".$_FILES["txbproduct_file1"]["name"]."<br>";
        //echo "Input Text_contract_file : ".$Text_contract_file."<br>";
        $target_file1 = $target_dir . basename($_FILES["txbproduct_file1"]["name"]);
		$target_file2 = $target_dir . basename($_FILES["txbproduct_file2"]["name"]);
		$target_file3 = $target_dir . basename($_FILES["txbproduct_file3"]["name"]);
        $uploadOk_file1 = 1;
		$uploadOk_file2 = 1;
		$uploadOk_file3 = 1;
        $Status_file1 = '';
		$Status_file2 = '';
		$Status_file3 = '';
		if($product_file1 != '' && $product_file1 != null){
			//////////// Check if file already exists //////////// 
			if (file_exists($target_file1)) {
				$Status_file1 .="Sorry, file already exists.";
				$uploadOk_file1 = 0;
			}
			//////////// Check if $uploadOk_file1 is set to 0 by an error //////////// 
			if ($uploadOk_file1 == 0) {
				$Status_file1 .="Sorry, your file was not uploaded.";
			//////////// if everything is ok, try to upload file //////////// 
			} else {
				if (move_uploaded_file($_FILES["txbproduct_file1"]["tmp_name"], $target_file1)) {
					$Status_file1 .= "The file ". basename( $_FILES["txbproduct_file1"]["name"]). " has been uploaded.";
					$uploadOk_file1 = 2;
				} else {
					//echo "Sorry, there was an error uploading your file.";
					$Status_file1 .= "Sorry, there was an error uploading your file.";
				}
			}
		}else{
			$Status_file1 .="No have upload.";
		}
		if($product_file2 != '' && $product_file2 != null){
			//////////// Check if file already exists //////////// 
			if (file_exists($target_file2)) {
				$Status_file2 .="Sorry, file already exists.";
				$uploadOk_file2 = 0;
			}
			//////////// Check if $uploadOk_file2 is set to 0 by an error //////////// 
			if ($uploadOk_file2 == 0) {
				$Status_file2 .="Sorry, your file was not uploaded.";
			//////////// if everything is ok, try to upload file //////////// 
			} else {
				if (move_uploaded_file($_FILES["txbproduct_file2"]["tmp_name"], $target_file2)) {
					$Status_file2 .= "The file ". basename( $_FILES["txbproduct_file2"]["name"]). " has been uploaded.";
					$uploadOk_file2 = 2;
				} else {
					//echo "Sorry, there was an error uploading your file.";
					$Status_file2 .= "Sorry, there was an error uploading your file.";
				}
			}
		}else{
			$Status_file2 .="No have upload.";
		}
		if($product_file3 != '' && $product_file3 != null){
			//////////// Check if file already exists //////////// 
			if (file_exists($target_file3)) {
				$Status_file3 .="Sorry, file already exists.";
				$uploadOk_file3 = 0;
			}
			//////////// Check if $uploadOk_file3 is set to 0 by an error //////////// 
			if ($uploadOk_file3 == 0) {
				$Status_file3 .="Sorry, your file was not uploaded.";
			//////////// if everything is ok, try to upload file //////////// 
			} else {
				if (move_uploaded_file($_FILES["txbproduct_file3"]["tmp_name"], $target_file3)) {
					$Status_file3 .= "The file ". basename( $_FILES["txbproduct_file3"]["name"]). " has been uploaded.";
					$uploadOk_file3 = 2;
				} else {
					//echo "Sorry, there was an error uploading your file.";
					$Status_file3 .= "Sorry, there was an error uploading your file.";
				}
			}
		}else{
			$Status_file3 .="No have upload.";
		}
		if($product_file1 != '' || $product_file2 != '' || $product_file3 != ''){
			echo "<script>alert('File1 : \\n".$Status_file1."\\nFile2 : \\n".$Status_file2."\\nFile3 : \\n".$Status_file3."');</script>";
		}

		if($_POST["submitAddProduct"] == 'Insert')  {
			$sql = "INSERT INTO `product` (`supplier_id`, `product_status`, `product_name`, `product_desc`, 
            `product_detail`, `product_file1`, `product_file2`, `product_file3`, `product_confirm_class`, 
            `product_seat`, `product_for`, `product_showtime`, `product_starttime`, `product_endtime`, `product_duration`, `product_car_type`, 
            `product_meal_type`, `product_cost_price`, `product_normal_price`, `product_oversea_price`, 
            `product_price_l1`, `product_price_l2`, `product_remark`, `createdatetime`, `createby`, `updatedatetime`, 
            `updateby`) VALUES ('$supplier_id', '$product_status', '$product_name', '$product_desc',
            '$product_detail', '$product_file1', '$product_file2', '$product_file3', '$product_confirm_class', 
            '$product_seat', '$product_for', '$product_showtime', '$product_starttime', '$product_endtime', '$product_duration', '$product_car_type', 
            '$product_meal_type', '$product_cost_price', '$product_normal_price', '$product_oversea_price', 
            '$product_price_l1', '$product_price_l2', '$product_remark', NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
		}else if($_POST["submitAddProduct"] == 'Update')  {
			//////////// upload file 1 ////////////
			if($product_file1 == null && $Text_txbproduct_file1 != '' ){
                $product_file1 = $Text_txbproduct_file1;
            }else if($product_file1 != '' && $Text_txbproduct_file1 != '' 
                && $product_file1 != $Text_txbproduct_file1 && $uploadOk_file1 == 2){
                unlink($target_dir.$Text_txbproduct_file1);
            }else if($uploadOk_file1 != 2){
                $product_file1 = $Text_txbproduct_file1;
            }
            //////////// upload file 2 ////////////
            if($product_file2 == null && $Text_txbproduct_file2 != ''){
                $product_file2 = $Text_txbproduct_file2;
            }else if($product_file2 != '' && $Text_txbproduct_file2 != '' 
                    && $product_file2 != $Text_txbproduct_file2 && $uploadOk_file2 == 2){
                unlink($target_dir.$Text_txbproduct_file2);
            }else if($uploadOk_file2 != 2){
                $product_file2 = $Text_txbproduct_file2;
            }
			//////////// upload file 3 ////////////
			if($product_file3 == null && $Text_txbproduct_file3 != ''){
                $product_file3 = $Text_txbproduct_file3;
            }else if($product_file3 != '' && $Text_txbproduct_file3 != '' 
                    && $product_file3 != $Text_txbproduct_file3 && $uploadOk_file2 == 2){
                unlink($target_dir.$Text_txbproduct_file3);
            }else if($uploadOk_file2 != 2){
                $product_file3 = $Text_txbproduct_file3;
            }

            $sql = "UPDATE `product` SET `supplier_id`='$supplier_id', `product_status`='$product_status', 
            `product_name`='$product_name', `product_desc`='$product_desc', `product_detail`='$product_detail',
            `product_file1`='$product_file1', `product_file2`='$product_file2', `product_file3`='$product_file3', 
            `product_confirm_class`='$product_confirm_class', `product_seat`='$product_seat', `product_for`='$product_for', 
            `product_showtime`='$product_showtime', `product_starttime`='$product_starttime', `product_endtime`='$product_endtime', `product_duration`='$product_duration', 
            `product_car_type`='$product_car_type', `product_meal_type`='$product_meal_type', `product_cost_price`='$product_cost_price', 
            `product_normal_price`='$product_normal_price', `product_oversea_price`='$product_oversea_price', `product_price_l1`='$product_price_l1', 
            `product_price_l2`='$product_price_l2', `product_remark`='$product_remark', `updatedatetime`=NOW(), `updateby`='$LoginByUser'
			WHERE `product_id` = '$product_id'";
		}else {
            $sql = "";
        }
        if ($sql<>"")   {
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            if($_POST["submitAddProduct"] == 'Insert') {
                header("location: product-setup.php");
            }
		    //echo "result : ".$result."<br>";
		    if(!$result) {
			    //echo "<script>alert('Failed to added.This user is already used.!'); window.location='supplier-management.php'</script>";
		    }else{
			    //echo "<script>alert('User successfully added!'); window.location='supplier-management.php'</script>";
            }
        }
	}else{
		// echo "not ok";
    }
    // Delete Action
    if (isset($_GET['hAction']))   {
        $sql = "DELETE FROM product WHERE product_id = '".$_GET['id']."'";
        $result = mysqli_query($_SESSION['conn'] ,$sql);
        if(!$result) {
            echo "<script>alert('Failed to delete.This product is already used.!'); window.location='product-setup.php'</script>";
        }
    }
?>