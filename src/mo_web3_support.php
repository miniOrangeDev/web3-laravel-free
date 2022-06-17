<?php

use MiniOrangeWeb3\Helper\DB;

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['authorized']) && !empty($_SESSION['authorized'])) {
    if ($_SESSION['authorized'] != true) {
        header('Location: mo_web3_admin_login.php');
        exit();
    }
}
else {
    header('Location: mo_web3_admin_login.php');
    exit();
}

if (isset($_POST['option']) && $_POST['option'] == 'mo_web3_contact_us') {
    $email = $_POST['contact_us_email'];
    $phone = $_POST['contact_us_phone'];
    $query = $_POST['contact_us_query'];

    if (mo_web3_check_empty_or_null($email) || mo_web3_check_empty_or_null($query)) {
        DB::update_option('mo_web3_message', 'Please fill up Email and Query fields to submit your query.');
        mo_web3_show_error_message();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        DB::update_option('mo_web3_message', 'Please enter a valid email address.');
        mo_web3_show_error_message();
    } else {
        $submited = $customer->submit_contact_us($email, $phone, $query);
        if ($submited == false) {
            DB::update_option('mo_web3_message', 'Your query could not be submitted. Please try again.');
            mo_web3_show_error_message();
        } else {
            DB::update_option('mo_web3_message', 'Thanks for getting in touch! We shall get back to you shortly.');
            mo_web3_show_success_message();
        }
    }
}
if (isset($_POST['option']) and $_POST['option'] == "mo_web3_contact_us_query_option") {

    if (!mo_web3_is_curl_installed()) {
        DB::update_option('mo_web3_message', 'ERROR: <a href="http://php.net/manual/en/curl.installation.php" target="_blank">PHP cURL extension</a> is not installed or disabled. Query submit failed.');
        mo_web3_show_error_message();

        return;
    }

    // Contact Us query
    $email = $_POST['mo_web3_contact_us_email'];
    $phone = $_POST['mo_web3_contact_us_phone'];
    $query = $_POST['mo_web3_contact_us_query'];
    $customer = new Customerweb3();
    if (mo_web3_check_empty_or_null($email) || mo_web3_check_empty_or_null($query)) {
        DB::update_option('mo_web3_message', 'Please fill up Email and Query fields to submit your query.');
        mo_web3_show_error_message();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        DB::update_option('mo_web3_message', 'Please enter a valid email address.');
        mo_web3_show_error_message();
    } else {
        $submited = $customer->submit_contact_us($email, $phone, $query);
        if ($submited == false) {
            DB::update_option('mo_web3_message', 'Your query could not be submitted. Please try again.');
            mo_web3_show_error_message();
        } else {
            DB::update_option('mo_web3_message', 'Thanks for getting in touch! We shall get back to you shortly.');
            mo_web3_show_success_message();
        }
    }
}
?>