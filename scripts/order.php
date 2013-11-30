<?php 
	
	$url = $_SERVER['HTTP_HOST'];

	$thisIsLocalHostUrl = (strpos($url, 'localhost') !== false);
	$thisIsCloudControlUrl = (strpos($url, 'cloudcontrolled') !== false);

	//Credentials for localhost database
	if ($thisIsLocalHostUrl) {
		$database_name = 'tradingwithfriends';
		$database_username = 'root';
		$database_password = '';
		$database_hostname = 'localhost';
	}
	
	//Credentials for cloudcontrol database
	if ($thisIsCloudControlUrl) {
		$database_name = 'depqdrc7d65';
		$database_username = 'depqdrc7d65';
		$database_password = 'p6A2wObwmahl';
		$database_hostname = 'mysqlsdb.co8hm2var4k9.eu-west-1.rds.amazonaws.com';
	}

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT name, quantity, id, order FROM `portfolio` WHERE `username` = ?"); //Select username, name, quantity, id, order and orderprice from portfolio

	$stmt->bind_param("s", $username);

	$stmt->execute(); 

	$stmt->bind_result($name, $quantity, $oldId, $order);

	$orderArray = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$orderArray[$id] = array(
			'name' => $name,
			'quantity' => $quantity,
			'id' => $oldId,
			'order' => $order,
		);
	}
	
	foreach($orderArray as $key => $orderKey){ //Get lastest cash

		$name = $orderKey['name'];
		$quantity = $orderKey['quantity'];
		$oldId = $orderKey['id'];
		$order = $orderKey['order'];
		
		if ($order = "Stop Loss Order" ){
		echo "hello";

		}
	}

	$stmt->close();

	$mysqli->close();

?>
