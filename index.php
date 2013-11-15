<?php

  // Server
  require 'server/fb-php-sdk/facebook.php';
  require 'scripts/equity.php';
  require 'scripts/portfolio.php';
  
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
      <script src="scripts/jquery-1.8.3.js"></script>
      <script src="scripts/jquery.jCounter-0.1.4.js"></script>
      <!--[if IE]><script src="scripts/excanvas.js"></script><![endif]-->
      
      <script> 
	  $(document).ready(function(){
  	  	$("#flip").click(function(){
      		$("#panel").slideToggle("slow");
      	});
      });
      </script>
 
	  <style type="text/css"> 
	  #panel,#flip
 	  {
		padding:5px;
		text-align:center;
		background-color:#e5eecc;
		border:solid 1px #c3c3c3;
	  }
	  #panel
	  {
		padding:50px;
		display:none;
	  }
	  </style>

  </head>
  <body>
  	
      <link rel="stylesheet" type="text/css" media="screen" href="<?= $model['appUrl'] ?>scripts/portfolio.css?v=1.0" />

<script>
  var STOCK_PRICE_AJAX_URL = '<?= $model['appUrl'] ?>/stockList';
</script>

<script src="<?= $model['appUrl'] ?>scripts/portfolio.js"></script>

<div id="content">

<h2>Hi 


Welcome to Stocks R Us

</h2>
 
<table>
   <tr>
     <th>Ticker</th>
     <th>Price</th>
     <th>Shares</th>
     <th>Total</th>
    <th colwidth="2">(negative shares = sell)</th>
   </tr>
   
   <? foreach ($model['stocks'] as $stock): ?>
   <tr>
     <td><?= $stock->TICKER ?></td>
     <td id="stock-price-<?= $stock->ID ?>"></td>
    
    <td id="stock-shares-<?= $stock->ID ?>">
       <?= $stock->SHARES ?>
     </td>

    <!-- because we cannot get the innerHTML of the shares element in FBJS -->
    <? if ($stock->SHARES): ?>
      <script> 
          portfolioShares[<?= $stock->ID ?>] = <?= $stock->SHARES ?>; 
      </script>
    <? endif; ?>
 
     <td id="stock-total-<?= $stock->ID ?>"></td>
     <td class="row-controls">
       <div>

         <!-- buy/sell form for this stock -->
         <form action="<?= $model['appUrl'] ?>/tradeStock">
           <input type="submit" value="Buy/Sell" class="trade-button"/>
           <input type="hidden" name="stockId" value="<?= $stock->ID ?>"/>
           <input type="text" name="shares" class="shares"/>           
           shares.
         </form>

         <!-- recommend this stock to your friends -->
         <a href="<?= $model['appUrl'] ?>/recommendStockToFriends?ticker=<?= $stock->TICKER ?>"
            class="recommend-control">
           Recommend to your friends!
         </a>

       </div>

       <? if ($model['tradeResult'] && $model['tradeResultStockId'] == $stock->ID): ?>       				       
         Change: <span id="trade-result"></span>         

	 <!-- leave the formatting to the javascript -->
         <script>            
	    tradeResult = <?= $model['tradeResult'] ?>;
         </script>

       <? endif; ?>

     </td>
   </tr>
   <? endforeach; ?>
   <tr class="footer">
     <td>Total:</td>
     <td id="total"></td>
     <td></td>
     <td></td>
   </tr>
</table>

<a id="toggle-refresh" onclick="toggleRefresh()">Start refresh</a>

<div id="console">
    
</div>

</div>

<script>
init();
</script>
      
      <div id="topbar">
      <img src="images/logo.jpg"/>
      </div>
      <?php function get_stocks($stock, $cache)
  {
  	return $this->generate_stock_array($stock);   
  } ?>
      
      <div id="fb-root"></div>
      <script src="//connect.facebook.net/en_US/all.js"></script>
      
      <span id="date_time"></span>
	  <script type="text/javascript">window.onload = date_time('date_time');</script>
      
      <p>AStar Corp</p>
      <button onclick="welcome()">Click Here!</button>
      <p id="welcome"></p>
      
      <script>
      
      function welcome()
      {
      	var x;

     	var person=prompt("Please enter your name","");

      if (person!=null)
        {
        	x="Hi " + person + "! Welcome to Trading with Friends";
        	document.getElementById("welcome").innerHTML=x;
        }
      }
      </script>
      
      <div id="flip">Click to slide the panel down or up</div>
	  <div id="panel">
	  <?php

  echo "<html>".header('Refresh: 300')."<head><body>";
  class yahoo_stocks {
  
  function get_stocks($stock, $cache)
  {
  	return $this->generate_stock_array($stock);   
  } 
     
  function generate_stock_array($stock)
  {
    echo "<style type=\"text/css\">";
	echo "td.even {";
	echo "	background-color: #FCF6CF; color: black; font-family:verdana;margin-top:0px;margin-bottom:4px;font-size:80%;";
	echo "}";
	echo "td.odd {";
	echo "	background-color: #FEFEF2; color: black; font-family:verdana;margin-top:0px;margin-bottom:4px;font-size:80%;";
	echo "}";
	echo "tr.head {";
	echo "color:#000000;
	background-color: #F0F0F0;
	font-family:verdana;
	margin-top:0px;
	margin-bottom:8px;
	font-size:80%;";
	echo "}";
	echo "</style>";
	echo "<table border=1 cellspacing=1 cellpadding=2>";
	echo "<tr class=head><td>Name</td><td>Last Trade</td><td>Open</td><td>% Change</td><td>Change</td><td>Day's Low</td><td>Day's High</td><td>Change 52wk Low</td><td>Change 52wk High</td><td>% Change 52wk Low</td><td>% Change 52wk High</td><td>52 low</td><td>52 high</td><td>Chart</td></tr>";
			
	$row = 1;
	if (($handle = fopen($stock, "r")) !== FALSE) 
	{
    	while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) 
    	{
        	$num = count($data);
			echo "<tr>";
        	$row++;
       		for ($c=0; $c < $num; $c++) 
        	{
				if($row%2==0)
				{
					echo "<td class=even>";
					if($data[4]<0&&($c==4||$c==1||$c==0))
						echo "<font color=red>";
					else	
					{
						if($data[4]>0&&($c==4||$c==1||$c==0))
						echo "<font color=green>";
					}
					echo $data[$c]."</font>";
					if(($c+1)==$num)
					{
						echo "</td><td class=even><img src=http://ichart.finance.yahoo.com/h?s=".$data[0]."&lang=en-IN&region=in></td>";
					}
				else 
					echo "</td>";
				}
					else
					{
						echo "<td class=odd>";
						if($data[4]<0&&($c==4||$c==1||$c==0))
							echo "<font color=red>";
						else
						{
							if($data[4]>0&&($c==4||$c==1||$c==0))
								echo "<font color=green>";
						}
							echo $data[$c]."</font>";
							if(($c+1)==$num)
							{
								echo "</td><td class=odd><img src=http://ichart.finance.yahoo.com/h?s=".$data[0]."&lang=en-IN&region=in></td>";
							}
							else 
								echo "</td>";
					}
        	} 
   	 	} echo "</tr>";
			echo "</table>";
    		fclose($handle);
	}
  } 
  function get_stock_bundle($syms)
  {
  	foreach ($syms as $s) {
		$bundle[$s] = $this->generate_stock_array($s);
    } 
    	return $bundle;
    } 
  }  
  $stocks = new yahoo_stocks();
  
  $stocks->get_stocks("http://download.finance.yahoo.com/d/quotes.csv?s=AAPL+FB+MSFT&f=sl1ok2c6ghj5k4j6k5jk", "n");
  echo "</body></head></html>";    
?>  

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
