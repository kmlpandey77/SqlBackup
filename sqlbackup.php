<?php 

/**
* SQL Backup
*/
class Sqlbackup
{
	/**
	 * Database name
	 * 
	 * Default null
	 * Required
	 */
	protected $db_name = '';

	/**
	 * Host
	 * 
	 * Default localhost
	 */
	protected $db_host = 'localhost';

	/**
	 * database user
	 * 
	 * Default root
	 */
	protected $db_user = 'root';

	/**
	 * database password
	 * 
	 * Default null
	 */
	protected $db_pass = '';

	/**
	 * Backup directory
	 * 
	 * //full/path/to/database/backup/dirctory/
	 * 
	 * Default __file__
	 */
	protected $db_dir = null;

	protected $db_filename = null;

	protected $_config = array();

	
	function __construct( array $config = array() )
	{
		$this->set_config($config);

		$this->db_filename = 'backup-'.date('dmy-His').'.sql';
		
		$this->set($this->config);

		$this->db_dir = $this->set_dir($this->db_dir);		
		
	}

	function set_config($config){

		$this->config = array();

		foreach ($config as $key => $value) {
			if(!empty($value) && !is_null($value)){
				$this->config[$key] = $value;
			}else{

				if($key == 'db_pass')
					$this->config[$key] = '';
				else
					$this->config[$key] = $this->$key;
			}
		}

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
				exit;
			}
		}

		$command = "mysqldump -h ".$this->db_host." -u ".$this->db_user." -p".$this->db_pass." ".$this->db_name." > ".$this->db_dir.$this->db_filename;
		$rtn = system($command, $return);

		if($return){
			if($return == 2){
				echo 'Error: Please check your database name, user and password.';				
			}else{
				echo 'Error while creating sql backup. Plase check config values.';
			}
			if(file_exists($this->db_dir.$this->db_filename)){
				unlink($this->db_dir.$this->db_filename);
			}
		}else{
			echo 'Success: Backup created.';
		}
	}

}