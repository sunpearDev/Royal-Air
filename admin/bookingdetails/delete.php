<?php
require_once "../../backend/dbService.php";



if (isset($_POST['booking_id'])) {
    $DB = new DbServices();
    try {
        $result =  $DB->delete('booking_detail', ['name' => 'booking_id', 'value' => "'" . $_POST['booking_id'] . "'"]);

        if ($result) {
            echo "Deleted Successfully";
        } else {
            echo "Delete Error";
        }
    } catch (Exception $e) {
        echo "Delete Error";
    }
}
