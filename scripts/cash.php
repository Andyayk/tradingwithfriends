<?php 

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT cash, id FROM `history` WHERE `username` = ?");  //Select cash and id from history

	$stmt->bind_param("s", $username);

	$stmt->execute(); 

	$stmt->bind_result($cash, $id);

	$cashArray = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$cashArray[$id] = array(
			'cash' => $cash
		);
	}

	foreach($cashArray as $key => $cashKey){ //Get lastest cash
		$cash = $cashKey['cash'];
	}

	$isCashValid = !empty($cash); //Cash is not empty

	$stmt->close();

	$mysqli->close();

	if ($isCashValid){ //Make sure cash is valid
		$cash = $cash;
	} else { //Else cash = 10000
		$cash = 10000;
	}

?>