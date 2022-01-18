<?php
include("connection.php");
$sql = "select * from `rollcalls`";
$results = mysqli_query($mysqli, $sql);
$user = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
$sql2 = "SELECT * FROM `users` WHERE `id` = $user_id";
$teacher_query = mysqli_query($mysqli, $sql2);
$teacher = mysqli_fetch_array($teacher_query);
?>
<!DOCTYPE html>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>teacher_profile</title>
    <meta charset="utf-8">
    <link rel="stylesheet " href="./teacher_profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Cutive&display=swap" rel="stylesheet">


</head>

<body>
    <div class="row">
        <div class="col">
            <img onclick="location.href='backend.php'" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC0AAAAtCAYAAAA6GuKaAAAAAXNSR0IArs4c6QAAAQtJREFUaEPt19ENwjAMBNDrBqzABLARsBlMAiMwAiN0BGSp+YmUqo7PbiO533H6ek2dZsKA1zSgGYmOemuZdCa9kkAuj1weuTz0a+AEYNaXtSu8P0QBvwF8ATxYcE90AV8X7JMF90LX4BKypC140+WBboFfAO4m7VLMRruDxc1Eh4CZ6DAwCx0KZqDDwVb0LmArWvrtrWphPwBnRltbm8PSPSTpD4BLdQPazteCW9Ay5y5wK3oXOAMdDmehQ+FMdBicjQ6Be6DX4If9ny7ttW6Hh/2frveDApczIuUAYN3Gt+7Ww53Gtz6YapzXh6hCaAcnWptY7/hMujc5bV0mrU2sd3wm3Zuctm7IpP/vyiwuzvoH7AAAAABJRU5ErkJggg==" class="logo">
            <h1>個人頁面</h1>
            <p>NTUT Roll call system teacher profile</p>


        </div>

        <div class="profile">

            <form class="picture" enctype="multipart/form-data" action="teacher_upload.php" method="POST">
                <img id="blah" style="width: 300px; height:300px;" src="uploads/<?= $teacher['image_name'] ?>" width="300" height="300" alt="your image" />
                <input type="hidden" name="id" value="<?= $user_id ?>">
                <input accept="image/*" name="fileToUpload" type="file" id="fileToUpload" />
                <label for="name">老師姓名：</label>
                <input type="text" name="name" value="<?= $teacher['name'] ?>" placeholder="Your name..">
                <input type="submit" id="botton" onclick="setBottom()" value="save" />
            </form>

        </div>

    </div>

    <script>
        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }
    </script>


</body>

</html>