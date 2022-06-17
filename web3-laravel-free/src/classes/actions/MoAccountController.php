<?php

namespace MiniOrangeWeb3\Classes\Actions;

use Illuminate\Routing\Controller;

class MoAccountController extends Controller {
    public function launch() {
        include_once dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'mo_web3_account.php';
        include_once dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'jsLoader.php';
        return view('moweb3::accountView');
    }
}