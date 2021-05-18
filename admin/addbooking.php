<?php

include('includes/header.php');
include('includes/navbar.php');

require_once "../backend/dbService.php";

//var_dump($_POST['ngay1']);

if (isset(
    //$_POST['booking_ID'],
    $_POST['user_id'],
    $_POST['adult'],
    $_POST['children'],
    $_POST['total_pay']
)) {

    //$today = date("y.m.d");

    // var_dump($_POST);
    // die();

    $kq = false;
    $DB = new DbServices();

    try {
        $result = $DB->create(
            'booking',
            [
                // 'booking_ID' => "6097b072ba7b2",
                // 'booking_ID' => $_POST['booking_ID'],
                'booking_ID' => uniqid(),
                'user_id' => $_POST['user_id'],
                'adult' => $_POST['adult'],
                'children' => $_POST['children'],
                'check_in' => date("Y-m-d H:i:s", strtotime($_POST['ngay1'])),
                'check_out' => date("Y-m-d H:i:s", strtotime($_POST['ngay2'])),
                'total_pay' => $_POST['total_pay']
            ]

        );
        if ($result)
            $kq = true;
    } catch (Exception $e) {
    }

    $resultAdd = json_encode($kq);
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
            <h1 class="h3 mb-2 text-gray-800">Đặt phòng</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thêm đặt phòng</h6>
                </div>

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
                            <form action="./addbooking.php" method="POST">
                                <!-- <div class="form-group">
                                    <input type="text" name="booking_ID" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'ID'" placeholder="ID" aria-label="ID" required aria-describedby="basic-addon1">
                                </div> -->

                                <div class="form-group">
                                    <select class="form-control" id="exampleFormControlSelect1" name="user_id">
                                        <option value="" selected disabled>Tên tài khoản</option>
                                        <?php
                                        $DB =  new DbServices();
                                        // $sql = "SELECT * FROM account WHERE account_category='customer'";
                                        $sql = "SELECT * FROM account";
                                        if ($roomType =  $DB->execute1($sql)) {
                                            foreach ($roomType as $item) {
                                                echo '<option  value="' . $item['user_id'] . '">' . $item['username'] . '</option>';
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="adult" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Người lớn'" placeholder="Người lớn" aria-label="Adult" required aria-describedby="basic-addon1">
                                </div>

                                <div class="form-group">
                                    <input type="text" name="children" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Trẻ em'" placeholder="Trẻ em" aria-label="Children" required aria-describedby="basic-addon1">
                                </div>

                                <div class="form-group">
                                    <label>Nhận phòng: </label>
                                    <div id="datepicker" class="input-group date " data-date-format="dd-mm-yyyy">
                                        <input name="ngay1" class="form-control" readonly="" type="text">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Trả phòng: </label>
                                    <div id="datepicker2" class="input-group date " data-date-format="dd-mm-yyyy">
                                        <input name="ngay2" class="form-control" readonly="" type="text">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="text" name="total_pay" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Tổng thanh toán'" placeholder="Tổng thanh toán" aria-label="Total Pay" required aria-describedby="basic-addon1">
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
    <style>
        #datepicker>span:hover {
            cursor: pointer;
        }

        #datepicker2>span:hover {
            cursor: pointer;
        }
    </style>

    <link rel="stylesheet prefetch" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>

    <script type="text/javascript">
        $(function() {
            $("#datepicker").datepicker({
                autoclose: true,
                todayHighlight: true
            }).datepicker('update', new Date());
            $("#datepicker2 ").datepicker({
                autoclose: true,
                todayHighlight: true
            }).datepicker('update', new Date());
        });
    </script>

    <?php include('includes/scripts.php'); ?>
    <?php include('includes/footer.php'); ?>