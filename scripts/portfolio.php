<?php
try {
	
	$m = new MongoClient();

	$db = $m->tradingwithfriends;

	echo "<h2>Collections</h2>";
	echo "<ul>";

	// print out list of collections
	$cursor = $db->listCollections();
	$collection_name = "";
	foreach( $cursor as $doc ) {
		echo "<li>" .  $doc->getName() . "</li>";
		$collection_name = $doc->getName();
	}
	echo "</ul>";

	// print out last collection
	if ( $collection_name != "" ) {
		$collection = $db->selectCollection($collection_name);
		echo "<h2>Documents in ${collection_name}</h2>";

		// only print out the first 5 docs
		$cursor = $collection->find();
		$cursor->limit(5);
		echo $cursor->count() . ' document(s) found. <br/>';
		foreach( $cursor as $doc ) {
		echo "<pre>";
		var_dump($doc);
		echo "</pre>";
}
}

		// disconnect from server
		$m->close();
} catch ( MongoConnectionException $e ) {
die('Error connecting to MongoDB server');
} catch ( MongoException $e ) {
die('Mongo Error: ' . $e->getMessage());
} catch ( Exception $e ) {
die('Error: ' . $e->getMessage());
}
?>

</body>
</html>