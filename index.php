<?php

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
  
$days = array(		
	'1' => '1',		
	'2' => '2',		
	'3'	=> '3',	
	'4' => '4',		
	'5' => '5',		
	'6'	=> '6',
	'7' => '7',		
	'8' => '8',		
	'9'	=> '9',
	'10' => '10',		
	'11' => '11',		
	'12' => '12',
	'13' => '13',		
	'14' => '14',		
	'15' => '15',
	'16' => '16',		
	'17' => '17',		
	'18' => '18',
	'19' => '19',		
	'20' => '20',		
	'21' => '21',
	'22' => '22',		
	'23' => '23',		
	'24' => '24',
	'25' => '25',		
	'26' => '26',		
	'27' => '27',
	'28' => '28',		
	'29' => '29',		
	'30' => '30',
	'31' => '31'	
);  
   
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Trading with Friends!</title>
    
   	  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

      <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <meta name="apple-mobile-web-app-capable" content="yes" />
      <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
      <meta property="og:image" content="https://github.com/Astarcorp/tradingwithfriends/blob/master/images/logo_large.jpg"/>

      <link href="scripts/style.css" rel="stylesheet" type="text/css">
      
      <script type="text/javascript" src="scripts/date_time.js"></script>
      <script type="text/javascript" src="scripts/jquery-1.10.2.min.js"></script>

  </head>
  <body>
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
	  
	  <p>
		<b>Date of Birth:</b>
		Day
		<select name="day" >
			<option value="">Select Day</option>
			<?php foreach($days as $key=>$day) : ?>			
				<option value="<?php echo $key; ?>"  <?php if(!empty($_POST['day']) && $_POST['day']==$key) echo "selected"; ?> ><?php echo $day; ?></option>			
			<?php endforeach; ?>
		</select>
	  </p>
	 
	  <div id="portfolioButton">My Portfolio</div>
	  <div id="showPortfolio">My Portfolio</div>
	  
	  <div id="recommendButton">Recommend Friends</div>
                         
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
  </body>
</html>
