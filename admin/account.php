<?php

include('includes/header.php');
include('includes/navbar.php');
require_once "../backend/dbService.php";

if (isset(
    $_POST['user_id'],
    $_POST['username'],
    $_POST['email'],
    // $_POST['password'],
    $_POST['account_category'],
)) {



    $kq = false;
    $resultEdit = "";
    $DB = new DbServices();
    $sql = "update account set ";
    $sql .= "username = '" . $_POST['username'] . "'";
    $sql .= ",email = '" . $_POST['email'] . "'";
    if (isset($_POST['password']) && $_POST['password'] != '********')
        $sql .= ",password = '" . sha1($_POST['password']) . "'";
    $sql .= ",account_category = '" . $_POST['account_category'] . "'";
    $sql .= " where user_id = '" . $_POST['user_id'] . "'";


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
            <h1 class="h3 mb-2 text-gray-800">Danh sách tài khoản</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tài khoản</h6>
                </div>
                <div class="alert" role="alert" id="notification">
                </div>
                <?php if (isset($resultEdit)) { ?>
                    <div class="alert <?php if ($kq)  echo ('alert-success');
                                        else echo 'alert-danger' ?>" role="alert">
                        <?php echo $resultEdit ?>
                    </div>
                <?php } ?>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Tài khoản</th>
                                    <th>Email</th>
                                    <th>Mật khẩu</th>
                                    <th>Loại tài khoản</th>
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
                        <form action="./account.php" method="POST" id="formEdit">


                            <input type="text" hidden name="user_id">

                            <div class="form-group">
                                Loại tài khoản:<select class="form-control" id="cb_acccat" name="account_category">
                                    <option value="" selected disabled>Loại tài khoản</option>
                                    <option value="admin">Admin</option>
                                    <option value="customer">Customer</option>
                                </select>
                            </div>

                            <div class="form-group">
                                Tên tài khoản:<input type="text" name="username" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'" placeholder="Username" aria-label="Username" required aria-describedby="basic-addon1">
                            </div>

                            <div class="form-group">
                                Email:<input type="email" name="email" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" placeholder="Email" aria-label="Email" required aria-describedby="basic-addon1">
                            </div>

                            <div class="form-group">
                                Mật khẩu:<input type="password" name="password" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" placeholder="Password" aria-label="Password" required aria-describedby="basic-addon1">
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
                        url: "accounts/fetch.php",
                        type: "post",
                        // success: (data) => {console.log(data)}
                    },

                    columns: [{
                            data: "user_id"
                        },
                        {
                            data: "username"
                        },
                        {
                            data: "email"
                        },
                        {
                            data: "password"
                        },
                        {
                            data: "account_category"
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
                        inputs[i].value = $(this).parents('tr')[0].childNodes[i].firstChild.nodeValue
                    } catch (e) {
                        inputs[i].value = ''
                    }
                }
                if ($(this).parents('tr')[0].childNodes[4].firstChild.nodeValue == 'admin') {
                    $('#cb_acccat option')
                        .removeAttr('selected')
                        .filter('[value=admin]')
                        .attr('selected', true)
                } else {
                    $('#cb_acccat option')
                        .removeAttr('selected')
                        .filter('[value=customer]')
                        .attr('selected', true)
                }

            });
            // Delete a record
            $('#dataTable').on('click', 'td.editor-delete', function(e) {
                e.preventDefault();
                var id = $(this).parents('tr')[0].childNodes[0].firstChild.nodeValue
                var self = this

                $.ajax({
                    url: "./accounts/delete.php",
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