<?php error_reporting(E_ALL);ini_set('display_errors', '1');

require 'sqlbackup.php';

$config = array(

	/**
	 * Database name
	 * 
	 * Required
	 * 
	 */
	'db_name' => '',



	/**
	 * Host
	 * 
	 * Default localhost
	 * 
	 */
	'db_host' => '',



	/**
	 * 
	 * database user
	 * 
	 * Default root
	 * 
	 */	
	'db_user' => '',



	/**
	 * database password
	 * 
	 * Default null
	 */
	'db_pass' => '',



	/**
	 * Backup directory
	 * 
	 * full/path/to/database/backup/dirctory/
	 * 
	 * Default __file__
	 */
	
	
	
	'db_dir' => ''
);

$sql = new sqlbackup($config);
$sql->backup();
