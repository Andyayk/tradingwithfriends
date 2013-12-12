<?php 

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT cash, id FROM `history` WHERE `username` = ?");  //Select cash/score and id from history

	$stmt->bind_param("s", $friendsusername);

	$stmt->execute(); 

	$stmt->bind_result($score, $id);

	$scoreArray = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$scoreArray[$id] = array(
			'score' => $score
		);
	}

	foreach($scoreArray as $key => $scoreKey){ //Get latest score
		$score = $scoreKey['score'];
	}

	$isScoreValid = !empty($score); //Score is not empty

	$stmt->close();

	$mysqli->close();

	if ($isScoreValid){ //Make sure score is valid
		$score = $score;
	}

?>