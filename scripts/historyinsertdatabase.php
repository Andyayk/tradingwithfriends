<?php

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("INSERT INTO `history` (`username`, `name`, `quantity`, `price`, `total`, `cash`) VALUES (?, ?, ?, ?, ?, ?)"); //Insert into history

	$stmt->bind_param("ssssss", $username, $name, $quantity, $price, $total, $cash); 

	$successfullyInserted = $stmt->execute(); 

	$stmt->close();

	$mysqli->close();

?>