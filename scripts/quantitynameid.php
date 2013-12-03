<?php

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT quantity, name, id FROM `portfolio` WHERE `username` = ? AND `id` = ?"); //Select quantity, name and id from portfolio

	$stmt->bind_param("si", $username, $id);

	$stmt->execute(); 

	$stmt->bind_result($oldQuantity, $name, $oldId);
	
	$checkPortfolio = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$checkPortfolio[$id] = array(
			'quantity' => $oldQuantity,
			'name' => $name,
			'id' => $oldId
		);
	}

	foreach($checkPortfolio as $key => $checkKey){ //Get lastest quantity and price
		$oldQuantity = $checkKey['quantity'];
		$name = $checkKey['name'];
		$oldId = $checkKey['id'];
	}

	$isQuantityValid = !empty($oldQuantity); //Quantity is not empty
	$isNameValid = !empty($name); //Name is not empty
	$isIDValid = !empty($oldId); //ID is not empty

	$stmt->close();

	$mysqli->close();

	if ($isQuantityValid && $isNameValid && $isIDValid){ //Make sure quantity, name & ID is valid
		$oldQuantity = $oldQuantity;
		$name = $name;
		$oldId = $oldId;
	} else { //Else original quantity the user posted
		$quantity = $quantity;
		$oldQuantity = 0;
	}

?>