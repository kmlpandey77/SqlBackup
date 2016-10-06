<?php error_reporting(E_ALL);ini_set('display_errors', '1');

require 'sqlbackup.php';

$config = array(	
	'db_name' => '',		
	'db_pass' => '',
);

$sql = new sqlbackup($config);
$sql->backup();
