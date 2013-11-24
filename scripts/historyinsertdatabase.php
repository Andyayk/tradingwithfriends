<?php

	require_once('config/database.php');

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); 

	$stmt = $mysqli->prepare("INSERT INTO `history` (`username`, `name`, `quantity`, `price`, `total`, `cash`) VALUES (?, ?, ?, ?, ?, ?)"); 

	$stmt->bind_param("ssssss", $username, $name, $quantity, $price, $total, $cash); 

	$successfullyInserted = $stmt->execute(); 

	$stmt->close();

	$mysqli->close();

?>