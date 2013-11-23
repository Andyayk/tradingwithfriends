<?php 

require_once('config/database.php');

$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); 

$stmt = $mysqli->prepare("SELECT * FROM `portfolio` WHERE username = ?"); 

$stmt->bind_param("s", $username);

$stmt->execute(); 

$stmt->bind_result($username, $name, $quantity, $price, $total);

$portfolioEquities = array();
while ($stmt->fetch()) {
	$portfolioEquities[$username] = array(
		'name' => $name,
		'quantity' => $quantity,
		'price' => $price,
		'total' => $total
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
  $price = $portfolioEquity['price'];
  $total = $portfolioEquity['total'];
  ?>

  <tr>
	<td>
		<b>Subject:</b> <?php echo $name; ?>
	</td>
	<td>
		<b>Subject:</b> <?php echo $quantity; ?>
	</td>
	<td>
		<b>Subject:</b> <?php echo $price; ?>
	</td>
	<td>
		<b>Subject:</b> <?php echo $total; ?>
	</td>
  </tr>
  <?php endforeach; ?>

</table>