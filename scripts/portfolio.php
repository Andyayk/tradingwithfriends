<?php 
echo "Dont touch this until we have settled with putting data into DATABASE";

session_start();
	
$user = '';

$loggedIn = (!empty($_SESSION['user']));
	
if ($loggedIn) {
	$user = $_SESSION['user'];
} else {
	header('Location: index.php');
	exit;
}

require_once('config/database.php');
	
$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); 
	
$stmt = $mysqli->prepare("SELECT * FROM `assignment_speeches`"); 

$stmt->execute(); 

$stmt->bind_result($id, $subject, $body, $tags, $image);

$speeches = array();
while ($stmt->fetch()) {
	$speeches[$id] = array(
		'id' => $id,
		'subject' => $subject,
		'body' => $body,
		'tags' => $tags,
		'image' => $image
	);
}

$stmt->close();
	
$mysqli->close();

$message = ''; 
	
if (!empty($_SESSION['message'])) {
	$message = $_SESSION['message'];
	unset($_SESSION['message']);
}

?>