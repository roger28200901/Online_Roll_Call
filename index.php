<?php
include('connection.php');
if ($_SESSION['login'] == false) {
    header("Location:login.php");
}
$id = $_GET['id'];
$sql = "SELECT * FROM `rollcalls` WHERE `id` = $id";

// $sql = "SELECT * FROM `students`";

$result = mysqli_query($mysqli, $sql);

$row = mysqli_fetch_array($result);
$now = date('Y/m/d H:i:s');
$rollcall_time = $row['date'] . " " . $row['time'];
$rollcall_time_plus_delay = date("Y-m-d H:i", strtotime($rollcall_time . '+' . $row['delay'] . 'minute'));
//如果現在時間還沒到點名時間 則不會啟動點名的功能
$rollcall_function = false;
if (strtotime($now) < strtotime($rollcall_time)) {
    $rollcall_function = false;
} else if (strtotime($now) - strtotime($rollcall_time_plus_delay)) {  // 如果今天超過遲到的時間 則也不算啟動
    $rollcall_function = false;
} else {
    $rollcall_function = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>臉部辨識點名系統</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

    <!-- Our project just needs Font Awesome solid + brand -->
    <script defer src="js/brands.js"></script>
    <script defer src="js/solid.js"></script>
    <script defer src="js/fontawesome.js"></script>

    <!-- Jquery and Popper Bootstrap js -->
    <script src="js/jquery.js"></script>
    <!-- <script src="js/popper.js"></script> -->
    <script src="js/bootstrap.min.js"></script>

    <!-- This is for Camera -->
    <script src="script_min.js"></script>
</head>

<body onload="setTimeout('init();', 100);">
    <input type="hidden" name="rollcall_time" value="<?= $rollcall_time ?>">
    <input type="hidden" name="rollcall_time_plus_delay" value="<?= $rollcall_time_plus_delay ?>">
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h1 style="letter-spacing: 3px; color:white">簽到狀態</h1>

                <h3 style="letter-spacing: 3px; color:white"> 班級 ｜ 互動三</h3>
                <input type="button" value="返回後台管理" class="btn btn-success" onclick="location.href='backend.php'">

            </div>

            <div class="container">
                <div class="grid-wrapper" id="left_container">
                    <?php
                    $sql2 = "SELECT * FROM `students` WHERE `time` LIKE '%$row[date]%'";
                    $results = mysqli_query($mysqli, $sql2);
                    while ($row2 = mysqli_fetch_assoc($results)) {
                        # code...
                    ?>
                        <div class="grid-item">
                            <div class="flex">
                                <?php
                                if (isset($row2['image'])) {
                                    echo `<img src="test.jpeg" class="user " width="75" height="75" alt="">`;
                                } else {
                                    // echo '<img src="test.jpeg" style="border:4px solid orange; border-radius:50%;"  class="user " width="75" height="75" alt="">';
                                    echo '<i class="user fas fa-user-circle"></i>';
                                }
                                ?>

                                <!-- <img src="test.jpeg" class="user " width="75" height="75" alt=""> -->
                                <!-- <i class="user fas fa-user-circle"></i> -->
                                <div class="information">
                                    <span>姓名:<?= $row2['name'] ?></span>
                                    <span>學號:<?= $row2['school_number'] ?></span>
                                    <span>簽到時間:<?= $row2['time'] ?></span>
                                    <span class="<?= $row['status'] == '辨識成功' ? 'text-success' : 'text-danger' ?>">狀態：<?= $row2['status'] ?></span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <!-- <div class="grid-item">
                        <div class="flex">
                            <i class="user fas fa-user-circle"></i>
                            <div class="information">
                                <span>姓名:郭芝玲</span>
                                <span>學號:108ac2011</span>
                                <span>簽到時間:2020/11/16 10:41:30</span>
                                <span class="text-danger">狀態：遲到</span>
                            </div>
                        </div>
                    </div>
                    <div class="grid-item">
                        <div class="flex">
                            <i class="user fas fa-user-circle"></i>
                            <div class="information">
                                <span>姓名:陳OO</span>
                                <span>學號:108ac10XX</span>
                                <span>簽到時間:2020/11/16 10:40:30</span>
                                <span class="text-warning">狀態：簽到遲到</span>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
        </nav>
        <nav class="block navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fas fa-align-left"></i>
                </button>
            </div>
        </nav>
        <!-- Content -->
        <div id="content">
            <div id="video" class="card">
                <div class="card-body">
                    <h5 class="card-title">攝影畫面</h5>
                    <p class="card-text" style="height: 500px;">
                        <!-- <img style="width: 90%; position:absolute" id="mjpeg_dest" crossorigin='anonymous' /> -->
                        <img style="width: 90%; position:absolute" id="mjpeg_dest" crossorigin='anonymous' />
                        <canvas style="position: absolute;" id="overlay">test</canvas>
                        <!-- <img id="stream" src="image.png" width="500" height="500" alt=""> -->
                    </p>
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
        </div>
        <div id="right-information">
            <h4 style="text-align: center; margin:15%; color:gray; border:1px solid black; padding:10%; border-radius:50%; background:white">線上簽到</h4>
            <div style="bottom: 0; right:0; position:absolute; margin-bottom:5%; margin-right:5%;" hidden>
                <span style="text-align: right;">全班人數:80人</span>
                <span style="text-align: right;">目前已到人數:20人</span>
            </div>
        </div>
        <div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body text-center">
                        <!-- <div class="loader"></div> -->
                        <div clas="loader-txt">
                            <div class="text-center">
                                <div class="spinner-border" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>
                            <div>
                                讀取人臉模組中...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>
<script>
    $(document).ready(function() {

        $('#sidebarCollapse').on('click', function() {
            $('#sidebar').toggleClass('active');
        });
        $(window).resize(function() {
            if ($(window).width() < 768) {
                $('#sidebar').hide();
            } else {
                $('#sidebar').show();
            }
        });

        setInterval(function() {
                $.ajax({
                    url: 'update.php',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        "rollcall_time": $('[name=rollcall_time]').val().split(' ')[0]
                    },
                    success: function(responses) {
                        $('#left_container').empty();
                        responses.forEach(function(response) {

                            let tag = `
                            <div class="grid-item">
                                <div class="flex">
                                    <i class="user fas fa-user-circle"></i>
                                    <div class="information">
                                        <span>姓名:${response.name}</span>
                                        <span>學號:${response.school_number}</span>
                                        <span>簽到時間:${response.time}</span>
                                        <span class="${response.status == '準時' ? 'text-success' : 'text-danger'}">狀態：${response.status}</span>
                                    </div>
                                </div>
                            </div>
                            `
                            $('#left_container').append(tag);
                        })
                    }
                })
            },
            5000)


        // setInterval(function() {
        //     $('#stream').attr('src', 'image.png');
        //     console.log('test')
        // }, 1000)

        //TODO: For Camera Area
    });
</script>
<script src="public/js/face-api.min.js"></script>
<script defer src="public/js/script.js"></script>

</html>