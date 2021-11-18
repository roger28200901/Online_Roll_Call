<?php
include('connection.php');
$name = $_POST['name'];
$school_number = $_POST['school_number'];
$status = $_POST['status'];

// Current Time
$time = date("Y/m/d H:i:s", time());

// Insert sql 
// $sql = "";
// qa($sql);
