<?php
	session_start();
	include("inc/auth.php");
	include("inc/constant.php");
    include("inc/connectionToMysql.php");
    
	if (isset($_POST["supplier_id"]))   {
        if (isset($_POST["product_id"]))    {
            $_product_id = $_POST["product_id"];
            $_supplier_id = $_POST["supplier_id"];
            $_product_status = $_POST["chkproduct_status"];
            $_product_name = $_POST["txbproduct_name"];
            $_product_desc = $_POST["txbproduct_desc"];
            $_product_seattype = $_POST["chkproduct_seattype"];
            $_product_transporttype = $_POST["chkproduct_transporttype"];
            $_product_duration = $_POST["txbproduct_duration"];
            $_product_fixedtime = $_POST["chkproduct_fixedtime"];
            $LoginByUser = trim($_SESSION['LoginUser']);
            
            if($_product_id <> '')  {
                $sql = "UPDATE tb_product_tr SET 
                            product_status = '$_product_status', 
                            product_name = '$_product_name',
                            product_desc = '$_product_desc',
                            product_seattype = '$_product_seattype', 
                            product_transporttype = '$_product_transporttype',
                            product_fixedtime = '$_product_fixedtime', 
                            product_duration = '$_product_duration',
                            update_datetime = NOW(),
                            update_by = '$LoginByUser'
                    WHERE product_id = '$_product_id'";
                $sql2="";
            }else{
                $sql = "INSERT INTO tb_product_tr (supplier_id, product_status, product_name, product_desc, 
                                    product_seattype, product_transporttype, product_fixedtime, product_duration,
                                    create_datetime, create_by, update_datetime, update_by) 
                        VALUES ('$_supplier_id', '$_product_status', '$_product_name', '$_product_desc',
                '$_product_seattype', '$_product_transporttype', '$_product_fixedtime', '$_product_duration', 
                    NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
                $sql2 = "SELECT max(product_id) AS iMax FROM tb_product_tr";
            }
            if ($sql<>"")   {
                $result = mysqli_query($_SESSION['conn'] ,$sql);
                if ($sql2<>'')  {
                    $result = mysqli_query($_SESSION['conn'] ,$sql2);
                    mysqli_num_rows($result);
                    $row = mysqli_fetch_assoc($result);
                    $_product_id = $row['iMax'];
                }
                header("location: product-a-addedit.php?supplier_id=$_supplier_id&product_id=$_product_id");
            }
        }
    }
	
    // Delete Action
    if (isset($_GET['hAction']))   {
        if ($_GET['hAction']=='delete')     {
            $sql = "DELETE FROM tb_product_tr WHERE product_id = '".$_GET['product_id']."'";
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            if(!$result) {
                echo "<script>alert('Failed to delete.This product is already used.!'); window.location='product.php?supplier_id=$_supplier_id'</script>";
            }
        }
    }
?>