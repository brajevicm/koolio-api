<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 6/06/17
 * Time: 1:59 AM
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Token, token, TOKEN');

require '../posts_functions.php';

if (isset($_SERVER['HTTP_TOKEN'])) {
    $token = $_SERVER['HTTP_TOKEN'];
    echo getPostsFromUser($token);
}
