<?php

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

  // Server
  require 'server/fb-php-sdk/facebook.php';
  
  function get_stocks($stock, $cache)
  {
  	return $this->generate_stock_array($stock);   
  } 

  // Linking to Facebook Application
  $app_id = '418284238273760';
  $app_secret = '44926e66c8b6d95019865554ec58c9a2';
  $app_namespace = 'tradingwithfriends';

  $app_url = 'http://apps.facebook.com/' . $app_namespace . '/';
  $scope = 'email,publish_actions';

  // Init the Facebook SDK
  $facebook = new Facebook(array(
     'appId'  => $app_id,
     'secret' => $app_secret,
   ));

   // Get the current user
  $user = $facebook->getUser();

   // If the user has not installed the app, redirect them to the Login Dialog
  if (!$user) {
    $loginUrl = $facebook->getLoginUrl(array(
      'scope' => $scope,
      'redirect_uri' => $app_url,
    ));
    print('<script> top.location.href=\'' . $loginUrl . '\'</script>');
  }
  
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
  	require_once('scripts/userinsertdatabase.php');
 	$total = $price*$quantity;
	$message = "\t\t" . '<font color="green">Success!! Equity has been added into your Portfolio</font><br />' . "\n";
	$message = $message . "\t\t" . 'You have bought ' . $quantity;
	$message = $message . "\t\t" . $name . ' shares';
	$message = $message . "\t\t" . 'at $' . $total;

  } else if ($haveErrors && $userArriveBySubmittingAForm) {	//If have errors
	
	foreach ($errors as $key=>$errorMessage) {
	
		if ($key == 'name') {
			$nameError = $errorMessage;
		}
		if ($key == 'quantity') {
			$quantityError = $errorMessage;
		}
	}
	
	$message = '';
	
  } else if ($userArriveByClickingOrDirectlyTypeURL) { //If arrive directly by url
  
	$message = '';
	
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
      
      <div id="topbar">
      <img src="images/logo.jpg"/>
      </div>
      
      <div id="fb-root"></div>
      <script src="//connect.facebook.net/en_US/all.js"></script>
      
      <span id="date_time"></span>
	  <script type="text/javascript">window.onload = date_time('date_time');</script>

      <script src="scripts/userinterface.js"></script>
      <script src="scripts/accounting.js"></script>
      <script src="scripts/payments.js"></script>
      
      <div id="equityButton">Equities List</div>
	  <div id="showEquity"><?php require 'scripts/equity.php';?></div>
	  
	  <?php echo $message; ?>
	  <div id="purchasingformButton">Purchasing Form</div>
	  <div id="showForm">
	  <p>
		<b>Equity:</b>
		<select name="name" >
			<option value="">Select Equity</option>
			<?php foreach($names as $key=>$name) : ?>			
				<option value="<?php echo $key; ?>"  <?php if(!empty($_POST['name']) && $_POST['name']==$key) echo "selected"; ?> ><?php echo $name; ?></option>			
			<?php endforeach; ?>
		</select>
		<font color="red"><?php echo $nameError; ?></font>
	 
		<b>Quantity:</b> <input type="text" name="quantity" value="<?php if(!empty($_POST['quantity']))echo $_POST['quantity']; ?>" /> <font color="red"><?php echo $quantityError; ?></font>	
	  	<b>Price:</b> <input type="text" name="price" value="<?php echo $price; ?>" readonly />
	  </p>
	  
	  <p>
	  	<input type="submit" value="Submit" /><br>
	  </p>
	  </div>
	  
	  <div id="portfolioButton">My Portfolio</div>
	  <div id="showPortfolio"><?php require 'scripts/portfolio.php';?></div>
	  
	  
	  <div id="recommendButton">Recommend this App to Your Friends!</div>
                         
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
