<?php

  //Define variables
  $name = '';
  $quantity = '';
  $price = '';
  $total = '';
  $nameError = '';
  $quantityError = '';
  $message = '';
  $errors = array();
  $noErrors = true;
  $haveErrors = !($noErrors);
  $username = '';
  $cash = '';
  $newQuantity = 0;

  require 'server/fb-php-sdk/facebook.php'; //Server

  //Linking to Facebook Application
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
  
  require_once('scripts/cash.php'); //Get cash data
  
  //Array storing equities names
  $names = array(	
	'A33.SI' => 'A33.SI',
	'P05.SI' => 'P05.SI',
	'E5H.SI' => 'E5H.SI',
	'557.SI' => '557.SI',
	'N21.SI' => 'N21.SI',
	'5WH.SI' => '5WH.SI',
	'MT1.SI' => 'MT1.SI',
	'A78.SI' => 'A78.SI',
	'Z74.SI' => 'Z74.SI',
	'5MM.SI' => '5MM.SI'	
  );
  
  //Validations
  require_once('validations/equityformresult.php');
  
  if ($noErrors && $userArriveBySubmittingAForm) { //If no errors
  	
  	if ($quantity>0){ //Buy
  	
  		$total = $price*$quantity;
  		
  		if (($cash-$total-40)>0){ //Enough cash to buy
  			
  			$cash = $cash-$total-40;
  			$username = $user_profile['name'];
    		
  			require_once('scripts/quantity.php'); //Get quantity data
  			
  			if ($newQuantity = 0){
  				
  				require_once('scripts/userupdatedatabase.php'); //Insert into database
  				require_once('scripts/historyinsertdatabase.php'); //Insert into database
  				
  			} else {
  				
  				require_once('scripts/userinsertdatabase.php'); //Insert into database
  				require_once('scripts/historyinsertdatabase.php'); //Insert into database
  			
  			}

  			//Message
			$message = "\t\t" . '<font color="green">Transaction successful!!</font><br />' . "\n";
			$message = $message . "\t\t" . 'You have bought ' . $quantity;
			$message = $message . "\t\t" . $name . ' shares';
			$message = $message . "\t\t" . 'at $' . $total . '<br />';
			$message = $message . "\t\t" . 'A $40 commission fee has also been deducted from your account.<br />';
			$message = $message . "\t\t" . 'All prices are quoted in SGD dollars. Terms & Conditions may apply.';

			echo "<script language=javascript>alert('Transaction successful!!')</script>";
  		} else { //Not enough cash to buy
  			echo "<script language=javascript>alert('You do not have enough cash!! Please try again!!')</script>";
  		}
	
  	} else { //Sell
  		
  		$total = ($price*$quantity)*-1;
  		$cash = $cash+$total-40;
  		$username = $user_profile['name'];
    
  		require_once('scripts/userinsertdatabase.php'); //Insert into database
  		require_once('scripts/historyinsertdatabase.php'); //Insert into database

  		//Message
		$message = "\t\t" . '<font color="green">Transaction successful!!</font><br />' . "\n";
		$message = $message . "\t\t" . 'You have sold ' . $quantity;
		$message = $message . "\t\t" . $name . ' shares';
		$message = $message . "\t\t" . 'at $' . $total . '<br />';
		$message = $message . "\t\t" . 'A $40 commission fee has also been deducted from your account.<br />';
		$message = $message . "\t\t" . 'All prices are quoted in SGD dollars. Terms & Conditions may apply.';
		
		echo "<script language=javascript>alert('Transaction successful!!')</script>";
		
  	}
	
  } elseif ($haveErrors && $userArriveBySubmittingAForm) {	//If have errors
	
	foreach ($errors as $key=>$errorMessage) {
	
		if ($key == 'name') {
			$nameError = $errorMessage;
		}
		if ($key == 'quantity') {
			$quantityError = $errorMessage;
		}
	}
	
	$message = '';
	
	echo "<script language=javascript>alert('Please try again!!')</script>";
	
  } elseif ($userArriveByClickingOrDirectlyTypeURL) { //If arrive by URL
  
  	$message = '';
  	
  	echo "<script language=javascript>alert('Welcome!!')</script>";
  
  }
  
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Trading with Friends</title>
    
   	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <meta name="apple-mobile-web-app-capable" content="yes" />
      <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
      <meta property="og:image" content="https://github.com/Astarcorp/tradingwithfriends/blob/master/images/logo_large.jpg"/>

      <link href="scripts/style.css" rel="stylesheet" type="text/css">
    
      <script type="text/javascript" src="scripts/date_time.js"></script>
      <script type="text/javascript" src="scripts/jquery-1.10.2.min.js"></script>
      
      <script> 
      $(document).ready(function(){
        var auto_refresh = setInterval(
		  function (){
		  $("#showEquity").load("scripts/equity.php").fadeIn("slow");
	    }, 30000); //refresh every 30000 milliseconds
      });
      </script>

  </head>
  <body>
      <form action="index.php" method="post">
      
      <div id="fb-root"></div>
      <script src="//connect.facebook.net/en_US/all.js"></script>
      
      <div id="topbar">
      <img src="images/logo.jpg"/>
      </div>

      <span id="date_time"></span>
	  <script type="text/javascript">window.onload = date_time('date_time');</script>
      
      <p style="text-align: center;"><b><?php echo "Welcome " . $username . " to Trading with Friends!";?></b></p>
      <p style="text-align: center;"><b><?php echo "Currently, you have $" . $cash . " to spend on trading.";?></b></p>
      
      <script src="scripts/userinterface.js"></script>
      
      <?php echo $message; ?>
      
      <div id="equityButton">Equities List</div>
	  <div id="showEquity"><?php require 'scripts/equity.php';?></div>
	  
	  <div id="purchasingformButton">Purchasing Form</div>
	  <div id="showForm">
	  <p>
	  	<div><i>Tip: To sell an equity, type in negative number e.g -20</i></div></br></br>
		<b>Symbol:</b>
		<select id=name name="name" >
			<option value="">Select Equity</option>
			<?php foreach($names as $key=>$name) : ?>			
				<option value="<?php echo $key; ?>"  <?php if(!empty($_POST['name']) && $_POST['name']==$key) echo "selected"; ?> ><?php echo $name; ?></option>			
			<?php endforeach; ?>
		</select>
		<font color="red"><?php echo $nameError; ?></font><br/>
	 
		<b>Quantity:</b> <input type="text" name="quantity" value="<?php if(!empty($_POST['quantity']))echo $_POST['quantity']; ?>" /> <font color="red"><?php echo $quantityError; ?></font><br/>	

	  	<b>Last Trade:</b> <input type="text" name="price" value="<?php echo $price; ?>" readonly /><br/>
	  </p>
	  
	  <p>
	  <input type="submit" value="Submit" /><br>
	  </p>
	  </div>
	  
	  <div id="portfolioButton">My Portfolio</div>
	  <div id="showPortfolio"><?php require 'scripts/portfolio.php';?></div>
	  
	  
	  <div id="historyButton">History of Transaction</div>
	  <div id="showHistory"><?php require 'scripts/history.php';?></div>
  
	  <div id="recommendButton">Recommend this app to your friends!!</div>    
      
      <script>
      var appId = '<?php echo $facebook->getAppID() ?>';

      // Initialize the JS SDK
      FB.init({
        appId: appId,
        frictionlessRequests: true,
        cookie: true,
      });

      FB.getLoginStatus(function(response) {
        uid = response.authResponse.userID ? response.authResponse.userID : null;
      });
      </script>
      
      <b>Any Questions to Ask?? </b><a href="http://astartalk.forumotion.com/" target="_blank">Discuss it on our Forum!!</a>
      <br /><b>Interested to Find Out More About Equities?? </b><a href="http://astartalk.forumotion.com/">Visit our Website now!!</a>      
  </body>
</html>
