<?php
// Function to get the client ip address
function get_client_ip_env() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
 
    return $ipaddress;
}

// Function add data to audit trail
function Add_Audit_Trail($strLogin,$strMessage)   {
    $strIP = get_client_ip_env();
    $sql = "INSERT INTO tb_auditlog_tr (audit_type, audit_detail, audit_ip, create_datetime, create_by) 
            VALUES ('$strLogin', '$strMessage', '$strIP', NOW(), 'admin')";
    $result = mysqli_query($_SESSION['conn'] ,$sql);
}

?>