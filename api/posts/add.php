<?php

header("Access-Control-Allow-Origin: *");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(array('status' => false));
    exit;
}

$path = 'uploads/';

if (isset($_FILES['file'])) {
    $originalName = $_FILES['file']['name'];
    $ext = '.' . pathinfo($originalName, PATHINFO_EXTENSION);
    $generatedName = md5($_FILES['file']['tmp_name']) . $ext;
    $filePath = $path . $generatedName;

    if (!is_writable($path)) {
        echo json_encode(array(
            'status' => false,
            'msg' => 'Destination directory not writable.'
        ));
        exit;
    }

    if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
        echo json_encode(array(
            'status' => true,
            'originalName' => $originalName,
            'generatedName' => $generatedName
        ));
    }
} else {
    echo json_encode(
        array('status' => false, 'msg' => 'No file uploaded.')
    );
    exit;
}

?>
///**
// * Created by PhpStorm.
// * User: brajevicm
// * Date: 4/06/17
// * Time: 6:28 PM
// */
//
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: POST');
//header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Token, token, TOKEN');
//
//require '../posts_functions.php';
//
//if (isset($_SERVER['HTTP_TOKEN']) && isset($_POST['title']) && isset($_POST['image'])) {
//    $token = $_SERVER['HTTP_TOKEN'];
//    $title = $_POST['title'];
//    $image = $_POST['image'];
//    echo addPost($token, $title, $image);
//}