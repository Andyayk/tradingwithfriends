<?php
	$url = $_SERVER['HTTP_HOST'];

	// read more about strpos here http://php.net/manual/en/function.strpos.php
	$thisIsLocalHostUrl = (strpos($url, 'localhost') !== false);
	$thisIsCloudControlUrl = (strpos($url, 'cloudcontrolled') !== false);

	// the credentials for localhost database
	if ($thisIsLocalHostUrl) {

		$database_name = 'phpwebp_1104259e';
		$database_username = 'root';
		$database_password = '';
		$database_hostname = 'localhost';
	}
	
	// the credentials for cloudcontrol database
	if ($thisIsCloudControlUrl) {
		$database_name = 'depgrhnup7d';
		$database_username = 'depgrhnup7d';
		$database_password = 'O6F9DvFCyWfJ';
		$database_hostname = 'mysqlsdb.co8hm2var4k9.eu-west-1.rds.amazonaws.com';
	}
	

?>