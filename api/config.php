<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 31/05/17
 * Time: 7:05 PM
 */
define('DB_NAME', 'koolio');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');
define('DB_TABLE_USERS', 'users');
define('DB_TABLE_COMMENTS', 'comments');
define('DB_TABLE_POSTS', 'posts');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die('Connection error: ' . $conn->connect_error);
}