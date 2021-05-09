<?php
require_once "../../backend/dbService.php";

if (isset($_POST['category_ID'])) {
    $DB = new DbServices();
    $sql = "delete from room_category where category_ID  = '" . $_POST['category_ID'] . "'";
    try {
        $result =  $DB->delete('room_category', ['name' => 'category_ID', 'value' => "'" . $_POST['category_ID'] . "'"]);

        if ($result) {
            echo "Deleted Successfully";
        } else {
            echo "Delete Error";
        }
    } catch (Exception $e) {
        echo "Delete Error";
    }
}
