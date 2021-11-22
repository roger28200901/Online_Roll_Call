<?php
$dir    = 'public/labeled_images/';
$files = scandir($dir);
$response = array();
if ($handle = opendir($dir)) {
    $tempArray = array();

    while (false !== ($entry = readdir($handle))) {
        if ($entry != "." && $entry != ".." && $entry != '.DS_Store') {
            $tempArray["name"] = $entry;
            array_push($response, $tempArray);
        }
    }
    // array_push($response, $tempArray);
}
echo json_encode($response, JSON_UNESCAPED_UNICODE);
