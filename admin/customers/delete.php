<?php
require_once "../../backend/dbService.php";



if (isset($_POST['username'])) {
    $DB = new DbServices();

    $result =  $DB->delete('profile', ['name' => 'username', 'value' => $_POST['username']]);
    echo "Deleted successfully!";
}
