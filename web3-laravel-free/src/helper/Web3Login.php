<?php
namespace MiniOrangeWeb3\Helper;


use Elliptic\EC;
use kornrunner\Keccak;

$mo_web3_dir = dirname(__DIR__).DIRECTORY_SEPARATOR;
require_once $mo_web3_dir."lib/Keccak/Keccak.php";
require_once $mo_web3_dir."lib/Elliptic/EC.php";
require_once $mo_web3_dir."lib/Elliptic/Curves.php";
require_once $mo_web3_dir."lib/JWT/jwt_helper.php";

class Web3Login
{
	function pubKeyToAddress($pubkey) {
    	return "0x" . substr(Keccak::hash(substr(hex2bin($pubkey->encode("hex")), 1), 256), 24);
  }

  	function verifySignature($message, $signature, $address)
  	{
	    $msglen = strlen($message);
	    $hash   = Keccak::hash("\x19Ethereum Signed Message:\n{$msglen}{$message}", 256);
	    $sign   = ["r" => substr($signature, 2, 64),
	               "s" => substr($signature, 66, 64)];
	    $recid  = ord(hex2bin(substr($signature, 130, 2))) - 27;
	    if ($recid != ($recid & 1))
	        return false;

	    $ec = new EC('secp256k1');
	    $pubkey = $ec->recoverPubKey($hash, $sign, $recid);

	    return $address == $this->pubKeyToAddress($pubkey);
  	}
}