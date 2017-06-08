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

if (isset($_SERVER['HTTP_TOKEN']) && isset($_POST['title']) && isset($_POST['image'])) {
    $token = $_SERVER['HTTP_TOKEN'];
    $title = $_POST['title'];
    $image = $_POST['image'];
    echo addPost($token, $title, $image);
}