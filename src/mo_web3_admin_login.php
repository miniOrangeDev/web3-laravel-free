<?php

use MiniOrangeWeb3\Helper\DB;

if (!isset($_SESSION)) {
    session_start();
}

if (!mo_web3_is_user_registered()) {
    header('Location: mo_web3_register.php');
    exit();
}

if (isset($_SESSION['authorized']) && !empty($_SESSION['authorized'])) {
    if ($_SESSION['authorized'] == true) {
        if (mo_web3_is_customer_license_verified()) {
            header("Location: mo_web3_how_to_setup.php");
            exit();
        } elseif (isset($_REQUEST['option'])) {
            header("Location: mo_web3_how_to_setup.php");
            exit();
        }
    }
}
if (isset($_REQUEST['option']) && $_REQUEST['option'] == 'admin_login') {

    $email = '';
    $password = '';
    if (isset($_POST['email']) && !empty($_POST['email']))
        $email = $_POST['email'];
    if (isset($_POST['password']) && !empty($_POST['password']))
        $password = $_POST['password'];
    if (!empty($password)) {
        $password = sha1($password);
    }
    $user = DB::get_registered_user();
    $password_check = '';
    $email_check = '';
    if ($user != NULL)
        if (isset($user->password))
            $password_check = $user->password;
        else {
            $_SESSION['invalid_credentials'] = true;
        }
    if ($user != NULL) {
        if (isset($user->email))
            $email_check = $user->email;
        else
            $_SESSION['invalid_credentials'] = true;
    }

    if (!empty($password_check)) {
        if ($password === $password_check) {

            if (!isset($_SESSION['authorized']) || $_SESSION['authorized'] != true) {
                $_SESSION['authorized'] = true;
            }
            $_SESSION['admin_email'] = $email;
            if (mo_web3_is_customer_license_verified()) {
                header("Location: mo_web3_how_to_setup.php");
                exit();
            } else {
                header("Location: mo_web3_how_to_setup.php");
                exit();
            }
        } else {
            $_SESSION['invalid_credentials'] = true;
        }
    }
}

?>
