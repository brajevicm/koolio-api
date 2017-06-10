<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 31/05/17
 * Time: 7:05 PM
 */

define('DB_NAME', 'koolio');
define('DB_USER', 'root');
define('DB_PASSWORD', 'pw');
define('DB_HOST', 'localhost');
define('DB_TABLE_USERS', 'users');
define('DB_TABLE_COMMENTS', 'comments');
define('DB_TABLE_REPORTED_COMMENTS', 'reported_comments');
define('DB_TABLE_UPVOTED_COMMENTS', 'upvoted_comments');
define('DB_TABLE_POSTS', 'posts');
define('DB_TABLE_REPORTED_POSTS', 'reported_posts');
define('DB_TABLE_UPVOTED_POSTS', 'upvoted_posts');
define('DB_TABLE_FLAGS', 'flags');
define('DB_TABLE_ROLES', 'roles');

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die('Connection error: ' . $conn->connect_error);
}