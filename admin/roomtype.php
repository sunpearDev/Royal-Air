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
    $_POST['available'],
    $_POST['price_on_day'],
    $_POST['category_ID']
)) {


    // var_dump($_POST);
    // die();
    $kq = false;
    $resultEdit = "";
    $DB = new DbServices();
    $sql = "update room_category set ";
    $sql .= "category_name = '" . $_POST['category_name'] . "'";
    $sql .= ",single_bed = " . $_POST['single_bed'];
    $sql .= ",double_bed = " . $_POST['double_bed'];
    $sql .= ",area = " . $_POST['area'];
    $sql .= ",description = '" . $_POST['description'] . "'";
    $sql .= ",available = " . $_POST['available'];
    $sql .= ",price_on_day = " . $_POST['price_on_day'];

    $sql .= " where category_ID = '" . $_POST['category_ID'] . "'";

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
            <h1 class="h3 mb-2 text-gray-800">Danh sách loại phòng</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Loại phòng</h6>
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
                        <table class="table table-bordered display" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Mã</th>
                                    <th>Tên</th>
                                    <th>Giường đơn</th>
                                    <th>Giường đôi</th>
                                    <th>Khu vực</th>
                                    <th>Mô tả</th>
                                    <th>Có sẵn</th>
                                    <th>Giá</th>
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
                var idcat = $(this).parents('tr')[0].childNodes[0].firstChild.nodeValue
            });
            // Delete a record
            $('#dataTable').on('click', 'td.editor-delete', function(e) {
                e.preventDefault();
                var id = $(this).parents('tr')[0].childNodes[0].firstChild.nodeValue
                var self = this

                $.ajax({
                    url: "./roomtype/delete.php",
                    method: "POST",
                    data: {
                        "category_ID": id
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
                        $("#notification").attr('class', 'alert-danger');
                        $("#notification").html("Problem");
                    }
                });

            });
        </script>

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
                        <form action="./roomtype.php" method="POST" id="formEdit">
                            <input type="text" hidden name="category_ID">
                            <div class="form-group">
                                Loại phòng:<input type="text" name="category_name" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Name'" placeholder="Name" aria-label="Room Number" required aria-describedby="basic-addon1">
                            </div>

                            <div class="form-group">
                                Giường đơn:<input type="text" name="single_bed" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Single Bed'" placeholder="Single Bed" aria-label="Single Bed" required aria-describedby="basic-addon1">
                            </div>

                            <div class="form-group">
                                Giường đôi:<input type="text" name="double_bed" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Double Bed'" placeholder="Double Bed" aria-label="Double Bed" required aria-describedby="basic-addon1">
                            </div>

                            <div class="form-group">
                                Khu vực:<input type="text" name="area" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Area'" placeholder="Area" aria-label="Area" required aria-describedby="basic-addon1">
                            </div>

                            <div class="form-group">
                                Mô tả:<input type="text" name="description" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Description'" placeholder="Description" aria-label="Description" required aria-describedby="basic-addon1">
                            </div>

                            <div class="form-group">
                                Có sẵn:<input type="text" name="available" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Available'" placeholder="Available" aria-label="Available" required aria-describedby="basic-addon1">
                            </div>

                            <div class="form-group">
                                Giá:<input type="text" name="price_on_day" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Price on day'" placeholder="Price on day" aria-label="Price on day" required aria-describedby="basic-addon1">
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
                        url: "roomtype/fetch.php",
                        type: "post",
                        // success: (data) => {console.log(data)}
                    },

                    columns: [{
                            data: "category_ID"
                        },
                        {
                            data: "category_name"
                        },
                        {
                            data: "single_bed"
                        },
                        {
                            data: "double_bed"
                        },
                        {
                            data: "area"
                        },
                        {
                            data: "description"
                        },
                        {
                            data: "available"
                        },
                        {
                            data: "price_on_day"
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




        <?php include('includes/scripts.php'); ?>
        <?php include('includes/footer.php'); ?>