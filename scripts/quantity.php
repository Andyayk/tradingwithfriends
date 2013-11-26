<?php

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT * FROM `portfolio` WHERE username = ? AND name = ? AND price = ?"); //Select all from portfolio

	$stmt->bind_param("sss", $username, $name, $price);

	$stmt->execute(); 

	$stmt->bind_result($username, $name, $quantity, $price, $total, $cash, $id);
	
	$checkPortfolio = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$checkPortfolio[$price] = array(
			'quantity' => $quantity,
		);
	}

	foreach($checkPortfolio as $key => $checkKey){ //Get lastest quantity
		$oldQuantity = $checkKey['quantity'];
	}

	$isQuantityValid = !empty($oldQuantity); //Quantity is not empty

	$stmt->close();

	$mysqli->close();

	if ($isQuantityValid){ //Make sure quantity is valid
		$newQuantity = $oldQuantity+$quantity;
	} else { //Else original quantity the user posted
		$quantity = quantity;
		$newQuantity = 0;
	}

?>