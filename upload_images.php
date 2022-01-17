<?php
# 取得上傳檔案數量
$fileCount = count($_FILES['uploads']['name']);
$name = $_POST['name'];
for ($i = 0; $i < $fileCount; $i++) {
    # 檢查檔案是否上傳成功
    if ($_FILES['uploads']['error'][$i] === UPLOAD_ERR_OK) {
        // echo '檔案名稱: ' . $_FILES['uploads']['name'][$i] . '<br/>';
        // echo '檔案類型: ' . $_FILES['uploads']['type'][$i] . '<br/>';
        // echo '檔案大小: ' . ($_FILES['uploads']['size'][$i] / 1024) . ' KB<br/>';
        // echo '暫存名稱: ' . $_FILES['uploads']['tmp_name'][$i] . '<br/>';

        # 檢查檔案是否已經存在
        if (!is_dir('public/labeled_images/' . $name)) {
            mkdir('public/labeled_images/' . $name, 0777);
            // echo "Create Folder";
        }

        if (file_exists('public/labeled_images/' . $name . '/' . $_FILES['uploads']['name'][$i])) {
            // echo '檔案已存在。<br/>';
        } else {
            $file = $_FILES['uploads']['tmp_name'][$i];
            $dest = 'public/labeled_images/' . $name . '/' . $_FILES['uploads']['name'][$i];
            // echo $dest;
            # 將檔案移至指定位置
            move_uploaded_file($file, $dest);
        }
    } else {
        // echo '錯誤代碼：' . $_FILES['uploads']['error'] . '<br/>';
    }
}
return header("Location:insert_student_image.php");
