<?php
include("../backend/Account.php");
if (isset($_POST['submit'])) {
    $account = new Account();
    $res = $account->login(['username' => $_POST['username'], 'password' => $_POST['password']]);
    echo "<script>alert('" . $res['message'] . "')</script>";
    if (isset($res['status']) && $res['status']) {
        echo '<script> document.cookie="token=' . $res['token'] . ' ;max-age=864000"; </script>';
        echo '<script> document.cookie="username=' . $res['username'] . ' ;max-age=864000"; </script>';
        if ($res['account_category'] == "admin") {
            echo "<script> window.location='/admin/index.php'</script>";
        }
    }
    var_dump($_COOKIE);
}
?>
<div class="whole-wrap">
    <div class="container">
        <div class="section-top-border">
            <div class="row">
                <div class="col-lg-3 col-md-3"></div>
                <div class="col-lg-6 col-md-6">
                    <h1 class="title_color">Đăng nhập</h1>
                    <form action="./login.php" method="post">
                        <div class="input-group-icon mt-30">
                            <div class="icon"><i class="fa fa-user" aria-hidden="true"></i></div>
                            <input type="text" name="username" placeholder="Tài khoản" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Tài khoản'" required class="single-input">
                        </div>
                        <div class="mt-30 input-group-icon">
                            <div class="icon"><i class="fa fa-lock" aria-hidden="true"></i></div>
                            <input type="password" name="password" placeholder="Mật khẩu" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mật khẩu'" required class="single-input">
                        </div>
                        <div class="mt-30 row justify-content-center">
                            <input id="comfirm-btn" type="submit" name="submit" value="Đăng nhập" class="genric-btn danger radius btn w-75" />
                        </div>
                        <div class="mt-10 row justify-content-center">hoặc</div>
                        <div class="mt-10 row justify-content-center">
                            <a href="/royal/signup.php" class="w-75 genric-btn success radius">Đăng ký</a>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>