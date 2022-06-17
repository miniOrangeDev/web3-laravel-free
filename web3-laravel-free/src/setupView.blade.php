<?php
?><main class="app-content">
    <div class="app-title">
        <div>
            <h1>
                <i class="fa fa-gear"></i> Plugin Settings
            </h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Plugin Settings</a></li>
        </ul>
    </div>
    <p id="web3_message"></p>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <fieldset>
                    <div class="row">
                        <div class="col-lg-6">
                        </div>
                    </div> 
                </fieldset>
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
    exit();
}
?>