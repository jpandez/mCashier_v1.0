<?php class Common{
var $LOG_ROOT= '/log/';
	

	function __construct(){
		$this->LOG_ROOT = getcwd() . $this->LOG_ROOT;
		if(!file_exists($this->LOG_ROOT)){
			mkdir($this->LOG_ROOT);
		}
	}

	function WriteLog($log){
		$logfile = date('Ymd') . '@' . date('H00'). '.log';
		$handler = fopen($this->LOG_ROOT . $logfile,'a');
		if($handler){
			fwrite($handler,'[' .date('Hi'). ':'. date('s') . '] ' . $log . "\n");
		}else{
			die("FILE WRITE ERROR");
		}
		fclose($handler);
	}
	
	function checkEncoding($json)
	{
	   $encoding = mb_detect_encoding($json);
	
		if($encoding == 'UTF-8') {
		  $json = preg_replace('/[^(\x20-\x7F)]*/','', $json);    
		}    
		
	    return $json;
	}
	
	function formatJson($json)
	{
		$json = base64_decode($json);      
		$json = str_replace(array("\r", "\n"), '', $json);
		$json =stripslashes($json);
		$json = json_decode($json);		
		
	    return $json;
	}
}

?>