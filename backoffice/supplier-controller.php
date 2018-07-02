<?php
session_start();
include('inc/auth.php');
include("inc/constant.php");
include("inc/connectionToMysql.php");
//Session Value
$LoginByUser = trim($_SESSION['LoginUser']);

	if(isset($_POST['supplier_id']))	{
		if($_POST["supplier_id"]<>"")	{
			$supplier_id = $_POST["supplier_id"];
		}else{
			$supplier_id = "";
        }
        $_supplier_name = $_POST['txbsupplier_name'];
        $_dest_id = $_POST['lsbdest_id'];
        $_supplier_type = $_POST['lsbsupplier_type'];
        $_supplier_description = $_POST['txbsupplier_description'];
        $_supplier_address = $_POST['txbsupplier_address'];
        $_supplier_googlemap = $_POST['txbsupplier_googlemap'];
        $_supplier_website = $_POST['txbsupplier_website'];
        $_supplier_tel = $_POST['txbsupplier_tel'];
        $_supplier_remark = $_POST['txbsupplier_remark'];
        $_supplier_sales_name = $_POST['txbsupplier_sales_name'];
        $_supplier_sales_tel = $_POST['txbsupplier_sales_tel'];
        $_supplier_sales_email = $_POST['txbsupplier_sales_email'];
        $_supplier_sales_line = $_POST['txbsupplier_sales_line'];
        $_supplier_reserv_name = $_POST['txbsupplier_reserv_name'];
        $_supplier_reserv_email = $_POST['txbsupplier_reserv_email'];
        $_supplier_reserv_tel = $_POST['txbsupplier_reserv_tel'];
        $_supplier_reserv_fax = $_POST['txbsupplier_reserv_fax'];
        $_supplier_reserv_line = $_POST['txbsupplier_reserv_line'];
        $_supplier_account_name = $_POST['txbsupplier_account_name'];
        $_supplier_account_tel = $_POST['txbsupplier_account_tel'];
        $_supplier_account_email = $_POST['txbsupplier_account_email'];
        $_supplier_name_acc = $_POST['txbsupplier_name_acc'];
        $_supplier_status = $_POST['chksupplier_status'];
        $_supplier_open = $_POST['txbsupplier_open'];
        $_supplier_close = $_POST['txbsupplier_close'];
        $_supplier_operate_remark = $_POST['txbsupplier_operate_remark'];
		//File = Logo File
		$supplier_logo_file = $_FILES["txbsupplier_logo_file"]["name"];
		$Text_supplier_logo_file = $_POST["Text_supplier_logo_file"];
		$target_file = $path_folder_Supplier.basename($_FILES["txbsupplier_logo_file"]["name"]);
        $file_status_1 = '';
		if($supplier_logo_file != '' && $supplier_logo_file != null){
			if (file_exists($target_file)) {
				$file_status_1 .="Sorry, file already exists.";
			}else{
				if (move_uploaded_file($_FILES["txbsupplier_logo_file"]["tmp_name"], $target_file)) {
					$file_status_1 .= "The file ". basename( $_FILES["txbsupplier_logo_file"]["name"]). " has been uploaded.";
				} else {
					$file_status_1 .= "Sorry, there was an error uploading your file.";
				}
			}
		}else{
			$file_status_1 .="No have upload.";
        }
		//File = Brochure_file
		$supplier_brochure_file = $_FILES["txbsupplier_brochure_file"]["name"];
		$Text_supplier_brochure_file = $_POST["Text_supplier_brochure_file"];
		$target_file = $path_folder_Supplier.basename($_FILES["txbsupplier_brochure_file"]["name"]);
        $file_status_2 = '';
		if($supplier_brochure_file != '' && $supplier_brochure_file != null){
			if (file_exists($target_file)) {
				$file_status_2 .="Sorry, file already exists.";
			}else{
				if (move_uploaded_file($_FILES["txbsupplier_brochure_file"]["tmp_name"], $target_file)) {
					$file_status_2 .= "The file ". basename( $_FILES["txbsupplier_brochure_file"]["name"]). " has been uploaded.";
				} else {
					$file_status_2 .= "Sorry, there was an error uploading your file.";
				}
			}
		}else{
			$file_status_2 .="No have upload.";
		}
		//File = other_file
		$supplier_other_file = $_FILES["txbsupplier_other_file"]["name"];
		$Text_supplier_other_file = $_POST["Text_supplier_other_file"];
		$target_file = $path_folder_Supplier.basename($_FILES["txbsupplier_other_file"]["name"]);
        $file_status_3 = '';
		if($supplier_other_file != '' && $supplier_other_file != null){
			if (file_exists($target_file)) {
				$file_status_3 .="Sorry, file already exists.";
			}else{
				if (move_uploaded_file($_FILES["txbsupplier_other_file"]["tmp_name"], $target_file)) {
					$file_status_3 .= "The file ". basename( $_FILES["txbsupplier_other_file"]["name"]). " has been uploaded.";
				} else {
					$file_status_3 .= "Sorry, there was an error uploading your file.";
				}
			}
		}else{
			$file_status_3 .="No have upload.";
        }
        //File = txbsupplier_contract_file
		$supplier_contract_file = $_FILES["txbsupplier_contract_file"]["name"];
		$Text_supplier_contract_file = $_POST["Text_supplier_contract_file"];
		$target_file = $path_folder_Supplier.basename($_FILES["txbsupplier_contract_file"]["name"]);
        $file_status_4 = '';
		if($supplier_contract_file != '' && $supplier_contract_file != null){
			if (file_exists($target_file)) {
				$file_status_4 .="Sorry, file already exists.";
			}else{
				if (move_uploaded_file($_FILES["txbsupplier_contract_file"]["tmp_name"], $target_file)) {
					$file_status_4 .= "The file ". basename( $_FILES["txbsupplier_contract_file"]["name"]). " has been uploaded.";
				} else {
					$file_status_4 .= "Sorry, there was an error uploading your file.";
				}
			}
		}else{
			$file_status_4 .="No have upload.";
        }
        //File = txbsupplier_image1_file
		$supplier_image1_file = $_FILES["txbsupplier_image1_file"]["name"];
		$Text_supplier_image1_file = $_POST["Text_supplier_image1_file"];
		$target_file = $path_folder_Supplier_Image.basename($_FILES["txbsupplier_image1_file"]["name"]);
        $file_status_5 = '';
		if($supplier_image1_file != '' && $supplier_image1_file != null){
			if (file_exists($target_file)) {
				$file_status_5 .="Sorry, file already exists.";
			}else{
				if (move_uploaded_file($_FILES["txbsupplier_image1_file"]["tmp_name"], $target_file)) {
					$file_status_5 .= "The file ". basename( $_FILES["txbsupplier_image1_file"]["name"]). " has been uploaded.";
				} else {
					$file_status_5 .= "Sorry, there was an error uploading your file.";
				}
			}
		}else{
			$file_status_5 .="No have upload.";
        }
        //File = txbsupplier_image2_file
		$supplier_image2_file = $_FILES["txbsupplier_image2_file"]["name"];
		$Text_supplier_image2_file = $_POST["Text_supplier_image2_file"];
		$target_file = $path_folder_Supplier_Image.basename($_FILES["txbsupplier_image2_file"]["name"]);
        $file_status_6 = '';
		if($supplier_image2_file != '' && $supplier_image2_file != null){
			if (file_exists($target_file)) {
				$file_status_6 .="Sorry, file already exists.";
			}else{
				if (move_uploaded_file($_FILES["txbsupplier_image2_file"]["tmp_name"], $target_file)) {
					$file_status_6 .= "The file ". basename( $_FILES["txbsupplier_image2_file"]["name"]). " has been uploaded.";
				} else {
					$file_status_6 .= "Sorry, there was an error uploading your file.";
				}
			}
		}else{
			$file_status_6 .="No have upload.";
        }
        //File = txbsupplier_image3_file
		$supplier_image3_file = $_FILES["txbsupplier_image3_file"]["name"];
		$Text_supplier_image3_file = $_POST["Text_supplier_image3_file"];
		$target_file = $path_folder_Supplier_Image.basename($_FILES["txbsupplier_image3_file"]["name"]);
        $file_status_7 = '';
		if($supplier_image3_file != '' && $supplier_image3_file != null){
			if (file_exists($target_file)) {
				$file_status_7 .="Sorry, file already exists.";
			}else{
				if (move_uploaded_file($_FILES["txbsupplier_image3_file"]["tmp_name"], $target_file)) {
					$file_status_7 .= "The file ". basename( $_FILES["txbsupplier_image3_file"]["name"]). " has been uploaded.";
				} else {
					$file_status_7 .= "Sorry, there was an error uploading your file.";
				}
			}
		}else{
			$file_status_7 .="No have upload.";
        }
        //File = txbsupplier_image4_file
		$supplier_image4_file = $_FILES["txbsupplier_image4_file"]["name"];
		$Text_supplier_image4_file = $_POST["Text_supplier_image4_file"];
		$target_file = $path_folder_Supplier_Image.basename($_FILES["txbsupplier_image4_file"]["name"]);
        $file_status_8 = '';
		if($supplier_image4_file != '' && $supplier_image4_file != null){
			if (file_exists($target_file)) {
				$file_status_8 .="Sorry, file already exists.";
			}else{
				if (move_uploaded_file($_FILES["txbsupplier_image4_file"]["tmp_name"], $target_file)) {
					$file_status_8 .= "The file ". basename( $_FILES["txbsupplier_image4_file"]["name"]). " has been uploaded.";
				} else {
					$file_status_8 .= "Sorry, there was an error uploading your file.";
				}
			}
		}else{
			$file_status_8 .="No have upload.";
        }

        if($supplier_logo_file != '' || $supplier_brochure_file != '' || $supplier_other_file != '' || $supplier_contract_file != '' || $supplier_image1_file != '' || $supplier_image2_file != '' || $supplier_image3_file != '' || $supplier_image4_file != '')	{
            echo "<script>alert('1. Logo Files : ".$file_status_1;
            echo "\\n2. Brochure File : ".$file_status_2;
            echo "\\n3. Other File : ".$file_status_3;
            echo "\\n4. Contract File : ".$file_status_4;
            echo "\\n5. Contract File : ".$file_status_5;
            echo "\\n6. Contract File : ".$file_status_6;
            echo "\\n7. Contract File : ".$file_status_7;
            echo "\\n8. Contract File : ".$file_status_8;
            echo "');</script>";
		}
		if($supplier_id == ''){
			$sql = "INSERT INTO tb_supplier_tr (supplier_status, supplier_type, dest_id, supplier_description, 
                                supplier_name, supplier_name_acc, supplier_address, supplier_tel, supplier_website, 
                                supplier_googlemap, supplier_logo_file, supplier_brochure_file, supplier_other_file, 
                                supplier_sales_name, supplier_sales_tel, supplier_sales_email, supplier_sales_line, 
                                supplier_reserv_name, supplier_reserv_tel, supplier_reserv_email, supplier_reserv_line, 
                                supplier_reserv_fax, supplier_account_name, supplier_account_tel, supplier_account_email, 
                                supplier_remark, create_datetime, create_by, update_datetime, update_by, supplier_open, 
                                supplier_close, supplier_operate_remark,
                                supplier_contract_file, supplier_image1_file, supplier_image2_file, supplier_image3_file, supplier_image4_file)
                    VALUES ('$_supplier_status', '$_supplier_type', '$_dest_id', '$_supplier_description', 
                            '$_supplier_name', '$_supplier_name_acc', '$_supplier_address', '$_supplier_tel', '$_supplier_website',  
                            '$_supplier_googlemap', '$supplier_logo_file', '$supplier_brochure_file', '$supplier_other_file', 
                            '$_supplier_sales_name', '$_supplier_sales_tel', '$_supplier_sales_email', '$_supplier_sales_line', 
                            '$_supplier_reserv_name', '$_supplier_reserv_tel', '$_supplier_reserv_email', '$_supplier_reserv_line', 
                            '$_supplier_reserv_fax', '$_supplier_account_name', '$_supplier_account_tel', '$_supplier_account_email', 
                            '$_supplier_remark', NOW(),'$LoginByUser',NOW(),'$LoginByUser','$_supplier_open', 
                            '$_supplier_close', '$_supplier_operate_remark',
                            '$supplier_contract_file','$supplier_image1_file','$supplier_image2_file','$supplier_image3_file','$supplier_image4_file')";
		}else if($supplier_id <> ''){
			//Delete old Text_supplier_logo_file
			if (($supplier_logo_file == "") && ($Text_supplier_logo_file<>""))	{
				$supplier_logo_file = $Text_supplier_logo_file;
			}else if (($supplier_logo_file <> $Text_supplier_logo_file) && ($Text_supplier_logo_file<>""))	{
				unlink($$path_folder_Supplier.$Text_supplier_logo_file);
            }
			//Delete old Text_supplier_brochure_file
			if (($supplier_brochure_file == "") && ($Text_supplier_brochure_file<>""))	{
				$supplier_brochure_file = $Text_supplier_brochure_file;
			}else if (($supplier_brochure_file <> $Text_supplier_brochure_file) && ($Text_supplier_brochure_file<>""))	{
				unlink($path_folder_Supplier.$Text_supplier_brochure_file);
            }
			//Delete old Text_supplier_other_file
			if (($supplier_other_file == "") && ($Text_supplier_other_file<>""))	{
				$supplier_other_file = $Text_supplier_other_file;
			}else if (($supplier_other_file <> $Text_supplier_other_file) && ($Text_supplier_other_file<>""))	{
				unlink($path_folder_Supplier.$Text_supplier_other_file);
            }
            //Delete old Text_supplier_contract_file
			if (($supplier_contract_file == "") && ($Text_supplier_contract_file<>""))	{
				$supplier_contract_file = $Text_supplier_contract_file;
			}else if (($supplier_contract_file <> $Text_supplier_contract_file) && ($Text_supplier_contract_file<>""))	{
				unlink($path_folder_Supplier.$Text_supplier_contract_file);
            }
            //Delete old Text_supplier_image1_file
			if (($supplier_image1_file == "") && ($Text_supplier_image1_file<>""))	{
				$supplier_image1_file = $Text_supplier_image1_file;
			}else if (($supplier_image1_file <> $Text_supplier_image1_file) && ($Text_supplier_image1_file<>""))	{
				unlink($path_folder_Supplier_Image.$Text_supplier_image1_file);
            }
            //Delete old Text_supplier_image1_file
			if (($supplier_image2_file == "") && ($Text_supplier_image2_file<>""))	{
				$supplier_image2_file = $Text_supplier_image2_file;
			}else if (($supplier_image2_file <> $Text_supplier_image2_file) && ($Text_supplier_image2_file<>""))	{
				unlink($path_folder_Supplier_Image.$Text_supplier_image2_file);
            }
            //Delete old Text_supplier_image1_file
			if (($supplier_image3_file == "") && ($Text_supplier_image3_file<>""))	{
				$supplier_image3_file = $Text_supplier_image3_file;
			}else if (($supplier_image3_file <> $Text_supplier_image3_file) && ($Text_supplier_image3_file<>""))	{
				unlink($path_folder_Supplier_Image.$Text_supplier_image3_file);
            }
            //Delete old Text_supplier_image1_file
			if (($supplier_image4_file == "") && ($Text_supplier_image4_file<>""))	{
				$supplier_image4_file = $Text_supplier_image4_file;
			}else if (($supplier_image4_file <> $Text_supplier_image4_file) && ($Text_supplier_image4_file<>""))	{
				unlink($path_folder_Supplier_Image.$Text_supplier_image4_file);
			}
			$sql = "UPDATE tb_supplier_tr SET
                            supplier_status = '$_supplier_status',
                            supplier_type = '$_supplier_type',
                            dest_id = '$_dest_id',
                            supplier_description = '$_supplier_description',
                            supplier_name = '$_supplier_name',
                            supplier_name_acc = '$_supplier_name_acc',
                            supplier_address = '$_supplier_address',
                            supplier_tel = '$_supplier_tel',
                            supplier_website = '$_supplier_website',
                            supplier_googlemap = '$_supplier_googlemap',
                            supplier_logo_file = '$supplier_logo_file',
                            supplier_brochure_file = '$supplier_brochure_file',
                            supplier_other_file = '$supplier_other_file',
                            supplier_sales_name = '$_supplier_sales_name',
                            supplier_sales_tel = '$_supplier_sales_tel',
                            supplier_sales_email = '$_supplier_sales_email',
                            supplier_sales_line = '$_supplier_sales_line',
                            supplier_reserv_name = '$_supplier_reserv_name',
                            supplier_reserv_tel = '$_supplier_reserv_tel',
                            supplier_reserv_email = '$_supplier_reserv_email',
                            supplier_reserv_line = '$_supplier_reserv_line',
                            supplier_reserv_fax = '$_supplier_reserv_fax',
                            supplier_account_name = '$_supplier_account_name',
                            supplier_account_tel = '$_supplier_account_tel',
                            supplier_account_email = '$_supplier_account_email',
                            supplier_remark = '$_supplier_remark',
                            update_datetime = NOW(),
                            update_by = '$LoginByUser',
                            supplier_open = '$_supplier_open',
                            supplier_close = '$_supplier_close',
                            supplier_operate_remark = '$_supplier_operate_remark',
                            supplier_contract_file = '$supplier_contract_file',
                            supplier_image1_file = '$supplier_image1_file',
                            supplier_image2_file = '$supplier_image2_file',
                            supplier_image3_file = '$supplier_image3_file',
                            supplier_image4_file = '$supplier_image4_file'
					WHERE supplier_id = '$supplier_id'";
        }
        echo $sql;
		$result = mysqli_query($_SESSION['conn'] ,$sql);
        if(!$result) {
            echo "<script>alert('Error: Can not save is duplicate')</script>";
        }else{
            echo "<script>window.location='supplier.php'</script>";
        }
	}
    // Delete Action
    if (isset($_GET['hAction']))   {
        if ($_GET['hAction']=='Delete')	{
            //Delete File
            $sql = "SELECT  supplier_logo_file, supplier_brochure_file, supplier_other_file, 
                            supplier_contract_file, supplier_image1_file, supplier_image2_file, supplier_image3_file, supplier_image4_file
                    FROM tb_supplier_tr WHERE supplier_id = '".$_GET['supplier_id']."'";
            echo $sql;
            $result = mysqli_query($conn ,$sql);
            $row = mysqli_fetch_assoc($result);
            if ($row['supplier_logo_file']<>"")	{
                unlink($path_folder_Supplier.$row['supplier_logo_file']);
            }
            if ($row['supplier_brochure_file']<>"")	{
                unlink($path_folder_Supplier.$row['supplier_brochure_file']);
            }
            if ($row['supplier_other_file']<>"")	{
                unlink($path_folder_Supplier.$row['supplier_other_file']);
            }
            if ($row['supplier_contract_file']<>"")	{
                unlink($path_folder_Supplier.$row['supplier_contract_file']);
            }
            if ($row['supplier_image1_file']<>"")	{
                unlink($path_folder_Supplier_Image.$row['supplier_image1_file']);
            }
            if ($row['supplier_image2_file']<>"")	{
                unlink($path_folder_Supplier_Image.$row['supplier_image2_file']);
            }
            if ($row['supplier_image3_file']<>"")	{
                unlink($path_folder_Supplier_Image.$row['supplier_image3_file']);
            }
            if ($row['supplier_image4_file']<>"")	{
                unlink($path_folder_Supplier_Image.$row['supplier_image4_file']);
            }
            //Delete Record
            $sql = "DELETE FROM tb_supplier_tr WHERE supplier_id = '".$_GET['supplier_id']."'";
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            if(!$result) {
                echo "<script>alert('Failed to delete.This is already used.!'); window.location='agent.php'</script>";
            }
            echo "<script>window.location='supplier.php'</script>";
        }
    }
?>