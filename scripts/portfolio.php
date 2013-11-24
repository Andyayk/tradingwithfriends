<?php 

require_once('config/database.php');

$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); 

$stmt = $mysqli->prepare("SELECT username, name, quantity, id FROM `portfolio` WHERE username = ?"); 

$stmt->bind_param("s", $username);

$stmt->execute(); 

$stmt->bind_result($username, $name, $quantity, $id);

$portfolioEquities = array();
while ($stmt->fetch()) {
	$portfolioEquities[$id] = array(
		'name' => $name,
		'quantity' => $quantity
	);
}

$stmt->close();

$mysqli->close();

?>

<table>
  <?php foreach($portfolioEquities as $key => $portfolioEquity) : ?>

  <?php 
	$name = $portfolioEquity['name'];
    $quantity = $portfolioEquity['quantity'];
  ?>

  <tr>
	<td>
		<b>Symbol:</b> <?php echo $name; ?> </br>
	</td>
	<td>
		<b>Quantity:</b> <?php echo $quantity; ?> </br>
	</td>
  </tr>
  <?php endforeach; ?>

</table>