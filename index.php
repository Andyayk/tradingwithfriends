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
      
      <script>
      $(document).ready(function(){
      $("#customAccordion").accordion({
    		collapsible: true,
    	    active: false,
    	    heightStyle: "content"
    	});
      });  
      </script>

  </head>
  <body>
      <div id="topbar">
      <img src="images/logo.jpg"/>
      </div>
      
      <div id="fb-root"></div>
      <script src="//connect.facebook.net/en_US/all.js"></script>
      
      <span id="date_time"></span>
	  <script type="text/javascript">window.onload = date_time('date_time');</script>

      <script src="scripts/core.js"></script>
      <script src="scripts/userinterface.js"></script>
      <script src="scripts/accounting.js"></script>
      <script src="scripts/payments.js"></script>
      
      <div id="menuDemo">
      	<ul>
    	  <li id="homeMenu"><a href="#menuHome">Home</a>
          </li>
        <li><a href="#">Pages</a>
        	<ul>
              <li><a href="#menuPagesOne">Page Number One</a></li>
              <li><a href="#menuPagesTwo">Page Number Two</a></li>
              <li><a href="#menuPagesThree">Page Number Three</a></li>
            </ul>
        </li>
        <li><a href="#">Links</a>
        	<ul>
              <li><a href="#LinkNumber1">Link Number 1</a></li>
              <li><a href="#LinkNumber2">Link Number 2</a></li>
              <li><a href="#LinkNumber3">Link Number 3</a></li>
            </ul>
        </li>
        </ul>
	  </div>
	  
	  <div id="customAccordion">
   	    <!-- First accordion menu item-->
   		<h3>Custom Feature #1</h3>
   		<div>
       		<p>
       			Allow collapsible menus - including the active one.
     		</p>
    	</div>
    
		<!-- Second accordion menu item-->
    	<h3>Custom Feature #2</h3>
    	<div>
    		<p>
        	    Sets active panel to false, making the menu start out with all menu items closed.
       	 	</p>
    	</div>
    
    	<!-- Third accordion menu item-->
    	<h3>Custom Feature #3</h3>
    	<div>
    		<p>
           		Make each inside panel only as tall as it's content requires.
        	</p>
    	</div>
	  </div>
      
      <div id="equityButton">Equities List</div>
	  <div id="showEquity"><?php require_once 'scripts/equity.php';?></div>
	  
	  <div id="portfolioButton">My Portfolio</div>
	  
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
