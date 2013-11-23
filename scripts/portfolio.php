<?php 

require_once('config/database.php');
	
$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); 
	
$stmt = $mysqli->prepare("SELECT * FROM `portfolio`"); 

$stmt->execute(); 

$stmt->bind_result($name, $quantity, $price, $total);

$portfolioData = array();
while ($stmt->fetch()) {
	$portfolioData[$id] = array(
		'name' => $name,
		'quantity' => $quantity,
		'price' => $price,
		'total' => $total
	);
}

$stmt->close();
	
$mysqli->close();

$message = ''; 
	
?>