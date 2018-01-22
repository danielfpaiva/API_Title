<?php
include_once ('api.php');

$keywords = $_POST['keywords'];
$file = $_FILES["file"]["name"];

if ($file){
    $fileName = basename( $_FILES['file']['name']);
    $fileDest = "files/".$fileName;
    (move_uploaded_file($_FILES['file']['tmp_name'], $fileDest));

    if (file_exists($fileDest)) {
        echo funStartAPI($fileDest, $keywords);
    } else{
        die("Occurred an error moving the file.");
    }
} else {
    die("The file was not selected.");
}