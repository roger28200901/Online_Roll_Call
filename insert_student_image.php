<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>新增學生圖片</title>
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
        <h1>
            新增學生圖片庫
        </h1>
        <input type="button" value="回到後台頁面" class="btn btn-danger" onclick="location.href='backend.php'">
        <hr>
        <form method="POST" enctype="multipart/form-data" action="upload_images.php">
            <div class="form-group">
                <p>
                    <small>命名檔案請依照1.jpeg / 2.jpeg做為範例</small>
                </p>
                <label for="exampleFormControlFile1">選擇圖片</label>

                <input type="file" multiple="multiple" class="form-control-file" name="uploads[]">
                <br>
                <input type="text" name="name" class="form-control" placeholder="學生姓名">
                <br>

                <input type="submit" value="新增" class="btn btn-success">
            </div>
        </form>
        <hr>
        <h1>
            已紀錄的學生模組
        </h1>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>#</th>
                    <th>名字</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $dir    = 'public/labeled_images/';
                $files = scandir($dir);
                if ($handle = opendir($dir)) {

                    while (false !== ($entry = readdir($handle))) {

                        if ($entry != "." && $entry != ".." && $entry != '.DS_Store') {
                ?>
                            <tr>
                                <td>#</td>
                                <td><?= $entry ?></td>
                                <td>
                                    <input class="btn btn-danger" type="button" value="刪除模組" onclick="location.href='remove_images.php?name=<?= $entry ?>'">
                                </td>
                            </tr>
                <?php
                        }
                    }

                    closedir($handle);
                }
                ?>
            </tbody>
        </table>

    </center>

</body>

</html>