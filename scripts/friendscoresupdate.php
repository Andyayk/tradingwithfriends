<?php
	
	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("UPDATE `friendscores` SET `cash` = ? WHERE `username` = ? AND `friendsusername` = ? AND `friendsid` = ?"); //Update score

	$stmt->bind_param("isss", $scores, $username, $friendsusername, $friendsid);

	$successfullyUpdated = $stmt->execute(); 

	$stmt->close();
	
	$mysqli->close();

?>