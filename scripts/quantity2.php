<?php

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT quantity, id, price FROM `portfolio` WHERE `username` = ? AND `name` = ? "); //Select quantity, price and id from portfolio

	$stmt->bind_param("ss", $username, $name);

	$stmt->execute(); 

	$stmt->bind_result($oldQuantity, $id, $oldPrice);
	
	$checkPortfolio = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$checkPortfolio[$id] = array(
			'quantity' => $oldQuantity,
			'price' => $oldPrice
		);
	}

	foreach($checkPortfolio as $key => $checkKey){ //Get lastest quantity
		$oldQuantity = $checkKey['quantity'];
		$oldPrice = $checkKey['price'];
	}

	$isQuantityValid = !empty($oldQuantity); //Quantity is not empty

	$stmt->close();

	$mysqli->close();

	if ($isQuantityValid){ //Make sure quantity is valid
		$oldQuantity = $oldQuantity;
		$oldPrice = $oldPrice;
	} else { //Else original quantity the user posted
		$quantity = $quantity;
		$oldQuantity = 0;
	}

?>