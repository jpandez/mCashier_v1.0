<?php
//Pending as of January 25 2011: Unit Test and Decoder
class CipheredNumber{

		
	const CIPHER_BASE = 36;
	const CIPHER_LIMIT = 46599;
	const KEY = "MTIzNDU2Nzg5MFRIUUlDS0JXTkZYSlVNUFNWUkVMQVpZRE9H";
	const KEY2 = "QUJDREVGR0hJSktMTU5PUFFSU1RVVldYWVoxMjM0NTY3ODkw";
	
	
	public static function encode($seed,$seq){
	
		if($seed%CipheredNumber::CIPHER_BASE==0 && $seed!=0){
			throw new InvalidCipherNumberException($seq,$seed,"Reserved seed number");
		}
		
		if($seq >CipheredNumber::CIPHER_LIMIT){
			throw new InvalidCipherNumberException($seq,$seed,"Maximum allowed number exceeded!");
		}
		
		$seed = $seed%CipheredNumber::CIPHER_BASE;
		$rCipher="";
		
	
		
		$rSeed = substr(base64_decode(CipheredNumber::KEY2),$seed,1);
		$tmp = $seq+$seed;
		
		$res = CipheredNumber::convBase($tmp,'0123456789',base64_decode(CipheredNumber::KEY));
		return $rSeed.str_pad($res,3,substr(base64_decode(CipheredNumber::KEY),0,1),STR_PAD_LEFT);
		
	}
	
	
	//credits to: niconet2k dot com http://www.php.net/manual/en/function.base-convert.php
	static function convBase($numberInput, $fromBaseInput, $toBaseInput)
	{
    if ($fromBaseInput==$toBaseInput) return $numberInput;
    $fromBase = str_split($fromBaseInput,1);
    $toBase = str_split($toBaseInput,1);
    $number = str_split($numberInput,1);
    $fromLen=strlen($fromBaseInput);
    $toLen=strlen($toBaseInput);
    $numberLen=strlen($numberInput);
    $retval='';
    if ($toBaseInput == '0123456789')
    {
        $retval=0;
        for ($i = 1;$i <= $numberLen; $i++)
            $retval = bcadd($retval, bcmul(array_search($number[$i-1], $fromBase),bcpow($fromLen,$numberLen-$i)));
        return $retval;
    }
    if ($fromBaseInput != '0123456789')
        $base10=convBase($numberInput, $fromBaseInput, '0123456789');
    else
        $base10 = $numberInput;
    if ($base10<strlen($toBaseInput))
        return $toBase[$base10];
    while($base10 != '0')
    {
        $retval = $toBase[bcmod($base10,$toLen)].$retval;
        $base10 = bcdiv($base10,$toLen,0);
    }
    return $retval;
}
	
}


class InvalidCipherNumberException extends Exception{
	var $_seed;
	var $_sequence;
	public function getSeed(){
		return $this->_seed;
	}
	
	public function getSequence(){
		return $this->_sequence;
	}
	
	function __construct($sequence,$seed,$message){
		parent::__construct($message);
		$this->_seed = $seed;
		$this->_sequence = $sequence;
		
	}
}
?>