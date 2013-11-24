<?php 

require_once('config/database.php');

$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); 

$stmt = $mysqli->prepare("SELECT cash, id FROM `history` WHERE username = ?"); 

$stmt->bind_param("s", $username);

$stmt->execute(); 

$stmt->bind_result($cash, $id);

$cashArray = array();
while ($stmt->fetch()) {
	$cashArray[$id] = array(
		'cash' => $cash
	);
}

foreach($cashArray as $key => $cashKey){
	$cash = $cashKey['cash'];
}

$isCashValid = !empty($cash);

$stmt->close();

$mysqli->close();

if ($isCashValid){

$cash = $cash;

} else {

$cash = 10000;

}

?>