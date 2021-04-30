<?php
require_once('dbService.php');
class Category extends DbServices
{
    function searchRoom($adult, $child)
    {
        $multiplesBody = $adult + $child / 2;
        $categorys = $this->getAll("room_category");
        $res = [];
        foreach ($categorys as $cat) {
            if (($cat['single_bed'] + $cat['double_bed'] * 2) >= $multiplesBody) {
                $res[] = $cat;
            }
        }
        return $res;
    }
}
