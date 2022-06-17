<?php

namespace MiniOrangeWeb3\Classes\Actions;

use Illuminate\Routing\Controller;
use MiniOrangeWeb3\Helper\Web3User;
use MiniOrangeWeb3\Helper\Web3Login;
use Illuminate\Support\Facades\Session;

class MoWeb3LoginController extends Controller {
  public function __construct()
    {
        $this->middleware('Illuminate\Session\Middleware\StartSession');
    }
  public function launch() {
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
          Session::put('mo_web3_address',$address);
          return redirect('http://localhost:8000/mo_login');
      }
    }
  }
}