<?php
$con = mysqli_connect('localhost', 'root', '', 'royal_side');
$request = $_REQUEST;
$col = array(
    0 => 'room_number',
    1 => 'category_ID',
    2 => 'state'
);

$sql = "SELECT * FROM room";
$query = mysqli_query($con, $sql);
$totalData = mysqli_num_rows($query);
$totalFilter = $totalData;
$data = array();

while ($row = mysqli_fetch_array($query)) {
    $subdata = array();
    $subdata['roomNumber'] = $row[0]; //roomnumber
    $subdata['roomType'] = $row[1]; //roomtype
    $subdata['state'] = $row[2]; //state
    $data[] = $subdata;
}


$json_data = [
    "recordsTotal"      => intval($totalData),
    "recordsFiltered"   => intval($totalFilter),
    "data"              => $data,
];

echo json_encode($json_data);
