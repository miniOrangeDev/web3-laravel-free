<?php use MiniOrangeWeb3\Helper\DB;?>
<?php echo View::make('moweb3::menuView'); 
?><main class="app-content">
    <div class="app-title">
        <div>
            <h1>
                <i class="fa fa-info-circle"></i> How to Setup?
            </h1>

        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">How to Setup?</a></li>
        </ul>
    </div>
    <p id="web3_message"></p>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="row">
                    <div class="col-lg-10">
                        <h3>Follow these steps to setup the plugin:</h3>
                        <h4>Step 1:</h4>
                        <ul>
                            <li>Login to your laravel application</li>
                            <li>Call your-laravel-application-domain/mo_web3_link and click on crypto wallet authentication button. Then link your crypto account by completing web3 authentication process
                            </li>
                    
                        </ul>
                        <br/> <br/>
                        <h4>Step 2:</h4>
                        <ul>
                            <li>Once you link web3 account to your laravel application, you can start login to your laravel application using crypto wallet </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

</body>
</html>
<?php
use MiniOrangeWeb3\Helper\DB as setupDB;
if (isset($_SESSION['show_success_msg'])) {

    echo '<script>
    var message = document.getElementById("web3_message");
    message.classList.add("success-message");
    message.innerText = "' . setupDB::get_option('mo_web3_message') . '"
    </script>';
    unset($_SESSION['show_success_msg']);
    exit();
}
if (isset($_SESSION['show_error_msg'])) {
    echo '<script>
    var message = document.getElementById("web3_message");
    message.classList.add("error-message");
    message.innerText = "' . DB::get_option('mo_web3_message') . '"
    </script>';
    unset($_SESSION['show_error_msg']);
}
?>