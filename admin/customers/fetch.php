<?php
$con = mysqli_connect('localhost', 'root', '', 'royal_side');
$request = $_REQUEST;
$col = array(
    0 => 'user_id',
    1 => 'name',
    2 => 'phone_number',
    3 => 'gender',
    4 => 'address',
    5 => 'identify_number',
);

$sql = "SELECT * FROM profile";
$query = mysqli_query($con, $sql);
$totalData = mysqli_num_rows($query);
$totalFilter = $totalData;
$data = array();

while ($row = mysqli_fetch_array($query)) {
    $subdata = array();
    $subdata['user_id'] = $row[0];
    $subdata['name'] = $row[1];
    $subdata['phone_number'] = $row[2];
    if ($row[3] == 1)
        $subdata['gender'] = 'Male';
    else
        $subdata['gender'] = 'Female';
    $subdata['address'] = $row[4];
    $subdata['identify_number'] = $row[5];
    $data[] = $subdata;
}


$json_data = [
    "recordsTotal"      => intval($totalData),
    "recordsFiltered"   => intval($totalFilter),
    "data"              => $data,
];

echo json_encode($json_data);
