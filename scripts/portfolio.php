<?php 
	
	$m = new Mongo("mongodb://corepbl:542321@dharma.mongohq.com:10057/tradingwithfriends");
	
	$db = $m->tradingwithfriends;
	
	$collection = $db->myportfolio;
	
	$obj = array( "title" => "Calvin and Hobbes", "author" => "Bill Watterson");
	$collection->insert($obj);
	
	$obj = array( "title" => "XKCD", "online" => true);
	$collection->insert($obj);
	
	$cursor = $collection->find();
	
	foreach ($cursor as $obj){
		echo $obj("title") . "\n";
	}
	
?>