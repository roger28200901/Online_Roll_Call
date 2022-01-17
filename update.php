<?php


include('connection.php');

// Select * from members;
$sql = "SELECT * FROM `students` WHERE `time` LIKE '%$_GET[rollcall_time]%'";
$results = mysqli_query($mysqli, $sql);

$myArray = array();
$tempArray = array();
while ($row = mysqli_fetch_object($results)) {
    $tempArray = $row;
    array_push($myArray, $tempArray);
}
echo json_encode($myArray);

// Return json array to front end and update 