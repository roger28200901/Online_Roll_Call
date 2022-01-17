<?php
include("connection.php");
$sql = "INSERT INTO `rollcalls` (`id`, `class_name`, `date`, `time`, `delay`) VALUES (NULL, '$_POST[class_name]', '$_POST[date]', '$_POST[time]', '$_POST[delay]');";

mysqli_query($mysqli, $sql);
header("Location:backend.php");
