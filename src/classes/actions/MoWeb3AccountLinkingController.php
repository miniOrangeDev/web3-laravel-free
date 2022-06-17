<?php 
namespace MiniOrangeWeb3\Classes\Actions;

use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;
use MiniOrangeWeb3\Helper\Web3User;
use MiniOrangeWeb3\Helper\Web3Login;
use MiniOrangeWeb3\Helper\Web3ButtonUi;
use Auth;
class MoWeb3AccountLinkingController extends Controller
{

    public function __construct()
    {
        $this->middleware('web');
    }
    public function load(){

        $button = new Web3ButtonUi();
        $button->get_button_ui('mo_web3_account_link');
    }
    public function launch(){

    	$data = json_decode(file_get_contents("php://input"));
        $request = $data->request;

	    // Create a standard of eth address by lowercasing them
	    // Some wallets send address with upper and lower case characters
	    if (!empty($data->address)) {
	      $data->address = strtolower($data->address);
	    }

	    $web3user = new Web3User($data->address);
	    $nonce = $web3user->get_nonce();

	    if ($request == "login") {
	      $address = $data->address;

	      if ($nonce) {
	        // If user exists, return message to sign
	        echo("Sign this message to validate that you are the owner of the account. Random string: " . $nonce);
	      }
	      else {
	        // If user doesn't exist, register new user with generated nonce, then return message to sign
	        $nonce = uniqid();
	      }

	      exit;
	    }

	    if ($request == "auth") {
	      $address = $data->address;
	      $signature = $data->signature;

	      $message = "Sign this message to validate that you are the owner of the account. Random string: " . $nonce;

	      // Check if the message was signed with the same private key to which the public address belongs


	      $web3Login = new Web3Login();
	      // If verification passed, authenticate user
	      	if ($web3Login->verifySignature($message, $signature, $address)) {
		    	$user_id = Auth::id();
		    	if(!is_null($user_id)){
		    		if(!is_null($address)){
			    		$user = User::where('id', $user_id)->first();
			    		if(!is_null($user) && !is_null($user->email)){
			    			$web3user = new Web3User($address);
			    			$web3user->update_email($user->email);
			    			echo "Your account is linked successfully!!";
			    			exit;
			    		}
			    	}
		    	}else{
		    		echo "Login to your laravel site first!!";
			    			exit;
		    	}
	    	}
		}
	}
}    