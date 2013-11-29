<?php

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("INSERT INTO `portfolio` (`username`, `name`, `quantity`, `price`, `total`, `cash`, `order`, `orderprice`) VALUES (?, ?, ?, ?, ?, ?, ? ,?)"); //Insert into porfolio

	$stmt->bind_param("ssssss", $username, $name, $quantity, $price, $total, $cash, $order, $orderPrice); 

	$successfullyInserted = $stmt->execute(); 

	$stmt->close();

	$mysqli->close();

?>