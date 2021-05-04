<?php
$con = mysqli_connect('localhost', 'root', '', 'royal_side');
$request = $_POST;


if (isset($_POST['room_number'], $_POST['category_ID'])) {
    return json_encode(['errors' => 'ID is required']);
} else {

    $sql = "DELETE FROM room WHERE room.room_number =" . $request['room_number'] . " AND room.category_ID =" . $request['category_ID'];
    if (mysqli_query($con, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}
