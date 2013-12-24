<?php

  //Define variables
  $name = '';
  $quantity = '';
  $price = '';
  $total = '';
  $sellQuantity = '';
  $username = '';
  $cash = '';
  $newQuantity = '';
  $oldQuantity = '';
  $oldId = '';
  $id = '';
  $order = '';
  $orderPrice = '';
  
  $friendsusername = '';
  $friendsid = '';
  $scores = '';
  $oldUsername = '';
  $oldFriends = '';
  $oldScores = ''; 
  $oldFriendsId = '';
  $Valid = '';
  
  $nameError = '';
  $quantityError = '';
  $sellquantityError = '';
  $idError = '';
  $orderError = '';
  $orderpriceError = '';

  $message = '';
  
  $errors = array();
  $noErrors = true;
  $haveErrors = !($noErrors);
 
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
  
  $profile_pic =  "http://graph.facebook.com/".$user."/picture?type=square";

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
  
  $friends = $facebook->api('me/friends'); //Get friends username
  
  foreach ($friends['data'] as $key=>$listOfFriends) {
  	
  	$friendsusername = $listOfFriends['name']; //Get friend name from array
    $friendsid = $listOfFriends['id']; //Get friend ID from array
  	
    require 'scripts/friendscore.php'; //Get score data from database
  	
  	if ($friendsusername!='' && $friendsid!='' && $scores!='') {
  		
  		$username = $user_profile['name'];
		require 'scripts/checkscores.php'; //Check database
		
		if ($Valid==1) {
			require 'scripts/friendscoresupdate.php'; //Update database
			$Valid = '';
		} else {
			require 'scripts/friendscoresinsert.php'; //Insert into database
		}
		
  		$scores = '';
  	}
  }

  require_once('scripts/cash.php'); //Get cash data from database
  
  $username = $user_profile['name'];
  $friendsusername = $user_profile['name']; //Input user name into database
  $friendsid = $user_profile['id']; //Input user ID into database
  $scores = $cash; //Get user score

  require 'scripts/checkscores.php'; //Check database
		
  if ($Valid==1) {
  	require 'scripts/friendscoresupdate.php'; //Update database
  	$Valid = '';
  } else {
	require 'scripts/friendscoresinsert.php'; //Insert into database
  }
  
  //Array storing equities names
  $names = array(	
	'Blumont, A33.SI' => 'Blumont, A33.SI',
	'Ezra, 5DN.SI' => 'Ezra, 5DN.SI',
	'GoldenAgr, E5H.SI' => 'GoldenAgr, E5H.SI',
	'$ Viking, 557.SI' => '$ Viking, 557.SI',
	'Noble Grp, N21.SI' => 'Noble Grp, N21.SI',
	'$ Rex Intl, 5WH.SI' => '$ Rex Intl, 5WH.SI',
	'Dragon Gp, MT1.SI' => 'Dragon Gp, MT1.SI',
	'LionGold, A78.SI' => 'LionGold, A78.SI',
	'Singtel, Z74.SI' => 'Singtel, Z74.SI',
	'$ Sky One, 5MM.SI' => '$ Sky One, 5MM.SI',
  	'$ Vallianz, 545.SI' => '$ Vallianz, 545.SI',
    'Genting SP, G13.SI' => 'Genting SP, G13.SI',
    'Capitaland, C31.SI' => 'Capitaland, C31.SI',
    'SIIC Env, 5GB.SI' => 'SIIC Env, 5GB.SI',
    'e Genting HK US$, S21.SI' => 'e Genting HK US$, S21.SI',
    'Yangzijiang, BS6.SI' => 'Yangzijiang, BS6.SI',
    'Asiasons, 5ET.SI' => 'Asiasons, 5ET.SI',
    'GLP, MC0.SI' => 'GLP, MC0.SI',
    'CapMallsAsia, JS8.SI' => 'CapMallsAsia, JS8.SI',
    'EzionHldg, 5ME.SI' => 'EzionHldg, 5ME.SI'
  );
  
  $orders = array(	
	'Stop Loss' => 'Stop Loss',
	'Market' => 'Market'
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
			$message = "\t\t" . '<font size="4" color="green">Transaction successful!!</font><br />' . "\n";
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
	
  		//Message
  		$message = '';
	
		$message = $message . "\t\t" . '<font size="4" color="red">Transaction fail!!</font><br />' . "\n";
		$message = $message . "\t\t" . 'Please correct the following error(s) : <br />' . "\n";
	
		$message = $message . "\t\t" . '<ol>' . "\n";
		
		foreach ($errors as $key=>$errorMessage) {
		
			$message = $message . "\t\t" . '<li>' . '<font color="red">' . $errorMessage . '</font>' . '</li>' . "\n";
			
			if ($key == 'name') {
				$nameError = $errorMessage;
			}
			if ($key == 'quantity') {
				$quantityError = $errorMessage;
			}
			if ($key == 'order') {
				$orderError = $errorMessage;
			}
			if ($key == 'orderPrice') {
				$orderpriceError = $errorMessage;
			}
		}
	
		$message = $message . "\t\t" . '</ol>' . "\n";

  	}
  } elseif (!empty($_POST['sellSubmit'])){ //User submit sell form
  
  	//Validations
  	require_once('validations/equityformresultsell.php');
  
  	if ($noErrors && $userArriveBySubmittingAForm) { //If no errors
  		
  		$username = $user_profile['name'];
  		
  		require_once('scripts/quantitynameid.php'); //Get quantity, name & id data from database
  		
  		if ($id = $oldId){ //Correct ID
  		
  			//Get price
	    	require 'scripts/equity_price.php';
	  		if ($name=="Blumont, A33.SI"){
	  			$price = $blumont;
	  		} elseif ($name=="Ezra, 5DN.SI"){
	  			$price = $ezra;
	  		} elseif ($name=="GoldenAgr, E5H.SI"){
	  			$price = $goldenagr;
	  		} elseif ($name=="$ Viking, 557.SI"){
	  			$price = $viking;
	  		} elseif ($name=="Noble Grp, N21.SI"){
	  			$price = $noble;
	  		} elseif ($name=="$ Rex Intl, 5WH.SI"){
	  			$price = $rex;
	  		} elseif ($name=="Dragon Gp, MT1.SI"){
	  			$price = $dragon;
	  		} elseif ($name=="LionGold, A78.SI"){
	  			$price = $liongold;
	  		} elseif ($name=="Singtel, Z74.SI"){
	  			$price = $singtel;
	  		} elseif ($name=="$ Sky One, 5MM.SI"){
	  			$price = $skyone;
	  		} elseif ($name=="$ Vallianz, 545.SI"){
	  			$price = $vallianz;
	  		} elseif ($name=="Genting SP, G13.SI"){
	  			$price = $gentingsp;
	  		} elseif ($name=="Capitaland, C31.SI"){
	  			$price = $capitaland;
	  		} elseif ($name=="SIIC Env, 5GB.SI"){
	  			$price = $siic;
	  		} elseif ($name=="e Genting HK US$, S21.SI"){
	  			$price = $gentinghk;
	  		} elseif ($name=="Yangzijiang, BS6.SI"){
	  			$price = $yangzijiang;
	  		} elseif ($name=="Asiasons, 5ET.SI"){
	  			$price = $asiasons;
	  		} elseif ($name=="GLP, MC0.SI"){
	  			$price = $glp;
	  		} elseif ($name=="CapMallsAsia, JS8.SI"){
	  			$price = $capmallsasia;
	  		} elseif ($name=="EzionHldg, 5ME.SI"){
	  			$price = $ezionhldg;
	  		} else{
	  			$price = "ERROR!!";
	  		} 
	  		
  			
  			if ($oldQuantity>0){ //There is quantity in database
  			
  				$newQuantity = $oldQuantity-$quantity;
  			
  				if ($newQuantity>0){ //Updated quantity is more than 0
	
  					$total = $price*$quantity;
  					$cash = $cash+$total-40;
  				
  					require_once('scripts/userupdatedatabasesell.php'); //Update database
  					require_once('scripts/historyinsertdatabase.php'); //Insert into database
  				
  					//Message
					$message = "\t\t" . '<font size="4" color="green">Transaction successful!!</font><br />' . "\n";
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
					$message = "\t\t" . '<font size="4" color="green">Transaction successful!!</font><br />' . "\n";
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
  		} else { //Wrong ID
  			echo "<script language=javascript>alert('Wrong ID entered!! Please try again!!')</script>";
  		}
	
  	} elseif ($haveErrors && $userArriveBySubmittingAForm) { //If have errors
	
  		//Message
  		$message = '';
	
		$message = $message . "\t\t" . '<font size="4" color="red">Transaction fail!!</font><br />' . "\n";
		$message = $message . "\t\t" . 'Make corrections to the following error(s) : <br />' . "\n";
	
		$message = $message . "\t\t" . '<ol>' . "\n";
		
		foreach ($errors as $key=>$errorMessage) {
			
			$message = $message . "\t\t" . '<li>' . '<font color="red">' . $errorMessage . '</font>' . '</li>' . "\n";
			
			if ($key == 'sellQuantity') {
				$sellquantityError = $errorMessage;
			}
			if ($key == 'id') {
				$idError = $errorMessage;
			}
		}
		
		$message = $message . "\t\t" . '</ol>' . "\n";
	
  	}
  } else { //Welcome user
  	$message = '';
	
	$message = $message . "\t\t" . '<font size="4" color="blue">Welcome to Trading with Friends!!</font><br />' . "\n";
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
			$("#scrollEquity").load("scripts/equity.php").fadeIn("slow");
		}, 30000); //refresh every 30000 milliseconds
    });
    </script>
      
    <script> 
    $(document).ready(function(){
    	var auto_refresh = setInterval(
			function (){
			$("#orderprocessing").load("scripts/order.php");
		}, 30000); //refresh every 30000 milliseconds
	});
	</script>
	
	<script>
	(function(d, s, id) {
  		var js, fjs = d.getElementsByTagName(s)[0];
  		if (d.getElementById(id)) return;
  		js = d.createElement(s); js.id = id;
  		js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
	</script>
	
	<script>
		!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
		if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';
		fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');
	</script>
</head>
  <body>
	<div id="fb-root"></div>
    <script src="//connect.facebook.net/en_US/all.js"></script>
               
    <div id="topbar" style="text-align: center;">
    <br /><img src="images/logo.png"/>
    </div>
    
    <div id="welcome">
    <p>
    <b><span id="date_time"></span></b>
    <script type="text/javascript">window.onload = date_time('date_time');</script>
    </p>
    
    <div style="float:right;">
    <a href="https://twitter.com/tradingwfriends",'_blank' class="twitter-follow-button" data-show-count="false">Follow @tradingwfriends</a>
    <a href="https://twitter.com/intent/tweet?screen_name=tradingwfriends" class="twitter-mention-button" data-related="tradingwfriends">Tweet to @tradingwfriends</a>
	</div>
    
	<div class="fb-like" data-href="https://www.facebook.com/tradingwithfriends",'_blank" data-layout="standard" data-action="like" data-show-faces="true" data-share="true" style="display:inline-block;"></div>

    <div style="text-align: center;">    
    <?php echo "<img src=\"" . $profile_pic . "\" />";?>
    </div>
    
    <div style="text-align: center;"><b><?php echo "Hello " . $username . "! You have $" . $cash . " on hand now, let's start trading!!";?></b></div>

    <div style="text-align: center;"><b><?php echo $message; ?></b></div>
    </div>
    
    <script src="scripts/userinterface.js"></script>
      
    <div id="equityButton">Equities List</div>
	<div id="showEquity">
		<table border=1 cellspacing=4 cellpadding=2>
	 		<tr class=head><th>Names of Equities</th><th>Symbol</th><th>Last</th><th>Open</th><th>Close</th><th>Change</th><th>Bid P</th><th>Ask P</th><th>Total Volume</th><th>Day Range</th><th>52 Wks Range</th><th>EPS</th><th>P/B</th><th>P/E</th><th>Last Trade Date</th><th>Time</th><th>Charts</th></tr>
	 	</table>
      	<div id="scrollEquity" style="width:1190px;height:250px;line-height:1.5em;overflow:auto;padding:2px;">
				<?php require 'scripts/equity.php';?>
 		</div>
 		</div>
	
	<div id="orderprocessing"><?php require 'scripts/order.php';?></div>
	
	<div>
	<div id="purchasingformButton" style="display:inline-block;">Purchasing Form</div> 
	<div id="sellingformButton" style="display:inline-block;">Selling Form</div>
	
	<div id="showForm" style="display:inline-block;">
	<form name="buyForm" method="post">
	<p>
		<i>Tip: Check everything before submitting to prevent mistakes</i></br>
		<b>Equity:</b>
		<select id=name name="name" >
			<option value="">Select Equity</option>
			<?php foreach($names as $key=>$name) : ?>			
				<option value="<?php echo $key; ?>"  <?php if(!empty($_POST['name']) && $_POST['name']==$key) echo "selected"; ?> ><?php echo $name; ?></option>			
			<?php endforeach; ?>
		</select>
		<font color="red"><?php echo $nameError; ?></font><br/>
	 
		<b>Quantity:</b> <input type="text" name="quantity" value="<?php if(!empty($_POST['quantity']))echo $_POST['quantity']; ?>" /> <font color="red"><?php echo $quantityError; ?></font><br/>	
	 	
	 	<b>Order:</b>
	 	<select id=order name="order" >
			<option value="">Select Order</option>
			<?php foreach($orders as $key=>$order) : ?>			
				<option value="<?php echo $key; ?>"  <?php if(!empty($_POST['order']) && $_POST['order']==$key) echo "selected"; ?> ><?php echo $order; ?></option>			
			<?php endforeach; ?>
		</select>
		<font color="red"><?php echo $orderError; ?></font>
		
		<b>at:</b> <input type="text" name="orderPrice" value="<?php if(!empty($_POST['orderPrice']))echo $_POST['orderPrice']; ?>" /> <font color="red"><?php echo $orderpriceError; ?></font>
	</p>
	  
	<p>
		<input type="submit" name="buySubmit" value="Submit" id="submit"/>
	</p>
	</form>
	</div>
	 
	<div id="showsellForm" style="display:inline-block;">
	<form name="sellForm" method="post">
	<p>
	  	<i>Tip: Check everything before submitting to prevent mistakes</i></br>
		<b>ID:</b> <input type="text" name="id" value="<?php if(!empty($_POST['id']))echo $_POST['id']; ?>" /> <font color="red"><?php echo $idError; ?></font><br/>
		<b>Quantity:</b> <input type="text" name="sellQuantity" value="<?php if(!empty($_POST['sellQuantity']))echo $_POST['sellQuantity']; ?>" /> <font color="red"><?php echo $sellquantityError; ?></font><br /><br />
	</p>
	
	<p>
	  	<input type="submit" name="sellSubmit" value="Submit" id="submit"/>
	</p>
	</form>
	</div>
	</div>
	
	<div>
	<div id="portfolioButton" style="display:inline-block;">My Portfolio </div> 
	<div id="historyButton" style="display:inline-block;">History of Transactions</div>
	
	<div id="showPortfolio" style="display:inline-block;">
	<div style="width:570px;height:150px;line-height:1.5em;overflow:auto;padding:3px;">
		<?php require 'scripts/portfolio.php';?>  
	</div> 
	</div>
	 
	<div id="showHistory" style="display:inline-block;">
	<div style="width:570px;height:150px;line-height:1.5em;overflow:auto;padding:3px;">
		<?php require 'scripts/history.php';?>	 
	</div>
	</div>
	</div>
     
    <div>
    <div id="scoreButton" style="display:inline-block;">Hall of Fame</div>
    <div id="tipsButton" style="display:inline-block;">Tips on Investing</div>
    
    <div id="showScore" style="display:inline-block;">
    <div style="width:570px;height:150px;line-height:1.5em;overflow:auto;padding:3px;">
		<?php require 'scripts/friendscores.php'; ?>
    </div>
    </div>
    
    <div id="showTips" style="display:inline-block;">
    <div style="width:570px;height:150px;line-height:1.5em;overflow:auto;padding:3px;">
		hi
    </div>
    </div>
    </div>
    
    <div>
	<div id="recommendButton" style="display:inline-block;">Recommend to Friends</div>
	<div id="postButton" style="display:inline-block;">Post on Facebook</div>     
	<div id="websiteButton" style="display:inline-block;">Trading with Friends Website</div>
	<div id="forumButton" style="display:inline-block;">Trading with Friends Forum</div>     
    </div>
    
    <div id="connect">
		<a href="https://twitter.com/tradingwfriends/" target="_blank" id="twitter">twitter</a> <a href="https://www.facebook.com/tradingwithfriends/" target="_blank" id="facebook">facebook</a>
	</div>
			
	<p id="footnote">
		&#169; Copyright 2013. All rights reserved
	</p>
	
    <script>
    var appId = '<?php echo $facebook->getAppID() ?>';

    //Initialize the JS SDK
    FB.init({
      appId: appId,
      frictionlessRequests: true,
      cookie: true,
    });

    FB.getLoginStatus(function(response) {
      uid = response.authResponse.userID ? response.authResponse.userID : null;
    });
    </script>
</body>
</html>
