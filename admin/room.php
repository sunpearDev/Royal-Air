<?php

include('includes/header.php');
include('includes/navbar.php');

require_once "../backend/dbService.php";


if (isset(
    $_POST['room_number'],
    $_POST['room_number1'],
    $_POST['category_ID'],
    $_POST['state'],
    $_POST['category_ID1'],
)) {



    $kq = false;
    $resultEdit = "";
    $DB = new DbServices();
    $sql = "update room set ";
    $sql .= "room_number = '" . $_POST['room_number'] . "'";
    $sql .= ",category_ID = '" . $_POST['category_ID'] . "'";
    $sql .= ",state = " . $_POST['state'];

    $sql .= " where category_ID = '" . $_POST['category_ID1'] . "' and room_number = " . $_POST['room_number1'];



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
            <h1 class="h3 mb-2 text-gray-800">Danh sách phòng</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Phòng</h6>
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
                                    <th>Số phòng</th>
                                    <th><a href="./roomtype.php" />Loại phòng</th>
                                    <th>Trạng thái</th>
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
                        <h5 class="modal-title" id="exampleModalLabel">EDIT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="./room.php" method="POST" id="formEdit">

                            <input type="text" hidden name="room_number1">
                            <input type="text" hidden name="category_ID1">
                            <div class="form-group">
                                Số phòng:<input type="text" name="room_number" class="form-control" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Room Number'" placeholder="Room Number" aria-label="Room Number" required aria-describedby="basic-addon1">
                            </div>

                            <div class="form-group">
                                Loại phòng:<select class="form-control" id="loaiphong" name="category_ID">
                                    <option value="" selected disabled>Loại phòng</option>
                                    <?php
                                    $DB =  new DbServices();
                                    $roomType = $DB->getAll('room_category');
                                    foreach ($roomType as $item) {
                                        echo '<option  value="' . $item['category_ID'] . '">' . $item['category_name'] . " - " . $item['category_ID'] . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                Trạng thái:<select class="form-control" name="state" id="trangthai">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                </select>
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
                        url: "rooms/fetch.php",
                        type: "post",
                        // success: (data) => {console.log(data)}
                    },

                    columns: [{
                            data: "roomNumber"
                        },
                        {
                            data: "roomType"
                        },
                        {
                            data: "state"
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
                inputs[2].value = $(this).parents('tr')[0].childNodes[0].firstChild.nodeValue
                var idedit = $(this).parents('tr')[0].childNodes[1].firstChild.nodeValue
                $('#loaiphong option')
                    .removeAttr('selected')
                    .filter('[value=' + idedit + ']')
                    .attr('selected', true)
                if ($(this).parents('tr')[0].childNodes[2].firstChild.nodeValue == '0') {
                    $('#trangthai option')
                        .removeAttr('selected')
                        .filter('[value=0]')
                        .attr('selected', true)
                } else {
                    $('#trangthai option')
                        .removeAttr('selected')
                        .filter('[value=1]')
                        .attr('selected', true)
                }
            });
            // Delete a record
            $('#dataTable').on('click', 'td.editor-delete', function(e) {
                e.preventDefault();
                var idCategory = $(this).parents('tr')[0].childNodes[1].firstChild.nodeValue
                var id = $(this).parents('tr')[0].childNodes[0].firstChild.nodeValue

                var self = this

                $.ajax({
                    url: "./rooms/delete.php",
                    method: "POST",
                    data: {
                        "category_ID": idCategory,
                        "room_number": id,
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

        <?php include('includes/scripts.php'); ?>
        <?php include('includes/footer.php'); ?>