<?php
	// Connection to mysql database
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbName = "b2b";

	//Make Connection
	$conn = new mysqli($servername, $username, $password, $dbName);
	mysqli_set_charset($conn, "utf8");
	//Check Connection

	$_SESSION['conn'] = $conn;

	if(!$conn){
		die("Connection Failed. ". mysqli_connect_error());
	}
?>
