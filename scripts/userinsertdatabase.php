<?php

	require_once('config/database.php');

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); 

	$stmt = $mysqli->prepare("INSERT INTO `assignment_users` (`userid`, `name`, `password`, `interests`, `address`, `gender`, `dob`) VALUES (?, ?, ?, ?, ?, ?, ?)"); 

	$interestAsString = implode(",", $interest); 
	
	$dob = $day . $month . $year; 
	
	$stmt->bind_param("sssssss", $userid, $name, $password, $interestAsString, $address, $gender, $dob); 

	$successfullyInserted = $stmt->execute(); 

	$stmt->close();

	$mysqli->close();

?>