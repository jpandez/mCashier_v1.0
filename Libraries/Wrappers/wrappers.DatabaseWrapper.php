<?php 
error_reporting(1);
class DatabaseWrapper{
	
	var $CONNECT_RETRIES = 1;
	var $RECONNECT_SEC = 1;
	var $LOG_ROOT= '/log/';
	var $user='';
	var $pass='';
	var $server='';
	var $db = '';
	public function __construct($username,$password,$server,$database){
		$this->LOG_ROOT = getcwd() . $this->LOG_ROOT;
		if(!file_exists($this->LOG_ROOT)){
			mkdir($this->LOG_ROOT);
		}
		$this->user=$username;
		$this->password = $password;
		$this->server = $server;	
		$this->db = $database;
		
		
	}
	
	/*to be implemented using a database configuration file 
	public function __construct($filename){
		$this->user=$username;
		$this->password = $password;
		$this->server = $server;	
	} */
	
	
	
	function QueryDataRows($query){
		$connect_ctr = 0;
		$result = FALSE;
		$rows = FALSE;
		
		$db_handler = FALSE;
		$continue = false;
		
		//tryAgain:
			 $dbcon=FALSE; 
			
				$dbcon = mysql_connect($this->server,$this->user,$this->password);
				
				if($dbcon == FALSE){
					if($connect_ctr<$this->CONNECT_RETRIES){
						$connect_ctr ++;
						sleep($this->RECONNECT_SEC);
						//goto tryAgain;
					}
					else{
						$this->WriteLog(mysql_error());
					}
				}

		$db_handler = mysql_select_db($this->db,$dbcon);
		if($db_handler){
			$continue  = true;
		}else{
			$continue  = false;
			$this->WriteLog(mysql_error());
		}
		
		
		if($continue){
						
			$result  = mysql_query($query);
			if($result){
				if(mysql_num_rows($result)>0){
					while($row = mysql_fetch_array($result)){
						$data[] = $row;
					}					
					mysql_free_result($result);
				}
			}else{
				$this->WriteLog(mysql_error());
			}
			
		}
		
		mysql_close($dbcon);
		return $data;
	}
	
	function QueryScalar($query,$default){
		$connect_ctr = 0;
		$result = FALSE;
		$rows = FALSE;
		$data = $default;
		$db_handler = FALSE;
		$continue = false;
		//tryAgain:
			 $dbcon=FALSE; 
			
				$dbcon = mysql_connect($this->server,$this->user,$this->password);
				if($dbcon == FALSE){
					if($connect_ctr<$this->CONNECT_RETRIES){
						$connect_ctr ++;
						sleep($this->RECONNECT_SEC);
						//goto tryAgain;
					}
					else{
						$this->WriteLog(mysql_error());
					}
				}

		$db_handler = mysql_select_db($this->db,$dbcon);
		if($db_handler){
			$continue  = true;
		}else{
			$continue  = false;
			$this->WriteLog(mysql_error());
		}
		
		if($continue){
			$result  = mysql_query($query);
			if($result){			
				if(mysql_num_rows($result)>0){
					if($row = mysql_fetch_array($result)){
						$data = is_null($row[0])?$default:$row[0];
					}					
					mysql_free_result($result);
				}
				
			}else{
				$this->WriteLog(mysql_error());
			}	
		}
		
		mysql_close($dbcon);
		return $data;	
	}
	
	function ExecuteNonQuery($query){
	
		$connect_ctr = 0;
		$result = 0;
		$db_handler = FALSE;
		$continue = false;
		//tryAgain:
			 $dbcon=FALSE; 
			
				$dbcon = mysql_connect($this->server,$this->user,$this->password);
				if($dbcon == FALSE){
					if($connect_ctr<$this->CONNECT_RETRIES){
						$connect_ctr ++;
						sleep($this->RECONNECT_SEC);
						//goto tryAgain;
					}
					else{
						$this->WriteLog(mysql_error() );
					}
				}

		$db_handler = mysql_select_db($this->db,$dbcon);
		if($db_handler){
			$continue  = true;
		}else{
			$continue  = false;
			$this->WriteLog(mysql_error());
		}
		
		if($continue){
			mysql_query($query);
			if(mysql_error()){
				$this->WriteLog(mysql_error());
			}
			$result = mysql_affected_rows();
		}
		
		mysql_close($dbcon);
		return $result;
	}
	
	
	function WriteLog($log){
	
	
		$logfile = date('Ymd') . '@' . date('H'). '00.log';
		$handler = fopen($this->LOG_ROOT . $logfile,'a');
		if($handler){
			fwrite($handler,'[' .date('Hi'). ':'. date('s') . '] ' . $log."\n");
		}else{
			die("FILE WRITE ERROR");
		}
		fclose($handler);
	}
	
}
?>
