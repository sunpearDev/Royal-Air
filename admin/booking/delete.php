<?php
require_once "../../backend/dbService.php";



if (isset($_POST['booking_id'])) {
    $DB = new DbServices();

    $result =  $DB->delete('booking', ['name' => 'booking_id', 'value' => $_POST['booking_id']]);
    echo "Deleted successfully!";
}
