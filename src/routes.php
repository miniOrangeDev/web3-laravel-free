<?php

Route::get('mo_web3_admin', 'MiniOrangeWeb3\Classes\Actions\MoAdminController@launch');

Route::get('mo_web3_register.php', 'MiniOrangeWeb3\Classes\Actions\MoRegisterController@launch');
Route::post('mo_web3_register.php', 'MiniOrangeWeb3\Classes\Actions\MoRegisterController@launch');

Route::get('mo_web3_account.php', 'MiniOrangeWeb3\Classes\Actions\MoAccountController@launch');
Route::post('mo_web3_account.php', 'MiniOrangeWeb3\Classes\Actions\MoAccountController@launch');

Route::get('mo_web3_admin_login.php', 'MiniOrangeWeb3\Classes\Actions\MoAdminLoginController@launch');
Route::post('mo_web3_admin_login.php', 'MiniOrangeWeb3\Classes\Actions\MoAdminLoginController@launch');

Route::get('mo_web3_setup.php', 'MiniOrangeWeb3\Classes\Actions\MoSetupController@launch');
Route::post('mo_web3_setup.php', 'MiniOrangeWeb3\Classes\Actions\MoSetupController@launch');

Route::get('mo_web3_admin_logout.php', 'MiniOrangeWeb3\Classes\Actions\MoAdminLogoutController@launch');

Route::get('mo_web3_how_to_setup.php', 'MiniOrangeWeb3\Classes\Actions\MoHowToSetupController@launch');
Route::post('mo_web3_how_to_setup.php', 'MiniOrangeWeb3\Classes\Actions\MoHowToSetupController@launch');

Route::get('mo_web3_support.php', 'MiniOrangeWeb3\Classes\Actions\MoSupportController@launch');
Route::post('mo_web3_support.php', 'MiniOrangeWeb3\Classes\Actions\MoSupportController@launch');

Route::get('mo_web3_create_tables', 'MiniOrangeWeb3\Classes\Actions\DatabaseController@createTables');

Route::post('mo_web3', 'MiniOrangeWeb3\Classes\Actions\MoWeb3LoginController@launch');
Route::post('mo_web3', 'MiniOrangeWeb3\Classes\Actions\MoWeb3LoginController@launch');

Route::get('mo_login', 'MiniOrangeWeb3\Classes\Actions\MoWeb3AuthFacadeController@attemptLogin');

Route::get('mo_web3_link', 'MiniOrangeWeb3\Classes\Actions\MoWeb3AccountLinkingController@load');

Route::post('mo_web3_account_link', 'MiniOrangeWeb3\Classes\Actions\MoWeb3AccountLinkingController@launch');