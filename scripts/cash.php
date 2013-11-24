<?php 

require_once('config/database.php');

$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); 

$stmt = $mysqli->prepare("SELECT * FROM `portfolio` WHERE username = ?"); 

$stmt->bind_param("s", $username);

$stmt->execute(); 

$stmt->bind_result($username, $name, $quantity, $price, $total, $cash, $id);

$stmt->fetch();

$isCashValid = !empty($cash);

$stmt->close();

$mysqli->close();

if ($isCashValid){

$cash = $cash;

} else {

$cash = 10000;

}

?>