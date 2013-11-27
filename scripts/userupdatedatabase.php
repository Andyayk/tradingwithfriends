<?php
	
	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("UPDATE `portfolio` SET `quantity` = ? WHERE `name` = ? AND `price` = ?"); //Update quantity

	$stmt->bind_param("sss", $newQuantity, $name, $price);

	$successfullyUpdated = $stmt->execute(); 

	$stmt->close();
	
	$mysqli->close();

?>