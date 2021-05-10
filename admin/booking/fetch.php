<?php
$con = mysqli_connect('localhost', 'root', '', 'royal_side');
$request = $_REQUEST;
$col = array(
    0 => 'booking_ID',
    1 => 'user_id',
    2 => 'adult',
    3 => 'children',
    4 => 'check_in',
    5 => 'check_out',
    6 => 'total_pay'
);

$sql = "SELECT * FROM booking";
$query = mysqli_query($con, $sql);
$totalData = mysqli_num_rows($query);
$totalFilter = $totalData;
$data = array();

while ($row = mysqli_fetch_array($query)) {
    $subdata = array();
    $subdata['booking_ID'] = $row[0];
    $subdata['user_id'] = $row[1];
    $subdata['adult'] = $row[2];
    $subdata['children'] = $row[3];
    $subdata['check_in'] = $row[4];
    $subdata['check_out'] = $row[5];
    $subdata['total_pay'] = $row[6];
    $data[] = $subdata;
}


$json_data = [
    "recordsTotal"      => intval($totalData),
    "recordsFiltered"   => intval($totalFilter),
    "data"              => $data,
];

echo json_encode($json_data);
