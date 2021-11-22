<?php
include("connection.php");
$sql = "SELECT * FROM `students` WHERE `rollcall_id` = $_GET[id]";
$sql2 = "SELECT `users`.* FROM `users` LEFT JOIN `students` ON `users`.`name` = `students`.`name` and `students`.`rollcall_id` = $_GET[id] WHERE `students`.`name` IS NULL";
$results = mysqli_query($mysqli, $sql);
$results2 = mysqli_query($mysqli, $sql2);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>點名單管理</title>
    <!-- Font Awesome js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

    <!-- Our project just needs Font Awesome solid + brand -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script defer src="js/brands.js"></script>
    <script defer src="js/solid.js"></script>
    <script defer src="js/fontawesome.js"></script>

    <!-- Jquery and Popper Bootstrap js -->
    <script src="js/jquery.js"></script>
    <!-- <script src="js/popper.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <center>
        <h1>點名單管理</h1>
        <input type="button" value="返回上一頁" class="btn btn-danger" onclick="history.back()">
        <hr>
        <table class="table table-hover table-dark">
            <thead>
                <tr class="bg-success">
                    <th scope="col">#</th>
                    <th scope="col">姓名</th>
                    <th scope="col">學號</th>
                    <th scope="col">點名時間</th>
                    <th scope="col">狀態</th>
                    <th scope="col">控制</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($results)) {
                ?>
                    <tr class="table-success">
                        <th scope="row"></th>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['school_number'] ?></td>
                        <td><?= $row['time'] ?></td>
                        <td><?= $row['status'] ?></td>
                        <td>
                            <!-- <input type="button" value="簽到" class="btn btn-primary"> -->
                            <input type="button" value="取消簽到" class="btn btn-danger">
                        </td>
                    </tr>
                <?php
                }
                ?>
                <?php
                while ($row2 = mysqli_fetch_array($results2)) {
                ?>
                    <tr class="table-danger">
                        <th scope="row"></th>
                        <td><?= $row2['name'] ?></td>
                        <td><?= $row2['school_number'] ?></td>
                        <td>未簽到</td>
                        <td>未簽到</td>
                        <td>
                            <input type="button" value="簽到" class="btn btn-success">
                            <input type="button" value="刪除" class="btn btn-danger">
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </center>
</body>


</html>