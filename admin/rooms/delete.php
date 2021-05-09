<?php


require_once "../../backend/dbService.php";

if (isset($_POST['category_ID'], $_POST['room_number'])) {
    $DB = new DbServices();
    $sql = "DELETE FROM room WHERE room_number = " . $_POST['room_number'] . " AND category_ID = '" . $_POST['category_ID'] . "'";
    try {
        $result =  $DB->rowEffect($sql);

        if ($result) {
            echo "Deleted Successfully";
        } else {
            echo "Delete Error";
        }
    } catch (Exception $e) {
        echo "Delete Error";
    }
}
