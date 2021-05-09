<?php
$con = mysqli_connect('localhost', 'root', '', 'royal_side');
$request = $_REQUEST;
$col = array(
    0 => 'booking_ID',
    1 => 'category_ID',
    2 => 'quantity',
    3 => 'price_on_day',
);

$sql = "SELECT * FROM booking_detail";
$query = mysqli_query($con, $sql);
$totalData = mysqli_num_rows($query);
$totalFilter = $totalData;
$data = array();

while ($row = mysqli_fetch_array($query)) {
    $subdata = array();
    $subdata['booking_ID'] = $row[0];
    $subdata['category_ID'] = $row[1];
    $subdata['quantity'] = $row[2];
    $subdata['price_on_day'] = $row[3];
    $data[] = $subdata;
}


$json_data = [
    "recordsTotal"      => intval($totalData),
    "recordsFiltered"   => intval($totalFilter),
    "data"              => $data,
];

echo json_encode($json_data);
