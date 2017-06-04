<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 4/06/17
 * Time: 6:28 PM
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Token, token, TOKEN');

require '../posts_functions.php';

if (isset($_POST['user_id']) && isset($_POST['title']) && isset($_POST['image'])) {
    $user_id = $_POST['user_id'];
    $title = $_POST['title'];
    $image = $_POST['image'];
    echo addPost($user_id, $title, $image);
}