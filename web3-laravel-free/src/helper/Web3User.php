<?php
namespace MiniOrangeWeb3\Helper;

use Illuminate\Support\Facades\DB as LaraDB;

class Web3User
{
	private $address;
	private $nonce;

	function __construct($address){
		$record = LaraDB::select('select nonce, email from mo_web3_user_details where address = ?',[$address]);
		if( 0 == count($record) ){
			$this->nonce = uniqid();
			$this->add_nonce($address,$this->nonce);
		}else{
			$this->address = $address;
			$this->nonce = $record[0]->nonce;
			$this->email = $record[0]->email;
		}
	}

	public function get_nonce(){
		return $this->nonce;
	}
	public function get_email(){
		return $this->email;
	}
	public function update_nonce($nonce){
		  $result = LaraDB::table('mo_web3_user_details')->updateOrInsert([
                'address' => $this->address
            ], [
                'nonce' => $nonce
            ]);
		$this->set_nonce($nonce);
	}
	public function update_email($email){
		  $result = LaraDB::table('mo_web3_user_details')->updateOrInsert([
                'address' => $this->address
            ], [
                'email' => $email
            ]);
		$this->set_nonce($email);
	}
	public function set_nonce($nonce){
		$this->nonce = $nonce;
	}
	public function set_email($email){
		$this->email = $email;
	}

	public function add_nonce($address,$nonce){
		LaraDB::table('mo_web3_user_details')->insertOrIgnore([
		    ['address' => $address, 'nonce' => $nonce]
		]);
	}

}