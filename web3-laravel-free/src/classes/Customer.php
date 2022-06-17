<?php

use MiniOrangeWeb3\Helper\CustomerDetails as CD;
use MiniOrangeWeb3\Helper\DB as DB;
use MiniOrangeWeb3\Helper\Lib\AESEncryption;

class Customerweb3
{
    public $email;


    function create_customer()
    {

        $url = DB::get_option('mo_web3_host_name') . '/moas/rest/customer/add';

        $ch = curl_init($url);
        $this->email = CD::get_option('mo_web3_admin_email');
        $password = $_POST['password'];

        $fields = array(
            'companyName' => $_SERVER ['SERVER_NAME'],
            'areaOfInterest' => 'Laravel web3 SP Package',
            'email' => $this->email,
            'password' => $password
        );
        $field_string = json_encode($fields);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // required for https urls
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'charset: UTF - 8',
            'Authorization: Basic'
        ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);
        $content = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Request Error:' . curl_error($ch);
            exit ();
        }

        curl_close($ch);
        return $content;
    }

    function submit_contact_us($email, $phone, $query)
    {
        $url = 'https://login.xecurify.com/moas/api/notify/send';
        $ch = curl_init($url);

        $customerKey = "16555";
        $apiKey = "fFd2XcvTGDemZvbw1bcUesNJWEqKbbUq";


        $currentTimeInMillis = round(microtime(true) * 1000);
        $stringToHash = $customerKey . number_format($currentTimeInMillis, 0, '', '') . $apiKey;
        $hashValue = hash("sha512", $stringToHash);
        $customerKeyHeader = "Customer-Key: " . $customerKey;
        $timestampHeader = "Timestamp: " . number_format($currentTimeInMillis, 0, '', '');
        $authorizationHeader = "Authorization: " . $hashValue;
        $fromEmail = $email;
        $subject = "Laravel web3 Premium Support Query - " . $email;

        $content = '<div >Hello, <br><br><b>Company :</b><a href="' . $_SERVER['SERVER_NAME'] . '" target="_blank" >' . $_SERVER['SERVER_NAME'] . '</a><br><br><b>Phone Number :</b>' . $phone . '<br><br><b>Email :<a href="mailto:' . $fromEmail . '" target="_blank">' . $fromEmail . '</a></b><br><br><b>Query: ' . $query . '</b></div>';

        $test_email_id = 'shubhangi@xecurify.com';
        $support_email_id = 'laravelsupport@xecurify.com';

        $fields = array(
            'customerKey' => $customerKey,
            'sendEmail' => true,
            'email' => array(
                'customerKey' => $customerKey,
                'fromEmail' => $fromEmail,
                'bccEmail' => $test_email_id,
                'fromName' => 'miniOrange',
                'toEmail' => $test_email_id,
                'toName' => $test_email_id,
                'subject' => $subject,
                'content' => $content
            ),
        );
        $field_string = json_encode($fields);


        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);    # required for https urls

        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", $customerKeyHeader,
            $timestampHeader, $authorizationHeader));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);
        $content = curl_exec($ch);
        if (curl_errno($ch)) {

            echo 'Request Error:' . curl_error($ch);
            return false;
        }

        curl_close($ch);

        return true;
    }

    function check_customer()
    {
        $url = DB::get_option('mo_web3_host_name') . "/moas/rest/customer/check-if-exists";
        $ch = curl_init($url);
        $email = CD::get_option("mo_web3_admin_email");

        $fields = array(
            'email' => $email
        );
        $field_string = json_encode($fields);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // required for https urls
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'charset: UTF - 8',
            'Authorization: Basic'
        ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);

        $content = curl_exec($ch);

        if (curl_errno($ch)) {
            echo "129";
            echo "$ch Error in sending curl Request";
            exit ();
        }
        curl_close($ch);

        return $content;
    }

    function get_customer_key()
    {
        $url = DB::get_option('mo_web3_host_name') . "/moas/rest/customer/key";
        $ch = curl_init($url);
        $email = CD::get_option("mo_web3_admin_email");

        $password = $_POST['password'];

        $fields = array(
            'email' => $email,
            'password' => $password
        );
        $field_string = json_encode($fields);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // required for https urls
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'charset: UTF - 8',
            'Authorization: Basic'
        ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);

        $content = curl_exec($ch);
        return $content;
    }

    function mo_web3_vl($code, $active)
    {
        $url = "";
        if ($active)
            $url = DB::get_option('mo_web3_host_name') . '/moas/api/backupcode/check';
        else
            $url = DB::get_option('mo_web3_host_name') . '/moas/api/backupcode/verify';

        $ch = curl_init($url);

        /* The customer Key provided to you */
        $customerKey = CD::get_option('mo_web3_admin_customer_key');

        /* The customer API Key provided to you */
        $apiKey = CD::get_option('mo_web3_admin_api_key');

        /* Current time in milliseconds since midnight, January 1, 1970 UTC. */
        $currentTimeInMillis = round(microtime(true) * 1000);

        /* Creating the Hash using SHA-512 algorithm */
        $stringToHash = $customerKey . number_format($currentTimeInMillis, 0, '', '') . $apiKey;
        $hashValue = hash("sha512", $stringToHash);

        $customerKeyHeader = "Customer-Key: " . $customerKey;
        $timestampHeader = "Timestamp: " . number_format($currentTimeInMillis, 0, '', '');
        $authorizationHeader = "Authorization: " . $hashValue;

        $fields = '';

        // *check for otp over sms/email

        $fields = array(
            'code' => $code,
            'customerKey' => $customerKey,
            'additionalFields' => array(
                'field1' => $this->web3_get_current_domain()
            )

        );


        $field_string = json_encode($fields);

        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // required for https urls
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            $customerKeyHeader,
            $timestampHeader,
            $authorizationHeader
        ));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        $content = curl_exec($ch);

        if (curl_errno($ch)) {
            echo "241";
            echo "$ch Error in sending curl Request";
            exit ();
        }

        curl_close($ch);
        return $content;
    }

    function check_customer_ln()
    {

        $url = DB::get_option('mo_web3_host_name') . '/moas/rest/customer/license';
        $ch = curl_init($url);
        $customerKey = CD::get_option('mo_web3_admin_customer_key');

        $apiKey = CD::get_option('mo_web3_admin_api_key');
        $currentTimeInMillis = round(microtime(true) * 1000);
        $stringToHash = $customerKey . number_format($currentTimeInMillis, 0, '', '') . $apiKey;
        $hashValue = hash("sha512", $stringToHash);
        $customerKeyHeader = "Customer-Key: " . $customerKey;
        $timestampHeader = "Timestamp: " . $currentTimeInMillis;
        $authorizationHeader = "Authorization: " . $hashValue;
        $fields = '';
        $fields = array(
            'customerId' => $customerKey,
            'applicationName' => 'laravel_web3_premium_plan'
        );
        $field_string = json_encode($fields);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  # required for https urls
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", $customerKeyHeader, $timestampHeader, $authorizationHeader));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        $content = curl_exec($ch);

        if (curl_errno($ch))
            return false;
        curl_close($ch);
        return $content;
    }

    function web3_get_current_domain()
    {
        $http_host = $_SERVER['HTTP_HOST'];
        if (substr($http_host, -1) == '/') {
            $http_host = substr($http_host, 0, -1);
        }
        $request_uri = $_SERVER['REQUEST_URI'];
        if (substr($request_uri, 0, 1) == '/') {
            $request_uri = substr($request_uri, 1);
        }

        $is_https = (isset($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], 'on') == 0);
        $relay_state = 'http' . ($is_https ? 's' : '') . '://' . $http_host;
        return $relay_state;
    }
    function remove_account() {
        // global $mc_util;
        $code = CD::get_option('sml_lk');
        $key = CD::get_option('mo_web3_customer_token');
        $code = AESEncryption::decrypt_data($code,$key);
        
        if ( !CD::get_option('mo_web3_registration_status') || false === $code || empty( $code ) ) {
            return;
        }
        $host_name    = DB::get_option('mo_web3_host_name');
        $url          = $host_name . '/moas/api/backupcode/updatestatus';
        $customer_key = CD::get_option('mo_web3_admin_customer_key');
        $api_key      = CD::get_option('mo_web3_admin_api_key');
// dd($code);
        $current_time_in_millis = round( microtime( true ) * 1000 );
        $current_time_in_millis = number_format( $current_time_in_millis, 0, '', '' );

        // /* Creating the Hash using SHA-512 algorithm */
        $string_to_hash           = $customer_key . $current_time_in_millis . $api_key;
        $hash_value               = hash( 'sha512', $string_to_hash );
        $customer_key_header      = 'Customer-Key: ' . $customer_key;
        $timestamp_header         = 'Timestamp: ' . $current_time_in_millis;
        $authorization_header     = 'Authorization: ' . $hash_value;
        $fields                   = '';
        $fields                   = array(
            'code'             => $code,
            'customerKey'      => $customer_key,
            'additionalFields' => array(
                'field1' => $this->web3_get_current_domain(),
            ),
        );
        $field_string             = json_encode( $fields );
        $headers                  = array( 'Content-Type' => 'application/json' );
        $headers['Customer-Key']  = $customer_key;
        $headers['Timestamp']     = $current_time_in_millis;
        $headers['Authorization'] = $hash_value;
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_ENCODING, "");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);  # required for https urls
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", $customer_key_header, $timestamp_header, $authorization_header));
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $field_string);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);

        $content = curl_exec($ch);

        if (curl_errno($ch))
            return false;
        curl_close($ch);
        return $content;
    }
}

?>