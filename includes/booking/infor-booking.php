<div class="whole-wrap">
    <div class="container">
        <div class="section-top-border">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                </div>
                <div class="col-lg-6 col-md-6">
                    <h1 class="title_color">Kiểm tra thông tin của bạn</h1>
                    <form action="./register.php" method="POST">
                        <div class="mt-30">
                            <input type="text" name="name" placeholder="Tên tài khoản" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Tên người đặt chỗ'" required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="email" name="email" id="email" placeholder="Email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" required class="single-input">
                        </div>

                        <div class="mt-10">
                            <input type="password" name="password" id="password" placeholder="Mật khẩu" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mật khẩu'" required class="single-input">
                        </div>

                        <div class="mt-30 row justify-content-center">
                            <input id="comfirm-register-btn" type="submit" name="submit" value="Đặt" class="w-25 genric-btn danger radius" />
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>