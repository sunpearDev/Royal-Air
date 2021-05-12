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
            <p>We all live in an age that belongs to the young at heart. Life that is becoming extremely fast, </p>
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
                    </div>
                    <a href="/room_detail.php">
                        <h4 class="sec_h4"><?php echo $item['category_name'] ?></h4>
                    </a></div>
            </div>
<?php $id=$key['category_ID'];
break; }}}?>
        </div>
    </div>
</section>