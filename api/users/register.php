<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 2/06/17
 * Time: 11:43 PM
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Token, token, TOKEN');

require '../users_functions.php';

$path = 'uploads/';
$fullPath = 'http://127.0.0.1:80/koolio-api/api/users/uploads/';

if (isset($_FILES['file']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstname'])
    && isset($_POST['lastname'])
) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $originalName = $_FILES['file']['name'];
    $ext = '.' . pathinfo($originalName, PATHINFO_EXTENSION);
    $generatedName = md5($_FILES['file']['tmp_name']) . $ext;
    $filePath = $path . $generatedName;
    $fullPath = $fullPath . $generatedName;

    if (!is_writable($path)) {
        echo json_encode(array(
            'status' => false,
            'msg' => 'Destination directory not writable.'
        ));
        exit;
    }

    if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
        echo register($username, $password, $firstname, $lastname, $fullPath);
//        echo json_encode(array(
//            'status' => true,
//            'originalName' => $originalName,
//            'generatedName' => $generatedName
//        ));
    }
}