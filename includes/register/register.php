<?php
include("./backend/Account.php");
if (isset($_POST['submit'])) {
    if (strlen($_POST['password']) < 8)
        $message = "Mật khẩu phải có ít nhất 8 kí tự.";
    else if ($_POST['password'] != $_POST['confirm_password'])
        $message = "Mật khẩu và mật khẩu xác nhận không giống.";
    else {
        $account = new Account();
        $res = $account->register(['user_id' => uniqid(), 'username' => $_POST['username'], 'email' => $_POST['email'], 'password' => sha1($_POST['password']), 'account_category' => "customer"]);
        $message = $res['message'];
    }
    echo "<script>alert('" . $message . "')</script>";
    if (isset($res['status']) && $res['status']) {
        echo "<script>  window.location.pathname='login.php'</script>";
    }
}
?>
<div class="whole-wrap">
    <div class="container">
        <div class="section-top-border">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                </div>
                <div class="col-lg-6 col-md-6">
                    <h1 class="title_color">Đăng ký</h1>
                    <form action="./register.php" method="POST">
                        <div class="mt-30">
                            <input type="text" name="username" placeholder="Tên tài khoản" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Tên tài khoản'" required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="email" name="email" id="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" required class="single-input">
                        </div>

                        <div class="mt-10">
                            <input type="password" name="password" id="password" placeholder="Mật khẩu" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mật khẩu'" required class="single-input">
                        </div>
                        <div class="mt-10" style="position: relative;">
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm password'" required class="single-input" onchange="check()">
                            <span id="message" style="position: absolute; right:-30px ; top:-5px; transform: translate(-50%,50%);"></span>
                        </div>

                        <div class="mt-30 row justify-content-center">
                            <input id="comfirm-register-btn" type="submit" name="submit" value="Đăng ký" class="w-25 genric-btn danger radius" />
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    function check() {
        if (document.getElementById('password').value ==
            document.getElementById('confirm_password').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'matching';
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'not matching';
        }
    }
</script>