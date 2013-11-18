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

<div id="console">
    
</div>

</div>

<script>
init();
</script>