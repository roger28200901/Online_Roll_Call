<?php

include("connection.php");


$sql = "SELECT * FROM `users` WHERE `account` = '$_POST[account]' AND `password` = '$_POST[password]'";

$result = mysqli_query($mysqli, $sql);

$check = mysqli_num_rows($result);

if ($check) {
    $_SESSION['login'] = true;
    header("Location: backend.php");
} else {
    header("Location: login.php");
}
