<?php

namespace MiniOrangeWeb3\Classes\Actions;

use Illuminate\Routing\Controller;

class MoSetupController extends Controller {
    public function launch() {
        $appList = file_get_contents(dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'defaultapps.json');
        $data = array('applist',$appList);
        include_once dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'mo_web3_setup.php';
        include_once dirname(__DIR__, 2).DIRECTORY_SEPARATOR.'jsLoader.php';
        @include('moweb3::menuView');
        return view('moweb3::setupView')->with('applist',$appList);
    }
}