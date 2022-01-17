<?php
include("connection.php");
$sql = "SELECT * FROM `rollcalls`";
$results = mysqli_query($mysqli, $sql);
?>
<!DOCTYPE html>

<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Maneger</title>
<meta charset="utf-8">

<!-- Jquery and Popper Bootstrap js -->
<script src="js/jquery.js"></script>
<!-- <script src="js/popper.js"></script> -->
<link rel="stylesheet " href="./rollcall_control.css">
<link href="https://fonts.googleapis.com/css2?family=Cutive&display=swap" rel="stylesheet">


</head>

<body>

    <div class="row">
        <div class="col">
            <img onclick="history.back()" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC0AAAAtCAYAAAA6GuKaAAAAAXNSR0IArs4c6QAAAQtJREFUaEPt19ENwjAMBNDrBqzABLARsBlMAiMwAiN0BGSp+YmUqo7PbiO533H6ek2dZsKA1zSgGYmOemuZdCa9kkAuj1weuTz0a+AEYNaXtSu8P0QBvwF8ATxYcE90AV8X7JMF90LX4BKypC140+WBboFfAO4m7VLMRruDxc1Eh4CZ6DAwCx0KZqDDwVb0LmArWvrtrWphPwBnRltbm8PSPSTpD4BLdQPazteCW9Ay5y5wK3oXOAMdDmehQ+FMdBicjQ6Be6DX4If9ny7ttW6Hh/2frveDApczIuUAYN3Gt+7Ww53Gtz6YapzXh6hCaAcnWptY7/hMujc5bV0mrU2sd3wm3Zuctm7IpP/vyiwuzvoH7AAAAABJRU5ErkJggg==" class="logo">
            <h1>點名單管理</h1>
            <p>NTUT Roll call system manerger</p>
            <div style="display: flex;">
                <div style="margin-top:27px;">
                    選擇課程：
                </div>
                <div>
                    <select name="" id="">
                        <option value="">Coding</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="container">
                <?php
                while ($row = mysqli_fetch_array($results)) {
                ?>
                    <div class="data-row">
                        <div onclick="location.href='rollcall_list.php?id=<?= $row['id'] ?>'" class="card">
                            <h2><?= $row['date'] ?></h2>
                            <h2><?= $row['class_name'] ?></h2>
                            <h2><?= $orw['class_name'] ?></h2>
                            <p>點名時間：<?= $row['time'] ?><br>遲到時間：<?= $row['delay'] ?>分鐘</p>


                        </div>
                        <div onclick="deleteItem(<?= $row['id'] ?>)" value="刪除" class="trash">
                            <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC0AAAAtCAYAAAA6GuKaAAAAAXNSR0IArs4c6QAAAYBJREFUaEPtmeFRwzAMhb9OACOwATABMAkwAWwAbAATAJMAEwAbMEKZAO5xzZ2bOJHtum57SHf5FVt5eXqWZXnGDtpsBzHzb0HvA4cZEfsE5hnjB0NrMP0CnGaAeAXOMsZXB30PXBUAeACuC+b9TVmF6QvgsfTDwCXwVDJ/DPQBcG44FFPSc6lJ14rUlL0BktOSjYGWRqXVTdsdcOugG4Qhi2lp9agBKOsTX4CeJE1bzjb6PjXlKb1Z2aTGj2i3NPN3Kmit4JsaqBJSnLm7OugKkdBm4kzHNC1mOrNK1H5JehKJTBOmwzVhbf0qR8M64sdBRxgYS3nONOCadnks1oxnj9hu7PJweUxUaS4Pl4fLY8jA1pSm4dFIfZKp3pxO2R/Bvwx6dK0KpgrHwiUXTaq82qCfAfVYJm3bWgjR3l1pW0x6fbcYqPD+uKf7qMtUpjVZYdNC26sAru/ie9EOS7oZyAHdfUisr3ID0AesG4Ewq5iclIA2na57gINeN8Od/19m6IUu1S6g2QAAAABJRU5ErkJggg==" />
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>

        </div>
    </div>
    </div>





</body>
<script>
    function deleteItem(id) {
        if (confirm("確認是否刪除")) {
            $.ajax({
                url: 'delete_rollcall.php',
                data: {
                    "id": id,
                },
                success: function(response) {
                    location.reload()
                }
            })
        }
    }
</script>

</html>