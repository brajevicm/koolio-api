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

require '../comments_functions.php';

if (isset($_SERVER['HTTP_TOKEN']) && isset($_POST['comment_id'])) {
    $comment_id = $_POST['comment_id'];
    echo removeComment($comment_id);
}