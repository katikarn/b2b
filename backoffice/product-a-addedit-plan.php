<?php
include("inc/constant.php");
include("inc/connectionToMysql.php");

if (isset($_GET['product_id']))     {
    $_product_id = ($_GET['product_id']);
    if (isset($_GET['hAction']))    {       
        $hAction=$_GET['hAction'];
        $LoginByUser = '';

        if ($hAction=="add")   {
            $_plan_showtime=$_GET['txbplan_showtime'];
            $_plan_pickup=$_GET['txbplan_pickup'];
            $_plan_dropoff=$_GET['txbplan_dropoff'];

            $sql="  SELECT * FROM tb_product_plan_tr WHERE product_id='$_product_id' AND plan_showtime='$_plan_showtime'";
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            if (mysqli_num_rows($result)==0)  {
                $sql="  INSERT INTO tb_product_plan_tr (product_id, plan_showtime, plan_pickup, plan_dropoff, create_datetime, create_by)
                        VALUES('$_product_id', '$_plan_showtime', '$_plan_pickup', '$_plan_dropoff', NOW(), '$LoginByUser')";
                $result = mysqli_query($_SESSION['conn'] ,$sql);
            }else{
                echo "<font color='red'>Duplicate Show Time, Please delete first.!</font>";
            }
        }elseif ($hAction=="delete")   {
            $_plan_id = ($_GET['plan_id']);
            //Delete Record
            $sql = "DELETE FROM tb_product_plan_tr WHERE plan_id = '".$_plan_id."'";
            $result = mysqli_query($_SESSION['conn'] ,$sql);
            if(!$result) {
                echo "<script>alert('Failed to delete.This is already used.!');'</script>";
            }
            echo "<script>window.location='agent.php'</script>";
        }
    }
    // Show Table list
    $sql = "SELECT plan_id, plan_showtime, plan_pickup, plan_dropoff 
            FROM tb_product_plan_tr
            WHERE product_id='".$_product_id."'";
    $result = mysqli_query($conn ,$sql);
    if (mysqli_num_rows($result)>0)  {?>
        <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-left">Show Time</th>
                    <th class="text-center">Pick-up</th>
                    <th class="text-center">Drop-Off</th>
                    <th></th>
                </tr>
            </thead>
            <tbody><?php
            $i=0;
            while($row = mysqli_fetch_assoc($result))	{
                $i++;?>
                <tr>
                    <td class="text-center"><?=date("H:i",strtotime($row['plan_showtime'])); ?></td>
                    <td class="text-center"><?=date("H:i",strtotime($row['plan_pickup'])); ?></td>
                    <td class="text-center"><?=date("H:i",strtotime($row['plan_dropoff'])); ?></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-small btn-danger" name="submitAddBooking" id="submitAddBooking" onclick="Delete_Plan(<?=$row['plan_id']?>);"><i class="fa fa-trash-o"></i> <span class="hidden-mobile"> Del </span></button>
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
			<label class="label">Show Time</label>
			<label class="input">
				<input type="time" name="txbplan_showtime" id="txbplan_showtime">
			</label>
        </section>
        <section class="col col-3">
			<label class="label">Pick-up</label>
			<label class="input">
				<input type="time" name="txbplan_pickup" id="txbplan_pickup">
			</label>
        </section>
        <section class="col col-3">
			<label class="label">Drop-off</label>
			<label class="input">
				<input type="time" name="txbplan_dropoff" id="txbplan_dropoff">
			</label>
        </section>
        <section class="col col-2">
        <label class="label">&nbsp;</label>
            <div>
                <button type="button" class="btn btn-primary" name="submitAddBooking" id="submitAddBooking" onclick="Add_Plan();"> Save </button>
            </div>
        </section>
    </div><?php
} ?>


<script type="text/javascript">
    function Add_Plan() {
        var txbplan_showtime = document.getElementById('txbplan_showtime').value;
        var txbplan_pickup = document.getElementById('txbplan_pickup').value;
        var txbplan_dropoff = document.getElementById('txbplan_dropoff').value;
        if ((txbplan_showtime!="")&&(txbplan_pickup!="")&&(txbplan_dropoff!="")) {
            LoadPage_2('get','product-a-addedit-plan.php?hAction=add&txbplan_showtime='+txbplan_showtime+'&txbplan_pickup='+txbplan_pickup+'&txbplan_dropoff='+txbplan_dropoff+'&supplier_id=<?php echo $_supplier_id;?>&product_id=<?php echo $_product_id;?>');
        }else{
            alert("Please All Time value")
        }
    }

    function Delete_Plan(plan_id) {
        if (plan_id!="") {
            LoadPage_2('get','product-a-addedit-plan.php?plan_id='+plan_id+'&hAction=delete&product_id=<?=$_product_id; ?>');
        }
    }

    function LoadPage_2(SendMethod,PageName)  {
        var x = new XMLHttpRequest();
        x.open(SendMethod,PageName);
        x.onreadystatechange=function(){
            var content=document.getElementById("showPlan");
            content.innerHTML=x.responseText;
        }
        x.send(null);
    }
</script>