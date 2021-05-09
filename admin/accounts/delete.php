<?php

require_once "../../backend/dbService.php";

if (isset($_POST['user_id'])) {
    $DB = new DbServices();
    try {
        $result =  $DB->delete('account', ['name' => 'user_id', 'value' => "'" . $_POST['user_id'] . "'"]);

        if ($result) {
            echo "Deleted Successfully";
        } else {
            echo "Delete Error";
        }
    } catch (Exception $e) {
        echo "Delete Error";
    }
}
