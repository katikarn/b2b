<?php
include("inc/constant.php");
include("inc/connectionToMysql.php");

if (isset($_GET['supplier_id']))    {
    $_supplier_id = ($_GET['supplier_id']);
    
    if (isset($_GET["hAction"]))    {
        $hAction=$_GET["hAction"];
        if ($hAction=="add")   {
            $contract_name=$_GET['txbcontract_name'];
            $contract_file = $_FILES["txbcontract_file"]["name"];            
            $LoginByUser = '';
            //Upload File
            $target_file = $path_folder_contract.basename($contract_file);
            if($contract_file != '' && $contract_file != null){
                if (file_exists($target_file)) {
                    $file_status_1 .="Sorry, file already exists.";
                }else{
                    if (move_uploaded_file($_FILES["txbcontract_file"]["tmp_name"], $target_file)) {
                        $file_status_1 .= "The file ". basename($contract_file). " has been uploaded.";
                    } else {
                        $file_status_1 .= "Sorry, there was an error uploading your file.";
                    }
                }
            }else{
                $file_status_1 .="No have upload.";
            }
            if($contract_file != '')	{
                echo "<script>alert('Files : ".$file_status_1."');</script>";
            }
            $sql="  INSERT INTO tb_supplier_contract_tr (supplier_id, contract_name, contract_file, create_datetime, create_by)
                    VALUES('$_supplier_id', '$contract_name', '$contract_file', NOW(), '$LoginByUser')";
            $result = mysqli_query($_SESSION['conn'] ,$sql);
        }elseif ($hAction=="delete")   {
            //Delete File
            $sql = "SELECT contract_file FROM tb_supplier_contract_tr WHERE contract_id = '".$_GET['contract_id']."'";
            $result = mysqli_query($conn ,$sql);
            $row = mysqli_fetch_assoc($result);
            if ($row['contract_file']<>"")	{
                unlink($path_folder_contract.$row['contract_file']);
            }
            //Delete Record
            $sql = "DELETE FROM contract_file WHERE contract_id = '".$_GET['contract_id']."'";
            $result = mysqli_query($_SESSION['conn'] ,$sql);
        }
    }
    // Show Table list
    $sql = " SELECT contract_name, contract_file FROM tb_supplier_contract_tr WHERE supplier_id='".$_GET['supplier_id']."'";
    $result = mysqli_query($conn ,$sql);
    if (mysqli_num_rows($result)>0)  {?>
        <div class="table-responsive">
        <table class="table table-striped table-bordered table-hover">
            <thead>
                <tr>
                    <th class="text-left">Description</th>
                    <th class="text-center">File</th>
                    <th class="text-center"></th>
                </tr>
            </thead>
            <tbody><?php
            $i=0;
            while($row = mysqli_fetch_assoc($result))	{
                $i++;?>
                <tr>
                    <td><?=$row['contract_name']; ?></td>
                    <td class="text-center"><a>Link</a></td>
                    <td class="text-center"><a href="supplier-addedit-contract.php?contract_id=<?=$row['contract_id']; ?>&hAction=Delete" class="btn btn-small btn-danger"><i class="fa fa-trash-o"></i> <span class="hidden-mobile"> Del </span></a></td>
                </tr><?php
            }?></tbody>
        </table>
        </div><?php 
    }?> 

    <div class="row">
        <label></label>
    </div>
    <div class="row">
 		<section class="col col-6">
		    <label class="label">Description</label>
			<label class="input">
			    <input type="text" name="txbcontract_name" id="txbcontract_name" maxlength="100">
            </label>
        </section>       
        <section class="col col-4">
			<label class="label">Attachment File</label>
			<div class="input input-file">
                <input type="file" id="txbcontract_file" name="txbcontract_file">
            </div>
        </section>
        <section class="col col-2">
            <label class="label">&nbsp;</label>
            <div>
                <i class="fa fa-cloud-upload"></i> <button type="button" class="btn btn-primary" name="submitAddBooking" id="submitAddBooking" onclick="Add_Contact();">Upload</button>
            </div>
        </section>
    </div>
<?php }else{
    $_supplier_id="";
} ?>

<script type="text/javascript">
    function Add_Contact() {
        var contract_name = document.getElementById('txbcontract_name').value;
        var contract_file = document.getElementById('txbcontract_file').value;
        if ((contract_name!="")&&(contract_file!="")) {
            LoadPage('post','supplier-addedit-contract.php?hAction=add&txbcontract_name='+contract_name+'&txbcontract_file='+contract_file+'&supplier_id=<?php echo $_supplier_id;?>');
        }else{
            alert("Please Fill Description and Attachment File");
        }
    }
    function Delete_Contact(contract_id) {
        if (contract_id!="") {
            LoadPage('get','supplier-addedit-contract.php?hAction=delete&contract_id='+contract_id);
        }
    }
    function LoadPage(SendMethod,PageName)  {
        var x = new XMLHttpRequest();
        x.open(SendMethod,PageName);
        x.onreadystatechange=function(){
            var content=document.getElementById("showContract");
            content.innerHTML=x.responseText;
        }
        x.send(null);
    }
</script>