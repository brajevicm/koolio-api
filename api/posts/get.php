<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 31/05/17
 * Time: 11:48 PM
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Token, token, TOKEN');

require '../posts_functions.php';

if (isset($_SERVER['HTTP_TOKEN'])) {
    $token = $_SERVER['HTTP_TOKEN'];
    echo getFilteredPostsForUser($token);
} else {
    echo getFilteredPosts();
}
