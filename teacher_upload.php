<?php

include("connection.php");
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image

$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);

if ($check !== false) {
    // echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
} else {
    // echo "File is not an image.";
    $uploadOk = 0;
}

if ($uploadOk) {
    // echo $_FILES["fileToUpload"]["tmp_name"];
    // echo $target_file;
    move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
    // if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    //     echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
    // } else {
    //     echo "Sorry, there was an error uploading your file.";
    // }
    $file_name = $_FILES["fileToUpload"]["name"];
    $sql = "UPDATE `users` SET `name` = '$_POST[name]', `image_name` = '$file_name' WHERE `users`.`id` = $_POST[id];";
} else {
    $sql = "UPDATE `users` SET `name` = '$_POST[name]' WHERE `users`.`id` = $_POST[id];";
}

mysqli_query($mysqli, $sql);
return header("Location:teacher_profile.php");
// return header("Location:insert_student_image.php");