<?php
$con = mysqli_connect('localhost', 'root', '', 'royal_side');
$request = $_REQUEST;
$col = array(
    0 => 'user_id',
    1 => 'username',
    2 => 'email',
    3 => 'password',
    4 => 'account_category'
);

$sql = "SELECT * FROM account";
$query = mysqli_query($con, $sql);
$totalData = mysqli_num_rows($query);
$totalFilter = $totalData;
$data = array();

while ($row = mysqli_fetch_array($query)) {
    $subdata = array();
    $subdata['user_id'] = $row[0];
    $subdata['username'] = $row[1];
    $subdata['email'] = $row[2];
    $subdata['password'] = '********';
    $subdata['account_category'] = $row[4];
    $data[] = $subdata;
}


$json_data = [
    "recordsTotal"      => intval($totalData),
    "recordsFiltered"   => intval($totalFilter),
    "data"              => $data,
];

echo json_encode($json_data);
