<?php

include('connection.php');

$handle = fopen("students.csv", "r");
$sql = "TRUNCATE `midterm`.`users`";
mysqli_query($mysqli, $sql);
while (($data = fgetcsv($handle)) !== FALSE) {

    $class = $data[0];
    $school_number = $data[1];
    $account = $school_number . "@ntut.edu.tw";
    $name = $data[2];

    $sql = "INSERT INTO `users` 
    (`id`, `account`, `password`, `class`, `school_number`, `name`) 
    VALUES 
    (NULL, '$account', '1234', '$class', '$school_number', '$name');";
    echo $sql;
    mysqli_query($mysqli, $sql);

    echo  "<br>";
}
