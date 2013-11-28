<?php

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("DELETE FROM `portfolio` WHERE `username` = ? AND `name` = ? AND `id` = ?"); //Delete from portfolio

	$stmt->bind_param("sss", $username, $name, $oldId);
	
	$stmt->execute();
	
	$stmt->close();
	
	$mysqli->close();
	
?>