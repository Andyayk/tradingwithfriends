<?php 

require_once('config/database.php');

$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); 

$stmt = $mysqli->prepare("SELECT * FROM `portfolio` WHERE username = ?"); 

$stmt->bind_param("s", $username);

$stmt->execute(); 

$stmt->bind_result($username, $name, $quantity, $price, $total);

$stmt->fetch();

$isUsernameValid = !empty($username);

$stmt->close();

$mysqli->close();

if ($isUsernameValid) {
	
	echo $name;
	echo $quantity;
	echo $price;
	echo $total;
					
} else {
	
	echo "You have not bought anything yet";	
	
}
	
?>