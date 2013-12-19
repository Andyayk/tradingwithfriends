<?php

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT * FROM `friendscores` WHERE `username` = ? AND `friendsusername` = ? AND `cash` = ? AND `friendsid` = ?"); //Select all from friendscores

	$stmt->bind_param("ssis", $username, $friendsusername, $scores, $friendsid);

	$stmt->execute(); 

	$stmt->bind_result($username, $friendsusername, $scores, $friendsid);
	
	$checkFriendscores = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$checkFriendscores[$oldFriendsId] = array(
			'username' => $username,
			'friendsusername' => $friendsusername,
			'scores' => $scores,
			'friendsid' => $friendsid
		);
	}

	foreach($checkFriendscores as $key => $checkFriendKeys){ //Get latest information
		$username = $checkFriendKeys['username'];
		$friendsusername = $checkFriendKeys['friendsusername'];
		$scores = $checkFriendKeys['scores'];
		$friendsid = $checkFriendKeys['friendsid'];
	}

	$isUsernameValid = !empty($username); //Username is not empty
	$isFriendValid = !empty($friendsusername); //Friend is not empty
	$isScoreValid = !empty($scores); //Score is not empty
	$isIdValid = !empty($friendsid); //ID is not empty

	$stmt->close();

	$mysqli->close();

	if ($isUsernameValid && $isFriendValid && $isScoreValid && $isIdValid){ //There is data in database
		$username = $username;
		$friendsusername = $friendsusername;
		$scores = $scores;
		$friendsid = $friendsid;
		$Valid = yes;
	} else { //No data in database
		$username = $username;
		$friendsusername = $friendsusername;
		$scores = $scores;
		$friendsid = $friendsid;
	}

?>