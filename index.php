<?php

/**
* Copyright 2013 Facebook, Inc.
*
* You are hereby granted a non-exclusive, worldwide, royalty-free license to
* use, copy, modify, and distribute this software in source code or binary
* form for use in connection with the web services and APIs provided by
* Facebook.
*
* As with any software that integrates with the Facebook platform, your use
* of this software is subject to the Facebook Developer Principles and
* Policies [http://developers.facebook.com/policy/]. This copyright notice
* shall be included in all copies or substantial portions of the software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
* THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
* FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER
* DEALINGS IN THE SOFTWARE.
*/
  require 'server/fb-php-sdk/facebook.php';

  // Production
  $app_id = '80663151393';
  $app_secret = 'e2379e1ff76d4887adecd0cbf0f6b4df';
  $app_namespace = 'zombieesssssssss';

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
    <title>Friend Smash!</title>

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
      var d=new Date();
      document.write(d);
      </script>

      <script>
      function startTime()
      {
      var today=new Date();
      var h=today.getHours();
      var m=today.getMinutes();
      var s=today.getSeconds();
      // add a zero in front of numbers<10
      m=checkTime(m);
      s=checkTime(s);
      document.getElementById('date').innerHTML=h+":"+m+":"+s;
      t=setTimeout(function(){startTime()},500);
      }

      function checkTime(i)
      {
      if (i<10)
        {
        i="0" + i;
        }
      return i;
      }
      </script>
      
  </head>
  
<body2 onload="startTime()">
<div id="date"></div>
</body2>

<body onload="startTime()">
<div id="date"></div>
</body>

  <body>
      <div id="fb-root"></div>
      <script src="//connect.facebook.net/en_US/all.js"></script>
      
      <p>HELLO JWJWJWJWJWJWJWJWJW</p>
      <button onclick="myFunction()">Try</button>
      <script>
      function myFunction()
      {
    		alert("I am an alert box!");
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