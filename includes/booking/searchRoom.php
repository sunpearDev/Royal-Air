<?php
include("./backend/Category.php");
$category = new Category();

$res = $category->getAllCategory();
?>
<div class="progress-table-wrap  m-5 p-4">
    <div class="progress-table">
        <div class="table-head">
            <h2 class="country w-100 p-3">
                <?php
                echo 'Room for ' . $_POST['adult'] . ' adult';
                if ($_POST['child'] > 0) echo ' and ' . $_POST['child'] . ' child';
                ?>
            </h2>
        </div>
        <div class="table-row">
            <form class="row" method="get" action="<?php echo './booking.php?booking=true';?>">
                <?php
                foreach ($res as $item) {
                    $html = '<div class="col-md-12">
                        <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                            <div class="col-4 d-none d-lg-block">
                                <div class="bd-example">
                                    <div id="carouselExampleCaptions' . $item['category_ID'] . '" class="carousel slide" data-ride="carousel">
                                        <ol class="carousel-indicators">
                                            ';
                    if (count($item['image']) == 0)
                        $html .= '<li data-target="#carouselExampleCaptions' . $item['category_ID'] . '" data-slide-to="0" class="active"></li>';
                    else {
                        $html .= '<li data-target="#carouselExampleCaptions' . $item['category_ID'] . '" data-slide-to="0" class="active"></li>';
                        for ($i = 1; $i < count($item['image']); $i++)
                            $html .= '<li data-target="#carouselExampleCaptions' . $item['category_ID'] . '" data-slide-to="' . $i . '"></li>';
                    }

                    $html .= '            
                                        </ol>
                                        <div class="carousel-inner">
                                            ';
                    if (count($item['image']) == 0)
                        $html .= '<div class="carousel-item active">
                                    <img height="250px" src="/image/grey.jpg" class="d-block w-100" alt="...">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>Unavailable</h5>
                                    </div>
                                </div>';
                    else {
                        $html .=  '<div class="carousel-item active">
                        <img height="250px" src="/image/' . $item['image'][0]['name'] . '" class="d-block w-100" alt="...">
                    </div>';
                        for ($i = 1; $i < count($item['image']); $i++)
                            $html .= '<div class="carousel-item">
                            <img height="250px" src="/image/' . $item['image'][$i]['name'] . '" class="d-block w-100" alt="...">
                        </div>';
                    }
                    $html .= '
                                        </div>
                                        <a class="carousel-control-prev" href="#carouselExampleCaptions' . $item['category_ID'] . '" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#carouselExampleCaptions' . $item['category_ID'] . '" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8 d-flex flex-column position-static">
                                <div class="row">
                                    <div class="col-md-8"><strong class="d-inline-block mb-2 text-warning">Royal Side</strong>
                                        <h3 class="mb-0">' . $item['category_name'];
                    $html .= '</h3>
                                        <div class="mb-1 text-muted"><i class="fas fa-square"></i> ' . $item['area'] . ' m2</div>
                                        <div class="mb-0">' . $item['single_bed'] . ' single bed <img width="16px" class="bed" src="image/single-bed.png" /> ,' . $item['double_bed'] . ' double bed <img width="16px" class="bed" src="image/double-bed.jpg" /></div>
                                        <p class="card-text mb-auto">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                                        <a href="/room_detail.php" class="stretched-link">Learn more</a>
                                    </div>
                                    ';
                    if ($item['available'] > 0) {
                        $html .= '<div class="col-md-4">
                                        <div class="row d-flex justify-content-center text-center">
                                            <div class="def-number-input number-input safari_only mb-0 w-100">
                                                <input class="quantity" min="0" name="quantity_' . $item['category_ID'] . '" value="0" max="' . $item['available'] . '" type="number">            
                                            </div>
                                        </div>
                                        <div class="row p-3 d-flex justify-content-center">
                                        <h4 class="money">' . $item['price_on_day'] . ' $/day</h4>
                                    </div>
                                    </div>';
                    } else $html .= '<div class="col-md-4 p-5 align-self-center">
                                    <div class="d-flex justify-content-center">
                                        <h4 class="text-danger p-3 border-3 border border-danger">Sold out</h4>
                                    </div>
                                </div>';
                    $html .= '
                                </div>
                            </div>
                        </div>
                    </div>';
                    echo $html;
                }
                ?>
                <input type="hidden" name="check_in" value="<?php echo $_POST['check_in'];?>">
                <input type="hidden" name="check_out" value="<?php echo $_POST['check_out'];?>">
                <input type="hidden" name="adult" value="<?php echo $_POST['adult'];?>">
                <input type="hidden" name="child" value="<?php echo $_POST['child'];?>">
                <div class="d-flex justify-content-lg-center">
                    <button type="submit" name="booking" value="true" class="book_now_btn button_hover circle">BOOK IT</button>
                </div>
            </form>


        </div>

    </div>

</div>