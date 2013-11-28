<?php

  //Define variables
  $name = '';
  $quantity = '';
  $price = '';
  $total = '';
  $nameError = '';
  $quantityError = '';
  $sellName = '';
  $sellQuantity = '';
  $sellnameError = '';
  $sellquantityError = '';
  $idError = '';
  $message = '';
  $errors = array();
  $noErrors = true;
  $haveErrors = !($noErrors);
  $username = '';
  $cash = '';
  $newQuantity = '';
  $oldQuantity = '';
  $oldId = '';
  $id = '';

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
  
  require_once('scripts/cash.php'); //Get cash data from database
  
  //Array storing equities names
  $names = array(	
	'Blumont, A33.SI' => 'Blumont, A33.SI',
	'PFood, P05.SI' => 'PFood, P05.SI',
	'GoldenAgr, E5H.SI' => 'GoldenAgr, E5H.SI',
	'$ Viking, 557.SI' => '$ Viking, 557.SI',
	'Noble Grp, N21.SI' => 'Noble Grp, N21.SI',
	'$ Rex Intl, 5WH.SI' => '$ Rex Intl, 5WH.SI',
	'Dragon Gp, MT1.SI' => 'Dragon Gp, MT1.SI',
	'LionGold, A78.SI' => 'LionGold, A78.SI',
	'Singtel, Z74.SI' => 'Singtel, Z74.SI',
	'$ Sky One, 5MM.SI' => '$ Sky One, 5MM.SI'	
  );
  
  if (!empty($_POST['buySubmit'])){ //User submit buy form
  
  	//Validations
  	require_once('validations/equityformresult.php');
  
  	if ($noErrors && $userArriveBySubmittingAForm) { //If no errors
  	
  		$total = $price*$quantity;
  		
  		if (($cash-$total-40)>0){ //Enough cash to buy
  			
  			$cash = $cash-$total-40;
  			$username = $user_profile['name'];
    		
  			require_once('scripts/quantity.php'); //Get quantity data from database
  			
  			if ($oldQuantity>0){ //There is quantity in database
  				
  				$newQuantity = $oldQuantity+$quantity;
  				
  				require_once('scripts/userupdatedatabase.php'); //Update database
  				require_once('scripts/historyinsertdatabase.php'); //Insert into database
  				
  			} else { //No quantity in database
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
	
  	} elseif ($haveErrors && $userArriveBySubmittingAForm) { //If have errors
	
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
	
  	}
  } elseif (!empty($_POST['sellSubmit'])){ //User submit sell form
  
  	//Validations
  	require_once('validations/equityformresultsell.php');
  
  	if ($noErrors && $userArriveBySubmittingAForm) { //If no errors
  		
  		$username = $user_profile['name'];
  		
  		require_once('scripts/quantity2.php'); //Get quantity & id data from database
  		
  		if ($id = $oldId){ //Correct ID
  			
  			if ($oldQuantity>0){ //There is quantity in database
  			
  				$newQuantity = $oldQuantity+$quantity;
  			
  				if ($newQuantity>0){ //Updated quantity is more than 0
	
  					$total = $price*$quantity;
  					$cash = $cash+$total-40;
  				
  					require_once('scripts/userupdatedatabase2.php'); //Update database
  					require_once('scripts/historyinsertdatabase.php'); //Insert into database
  				
  					//Message
					$message = "\t\t" . '<font color="green">Transaction successful!!</font><br />' . "\n";
					$message = $message . "\t\t" . 'You have sold ' . $quantity;
					$message = $message . "\t\t" . $name . ' shares';
					$message = $message . "\t\t" . 'at $' . $total . '<br />';
					$message = $message . "\t\t" . 'A $40 commission fee has also been deducted from your account.<br />';
					$message = $message . "\t\t" . 'All prices are quoted in SGD dollars. Terms & Conditions may apply.';
		
					echo "<script language=javascript>alert('Transaction successful!!')</script>";
  			
  				} elseif ($newQuantity<0){ //Updated quantity is less than 0
					echo "<script language=javascript>alert('You do not have enough equities to sell!! Please try again!!')</script>";
  				} else { //Updated quantity is equal to 0

  					$total = $price*$quantity;
  					$cash = $cash+$total-40;
  				
  					require_once ('scripts/userdeletedatabase.php'); //Delete from database
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
  				
  			} else { //No quantity in database
  				echo "<script language=javascript>alert('You do not have enough equities to sell!! Please try again!!')</script>";
  			}
  		} else {
  			echo "<script language=javascript>alert('Wrong ID entered!! Please try again!!')</script>";
  		}
	
  	} elseif ($haveErrors && $userArriveBySubmittingAForm) {	//If have errors
	
		foreach ($errors as $key=>$errorMessage) {
	
			if ($key == 'sellName') {
				$sellnameError = $errorMessage;
			}
			if ($key == 'sellQuantity') {
				$sellquantityError = $errorMessage;
			}
			if ($key == 'id') {
				$idError = $errorMessage;
			}
		}
	
		$message = '';
		echo "<script language=javascript>alert('Please try again!!')</script>";
	
  	}
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
	  <form name="buyForm" method="post">
	  <p>
	  	<div><i>Tip: Check everything before submitting to prevent mistakes</i></div></br></br>
		<b>Equity:</b>
		
		<select id=name name="name" >
			<option value="">Select Equity</option>
			<?php foreach($names as $key=>$name) : ?>			
				<option value="<?php echo $key; ?>"  <?php if(!empty($_POST['name']) && $_POST['name']==$key) echo "selected"; ?> ><?php echo $name; ?></option>			
			<?php endforeach; ?>
		</select>
		<font color="red"><?php echo $nameError; ?></font><br/>
	 
		<b>Quantity:</b> <input type="text" name="quantity" value="<?php if(!empty($_POST['quantity']))echo $_POST['quantity']; ?>" /> <font color="red"><?php echo $quantityError; ?></font>	
	  </p>
	  
	  <p>
	  <input type="submit" name="buySubmit" value="Submit" />
	  </p>
	  </div>
	  </form>
	  
	  <div id="sellingformButton">Selling Form</div>
	  <div id="showsellForm">
	  <form name="sellForm" method="post">
	  <p>
	  	<div><i>Tip: Check everything before submitting to prevent mistakes</i></div></br></br>
		<b>Equity:</b>
		
		<select id=sellName name="sellName" >
			<option value="">Select Equity</option>
			<?php foreach($names as $key=>$name) : ?>			
				<option value="<?php echo $key; ?>"  <?php if(!empty($_POST['sellName']) && $_POST['sellName']==$key) echo "selected"; ?> ><?php echo $name; ?></option>			
			<?php endforeach; ?>
		</select>
		<font color="red"><?php echo $sellnameError; ?></font><br/>
	 
		<b>Quantity:</b> <input type="text" name="sellQuantity" value="<?php if(!empty($_POST['sellQuantity']))echo $_POST['sellQuantity']; ?>" /> <font color="red"><?php echo $sellquantityError; ?></font><br/>
		<b>ID:</b> <input type="text" name="id" value="<?php if(!empty($_POST['id']))echo $_POST['id']; ?>" /> <font color="red"><?php echo $idError; ?></font>	
	  </p>
	  
	  <p>
	  <input type="submit" name="sellSubmit" value="Submit" />
	  </p>
	  </div>
	  </form>
	  
	  <div id="portfolioButton">My Portfolio</div>
	  <div id="showPortfolio"><?php require 'scripts/portfolio.php';?></div>
	  
	  
	  <div id="historyButton">History of Transactions</div>
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
