<?php
if (!isset($_SESSION)) {
    session_start();
}

unset($_SESSION['authorized']);

session_destroy();

header("Location: mo_web3_admin_login.php");
exit();
?>