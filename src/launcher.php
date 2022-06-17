<?php
/*
 * Plugin Name: miniOrange Laravel web3 2.0 Connector
 * Version: 11.0.0
 * Author: miniOrange
 */
if (!isset($_SESSION)) {
    session_start();
}
// check if the directory containing CSS,JS,Resources exists in the root folder of the site
if (!is_dir($_SERVER['DOCUMENT_ROOT'] . '/miniorange/sso')) {
    // copy miniorange css,js,images,etc assets to root folder of laravel app
    $file_paths_array = array(
        '/includes',
        '/resources'
    );
    foreach ($file_paths_array as $path) {
        $src = __DIR__ . $path;
        $dst = public_path() . "/miniorange/sso" . $path;
        mo_mo_web3_recurse_copy($src, $dst);
    }
}
if (isset($_SESSION)) {
    if (mo_web3_is_user_registered() == NULL) {
        header("Location: mo_web3_register.php"); // https://www.google.com
        exit();
    } else {
        header("Location: mo_web3_admin_login.php");
        exit();
    }
}

?>
