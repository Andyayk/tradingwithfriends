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
   	 My Equity <?php echo $_POST["name"]; ?><br>
	 Your Quantity : <?php echo $_POST["quantity"]; ?><br>
	 Total Price : <?php echo $price; ?><br>
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
      
       <? endif; ?>

     </td>
   </tr>
   <? endforeach; ?>
</table>

<div id="console">
    
</div>

</div>

<script>
init();
</script>