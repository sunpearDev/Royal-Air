<?php
$con = mysqli_connect('localhost', 'root', '', 'royal_side');
$request = $_REQUEST;
$col = array(
    0 => 'category_ID',
    1 => 'category_name',
    2 => 'single_bed',
    3 => 'double_bed',
    4 => 'area',
    5 => 'description',
    6 => 'available',
    7 => 'price_on_day'
);

$sql = "SELECT * FROM room_category";
$query = mysqli_query($con, $sql);
$totalData = mysqli_num_rows($query);
$totalFilter = $totalData;
$data = array();

while ($row = mysqli_fetch_array($query)) {
    $subdata = array();
    $subdata['category_ID'] = $row[0];
    $subdata['category_name'] = $row[1];
    $subdata['single_bed'] = $row[2];
    $subdata['double_bed'] = $row[3];
    $subdata['area'] = $row[4];
    $subdata['description'] = $row[5];
    $subdata['available'] = $row[6];
    $subdata['price_on_day'] = $row[7];
    $data[] = $subdata;
}


$json_data = [
    "recordsTotal"      => intval($totalData),
    "recordsFiltered"   => intval($totalFilter),
    "data"              => $data,
];

echo json_encode($json_data);
