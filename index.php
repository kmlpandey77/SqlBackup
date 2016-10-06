<?php error_reporting(E_ALL);ini_set('display_errors', '1');

require 'sqlbackup.php';

$config = array(
	'db_name' => 'test_db',
	'db_host' => 'localhost',
	'db_user' => 'root',
	'db_pass' => 'root@123', 
	'db_dir' => NULL, //full/path/to/database/backup/dirctory/
);
$sql = new sqlbackup($config);
$sql->backup();
