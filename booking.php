<html lang="en">

<head>
    <?php include('./includes/head.php') ?>
</head>

<body>
    <?php include('./includes/header.php') ?>

    <?php include('./includes/breadcrumb.php') ?>

    <section class="banner_area mb-15">
        <?php include('./includes/accomodation/book_area.php') ?>
    </section>

    <?php
    $booking_info = [];

    if (!isset($_GET['booking'])) {
        include('./includes/booking/searchRoom.php');
    } elseif ($_GET['booking'] == true) {
        include('./backend/Booking.php');
        $booking = new Booking();
        $booking_info = ['booking_ID' => uniqid(), 'user_id' => $booking->decrypt($_COOKIE['token']), 'adult' => $_GET['adult'], 'children' => $_GET['child'], 'check_in' => $_GET['check_in'], 'check_out' => $_GET['check_out']];
        $booking_detail_info = ['booking_ID' => $booking_info['booking_ID'], 'category_ID' => $_GET['category'], 'quantity' => $_GET['quantity']];
        $res=$booking->book($booking_info, $booking_detail_info);
        echo "<script>alert('" . $res['message'] . "')</script>";
        echo "<script> window.location.pathname='account.php'</script>";
    }
    ?>


    <?php include('./includes/footer.php') ?>


</body>

</html>