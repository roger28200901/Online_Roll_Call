<?php
$name = $_GET['name'];
$dir = 'public/labeled_images/' . $name;
// rmdir($dir);
// delTree($dir);
deleteDirectory($dir);
header("Location:insert_student_image.php");

function deleteDirectory($dir)
{
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }
    }

    return rmdir($dir);
}

// function delTree($dir)
// {
//     $files = array_diff(scandir($dir), array('.', '..'));
//     foreach ($files as $file) {
//         (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file");
//     }
//     return rmdir($dir);
// }
