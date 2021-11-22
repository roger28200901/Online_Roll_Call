<?php
include("connection.php");
$sql = "DELETE `rollcalls`, `students` FROM `rollcalls` RIGHT JOIN `students` ON `rollcalls`.`id` = `students`.`rollcall_id` WHERE `rollcalls`.`id` = $_GET[id]";
mysqli_query($mysqli, $sql);

echo "success";
