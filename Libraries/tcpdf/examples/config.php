<?php
DEFINE('TMP',"D:\\wamp\\www\\Projects\\_MobileCash v1.0b\\temp\\");
DEFINE('BASE_URL',"http://localhost/Projects/_MobileCash v1.0b");
//LINUX
DEFINE('IMAGES_PATH', "/Projects/_MobileCash v1.0b/Views/images/");
$smtpuser=base64_decode("cmVwb3J0c0BtY2FzaGllci5hZQ==");
$smtppass=base64_decode("OFRlVlhlN0U===");
DEFINE('ISGMAIL',FALSE);
DEFINE('SMTP_ALIAS','Etisalat mCashier');
DEFINE('SMTPHOST','exmail.emirates.net.ae');
DEFINE('SMTPPORT','25');
DEFINE('SMTPUSER',$smtpuser);
DEFINE('SMTPPASSWORD',$smtppass);
function createFile($path = '', $data = '', $name = ''){
		$handler = fopen($path . $name ,'wb');
		if($handler){
			fwrite($handler, $data);
		}else{
			die("FILE WRITE ERROR");
		}
		fclose($handler);
}

if(!isset($_SESSION['timezone']))
{
        $zonelist = array('Kwajalein' => -12.00, 'Pacific/Midway' => -11.00, 'Pacific/Honolulu' => -10.00, 'America/Anchorage' => -9.00, 'America/Los_Angeles' => -8.00, 'America/Denver' => -7.00, 'America/Tegucigalpa' => -6.00, 'America/New_York' => -5.00, 'America/Caracas' => -4.30, 'America/Halifax' => -4.00, 'America/St_Johns' => -3.30, 'America/Argentina/Buenos_Aires' => -3.00, 'America/Sao_Paulo' => -3.00, 'Atlantic/South_Georgia' => -2.00, 'Atlantic/Azores' => -1.00, 'Europe/Dublin' => 0, 'Europe/Belgrade' => 1.00, 'Europe/Minsk' => 2.00, 'Asia/Kuwait' => 3.00, 'Asia/Tehran' => 3.30, 'Asia/Muscat' => 4.00, 'Asia/Yekaterinburg' => 5.00, 'Asia/Kolkata' => 5.30, 'Asia/Katmandu' => 5.45, 'Asia/Dhaka' => 6.00, 'Asia/Rangoon' => 6.30, 'Asia/Krasnoyarsk' => 7.00, 'Asia/Brunei' => 8.00, 'Asia/Seoul' => 9.00, 'Australia/Darwin' => 9.30, 'Australia/Canberra' => 10.00, 'Asia/Magadan' => 11.00, 'Pacific/Fiji' => 12.00, 'Pacific/Tongatapu' => 13.00);
        $index = array_keys($zonelist, 4);
        $_SESSION['timezone'] = $index[0];

}

date_default_timezone_set($_SESSION['timezone']);


?>