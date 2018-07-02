<?php
include("inc/constant.php");
include("inc/connectionToMysql.php");

if (isset($_GET['product_id']))     {
    $_product_id = ($_GET['product_id']);
    if (isset($_GET['hAction']))    {       
        $hAction=$_GET['hAction'];
        $LoginByUser = '';

        if ($hAction=="add")   {
            $_price_type=$_GET['lsbprice_type'];
            $_price_contract_rate=$_GET['txbprice_contract_rate'];
            $_price_walkin_rate=$_GET['txbprice_walkin_rate'];
            $_price_a_rate=$_GET['txbprice_a_rate'];
            $_price_b_rate=$_GET['txbprice_b_rate'];

            $sql="  SELECT * FROM tb_product_price_tr WHERE product_id='$_product_id' AND price_type='$_price_type'";
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            if (mysqli_num_rows($result)==0)  {
                $sql="  INSERT INTO tb_product_price_tr (product_id, price_type, price_contract_rate, price_walkin_rate, 
                                    price_a_rate, price_b_rate, create_datetime, create_by)
                        VALUES('$_product_id', '$_price_type', '$_price_contract_rate', '$_price_walkin_rate', 
                                    '$_price_a_rate', '$_price_b_rate', NOW(), '$LoginByUser')";
                $result = mysqli_query($_SESSION['conn'] ,$sql);
            }else{
                echo "<font color='red'>Duplicate Price Type, Please delete first.!</font>";
            }
        }elseif ($hAction=="delete")   {
            $_price_id = ($_GET['price_id']);
            //Delete Record
            $sql = "DELETE FROM tb_product_price_tr WHERE price_id = '".$_price_id."'";
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            if(!$result) {
                echo "<script>alert('Failed to delete.This is already used.!'); window.location='agent.php'</script>";
            }
        }
    }
    // Show Table list
    $sql = "SELECT price_id, mas_value AS price_type, price_contract_rate, price_walkin_rate, price_a_rate, price_b_rate 
            FROM tb_product_price_tr, tb_mas_ms 
            WHERE tb_product_price_tr.price_type = tb_mas_ms.mas_code 
            AND tb_mas_ms.masofmas_id = 13
            AND product_id='".$_product_id."'";
    $result = mysqli_query($conn ,$sql);
    if (mysqli_num_rows($result)>0)  {?>
        <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-left">Type</th>
                    <th class="text-center">Contract</th>
                    <th class="text-center">Walk-In</th>
                    <th class="text-center">Rate B</th>
                    <th class="text-center">Rate A</th>
                    <th></th>
                </tr>
            </thead>
            <tbody><?php
            $i=0;
            while($row = mysqli_fetch_assoc($result))	{
                $i++;?>
                <tr>
                    <td><?=$row['price_type']; ?></td>
                    <td class="text-right"><?=$row['price_contract_rate']; ?></td>
                    <td class="text-right"><?=number_format($row['price_walkin_rate'],2); ?></td>
                    <td class="text-right"><?=number_format($row['price_a_rate'],2); ?></td>
                    <td class="text-right"><?=number_format($row['price_b_rate'],2); ?></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-small btn-danger" name="submitAddBooking" id="submitAddBooking" onclick="Delete_Price(<?=$row['price_id']?>);"><i class="fa fa-trash-o"></i> <span class="hidden-mobile"> Del </span></button>
                    </td>
                </tr><?php
            }?></tbody>
        </table>
        </div><?php 
    }?> 

    <div class="row">
        <label></label>
    </div>
    <div class="row">
 		<section class="col col-3">
            <label class="label">Type</label>
            <select name="lsbprice_type" id="lsbprice_type" class="form-control">
                <option value="" selected></option><?php
                    $i=0;
                    $sql = "SELECT mas_code, mas_value FROM tb_mas_ms WHERE masofmas_id=13 ORDER BY mas_id";
                    $result = mysqli_query($conn ,$sql);
                    while($row = mysqli_fetch_assoc($result))	{?>
                        <option value="<?php echo $row["mas_code"]; ?>"><?php echo $row["mas_value"];?></option><?php
                    }?>
            </select>
        </section> 
        <section class="col col-2">
		    <label class="label">Contract</label>
			<label class="input">
			    <input type="number" name="txbprice_contract_rate" id="txbprice_contract_rate">
            </label>
        </section> 
        <section class="col col-2">
		    <label class="label">Walk-In</label>
			<label class="input">
			    <input type="number" name="txbprice_walkin_rate" id="txbprice_walkin_rate">
            </label>
        </section>   
        <section class="col col-2">
		    <label class="label">Rate B</label>
			<label class="input">
			    <input type="number" name="txbprice_a_rate" id="txbprice_a_rate">
            </label>
        </section>   
        <section class="col col-2">
		    <label class="label">Rate A</label>
			<label class="input">
			    <input type="number" name="txbprice_b_rate" id="txbprice_b_rate">
            </label>
        </section>
        <section class="col col-1">
        <label class="label">&nbsp;</label>
            <div>
                <button type="button" class="btn btn-primary" name="submitAddBooking" id="submitAddBooking" onclick="Add_Price();"> Save </button>
            </div>
        </section>
    </div><?php
} ?>


<script type="text/javascript">
    function Add_Price() {
        
        var lsbprice_type = document.getElementById('lsbprice_type').value;
        var txbprice_contract_rate = document.getElementById('txbprice_contract_rate').value;
        var txbprice_walkin_rate = document.getElementById('txbprice_walkin_rate').value;
        var txbprice_a_rate = document.getElementById('txbprice_a_rate').value;
        var txbprice_b_rate = document.getElementById('txbprice_b_rate').value;
        if ((lsbprice_type!="")&&(txbprice_contract_rate!="")&&(txbprice_walkin_rate!="")&&(txbprice_a_rate!="")&&(txbprice_b_rate!="")) {
             LoadPage('get','product-a-addedit-price.php?hAction=add&lsbprice_type='+lsbprice_type+'&txbprice_contract_rate='+txbprice_contract_rate+'&txbprice_walkin_rate='+txbprice_walkin_rate+'&txbprice_a_rate='+txbprice_a_rate+'&txbprice_b_rate='+txbprice_b_rate+'&supplier_id=<?php echo $_supplier_id;?>&product_id=<?php echo $_product_id;?>');
        }else{
            alert("Please fill Type and price rate")
        }
    }

    function Delete_Price(price_id) {
        if (price_id!="") {
            LoadPage('get','product-a-addedit-price.php?price_id='+price_id+'&hAction=delete&product_id='+<?=$_product_id; ?>);
        }
    }

    function LoadPage(SendMethod,PageName)  {
        var x = new XMLHttpRequest();
        x.open(SendMethod,PageName);
        x.onreadystatechange=function(){
            var content=document.getElementById("showPrice");
            content.innerHTML=x.responseText;
        }
        x.send(null);
    }
</script>