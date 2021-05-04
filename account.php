<?php
    if (isset($_COOKIE['token']))
    echo "<script> window.location.pathname='index.php'</script>";
?>
<!doctype html>
<html lang="en">

<head>
    <?php include('./includes/head.php') ?>
</head>

<body>
    <?php include('./includes/header.php') ?>

    <?php include('./includes/breadcrumb.php') ?>
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link <?php if (isset($_GET['info']) && $_GET['info']) echo "border border-primary" ?>"" href=" ?info=true">
                            <i class="fas fa-info-circle"></i>
                            Your infor
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if (isset($_GET['booking']) && $_GET['booking']) echo "border border-primary" ?>" href="?booking=true">
                            <i class="fas fa-hotel"></i>
                            Your room
                        </a>
                    </li>
            </div>
        </nav>
        <div class="col-md-8">
            <?php
            if (isset($_GET['booking']) && $_GET['booking']) {
                include('./backend/Booking.php');
                include('./backend/Category.php');
                $booking = new Booking();
                $userbookings = $booking->getUserBooking($_COOKIE['token']);
                foreach ($userbookings as $item) {
                    $category = new Category();
                    $booking_category = $category->getCategory($item['category_ID']);
                    //print_r($booking_category);
                    echo ' 
            <div class="card mt-3 mb-3 border border-warning">
                <div class="card-header">
                    Form ' . $item['check_in'] . ' to ' . $item['check_out'] . ' 
                </div>
                <div class="card-body">
                    <h3 class="card-title">Booking id:' . $item['booking_ID'] . '</h3>
                </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item"><h4>' . $booking_category[0]['category_name'] . ' x '.$item['quantity'].'</h4></li>
                <li class="list-group-item">' . $item['adult'] . ' adult and ' . $item['children'] . ' child</li>
                <li class="list-group-item">'.$booking_category[0]['price_on_day'].' $ per day</li>
              </ul>
              <div class="card-body">
              <h4 class="money">' . $item['total_pay'] . ' $</h4>
                <a href="#" class="card-link">Card link</a>
              </div>
            </div>';
                }
            }
            ?>
        </div>
    </div>


    <?php include('./includes/footer.php') ?>

</body>

</html>