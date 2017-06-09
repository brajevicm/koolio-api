<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 31/05/17
 * Time: 11:52 PM
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Token, token, TOKEN');

require '../comments_functions.php';

if (isset($_SERVER['HTTP_TOKEN']) && isset($_POST['post_id'])) {
    $token = $_SERVER['HTTP_TOKEN'];
    $post_id = $_POST['post_id'];
    echo getFilteredCommentsForUser($token, $post_id);
} else if (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    echo getFilteredComments($post_id);
}