<?php 

	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT * FROM `history` WHERE `username` = ?");  //Select all from history

	$stmt->bind_param("s", $username);

	$stmt->execute(); 

	$stmt->bind_result($username, $name, $quantity, $price, $total, $cash, $id);

	$historyEquities = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$historyEquities[$id] = array(
			'name' => $name,
			'quantity' => $quantity,
			'price' => $price,
			'total' => $total,
			'cash' => $cash
		);
	}

	$stmt->close();

	$mysqli->close();

?>

<table>
  	<?php foreach($historyEquities as $key => $historyEquity) : ?>

  	<?php 
		$name = $historyEquity['name'];
    	$quantity = $historyEquity['quantity'];
    	$price = $historyEquity['price'];
    	$total = $historyEquity['total'];
    	$cash = $historyEquity['cash'];
  	?>

  	<tr>
		<td>
			You had transacted <?php echo $quantity; ?> <?php echo $name; ?>
			equities at <?php echo $price; ?>
			each for $<?php echo $total; ?>.
			<b>Cash:</b> $<?php echo $cash; ?>
		</td>
    </tr>
  	<?php endforeach; ?>
</table>