
<html lang="en">

<head>
    <?php include('./includes/head.php') ?>
</head>

<body>
    <?php include('./includes/header.php') ?>

    <?php include('./includes/breadcrumb.php') ?>

    <section class="banner_area mt-30 mb-30">
        <?php include('./includes/accomodation/booking.php') ?>
    </section>


    <div class="row m-5 p-4">
        <div class="col-md-12">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                <div class="col-4 d-none d-lg-block">
                    <div class="bd-example">
                        <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                            <ol class="carousel-indicators">
                                <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                                <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                            </ol>
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="http://designwebhotel.com/wp-content/uploads/2020/07/cac-loai-hinh-kinh-doanh-khach-san-o-viet-nam-2.png" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>First slide label</h5>
                                        <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="http://designwebhotel.com/wp-content/uploads/2020/07/cac-loai-hinh-kinh-doanh-khach-san-o-viet-nam-2.png" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Second slide label</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <img src="http://designwebhotel.com/wp-content/uploads/2020/07/cac-loai-hinh-kinh-doanh-khach-san-o-viet-nam-2.png" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Third slide label</h5>
                                        <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p>
                                    </div>
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-8 d-flex flex-column position-static">
                    <div class="row">
                        <div class="col-md-8"><strong class="d-inline-block mb-2 text-primary">World</strong>
                            <h3 class="mb-0">Single Deluxe Room</h3>
                            <div class="mb-1 text-muted"><i class="fa fa-square-o" aria-hidden="true"></i> 35m * 50m</div>
                            <div class="mb-0">1 giường đơn <img width='16px' class="bed" src="image/single-bed.png" /> ,1 giường đôi <img width='16px' class="bed" src="image/double-bed.jpg" /></div>
                            <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                            <a href="#" class="stretched-link">Continue reading</a>
                        </div>
                        <div class="col-md-4 p-5 align-self-center">
                            <div class="d-flex justify-content-center">
                                <a class="book_now_btn button_hover circle" href="#">Book It <span class="lnr lnr-arrow-right"></span></a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>

    <?php include('./includes/footer.php') ?>


</body>

</html>