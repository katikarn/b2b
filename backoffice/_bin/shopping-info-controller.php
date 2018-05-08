<?php
    session_start();
    include('inc/constant.php');
	include('inc/auth.php');
	include("inc/connectionToMysql.php");

    $agent_id = trim($_SESSION["LoginUserID_Agent"]);
    $LoginByUser = trim($_SESSION['LoginUser']);
    $AgentVatType = trim($_SESSION["AgentVatType"]);
    $AgentPayType = trim($_SESSION["AgentPayType"]);
    $AgentPriceType = trim($_SESSION["AgentPriceType"]);

    if (isset($_REQUEST["hAction"])) {
        $hAction = $_REQUEST["hAction"];

        if ($hAction=="Add_P") {
            $product_id = $_POST["product_id"];
            $txbbooking_detail_date = $_POST["txbbooking_detail_date"];
            $txbbooking_detail_time = $_POST["txbbooking_detail_time"];
            $txbbooking_detail_qty = $_POST["txbbooking_detail_qty"];
            $txbbooking_detail_note = $_POST["txbbooking_detail_note"];
            // Find Price
            if ($AgentPriceType=="O")   {
                $product_price = $_POST["product_oversea_price"];
            }else if ($AgentPriceType=="B")   {
                $product_price = $_POST["product_price_l2"];
            }else if ($AgentPriceType=="A")   {
                $product_price = $_POST["product_price_l1"];
            }
            // Find VAT
            if ($AgentVatType=="I") {
                $product_vat = $vat_rate;

            }else{
                $product_vat = 0;
            }
            // Calculate Total Amount
            $total_amount = ($product_price+($product_price*$product_vat/100))*$txbbooking_detail_qty;

            //Add new product from shopping cart
            $sql = "SELECT IFNULL(max(booking_id),0) as m_bid FROM booking WHERE agent_id='$agent_id' AND booking_status='D'";
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            $row = mysqli_fetch_assoc($result);

            if($row['m_bid'] <= 0){
                //Create dummy booking
                $sql = "INSERT INTO booking (agent_id, booking_status, booking_pax, createdatetime, createby, updatedatetime, updateby) 
                        VALUES ('$agent_id', 'D', '$txbbooking_detail_qty', NOW(), '$LoginByUser', NOW(), '$LoginByUser')";

                $result = mysqli_query($_SESSION['conn'] ,$sql);
                //Finding booking id
                $sql = "SELECT max(booking_id) as m_bid FROM booking WHERE agent_id='$agent_id' AND booking_status='D'";
                $result = mysqli_query($_SESSION['conn'] ,$sql);
                $row = mysqli_fetch_assoc($result);
                $booking_id = $row['m_bid'];
            }else{
                $booking_id = $row['m_bid'];
            }
            // Check Dayoff
            $sql = "SELECT count(*) as c_id FROM product, supplier_dayoff WHERE product.supplier_id=supplier_dayoff.supplier_id
                    AND supplier_dayoff.dayoff_date='$txbbooking_detail_date'
                    AND product.product_id='$product_id'";
                    echo $sql;
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            $row = mysqli_fetch_assoc($result);
            if ($row['c_id']>0) {
                header("location: shopping-info-errordayoff.php");
            }
            // Create booking detail
            $sql = "INSERT INTO booking_detail (product_id, booking_id, booking_detail_status, booking_detail_note, booking_detail_date, booking_detail_time,
                    booking_detail_qty, booking_detail_price, booking_detail_vat, booking_detail_total_amount,
                    createdatetime, createby, updatedatetime, updateby) 
                    VALUES ('$product_id', '$booking_id', 'N', '$txbbooking_detail_note', '$txbbooking_detail_date', '$txbbooking_detail_time',
                    '$txbbooking_detail_qty', '$product_price', '$product_vat', '$total_amount',
                    NOW(), '$LoginByUser', NOW(), '$LoginByUser')";
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            header("location: shopping-info.php");
        
        }else if ($hAction=="Up_P")   {
            $booking_detail_id = $_POST["booking_detail_id"];
            $txbbooking_detail_date = $_POST["txbbooking_detail_date"];
            $txbbooking_detail_time = $_POST["txbbooking_detail_time"];
            $txbbooking_detail_qty = $_POST["txbbooking_detail_qty"];
            $txbbooking_detail_note = $_POST["txbbooking_detail_note"];

            // Check Dayoff
            $sql = "SELECT count(*) as c_id 
                    FROM booking_detail, product, supplier_dayoff 
                    WHERE product.supplier_id=supplier_dayoff.supplier_id
                    AND booking_detail.product_id=product.product_id
                    AND supplier_dayoff.dayoff_date='$txbbooking_detail_date'
                    AND booking_detail.booking_detail_id='$booking_detail_id'";

            $result = mysqli_query($_SESSION['conn'] ,$sql);
            $row = mysqli_fetch_assoc($result);
            if ($row['c_id']>0) {
                header("location: shopping-info-errordayoff.php");
            }else{
                $sql = "UPDATE booking_detail SET booking_detail_note='$txbbooking_detail_note', booking_detail_date='$txbbooking_detail_date', 
                        booking_detail_time='$txbbooking_detail_time', booking_detail_qty='$txbbooking_detail_qty', 
                        booking_detail_total_amount=(booking_detail_price+(booking_detail_price*booking_detail_vat))*booking_detail_qty,
                        updatedatetime=NOW(), updateby='$LoginByUser'
                        WHERE booking_detail_id = '$booking_detail_id'";
                $result = mysqli_query($_SESSION['conn'] ,$sql);
                header("location: shopping-info.php");
            }
        }else if ($hAction=="Del_P")   {
            $booking_detail_id = $_GET["booking_detail_id"];
            $sql = "DELETE FROM  booking_detail WHERE booking_detail_id = '".$booking_detail_id."'";
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            header("location: shopping-info.php");

        }else if ($hAction=="Up_B") {
            $booking_id = $_POST['booking_id'];
            $txbbooking_name = $_POST['txbbooking_name'];
            $txbbooking_pax = $_POST['txbbooking_pax'];
            $txbbooking_nat = $_POST['txbbooking_nat'];
            $txbbooking_tel = $_POST['txbbooking_tel'];
            $txbbooking_line = $_POST['txbbooking_line'];
            $txbbooking_remark = $_POST['txbbooking_remark'];

            $sql = "UPDATE booking SET booking_name='$txbbooking_name', booking_pax='$txbbooking_pax', 
                    booking_nat='$txbbooking_nat', booking_tel='$txbbooking_tel', booking_line='$txbbooking_line',
                    booking_remark='$txbbooking_remark', updatedatetime=NOW(), updateby='$LoginByUser'
                    WHERE booking_id = '".$booking_id."'";
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            header("location: shopping-info-review.php");

        }else if ($hAction=="Up_Submit")    {
            $booking_id = $_POST['booking_id'];

            $sql = "UPDATE booking SET booking_status='N', updatedatetime=NOW(), updateby='$LoginByUser'
            WHERE booking_id = '".$booking_id."'";
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            header("location: shopping-info-confirmation.php?booking_id=$booking_id");
        }
    }
    
?>