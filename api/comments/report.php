<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 10/06/17
 * Time: 7:37 PM
 */

require '../comments_functions.php';

if (isset($_SEVER['HTTP_TOKEN']) && isset($_POST['comment_id'])) {
    $token = $_SERVER['HTTP_TOKEN'];
    $comment_id = $_POST['comment_id'];
    echo reportComment($token, $comment_id);
}