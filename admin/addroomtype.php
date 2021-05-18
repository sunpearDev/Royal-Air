<?php

include('includes/header.php');
include('includes/navbar.php');

require_once "../backend/dbService.php";

if (isset(
    $_POST['category_name'],
    $_POST['single_bed'],
    $_POST['double_bed'],
    $_POST['area'],
    $_POST['description'],
    $_POST['price_on_day']
)) {


    // var_dump($_POST);
    // die();
    $kq = false;
    $DB = new DbServices();
    $idcat = uniqid();
    try {
        $result = $DB->create(
            'room_category',
            [
                // 'category_ID' => "608baa2d03821",
                'category_ID' => $idcat,
                'category_name' => $_POST['category_name'],
                'single_bed' => $_POST['single_bed'],
                'double_bed' => $_POST['double_bed'],
                'area' => $_POST['area'],
                'description' => $_POST['description'],
                'available' => 0,
                'price_on_day' => $_POST['price_on_day'],
            ]
        );
        if ($result)
            $kq = true;
    } catch (Exception $e) {
    }

    // $output = '';
    if (is_array($_FILES)) {
        foreach ($_FILES['images']['name'] as $key => $value) {
            $file_name = explode(".", $_FILES['images']['name'][$key]);
            $allowed_ext = array("jpg", "jpeg", "png", "gif");
            if (in_array($file_name[1], $allowed_ext)) {
                $new_name = $_POST['category_name'] . uniqid() . '.' . $file_name[1];
                $sourcePath = $_FILES['images']['tmp_name'][$key];
                $targetPath = "../image/" . $new_name;
                if (move_uploaded_file($sourcePath, $targetPath)) {
                    $DB->create(
                        'image',
                        [
                            'category_ID' => $idcat,
                            'name' => $new_name,
                        ]
                    );
                    // $output .= '<img src="' . $targetPath . '" width="200px" height="200px" />';
                }
            }
        }
        // echo $output;
    }
    // $resultAdd = json_encode($kq);
};

?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                <i class="fa fa-bars"></i>
            </button>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                        <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                    </a>
                    <!-- Dropdown - User Information -->
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                            Activity Log
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                        </a>
                    </div>
                </li>

            </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Loại phòng</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thêm loại phòng</h6>
                </div>

                <div class="alert" role="alert" id="alertResult"></div>

                <?php if (isset($resultAdd)) {
                    if ($kq == true)
                        echo '<div class="alert alert-info" role="alert">' . $resultAdd . ' </div>';
                    else
                        echo '<div class="alert alert-danger" role="alert">' . $resultAdd . ' </div>';
                }
                ?>

                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-3">
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <form class="image-upload" action="./addroomtype.php" method="POST">


                                <div class="form-group">
                                    <input type="text" name="category_name" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Tên'" placeholder="Tên" aria-label="Room Number" required aria-describedby="basic-addon1">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="single_bed" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Giường đơn'" placeholder="Giường đơn" aria-label="Single Bed" required aria-describedby="basic-addon1">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="double_bed" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Giường đôi'" placeholder="Giường đôi" aria-label="Double Bed" required aria-describedby="basic-addon1">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="area" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Khu vực'" placeholder="Khu vực" aria-label="Area" required aria-describedby="basic-addon1">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="description" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Mô tả'" placeholder="Mô tả" aria-label="Description" required aria-describedby="basic-addon1">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="price_on_day" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Giá'" placeholder="Giá" aria-label="Price on day" required aria-describedby="basic-addon1">
                                </div>

                                <div class="form-group">
                                    <input type="file" name="images[]" multiple="multiple" class="form-control">
                                </div>
                                <div class="mt-30 row justify-content-center">
                                    <input id="comfirm-add-btn" type="submit" name="submit" value="Thêm" class="w-25 genric-btn danger radius" />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.image-upload').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: "addroomtype.php",
                    type: "post",
                    data: new FormData(this),
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        $("#showimages").html(data);
                        $("#alertResult").html("Success!")
                        $("#alertResult").addClass("alert-info")
                        // alert(data);
                    }

                });
            });
        });
    </script>



    <?php include('includes/scripts.php'); ?>
    <?php include('includes/footer.php'); ?>