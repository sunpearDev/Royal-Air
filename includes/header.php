<header class="header_area">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand logo_h" href="/index.php"><img src="image/Logo.png" alt=""></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                <ul class="nav navbar-nav menu_nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="/index.php">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="/about.php">Về chúng tôi</a></li>
                    <li class="nav-item"><a class="nav-link" href="/accomodation.php">Chỗ ở</a></li>
                    <li class="nav-item"><a class="nav-link" href="/gallery.php">Bộ sưu tập</a></li>
                    <li class="nav-item submenu dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Blog</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item"><a class="nav-link" href="/blog.php">Blog</a></li>
                            <li class="nav-item"><a class="nav-link" href="/blog-single.php">Blog Details</a></li>
                        </ul>
                    </li>
                    <?php
                    if (isset($_COOKIE['username'])) {
                        echo '<li class="nav-item"><a class="nav-link" href="/account.php"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;' .$_COOKIE['username']. '</a></li><li class="nav-item"><a class="nav-link" href="/index.php" onclick="logout()"><i class="fas fa-sign-out-alt"></i>&nbsp;Logout</a></li>';
                    } else
                        echo '<li class="nav-item"><a class="nav-link" href="/login.php"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;Login</a></li><li class="nav-item"><a class="nav-link" href="/register.php"><i class="fa fa-user-plus" aria-hidden="true"></i>&nbsp;Register</a></li>';
                    ?>
                    <li class="nav-item"><a class="nav-link" href="/contact.php">liên lạc</a></li>

                </ul>
            </div>
        </nav>
    </div>
</header>