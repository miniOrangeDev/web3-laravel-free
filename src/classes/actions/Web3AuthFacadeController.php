<?php

namespace MiniOrangeWeb3\Classes\Actions;

use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use MiniOrangeWeb3\Helper\Web3User;

class MoWeb3AuthFacadeController extends Controller
{

    public function __construct()
    {
        $this->middleware('Illuminate\Session\Middleware\StartSession');
        $this->middleware('web');
    }

    protected function attemptLogin(Request $request)
    {
        $address = Session::get('mo_web3_address');
        $web3user = new Web3User($address); 
        if(! is_null($web3user->email)){
            $user = User::where('email', $web3user->email)->first();
            Auth::login($user, true);
            echo(json_encode(["Success",'http://localhost:8000/']));
        }else{
            echo "Login with your laravel application and link your wallet address first";
            exit;
        }
    }
}

