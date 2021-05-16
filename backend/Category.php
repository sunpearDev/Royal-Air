<?php
require_once('dbService.php');
class Category extends DbServices
{
    function getCategory($id)
    {
        return $this->getBy("room_category", ['name' => 'category_ID', 'value' => $id]);
    }
    function getAllCategory()
    {
        $res = $this->getAll("room_category");
        foreach ($res as $item) {
            $images = $this->getBy("image", ['name' => 'category_ID', 'value' => $item['category_ID']]);
            $item['image'] = $images;
            $res1[] = $item;
        }
        //print_r($res);
        //echo '<br />';
        return $res1;
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
    function listRoom($id)
    {
        $categorys = $this->getAll("room_category");
        $res = [];
        if ($id != null) {
            foreach ($categorys as $cat) {
                $images  = $this->getMultiTable([0 => 'room_category', 1 => 'image'], ['name' => 'category_ID', 'value' => $cat['category_ID']]);
                $cat['image'] = $images;
                $res[] = $cat;
            }
        }
        return $res;
    }
    function listRoom1($id)
    {
        $categorys = $this->getAll("image");
        $res = [];
        if ($id != null) {
            foreach ($categorys as $cat) {
                $images  = $this->getMultiTable([0 => 'room_category', 1 => 'image'], ['name' => 'category_ID', 'value' => $cat['category_ID']]);
                $cat['image'] = $images;
                $res[] = $cat;
            }
        }
        return $res;
    }
}
