<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 10/06/17
 * Time: 7:37 PM
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Token, token, TOKEN');

require '../comments_functions.php';

if (isset($_SERVER['HTTP_TOKEN']) && isset($_POST['comment_id'])) {
    $token = $_SERVER['HTTP_TOKEN'];
    $comment_id = $_POST['comment_id'];
    echo reportComment($token, $comment_id);
}