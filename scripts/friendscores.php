<?php 

	$counter = 0;
	
	require_once('config/database.php'); //Login to database

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT * FROM `friendscores` WHERE `username` = ?");  //Select all from friendscores in descending order

	$stmt->bind_param("s", $username);

	$stmt->execute(); 

	$stmt->bind_result($username, $friendsusername, $scores, $friendsid);

	$getScoreArray = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$getScoreArray[$friendsid] = array(
			'friendusername' => $friendsusername,
			'score' => $scores,
			'friendid' => $friendsid
		);
	}

	$stmt->close();

	$mysqli->close();

?>

<table>
	<?php foreach($getScoreArray as $key => $getScoreKey) : ?>

    <?php 
  		$friendsusername = $getScoreKey['friendusername'];
		$scores = $getScoreKey['score'];
    	$friendsid = $getScoreKey['friendid'];
    	$counter = $counter+1;
    ?>

	<tr>
		<td>
			<b><?php echo $counter; ?></b> <?php echo "<img src='https://graph.facebook.com/".$friendsid."/picture' width='25' height='25' title='".$friendsusername."' />".$friendsusername." ".$scores;?>
		</td>
  	</tr>
  	<?php endforeach; ?>
</table>