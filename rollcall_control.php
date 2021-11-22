<?php
include("connection.php");
$sql = "SELECT * FROM `rollcalls`";
$results = mysqli_query($mysqli, $sql);
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
        <input type="button" value="返回上一頁" class="btn btn-danger" onclick="location.href='backend.php'">
        <hr>
        <table class="table table-hover table-dark">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">課程名稱</th>
                    <th scope="col">日期</th>
                    <th scope="col">點名時間</th>
                    <th scope="col">遲到時間</th>
                    <th scope="col">控制</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_array($results)) {
                ?>
                    <tr>
                        <th scope="row"><?= $row['id'] ?></th>
                        <td><?= $row['class_name'] ?></td>
                        <td><?= $row['date'] ?></td>
                        <td><?= $row['time'] ?></td>
                        <td><?= $row['delay'] ?></td>
                        <td>
                            <input type="button" value="查看內容" class="btn btn-primary">
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