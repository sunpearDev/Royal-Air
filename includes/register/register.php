<div class="whole-wrap">
    <div class="container">
        <div class="section-top-border">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                </div>
                <div class="col-lg-6 col-md-6">
                    <h1 class="title_color">Đăng Ký</h1>
                    <form action="#">
                        <div class="mt-30">
                            <input type="text" name="user_name" placeholder="User name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'User name'" required class="single-input">
                        </div>

                        <div class="mt-10">
                            <input type="password" name="password" id="password" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" required class="single-input">
                        </div>
                        <div class="mt-10" style="position: relative;">
                            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Confirm password'" required class="single-input" onchange="check()">
                            <span id="message" style="position: absolute; right:-30px ; top:-5px; transform: translate(-50%,50%);"></span>
                        </div>
                        <div class="mt-10">
                            <input type="text" name="fisrt_name" placeholder="Fisrt name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Fisrt name'" required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="last_name" placeholder="Last name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Last name'" required class="single-input">
                        </div>
                        <div class="mt-10">
                            <div class="default-select" id="default-select">
                                <select style="display: none;">
                                    <option value="1">Giới Tính</option>
                                    <option value="1">Nam</option>
                                    <option value="1">Nữ</option>
                                </select>
                                <div class="nice-select" tabindex="0"><span class="current">Giới Tính</span>
                                    <ul class="list">
                                        <li data-value="1" class="option selected focus">Nam</li>
                                        <li data-value="1" class="option">Nữ</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="mt-10">
                            <input type="text" name="identify_number" placeholder="ID" onfocus="this.placeholder = ''" onblur="this.placeholder = 'CMND'" required class="single-input">
                        </div>
                        <div class="mt-10">
                            <input type="text" name="phone_number" placeholder="Phone number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone number'" required class="single-input">
                        </div>
                        <div class="mt-30 row justify-content-center">
                            <input id="comfirm-register-btn" type="submit" value="Register" class="w-25 genric-btn danger radius" />
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