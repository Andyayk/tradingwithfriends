<link rel="stylesheet" type="text/css" media="screen" href="<?= $model['appUrl'] ?>scripts/portfolio.css?v=1.0" />

<script>
  var STOCK_PRICE_AJAX_URL = '<?= $model['appUrl'] ?>/stockList';
</script>

<script src="<?= $model['appUrl'] ?>scripts/portfolio.js"></script>

<div id="content">

<h2>Hi 

<!-- first name-->
<fb:name firstnameonly="true" useyou="false" uid="<?= $model['facebookId'] ?>"/>.

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
