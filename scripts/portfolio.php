<?php
try {
	
	$m = new MongoClient();

	$db = $m->tradingwithfriends;

	$log = $db->createCollection(
    "logger",
    array(
        'capped' => true,
        'size' => 10*1024,
        'max' => 10
    )
);

for ($i = 0; $i < 100; $i++) {
    $log->insert(array("level" => WARN, "msg" => "sample log message #$i", "ts" => new MongoDate()));
}

$msgs = $log->find();

foreach ($msgs as $msg) {
    echo $msg['msg']."\n";
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