<?php
include('connection.php');
$sql = "SELECT * FROM `users`";
$results = mysqli_query($mysqli, $sql);
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
    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h1 style="letter-spacing: 3px; color:white">簽到狀態</h1>

                <h3 style="letter-spacing: 3px; color:white"> 班級 ｜ 互動三</h3>
            </div>

            <div class="container">
                <div class="grid-wrapper">
                    <?php
                    while ($row = mysqli_fetch_assoc($results)) {
                        # code...
                    ?>
                        <div class="grid-item">
                            <div class="flex">
                                <?php
                                if (isset($row['image'])) {
                                    echo `<img src="test.jpeg" class="user " width="75" height="75" alt="">`;
                                } else {
                                    echo '<img src="test.jpeg" style="border:4px solid orange; border-radius:50%;"  class="user " width="75" height="75" alt="">';
                                    // echo '<i style="border:2px solid green; border-radius:50%;" class="user fas fa-user-circle"></i>';
                                }
                                ?>

                                <!-- <img src="test.jpeg" class="user " width="75" height="75" alt=""> -->
                                <!-- <i class="user fas fa-user-circle"></i> -->
                                <div class="information">
                                    <span>姓名:<?= $row['name'] ?></span>
                                    <span>學號:<?= $row['school_number'] ?></span>
                                    <span>簽到時間:2020/11/16 10:40:30</span>
                                    <span class="text-success">狀態：簽到成功</span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="grid-item">
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
                    </div>
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
                        <img id="mjpeg_dest" />
                        <!-- <img id="stream" src="image.png" width="500" height="500" alt=""> -->
                    </p>
                    <small class="text-muted">Last updated 3 mins ago</small>
                </div>
            </div>
        </div>
        <div id="right-information">
            <h4 style="text-align: center; margin:15%; color:gray; border:1px solid black; padding:10%; border-radius:50%; background:white">線上簽到</h4>
            <div style="bottom: 0; right:0; position:absolute; margin-bottom:5%; margin-right:5%;">
                <span style="text-align: right;">全班人數:80人</span>
                <span style="text-align: right;">目前已到人數:20人</span>
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
                    success: function(response) {
                        console.log(response)
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

</html>