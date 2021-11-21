<?php
include("connection.php");

$name = $_POST['name'];
$status = $_POST['status'];
$time = time();
//school_number not working
$time = date('Y-m-d H:i:s');
$date = date('Y-m-d');
$prepare = "SELECT * FROM `students` WHERE `name` = '$name' AND `time` LIKE '%$date%'";
$result = mysqli_query($mysqli, $prepare);

if (mysqli_num_rows($result)) {
    echo "資料已存在";
    return;
}
$sql = "INSERT INTO `students` (`id`, `name`, `school_number`, `status`, `image_path`, `time`) VALUES (NULL, '$name', '108AC1007', '$status', 'images/test.jpg', '$time');";
mysqli_query($mysqli, $sql);
echo $sql;
