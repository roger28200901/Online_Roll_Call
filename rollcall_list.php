<?php
include("connection.php");
$sql = "SELECT * FROM `students` WHERE `rollcalls_id` = $_GET[id]";
// $sql2 = "SELECT `users`.* FROM `users` LEFT JOIN `students` ON `users`.`name` = `students`.`name` and `students`.`rollcall_id` = $_GET[id] WHERE `students`.`name` IS NULL";
$results = mysqli_query($mysqli, $sql);
// $results2 = mysqli_query($mysqli, $sql2);

$page_sql = "SELECT * FROM `rollcalls` WHERE `id` = $_GET[id]";
$page_results = mysqli_query($mysqli, $page_sql);
$page_row = mysqli_fetch_array($page_results);
?>
<!DOCTYPE html>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Maneger</title>
<meta charset="utf-8">
<link rel="stylesheet " href="./rollcall_list.css">
<link href="https://fonts.googleapis.com/css2?family=Cutive&display=swap" rel="stylesheet">


</head>

<body>

    <div class="row">
        <div class="col">
            <img onclick="history.back()" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC0AAAAtCAYAAAA6GuKaAAAAAXNSR0IArs4c6QAAAQtJREFUaEPt19ENwjAMBNDrBqzABLARsBlMAiMwAiN0BGSp+YmUqo7PbiO533H6ek2dZsKA1zSgGYmOemuZdCa9kkAuj1weuTz0a+AEYNaXtSu8P0QBvwF8ATxYcE90AV8X7JMF90LX4BKypC140+WBboFfAO4m7VLMRruDxc1Eh4CZ6DAwCx0KZqDDwVb0LmArWvrtrWphPwBnRltbm8PSPSTpD4BLdQPazteCW9Ay5y5wK3oXOAMdDmehQ+FMdBicjQ6Be6DX4If9ny7ttW6Hh/2frveDApczIuUAYN3Gt+7Ww53Gtz6YapzXh6hCaAcnWptY7/hMujc5bV0mrU2sd3wm3Zuctm7IpP/vyiwuzvoH7AAAAABJRU5ErkJggg==" class="logo">
            <h1><?= $page_row['date'] ?></h1>
            <p>點名時間：<?= $page_row['time'] ?><br>遲到時間：<?= $page_row['delay'] ?>分鐘</p>
            <!-- <botton type="">12311 程式設計</botton> -->
        </div>
        <div class="container">
            <?php
            while ($row = mysqli_fetch_array($results)) {
            ?>

                <div class="data-row">
                    <div>
                        <h4><?= $row['school_number'] ?></h4>
                    </div>
                    <div>
                        <h4><?= $row['name'] ?></h4>
                    </div>

                    <div>
                        <h4><?= $row['time'] ?></h4>
                    </div>


                    <div class="card <?= $row['status'] == "辨識成功" ? "attend" : "absent"; ?>">
                        <h4><?= $row['status'] == "辨識成功" ? "已到" : "未到"; ?></h4>
                    </div>


                </div>
            <?php
            }
            ?>

        </div>

    </div>





</body>



</html>