<?php 

require_once('config/database.php');

$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); 

$stmt = $mysqli->prepare("SELECT * FROM `portfolio` WHERE username = ?"); 

$stmt->bind_param("s", $username);

$stmt->execute(); 

$stmt->bind_result($username, $name, $quantity, $price, $total, $cash, $id);

$getCashes = array();
while ($stmt->fetch()) {
	$getCashes[$id] = array(
		'cash' => $cash
	);
}

$stmt->close();

$mysqli->close();

foreach($getCashes as $key => $getCash){
	$cash = $getCash['cash'];
}
?>