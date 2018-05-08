<?php
	// Create connection to mysql
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbName = "webtour";
	
	//Make Connection
	$conn = new mysqli($servername, $username, $password, $dbName);
	mysqli_set_charset($conn, "utf8");
	//Check Connection
	$_SESSION['conn'] = $conn;
	if(!$conn){
		die("Connection Failed. ". mysqli_connect_error());
	}
	else //echo("Connection Succes");
	
	// $sql = "SELECT `agentid`, `username`, `email`, `password`, `agentname`, 
	// `agentaddress`, `agentcontactname`, `agentcontacttel`, `maximumcredit`, 
	// `remaincredit`, `creditterm`, `pricetype`, `vattype`, `status`, `note`, 
	// `createdatetime`, `createby`, `updatedatetime`, `updateby` 
	// FROM `agent` ";
	// $result = mysqli_query($conn ,$sql);
	
	
	

	?>
