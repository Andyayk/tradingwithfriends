<?php 

require_once('config/database.php');

$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); 

$stmt = $mysqli->prepare("SELECT * FROM `portfolio` WHERE username = ?"); 

$stmt->bind_param("s", $username);

$stmt->execute(); 

$stmt->bind_result($username, $name, $quantity, $price, $total, $cash, $id);

$portfolioEquities = array();
while ($stmt->fetch()) {
	$portfolioEquities[$id] = array(
		'cash' => $cash
	);
}

foreach($portfolioEquities as $key => $portfolioEquity) :
	$cash = $portfolioEquity['cash'];
endforeach;

if($cash = 0 || $cash = ''){

$cash = 10000;

} else {

$cash = $portfolioEquity['cash'];

}

$stmt->close();

$mysqli->close();



?>


