<?php 

/**
* SQL Backup
*/
class Sqlbackup
{
	protected $db_name;
	protected $db_host;
	protected $db_user;
	protected $db_pass;
	protected $db_dir;
	protected $db_filename;

	protected $_config = array(
		'db_name' => 'test_db',
		'db_host' => 'localhost',
		'db_user' => 'root',
		'db_pass' => 'root@1203', 
		'db_dir' => NULL,
	);

	
	function __construct( array $config = array() )
	{
		$this->config = !empty($config) ? $config : $this->_config;

		$this->db_filename = 'backup-'.date('d-M-Y-H-i-s').'.sql';
		
		$this->set($this->config);

		$this->db_dir = $this->set_dir($this->db_dir);		
		
	}

	
	function set($config){

		foreach ($config as $key => $value) {
			if(property_exists( __class__, $key)){
				$this->$key = $value;
			}
		}

	}

	public function set_dir($db_dir)
	{
		if($db_dir){
			return $db_dir;
		}else{
			return dirname(__FILE__). '/backup/';
		}
	}

	function backup()
	{
		if(!file_exists($this->db_dir)){
			if(!mkdir($this->db_dir,777)){
				echo 'File or folder permission denied.' . "\n";
			}
		}

		$command = "mysqldump -h ".$this->db_host." -u ".$this->db_user." -p".$this->db_pass." ".$this->db_name." > ".$this->db_dir.$this->db_filename;
		$rtn = system($command, $return);

		if($return){
			if($return == 2){
				echo 'Error: Please check your database name, user and password.';				
			}else{
				echo 'Error while creating sql backup. Plase check config data.';
			}
			if(file_exists($this->db_dir.$this->db_filename)){
				unlink($this->db_dir.$this->db_filename);
			}
		}else{
			echo 'Success: Backup created.';
		}
	}

}