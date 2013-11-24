<?php

	require_once('config/database.php');

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); 

	$stmt = $mysqli->prepare("SELECT username, quantity, id FROM `portfolio` WHERE `name` = ? AND `username` = ?"); 

	$stmt->bind_param("s", $username);

	$stmt->execute(); 

	$stmt->bind_result($username, $quantity, $id);

	$portfolioEquities = array();
	while ($stmt->fetch()) {
		$portfolioEquities[$id] = array(
			'quantity' => $quantity
		);
	}
	
	foreach($portfolioEquities as $key => $portfolioEquity){
		$quantity2 = $portfolioEquity['quantity'];
	}
	
	$stmt->close();

	$mysqli->close();
	
	$newQuantity = $quantity2-$quantity;
	
	require_once('config/database.php');

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); 

	$stmt = $mysqli->prepare("UPDATE `portfolio` SET `quantity` = ? WHERE `name` = ? AND `username` = ?"); 

	$stmt->bind_param("sss", $newQuantity, $name, $username);

	$successfullyUpdated = $stmt->execute(); 

	$stmt->close();
	
	$mysqli->close();

?>