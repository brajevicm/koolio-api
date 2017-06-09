<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 4/06/17
 * Time: 6:28 PM
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Token, token, TOKEN');

require '../posts_functions.php';

$path = 'uploads/';

if (isset($_FILES['file']) && isset($_SERVER['HTTP_TOKEN']) && isset($_POST['title'])) {
    $originalName = $_FILES['file']['name'];
    $ext = '.' . pathinfo($originalName, PATHINFO_EXTENSION);
    $generatedName = md5($_FILES['file']['tmp_name']) . $ext;
    $filePath = $path . $generatedName;

    $token = $_SERVER['HTTP_TOKEN'];
    $title = $_POST['title'];
    $image = $filePath;

    echo $token;
    echo $title;
    echo $image;

    addPost($token, $title, $image);

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
}