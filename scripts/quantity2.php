<?php

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT quantity, id FROM `portfolio` WHERE `username` = ? AND `name` = ? AND `id` = ?"); //Select quantity and id from portfolio

	$stmt->bind_param("ssi", $username, $name, $id);

	$stmt->execute(); 

	$stmt->bind_result($oldQuantity, $oldId);
	
	$checkPortfolio = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$checkPortfolio[$id] = array(
			'quantity' => $oldQuantity,
			'id' => $oldId
		);
	}

	foreach($checkPortfolio as $key => $checkKey){ //Get lastest quantity and price
		$oldQuantity = $checkKey['quantity'];
		$oldId = $checkKey['id'];
	}

	$isQuantityValid = !empty($oldQuantity); //Quantity is not empty
	$isIDValid = !empty($oldId); //ID is not empty

	$stmt->close();

	$mysqli->close();

	if ($isQuantityValid && $isIDValid){ //Make sure quantity & ID is valid
		$oldQuantity = $oldQuantity;
		$oldId = $oldId;
	} else { //Else original quantity the user posted
		$quantity = $quantity;
		$oldQuantity = 0;
	}

?>