<?php
include("./backend/Category.php");
$category = new Category();
$res = $category->listRoom('category_ID');
$image=$category->listRoom1('category_ID');
$id=null;

?>
<section class="accomodation_area section_gap">
    <div class="container">
        <div class="section_title text-center">
            <h2 class="title_color">Hotel Accomodation</h2>
            <p>Tất cả chúng ta đang sống trong một thời đại thuộc về tuổi trẻ. Cuộc sống đang trở nên cực kỳ nhanh chóng, </p>
        </div>
        <div class="row ">
<?php
foreach($image as $key){
        foreach($res as $item){
if($key['category_ID']==$item['category_ID']&&$key['category_ID']!=$id){
        ?>
            <div class="col-lg-3 col-sm-6">
                <div class="accomodation_item text-center">
                    <div class="hotel_img">
                        <img src="image/<?php echo $key['name']; ?>" alt="image"class="img-thumbnail" >
                        <a href="/booking.php" class="btn theme_btn button_hover">Đặt ngay</a>
                    </div>
                    <a href="/room_detail.php">
                        <h4 class="sec_h4"><?php echo $item['category_name'] ?></h4>
                        <h5><?php echo $item['price_on_day'] ?><small>/night</small></h5>
                    </a></div>
            </div>
<?php $id=$key['category_ID'];
break; }}}?>
        </div>
    </div>
</section>