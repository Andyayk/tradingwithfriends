<link rel="stylesheet" type="text/css" media="screen" href="<?= $model['appUrl'] ?>scripts/portfolio.css?v=1.0" />

<script>
  var STOCK_PRICE_AJAX_URL = '<?= $model['appUrl'] ?>/stockList';
</script>

<script src="<?= $model['appUrl'] ?>scripts/portfolio.js"></script>

<div id="content">

<h2>Hi <br>

<!-- first name-->
<fb:name firstnameonly="true" useyou="false" uid="<?= $model['facebookId'] ?>"/>
Welcome to My Portfolio
</h2>
 
<table>
   <tr>
   	 <form name="input" action="index.php" method="POST">
   	
   	 My Equity : <?php echo $_POST["name"]; ?><br>
   	 Quantity : <?php echo $_POST["quantity"]; ?><br>

	</tr>
	
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