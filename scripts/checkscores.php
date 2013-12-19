<?php

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT * FROM `friendscores` WHERE `username` = ? AND `friendsusername` = ? AND `cash` = ? AND `friendsid` = ?"); //Select all from friendscores

	$stmt->bind_param("ssis", $username, $friendsusername, $scores, $friendsid);

	$stmt->execute(); 

	$stmt->bind_result($username2, $friendsusername2, $scores2, $friendsid2);
	
	$checkFriendscores = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$checkFriendscores[$friendsid] = array(
			'username' => $username2,
			'friendsusername' => $friendsusername2,
			'scores' => $scores2,
			'friendsid' => $friendsid2
		);
	}

	foreach($checkFriendscores as $key => $checkFriendKeys){ //Get latest information
		$username3 = $checkFriendKeys['username'];
		$friendsusername3 = $checkFriendKeys['friendsusername'];
		$scores3 = $checkFriendKeys['scores'];
		$friendsid3 = $checkFriendKeys['friendsid'];
	}

	$isUsernameValid = !empty($username3); //Username is not empty
	$isFriendValid = !empty($friendsusername3); //Friend is not empty
	$isScoreValid = !empty($scores3); //Score is not empty
	$isIdValid = !empty($friendsid3); //ID is not empty

	$stmt->close();

	$mysqli->close();

	if ($isUsernameValid && $isFriendValid && $isScoreValid && $isIdValid){ //There is data in database
		$username = $username3;
		$friendsusername = $friendsusername3;
		$scores = $scores3;
		$friendsid = $friendsid3;
		$Valid = 1;
	} else { //No data in database
		$username = $username3;
		$friendsusername = $friendsusername3;
		$scores = $scores3;
		$friendsid = $friendsid3;
	}

?>