<?php 
	$app_id = '418284238273760';
  $app_secret = '44926e66c8b6d95019865554ec58c9a2';
  $app_namespace = 'tradingwithfriends';

  $app_url = 'http://apps.facebook.com/' . $app_namespace . '/';
  $scope = 'email,publish_actions';
  
  $facebook = new Facebook(array( //Init the Facebook SDK
     'appId'  => $app_id,
     'secret' => $app_secret,
   ));

  $user = $facebook->getUser(); //Get the current user

  //If the user has not installed the app, redirect them to the Login Dialog
  if (!$user) {
    $loginUrl = $facebook->getLoginUrl(array(
      'scope' => $scope,
      'redirect_uri' => $app_url,
    ));
    print('<script> top.location.href=\'' . $loginUrl . '\'</script>');
  } else { //Get their names
 	 $user_profile = $facebook->api('/me','GET');
 	 $username = $user_profile['name'];
  }
		

	$url = $_SERVER['HTTP_HOST'];

	$thisIsLocalHostUrl = (strpos($url, 'localhost') !== false);
	$thisIsCloudControlUrl = (strpos($url, 'cloudcontrolled') !== false);

	//Credentials for localhost database
	if ($thisIsLocalHostUrl) {
		$database_name = 'tradingwithfriends';
		$database_username = 'root';
		$database_password = '';
		$database_hostname = 'localhost';
	}
	
	//Credentials for cloudcontrol database
	if ($thisIsCloudControlUrl) {
		$database_name = 'depqdrc7d65';
		$database_username = 'depqdrc7d65';
		$database_password = 'p6A2wObwmahl';
		$database_hostname = 'mysqlsdb.co8hm2var4k9.eu-west-1.rds.amazonaws.com';
	}

	$mysqli = new mysqli($database_hostname, $database_username, $database_password, $database_name) or exit("Error connecting to database"); //Connect

	$stmt = $mysqli->prepare("SELECT name, quantity, id, order, orderprice FROM `portfolio` WHERE `username` = ?"); //Select username, name, quantity, id, order and orderprice from portfolio

	$stmt->bind_param("s", $username);

	$stmt->execute(); 

	$stmt->bind_result($name, $quantity, $oldId, $order, $orderPrice);

	$orderArray = array(); //Fetch and store in array
	while ($stmt->fetch()) {
		$orderArray[$id] = array(
			'name' => $name,
			'quantity' => $quantity,
			'id' => $oldId,
			'order' => $order,
			'orderprice' => $orderPrice
		);
	}
	
	foreach($orderArray as $key => $orderKey){ //Get lastest cash

		$name = $orderKey['name'];
		$quantity = $orderKey['quantity'];
		$oldId = $orderKey['id'];
		$order = $orderKey['order'];
		$orderPrice = $orderKey['orderprice'];

		if ($order = "Stop Loss Order" ){
		//Get price
	    require 'scripts/equity_price.php';
	  	if ($name=="Blumont, A33.SI"){
	  	$currentPrice = $blumont;
	  	} elseif ($name=="PFood, P05.SI"){
	  	$currentPrice = $pfood;
	  	} elseif ($name=="GoldenAgr, E5H.SI"){
	  	$currentPrice = $goldenagr;
	  	} elseif ($name=="$ Viking, 557.SI"){
	  	$currentPrice = $viking;
	  	} elseif ($name=="Noble Grp, N21.SI"){
	  	$currentPrice = $noble;
	  	} elseif ($name=="$ Rex Intl, 5WH.SI"){
	  	$currentPrice = $rex;
	  	} elseif ($name=="Dragon Gp, MT1.SI"){
	  	$currentPrice = $dragon;
	  	} elseif ($name=="LionGold, A78.SI"){
	  	$currentPrice = $liongold;
	  	} elseif ($name=="Singtel, Z74.SI"){
	  	$currentPrice = $singtel;
	  	} elseif ($name=="$ Sky One, 5MM.SI"){
	  	$currentPrice = $skyone;
	  	} else{
	  	$currentPrice = "";
	  	}
	  	
	  	if ($currentPrice<=$orderPrice) {
	  		
	  		$total = $orderPrice*$quantity;
  			$cash = $cash+$total-40;
	  		require_once ('scripts/userdeletedatabase.php'); //Delete from database
  			require_once('scripts/historyinsertdatabase.php'); //Insert into database
  			echo "<script language=javascript>alert('Stop Loss Order had been activated!!')</script>";
	  	}
		}
	}

	$stmt->close();

	$mysqli->close();

?>
