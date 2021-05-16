<?php
if (isset($_SESSION)) session_destroy();
session_start();
?>
<html lang="en">

<head>
    <?php include('./includes/head.php');
    ?>
</head>

<body>
    <?php include('./includes/header.php') ?>

    <?php include('./includes/breadcrumb.php') ?>

    <section class="banner_area mb-15">
        <?php include('./includes/accomodation/book_area.php') ?>
    </section>

    <?php
    include('./backend/Booking.php');
    $booking = new Booking();
    function bookOneCategory($category)
    {
        include('./backend/Booking.php');
        $booking = new Booking();
        $booking_info = ['booking_ID' => uniqid(), 'user_id' => $_COOKIE['token'], 'adult' => $_GET['adult'], 'children' => $_GET['child'], 'check_in' => $_GET['check_in'], 'check_out' => $_GET['check_out']];
        $booking_detail_info = ['booking_ID' => $booking_info['booking_ID'], 'category_ID' => $category, 'quantity' => $_GET['quantity']];
        $res = $booking->book($booking_info, $booking_detail_info);
        echo "<script>alert('" . $res['message'] . "')</script>";
        echo "<script>window.location='/account.php?booking=true'</script>";
    }

    if (!isset($_GET['booking'])) {
        include('./includes/booking/searchRoom.php');
    } elseif ($_GET['booking'] == true) {
        //if (!isset($_COOKIE['token'])) session_destroy();
        if (isset($_GET)) {
            foreach ($_GET as $key => $value) {
                if (strpos($key, 'quantity') > -1) {
                    if ($value > 0) {
                        echo '<script> document.cookie="' . explode('_', $key)[1] . '=' . $value . ' ;max-age=864000"; </script>';
                    }
                } else //$_SESSION[$key] = $value;
                    echo '<script> document.cookie="' . $key . '=' . $value . ' ;max-age=864000"; </script>';
            }
            sleep(10);
            if (!isset($_COOKIE['token'])) {
                echo "<script> window.location='login.php'</script>";
            } else {
                $booking_info = ['booking_ID' => uniqid(), 'user_id' => ($_COOKIE['token']), 'adult' => ($_COOKIE['adult']), 'children' => ($_COOKIE['child']), 'check_in' => ($_COOKIE['check_in']), 'check_out' => ($_COOKIE['check_out'])];
                $res = $booking->createOneBooking($booking_info);
                if ($res['status'] == true) {
                    foreach ($_COOKIE as $key => $value) {
                        if ($key != 'token' && $key != 'username' && $key != 'PHPSESSID') {
                            $booking_detail_info = ['booking_ID' => $booking_info['booking_ID'], 'category_ID' => $key, 'quantity' => (int)$value, 'price_on_day' => 0];
                            
                            $booking->createOneBookingDetails($booking_detail_info);
                        }
                    }
                }
                foreach ($_COOKIE as $key => $value) {
                    if ($key != 'token' && $key != 'username' && $key != 'PHPSESSID') {
                        echo '<script> document.cookie="' . $key . '= ;max-age=0"; </script>';
                    }
                }
                
                echo "<script> window.location='account.php?booking=true'</script>";
            }
        }
    }
    ?>


    <?php include('./includes/footer.php') ?>


</body>

</html>