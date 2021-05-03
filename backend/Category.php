<?php
require_once('dbService.php');
class Category extends DbServices
{
    function getCategory($id){
        return $this->getBy("room_category",['name' => 'category_ID', 'value' => $id]);
    }
    function searchRoom($quantity, $adult, $child)
    {
        $multiplesBody = $adult + $child / 2;
        $categorys = $this->getAll("room_category");
        $res = [];
        foreach ($categorys as $cat) {
            $available = ($cat['single_bed'] + $cat['double_bed'] * 2) * $quantity - $multiplesBody;
            if ($available >= 0) {

                $res[] = $cat;
            }
        }
        return $res;
    }
}
