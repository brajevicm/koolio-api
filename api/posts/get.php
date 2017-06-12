<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 31/05/17
 * Time: 11:48 PM
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Token, token, TOKEN');

require '../posts_functions.php';

if (isset($_POST['offset']) && isset($_SERVER['HTTP_TOKEN'])) {
    $offset = $_POST['offset'];
    $token = $_SERVER['HTTP_TOKEN'];
    echo getFilteredPostsForUserLimit($token, $offset);
} elseif (isset($_POST['offset'])) {
    $offset = $_POST['offset'];
    echo getFilteredPostsLimit($offset);
} elseif (isset($_POST['post_id']) && isset($_SERVER['HTTP_TOKEN'])) {
    $token = $_SERVER['HTTP_TOKEN'];
    $offset = $_POST['offset'];
    $post_id = $_POST['post_id'];
    echo getPostForUser($token, $post_id);
} elseif (isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    echo getPost($post_id);
}
