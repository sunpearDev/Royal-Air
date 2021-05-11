<?php
require_once('dbService.php');
class Category extends DbServices
{
    function getCategory($id)
    {
        return $this->getBy("room_category", ['name' => 'category_ID', 'value' => $id]);
    }
    function searchRoom($quantity, $adult, $child)
    {
        $multiplesBody = $adult + $child / 2;
        $categorys = $this->getAll("room_category");
        $res = [];
        if ($quantity == 0) $quantity = 1;
        foreach ($categorys as $cat) {
            $available = ($cat['single_bed'] + $cat['double_bed'] * 2) * $quantity - $multiplesBody;
            if ($available >= 0) {
                $images = $this->getBy("image", ['name' => 'category_ID', 'value' => $cat['category_ID']]);
                $cat['image'] = $images;
                $res[] = $cat;
            }
        }
        return $res;
    }
}
