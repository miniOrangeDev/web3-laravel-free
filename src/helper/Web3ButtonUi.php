<?php
namespace MiniOrangeWeb3\Helper;

class Web3ButtonUi
{
	public function get_button_ui($ajax_url){
		?><div id="loggedOut" class="user-login-msg">
        Click the button to (sign up and) login!
        </div>
        <div id="needMetamask" style="display:none;color: rgb(255, 115, 0);" class="user-login-msg">
           To login, first install a Web3 wallet like the <a href="https://metamask.io/" style="color:#ff7300" target="_blank">MetaMask</a> browser extension or mobile app
        </div>
        <div id="needLogInToMetaMask" style="display:none;color: rgb(255, 115, 0);" class="user-login-msg">
            Log in to your wallet account first!
        </div>
        <div id="signTheMessage" style="display:none;" class="user-login-msg">
            Sign the message with your wallet to authenticate
        </div>
        <br>
        <?php
        echo    '<script>
            var mo_web3_url = "'.$ajax_url.'";
        </script>
        <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/web3@latest/dist/web3.min.js"></script>
        
        <script type="text/javascript" src="https://unpkg.com/web3modal@1.9.0/dist/index.js"></script>
        <script type="text/javascript" src="https://unpkg.com/@walletconnect/web3-provider@1.2.1/dist/umd/index.min.js"></script>
        <script src="/miniorange/sso/includes/js/web3-modal.js"></script>
                <script src="/miniorange/sso/includes/js/web3-login.js"></script>
                <script>
                window.onload = function() { addSsoButton() };
                function addSsoButton() {
                var ele = document.createElement("button");
                ele.className = "btn btn-primary";
                ele.innerHTML = "Login with Metamask";
                ele.name = "web3_sso_button";
                ele.id = "web3_sso_button";
                ele.style ="margin-left:44%";
                ele.addEventListener("click", function handleClick(event) {userLoginOut();});
                document.body.appendChild(ele);
                }

                </script>';
	}
}