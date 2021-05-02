<!doctype html>
<html lang="en">

<head>

    <?php include('./includes/head.php') ?>
</head>

<body>
    <? if (isset($_GET['login']) && $_GET['login'] == 'false')
        echo "<script> alert('You must login before booking.');</script>";
    ?>
    <?php include('./includes/header.php') ?>

    <?php include('./includes/breadcrumb.php') ?>

    <?php include('./includes/login/login.php') ?>

    <?php include('./includes/footer.php') ?>

</body>

</html>