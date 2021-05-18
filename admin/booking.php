<?php

include('includes/header.php');
include('includes/navbar.php');

require_once "../backend/dbService.php";

if (isset(
    $_POST['user_id'],
    $_POST['adult'],
    $_POST['children'],
    $_POST['ngay1'],
    $_POST['ngay2'],
    $_POST['total_pay'],
    $_POST['booking_ID'],
)) {



    $kq = false;
    $resultEdit = "";
    $DB = new DbServices();
    $sql = "update booking set ";
    $sql .= "user_id = '" . $_POST['user_id'] . "'";
    $sql .= ",adult = " . $_POST['adult'];
    $sql .= ",children = " . $_POST['children'];
    $sql .= ",check_in = '" . date("Y-m-d H:i:s", strtotime($_POST['ngay1'])) . "'";
    $sql .= ",check_out = '" . date("Y-m-d H:i:s", strtotime($_POST['ngay2'])) . "'";
    $sql .= ",total_pay = " . $_POST['total_pay'];

    $sql .= " where booking_ID = '" . $_POST['booking_ID'] . "'";


    try {
        $result = $DB->rowEffect($sql);
        if ($result) {
            $kq = true;
            $resultEdit = "Success!";
        } else {
            $kq = false;
            $resultEdit = "Error!";
        }
    } catch (Exception $e) {
        $kq = false;
        $resultEdit = "Error!";
    }
};

?>

<!-- Custom styles for this page -->
<script src="vendor/jquery/jquery.min.js"></script>

<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
<script src="https://editor.datatables.net/extensions/Editor/js/dataTables.editor.min.js"></script>

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
            <h1 class="h3 mb-2 text-gray-800">Danh sách đặt phòng</h1>

            <div class="alert" role="alert" id="notification">
            </div>
            <?php if (isset($resultEdit)) { ?>
                <div class="alert <?php if ($kq)  echo ('alert-success');
                                    else echo 'alert-danger' ?>" role="alert">
                    <?php echo $resultEdit ?>
                </div>
            <?php } ?>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Đặt phòng</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th><a href="./account.php" />Mã người dùng</th>
                                    <th>Người lớn</th>
                                    <th>Trẻ em</th>
                                    <th>Nhận phòng</th>
                                    <th>Trả phòng</th>
                                    <th>Tổng thanh toán</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

        <!-- Modal -->
        <div class="modal fade" id="modelEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="./booking.php" method="POST" id="formEdit">

                            <input type="text" hidden name="booking_ID">
                            <div class="form-group">
                                Tài khoản:<select class="form-control" id="mataikhoan" name="user_id">
                                    <option value="" selected disabled>Tên tài khoản</option>
                                    <?php
                                    $DB =  new DbServices();
                                    // $sql = "SELECT * FROM account WHERE account_category='customer'";
                                    $sql = "SELECT * FROM account";
                                    if ($roomType =  $DB->execute1($sql)) {
                                        foreach ($roomType as $item) {
                                            echo '<option  value="' . $item['user_id'] . '">' . $item['username'] . " - " . $item['user_id'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                Người lớn:<input type="text" name="adult" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Adult'" placeholder="Adult" aria-label="Adult" required aria-describedby="basic-addon1">
                            </div>

                            <div class="form-group">
                                Trẻ em:<input type="text" name="children" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Children'" placeholder="Children" aria-label="Children" required aria-describedby="basic-addon1">
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
                                Tổng thanh toán:<input type="text" name="total_pay" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Total Pay'" placeholder="Total Pay" aria-label="Total Pay" required aria-describedby="basic-addon1">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                var dataTable = $('#dataTable').dataTable({
                    searching: false,
                    ordering: false,
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        url: "booking/fetch.php",
                        type: "post",
                        // success: (data) => {console.log(data)}
                    },

                    columns: [{
                            data: "booking_ID"
                        },
                        {
                            data: "user_id"
                        },
                        {
                            data: "adult"
                        },
                        {
                            data: "children"
                        },
                        {
                            data: "check_in"
                        },
                        {
                            data: "check_out"
                        },
                        {
                            data: "total_pay"
                        },
                        {
                            data: null,
                            className: "dt-center editor-edit",
                            defaultContent: '<button class="btn btn-warning" data-toggle="modal" data-target="#modelEdit"><i class="fa fa-wrench" /> </button>',
                            orderable: false
                        },
                        {
                            data: null,
                            className: "dt-center editor-delete",
                            defaultContent: '<button class="btn btn-danger"><i class="fa fa-trash" /> </button>',
                            orderable: false
                        }
                    ]
                });
            });
        </script>

        <script>
            // Edit record
            $('#dataTable').on('click', 'td.editor-edit', function(e) {
                e.preventDefault();
                var inputs = $('#formEdit input')
                for (let i = 0; i < inputs.length; i++) {
                    try {
                        if (i < 1)
                            inputs[i].value = $(this).parents('tr')[0].childNodes[i].firstChild.nodeValue;
                        else
                            inputs[i].value = $(this).parents('tr')[0].childNodes[i + 1].firstChild.nodeValue;
                    } catch (e) {
                        inputs[i].value = ''
                    }
                }
                var idedit = $(this).parents('tr')[0].childNodes[1].firstChild.nodeValue
                $('#mataikhoan option')
                    .removeAttr('selected')
                    .filter('[value=' + idedit + ']')
                    .attr('selected', true)
            });

            // Delete a record
            $('#dataTable').on('click', 'td.editor-delete', function(e) {
                e.preventDefault();
                var id = $(this).parents('tr')[0].childNodes[0].firstChild.nodeValue
                var self = this

                $.ajax({
                    url: "./booking/delete.php",
                    method: "POST",
                    data: {
                        "booking_id": id
                    },
                    success: function(result) {
                        $("#notification").html(result);
                        if (result == "Deleted Successfully") {
                            $(self).parents('tr').remove()
                            $("#notification").attr('class', 'alert alert-success');
                        } else {
                            $("#notification").attr('class', 'alert alert-danger');
                        }
                    },
                    fail: function() {
                        $("#notification").html("Problem");
                    }
                });

            });
        </script>

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