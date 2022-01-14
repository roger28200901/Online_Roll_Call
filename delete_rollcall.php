<?php
include("connection.php");
$sql = "DELETE `rollcalls` FROM `rollcalls` WHERE `rollcalls`.`id` = $_GET[id]";
mysqli_query($mysqli, $sql);

echo "success";
