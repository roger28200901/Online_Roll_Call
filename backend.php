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
        overflow: auto;
        color: #98FFA2;
        padding-left: 5%;
        font-weight: 100;
    }

    .arrow {
        position: relative;
        left: 70%;
        top: 30%;
    }
</style>

<body>
    <img src="images/hello.png" id="hello" alt="">
    <div>
        <img src="images/ADD.png" id="btn_add" alt="">
        <img src="images/NEW CHECKROLL.png" id="new_checkroll" alt="">
    </div>
    <div id="wrapper">
        <div class="order_card">
            <h1 class="day">2021/11/21</h1>
            <img class="arrow" src="images/Arrow 1.png" alt="">
        </div>
        <div class="order_card">
            <h1 class="day">2021/11/21</h1>
            <img class="arrow" src="images/Arrow 1.png" alt="">
        </div>
        <div class="order_card">
            <h1 class="day">2021/11/21</h1>
            <img class="arrow" src="images/Arrow 1.png" alt="">
        </div>
        <div class="order_card">
            <h1 class="day">2021/11/21</h1>
            <img class="arrow" src="images/Arrow 1.png" alt="">
        </div>
        <div class="order_card">
            <h1 class="day">2021/11/21</h1>
            <img class="arrow" src="images/Arrow 1.png" alt="">
        </div>
        <div class="order_card">
            <h1 class="day">2021/11/21</h1>
            <img class="arrow" src="images/Arrow 1.png" alt="">
        </div>
        <div class="order_card">
            <h1 class="day">2021/11/21</h1>
            <img class="arrow" src="images/Arrow 1.png" alt="">
        </div>
        <div class="order_card">
            <h1 class="day">2021/11/21</h1>
            <img class="arrow" src="images/Arrow 1.png" alt="">
        </div>
        <div class="order_card">
            <h1 class="day">2021/11/21</h1>
            <img class="arrow" src="images/Arrow 1.png" alt="">
        </div>

    </div>
</body>

</html>