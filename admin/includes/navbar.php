<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Royal Side</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-home"></i>
            <span>Home</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Admin
    </div>

    <!-- Nav Item - Booking Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-paste"></i>
            <span>Booking</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="booking.php">All Booking</a>
                <a class="collapse-item" href="addbooking.php">Add Booking</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Booking Detail Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBookingDetail" aria-expanded="true" aria-controls="collapseBookingDetail">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Booking Detail</span>
        </a>
        <div id="collapseBookingDetail" class="collapse" aria-labelledby="headingBookingDetail" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="bookingdetail.php">All Booking Detail</a>
                <a class="collapse-item" href="addbookingdetail.php">Add Booking Detail</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Customer Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCustomer" aria-expanded="true" aria-controls="collapseCustomer">
            <i class="fas fa-fw fa-users"></i>
            <span>Customer</span>
        </a>
        <div id="collapseCustomer" class="collapse" aria-labelledby="headingCustomer" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="customer.php">All Customer</a>
                <a class="collapse-item" href="addcustomer.php">Add Customer</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Account Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAccount" aria-expanded="true" aria-controls="collapseAccount">
            <i class="fas fa-fw fa-user"></i>
            <span>Account</span>
        </a>
        <div id="collapseAccount" class="collapse" aria-labelledby="headingAccount" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="account.php">All Account</a>
                <a class="collapse-item" href="addaccount.php">Add Account</a>
            </div>
        </div>
    </li>


    <!-- Nav Item - Room Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoom" aria-expanded="true" aria-controls="collapseRoom">
            <i class="fas fa-fw fa-bed"></i>
            <span>Room</span>
        </a>
        <div id="collapseRoom" class="collapse" aria-labelledby="headingRoom" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="room.php">All Room</a>
                <a class="collapse-item" href="addroom.php">Add Room</a>
            </div>
        </div>
    </li>



    <!-- Nav Item - Room Type Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRoomType" aria-expanded="true" aria-controls="collapseRoomType">
            <i class="fas fa-fw fa-list-alt"></i>
            <span>Room Type</span>
        </a>
        <div id="collapseRoomType" class="collapse" aria-labelledby="headingRoomType" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="roomtype.php">All Room Type</a>
                <a class="collapse-item" href="addroomtype.php">Add Room Type</a>
            </div>
        </div>
    </li>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>



<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="../../login.php">Logout</a>
            </div>
        </div>
    </div>
</div>