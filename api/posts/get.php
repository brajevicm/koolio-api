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
}
