<?php
	
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

?>
