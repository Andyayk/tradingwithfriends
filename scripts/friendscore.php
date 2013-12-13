<?php 

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT cash FROM `history` WHERE `username` = ?");  //Select cash/score from history

	$stmt->bind_param("s", $friendsusername);

	$stmt->execute(); 

	$stmt->bind_result($scores);

	$scoreArray = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$scoreArray[] = array(
			'score' => $scores
		);
	}

	foreach($scoreArray as $key => $scoreKey){ //Get latest score
		$scores = $scoreKey['score'];
	}

	$isScoreValid = !empty($scores); //Score is not empty

	$stmt->close();

	$mysqli->close();

	if ($isScoreValid){ //Make sure score is valid
		$scores = $scores;
		$friendsusername = $friendsusername;
		$friendsid = $friendsid;
	} else { //Don't show anything
		$scores = '';
		$friendsusername = '';
		$friendsid = '';
	}

?>