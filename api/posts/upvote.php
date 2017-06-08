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

if (isset($_POST['user_id']) && isset($_POST['post_id'])) {
    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];
    echo upvotePost($user_id, $post_id);
}