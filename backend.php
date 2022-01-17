<?php
include("connection.php");
$sql = "select * from `rollcalls`";
$results = mysqli_query($mysqli, $sql);

?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Menu</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CARDS</title>
    <!-- Font Awesome js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>

    <!-- Our project just needs Font Awesome solid + brand -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Jquery and Popper Bootstrap js -->
    <script src="js/jquery.js"></script>
    <!-- <script src="js/popper.js"></script> -->
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet " href="./backend.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
</head>


<body>

    <div id="add_modal" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">新增點名單</h5>

                </div>
                <form action="rollcall_insert.php" method="POST">
                    <div class="modal-body">
                        <p>
                            <label for="">班級名稱:</label>
                            <input type="text" name="class_name">
                        </p>
                        <p>
                            <label for="">日期:</label>
                            <input type="date" name="date">
                        </p>
                        <p>
                            <label for="">時間設定:</label>
                        </p>
                        <p>
                            <input type="text" name="time" placeholder="點名時間 （範例：13:10）">
                            <input type="text" name="delay" placeholder="遲到時間 （範例:15） (分鐘)">
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="close_modal" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" data-dismiss="modal">Create</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="flex">
        <div class="sidebar">
            <div class="logo_content">
                <div class="logo">
                    <div class="logo_name">NTUT Roll call system</div>
                </div>
                <i class='bx bx-menu bx-sm' id="btn"></i>
            </div>
            <ul class="nav_list">

                <li>
                    <a href="#">
                        <i class='bx bx-search'></i>
                        <input type="text" placeholder="search...">
                </li>

                <li>
                    <a href="#">
                        <i class='bx bx-user-pin bx-flip-horizontal bx-tada bx-sm'></i>
                        <span class="link_name">個人頁面</span>
                    </a>
                    <span class="tooltip">個人頁面</span>

                </li>

                <li>
                    <a href="#">
                        <i class='bx bxs-chat bx-tada bx-sm'></i>
                        <span class="link_name">通訊</span>
                    </a>
                    <span class="tooltip">通訊</span>
                </li>

                <li>
                    <a href="rollcall_control.php">
                        <i class='bx bxs-cog bx-tada bx-sm'></i>
                        <span class="link_name">點名單管理</span>
                    </a>
                    <span class="tooltip">點名單管理</span>
                </li>

                <li>
                    <a href="logout.php">
                        <i class='bx bx-log-out-circle bx-tada bx-sm'></i>
                        <span class="link_name">登出</span>
                    </a>
                    <span class="tooltip">登出</span>
                </li>


            </ul>

            <!-- <div class="home_content">
                <div class="text">HOME!!!!!!</div>
            </div> -->


        </div>
        <select style="z-index: 99999; left:55%; position:absolute;" name="" id="">
            <option value="">course</option>
        </select>
        <div class="container scrollbar">

            <?php
            while ($row = mysqli_fetch_array($results)) {
            ?>

                <div class="card order_card" rollcall-id="<?= $row['id'] ?>">
                    <div class="box">
                        <div class="content">
                            <h2><?= $row['date']; ?></h2>
                            <h2><?= $row['class_name'] ?></h2>
                            <a href="#">GO</a>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <div class="menu">
        <div class="toggle">
            <ion-icon name="add-outline"></ion-icon>
        </div>

        <li class="tooltip-cus" style="--i:0;">
            <a href="insert_student_image.php">
                <ion-icon name="person-add-outline"></ion-icon>
            </a>
            <span class="tooltiptext">新增人臉辨識庫</span>
        </li>

        <li class="tooltip-cus" style="--i:1;">
            <a id="btn_add" href="#">
                <ion-icon name="clipboard-outline"></ion-icon>
            </a>
            <span class="tooltiptext">新增點名單</span>
        </li>
    </div>

    <script src="js/jquery.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


    <script>
        let btn = document.querySelector("#btn");
        let sidebar = document.querySelector(".sidebar");
        let searchBtn = document.querySelector(".bx-search");
        let container = document.querySelector(".container");

        btn.onclick = function() {
            sidebar.classList.toggle('active');
            container.classList.toggle('active');
        }
        searchBtn.onclick = function() {
            sidebar.onclick.toggle('active');
        }




        let toggle = document.querySelector('.toggle');
        let menu = document.querySelector('.menu');
        toggle.onclick = function() {
            menu.classList.toggle('active')
        }



        $(document).ready(function() {
            $('.container').on('wheel', function(ev) {
                let y = parseInt(ev.originalEvent.deltaY);
                console.log(y)
                if (y)
                    this.scrollLeft += y;
                console.log(y, this.scrollLeft);
            });

            $('#btn_add').on('click', function() {
                $('#add_modal').modal('show');
            })

            $('.order_card').on('click', function() {
                let id = $(this).attr('rollcall-id');
                location.href = 'index.php?id=' + id
            })
            $('#close_modal').on('click', function() {
                $('#add_modal').modal('hide');
            })
        })
    </script>
</body>

</html>