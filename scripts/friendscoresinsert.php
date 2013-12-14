<?php

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("INSERT INTO `friendscores` (`username`, `friendsusername`, `cash`, `friendsid`) VALUES (?, ?, ?, ?)"); //Insert into friendscores

	$stmt->bind_param("ssss", $username, $friendsusername, $scores, $friendsid); 

	$successfullyInserted = $stmt->execute(); 

	$stmt->close();

	$mysqli->close();

?>