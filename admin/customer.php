<?php

include('includes/header.php');
include('includes/navbar.php');


require_once "../backend/dbService.php";

if (isset(
    $_POST['user_id'],
    $_POST['user_id1'],
    $_POST['name'],
    $_POST['phone_number'],
    $_POST['gender'],
    $_POST['address'],
    $_POST['identify_number'],
)) {



    $kq = false;
    $resultEdit = "";
    $DB = new DbServices();
    $sql = "update profile set ";
    $sql .= "user_id = '" . $_POST['user_id'] . "'";
    $sql .= ",name = '" . $_POST['name'] . "'";
    $sql .= ",phone_number = '" . $_POST['phone_number'] . "'";
    $sql .= ",gender = " . $_POST['gender'];
    $sql .= ",address = '" . $_POST['address'] . "'";
    $sql .= ",identify_number = '" . $_POST['identify_number'] . "'";
    $sql .= " where user_id = '" . $_POST['user_id1'] . "'";


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
            <h1 class="h3 mb-2 text-gray-800">Danh sách khách hàng</h1>
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
                    <h6 class="m-0 font-weight-bold text-primary">Khách hàng</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th><a href="./account.php" />Mã tài khoản</th>
                                    <th>Tên khách hàng</th>
                                    <th>Số điện thoại</th>
                                    <th>Giới tính</th>
                                    <th>Địa chỉ</th>
                                    <th>CMND</th>
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
                        <form action="./customer.php" method="POST" id="formEdit">

                            <input type="text" hidden name="user_id1">
                            <div class="form-group">
                                Tài khoản:<select class="form-control" id="mataikhoan" name="user_id">
                                    <option value="" selected disabled>Tên tài khoản</option>
                                    <?php
                                    $DB =  new DbServices();
                                    $roomType = $DB->getAll('account');
                                    foreach ($roomType as $item) {
                                        if ($item['account_category'] === "customer") {
                                            echo '<option  value="' . $item['user_id'] . '">' . $item['username'] . " - " . $item['user_id'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                Tên khách hàng:<input type="text" name="name" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'" placeholder="Name" aria-label="Name" required aria-describedby="basic-addon1">
                            </div>

                            <div class="form-group">
                                Số điện thoại:<input type="text" name="phone_number" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Phone Number'" placeholder="Phone Number" aria-label="Phone Number" required aria-describedby="basic-addon1">
                            </div>

                            <div class="form-group">
                                Giới tính:<select class="form-control" id="gioitinh" name="gender">
                                    <option value="" selected disabled>Giới tính</option>
                                    <option value="1">Nam</option>
                                    <option value="0">Nữ</option>
                                </select>
                            </div>

                            <div class="form-group">
                                Địa chỉ:<input type="text" name="address" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Address'" placeholder="Address" aria-label="Address" required aria-describedby="basic-addon1">
                            </div>

                            <div class="form-group">
                                CMND:<input type="text" name="identify_number" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Identify Number'" placeholder="Identify Number" aria-label="Identify Number" required aria-describedby="basic-addon1">
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
                        url: "customers/fetch.php",
                        type: "post",
                        // success: (data) => {console.log(data)}
                    },

                    columns: [{
                            data: "user_id"
                        },
                        {
                            data: "name"
                        },
                        {
                            data: "phone_number"
                        },
                        {
                            data: "gender"
                        },
                        {
                            data: "address"
                        },
                        {
                            data: "identify_number"
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
                        if (i < 3) {
                            inputs[i].value = $(this).parents('tr')[0].childNodes[i].firstChild.nodeValue
                        } else if (i < 5) {
                            inputs[i].value = $(this).parents('tr')[0].childNodes[i + 1].firstChild.nodeValue
                        }
                    } catch (e) {
                        inputs[i].value = ''
                    }
                }
                var idedit = $(this).parents('tr')[0].childNodes[0].firstChild.nodeValue
                $('#mataikhoan option')
                    .removeAttr('selected')
                    .filter('[value=' + idedit + ']')
                    .attr('selected', true)
                if ($(this).parents('tr')[0].childNodes[3].firstChild.nodeValue == 'Nam') {
                    $('#gioitinh option')
                        .removeAttr('selected')
                        .filter('[value=1]')
                        .attr('selected', true)
                } else {
                    $('#gioitinh option')
                        .removeAttr('selected')
                        .filter('[value=0]')
                        .attr('selected', true)
                }
            });
            // Delete a record
            $('#dataTable').on('click', 'td.editor-delete', function(e) {
                e.preventDefault();
                var id = $(this).parents('tr')[0].childNodes[0].firstChild.nodeValue
                var self = this

                $.ajax({
                    url: "./customers/delete.php",
                    method: "POST",
                    data: {
                        "user_id": id
                    },
                    success: function(result) {
                        //console.log(result)
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

        <?php include('includes/scripts.php'); ?>
        <?php include('includes/footer.php'); ?>