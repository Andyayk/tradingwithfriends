<?php

  // Server
  require 'server/fb-php-sdk/facebook.php';

  // Production
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
        <title>Display Date and Time in Javascript</title>
        <script type="text/javascript" src="scripts/date_time.js"></script>

      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
      <meta name="apple-mobile-web-app-capable" content="yes" />
      <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
      <meta property="og:image" content="https://github.com/Astarcorp/Friendsmash2/blob/master/images/logo_large.jpg"/>

      <link href="scripts/style.css" rel="stylesheet" type="text/css">
      
      <script src="scripts/jquery-1.8.3.js"></script>
      <script src="scripts/jquery.jCounter-0.1.4.js"></script>
      <!--[if IE]><script src="scripts/excanvas.js"></script><![endif]-->
      
    <script>
	</script>
      
  </head>

  <body>
  
  		<span id="date_time"></span>
        <script type="text/javascript">window.onload = date_time('date_time');</script>
      
      <div id="fb-root"></div>
      <script src="//connect.facebook.net/en_US/all.js"></script>
      
      <p>A Star Crop</p>
      <button onclick="myFunction()">Click Here!</button>
      <p id="demo"></p>
      
      <script>
      function myFunction()
      {
      var x;

      var person=prompt("Please enter your name","Harry Potter");

      if (person!=null)
        {
        x="Hello " + person + "! Welcome to Trading With Friend";
        document.getElementById("demo").innerHTML=x;
        }
      }
      </script>
      
      <div id="topbar">
      <img src="images/logo.jpg"/>
      </div>
      
      <div id="stage">
        <div id="gameboard">
            <canvas id="myCanvas"></canvas>
        </div>
      </div>

      <script src="scripts/core.js"></script>
      <script src="scripts/game.js"></script>
      <script src="scripts/ui.js"></script>
      <script src="scripts/accounting.js"></script>
      <script src="scripts/payments.js"></script>      
      
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