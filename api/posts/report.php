<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 10/06/17
 * Time: 7:35 PM
 */

require '../posts_functions.php';

if (isset($_SEVER['HTTP_TOKEN']) && isset($_POST['post_id'])) {
    $token = $_SERVER['HTTP_TOKEN'];
    $post_id = $_POST['post_id'];
    echo reportPost($token, $post_id);
}