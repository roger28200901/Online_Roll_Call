<?php
 include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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

</head>
<style>
    @import url(//fonts.googleapis.com/earlyaccess/tharlon.css);

    * {
        font-family: 'Tharlon', sans-serif !important;
        font-size: 16px;
        background: #f3f3f3;
    }

    #welcome {
        position: absolute;
        left: 25%;
        top: 30%;
    }

    #login_container {
        position: absolute;
        left: 53%;
        top: 45%;
        background: #f3f3f3;
        height: 300px;
    }

    #login {
        position: relative;
        left: 10%;
        top: 10%;
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

    #login_form {
        left: 0;
        margin-top: 10%;
    }

    #login_form>div {
        margin-left: 5%;
    }

    #login_input {
        padding-left: 5%;
    }

    #login_input>div {
        margin-top: 5%;
    }

    #forget {
        position: absolute;
        bottom: 0;
        margin: 5%;
        left: 0%;
    }

    input[type=password],
    input[type=text] {
        background: #c4c4cc;
        border: none;
        border-radius: 5px;
        height: 20px;
    }

    #enter {
        /* BBB9B9 */
        background: #f3f3f3;
        border: 1px solid #bbb9b9;
        border-radius: 5px;
        box-shadow: 1px 1px 1px 1px #bbb9b9;
    }

    #circle {
        position: absolute;
        right: 5%;
        top: 5%;
    }

    #ntut {
        position: absolute;
        left: 5%;
        top: 5%;
    }

    #roll {
        position: absolute;
        left: 5%;
        top: 10%;
    }
</style>

<body>
    <div id="wrapper">
        <img id="ntut" src="images/NTUT.png" alt="">
        <img id="roll" src="images/roll.png" alt="">
        <img id="circle" src="images/circle.png" alt="">
        <img id="welcome" src="images/WELOME NTUT.png" alt="">
        <div id="login_container" style="border:3px solid #98FFA2; border-radius:2%; width:500px">
            <img id="login" src="images/login.png" alt="">
            <form action="check.php" method="POST">
                <div id="login_form" class="flex veritcal-center">
                    <div id="login_input">
                        <div class="flex horizontal-between vertical-center">
                            <label for="">Account： </label>
                            <input type="text" name="account">
                        </div>
                        <div class="flex horizontal-between vertical-center">
                            <label for="">Password： </label>
                            <input type="password" name="password">
                        </div>
                    </div>
                    <div class="flex vertical-center">
                        <input type="submit" id="enter" value="ENTER">
                    </div>

            </form>
            <a id="forget" href="">Forget password</a>
        </div>



    </div>

</body>

</html>
