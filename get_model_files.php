<?php
$dir    = 'public/labeled_images/';
$files = scandir($dir);
$response = array();
if ($handle = opendir($dir)) {

    while (false !== ($entry = readdir($handle))) {
        $tempArray = array();

        if ($entry != "." && $entry != ".." && $entry != '.DS_Store') {
            $handle2 = opendir($dir . '/' . $entry . '/');
            // echo $entry . 'ss';
            $tempArray["name"] = $entry;
            $tempArray["images"] = [];
            while (false !== ($entry2 = readdir($handle2))) {
                if ($entry2 != "." && $entry2 != ".." && $entry2 != '.DS_Store') {
                    // echo $entry . "/" . $entry2 . "<br>";
                    array_push($tempArray["images"], $entry2);
                }
            }
        }
        array_push($response, $tempArray);
    }
}
$tempArray2 = [];
foreach ($response as $index => $item) {

    if (count($item) != 0) {
        array_push($tempArray2, $item);
    }
}
$response = array();
foreach ($tempArray2 as $item) {
    array_push($response, $item);
}
// var_dump($response);
echo json_encode($response, JSON_UNESCAPED_UNICODE);
