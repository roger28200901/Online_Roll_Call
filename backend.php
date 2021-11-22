<?php
include("connection.php");
$sql = "select * from `rollcalls`";
$results = mysqli_query($mysqli, $sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>後台管理</title>
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
<style>
    @import url(//fonts.googleapis.com/earlyaccess/tharlon.css);

    * {
        font-family: 'Tharlon', sans-serif !important;
        font-size: 16px;
        background: #f3f3f3;
    }

    #hello {
        position: absolute;
        margin: 1%;
    }

    #btn_add {
        position: absolute;
        top: 20%;
        left: 5%;
        cursor: pointer;
        transition: transform .2s;
    }

    #btn_add:hover {
        transform: scale(1.2);
    }

    #new_checkroll {
        position: absolute;
        top: 40%;
        left: 9%;
    }

    #wrapper {
        position: absolute;
        left: 30%;
        width: 1000px;
        height: 100vh;
        overflow-y: scroll;
        background: white;
    }

    .flex {
        display: flex;
    }

    .horizontal-center {
        justify-content: center;

    }

    .horizontal-between {
        justify-content: space-between;
    }

    .vertical-center {
        align-items: center;
    }

    #wrapper {
        display: flex;
        flex-wrap: wrap;
    }

    .order_card {
        width: 350px;
        height: 400px;
        background: #f3f3f3;
        border: 1px solid black;
        margin: 5%;
        transition: transform .2s;
        cursor: pointer;
    }

    .order_card:hover {
        transform: scale(1.2);
        /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }

    .day {
        font-size: 36pt;
        color: #98FFA2;
        padding-left: 5%;
        font-weight: 100;

    }

    .arrow {
        position: relative;
        left: 70%;
        top: 30%;
    }


    input[type=text],
    input[type=date] {
        background: #c4c4cc;
        border: none;
        border-radius: 5px;
        height: 20px;
    }
</style>

<body>
    <img src="images/hello.png" id="hello" alt="">
    <div>
        <img src="images/ADD.png" id="btn_add" alt="">
        <img src="images/NEW CHECKROLL.png" id="new_checkroll" alt="">
        <input type="button" value="點名單管理" class="btn btn-primary" style="position: absolute; left:3%; top:50%">
        <input type="button" value="新增學生辨識" onclick="location.href='insert_student_image.php'" class="btn btn-success" style="position: absolute; left:15%; top:50%">
    </div>
    <div id="wrapper">

        <?php
        while ($row = mysqli_fetch_array($results)) {
        ?>
            <div class="order_card" rollcall-id="<?= $row['id'] ?>">
                <h1 class="day"><?= $row['date']; ?></h1>
                <h2 class="day"><?= $row['class_name'] ?></h2>
                <img class="arrow" src="images/Arrow 1.png" alt="">
            </div>
        <?php
        }
        ?>

    </div>
    <!-- Modal -->
    <!-- Modal -->
    <div id="add_modal" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">新增點名單</h5>

                </div>
                <form action="rollcall_insert.php" method="POST">
                    <div class="modal-body">
                        <p>
                            <label for="">Class:</label>
                            <input type="text" name="class_name">
                        </p>
                        <p>
                            <label for="">Date:</label>
                            <input type="date" name="date">
                        </p>
                        <p>
                            <label for="">Time Setting:</label>
                        </p>
                        <p>
                            <input type="text" name="time" placeholder="roll call time ex: 13:10">
                            <input type="text" name="delay" placeholder="late time ex: 15(mins)">
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
</body>
<script>
    $(document).ready(function() {
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

</html>