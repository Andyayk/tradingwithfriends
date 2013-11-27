<?php 

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT name, quantity, price, id FROM `portfolio` WHERE `username` = ?"); //Select name, quantity, price and id from portfolio

	$stmt->bind_param("s", $username);

	$stmt->execute(); 

	$stmt->bind_result($name, $quantity, $price, $id);

	$portfolioEquities = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$portfolioEquities[$id] = array(
			'name' => $name,
			'quantity' => $quantity,
			'price' => $price,
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
  ?>

  <tr>
	<td>
		<b>Equity:</b> <?php echo $name; ?> </br>
	</td>
	<td>
		<b>Quantity:</b> <?php echo $quantity; ?> </br>
	</td>
	<td>
		<b>Price:</b> <?php echo $price; ?> </br>
	</td>
  </tr>
  <?php endforeach; ?>

</table>