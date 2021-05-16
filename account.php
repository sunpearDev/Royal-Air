<?php
if (!isset($_COOKIE['token']))
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
                $item = $booking->getUserBooking($_COOKIE['token']);
                if (count($item) > 0) {
                    echo ' 
            <div class="card mt-3 mb-3 border border-warning">
                <div class="card-header">
                    Form ' . $item['check_in'] . ' to ' . $item['check_out'] . ' 
                </div>
                <div class="card-body">
                    <h3 class="card-title">Booking id:' . $item['booking_ID'] . '</h3>
                </div>
                <ul class="list-group list-group-flush">
                <li class="list-group-item"><div class="row">';

                    for ($i = 0; $i < count($item['detail']); $i++) {
                        $detail = $item['detail'][$i];
                        echo '<div class="col-md-' . (12 / count($item['detail'])) . '">
                    <ul class="list-group list-group-flush">
                        <h4 class="list-group-item">' . $detail['category_name'] . ' x ' . $detail['quantity'] . '</h4>
                        <h6 class="list-group-item">' . $detail['price_on_day'] * $detail['quantity'] . '$ per day</h6>
                    </ul>
                    </div>';
                    }

                    echo '</div></li>
                <li class="list-group-item">' . $item['adult'] . ' adult and ' . $item['children'] . ' child</li>
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