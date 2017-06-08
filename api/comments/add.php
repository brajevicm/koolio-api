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

require '../comments_functions.php';

if (isset($_SERVER['HTTP_TOKEN']) && isset($_POST['post_id']) && isset($_POST['text'])) {
    $token = $_SERVER['HTTP_TOKEN'];
    $post_id = $_POST['post_id'];
    $text = $_POST['text'];
    echo addComment($token, $post_id, $text);
}