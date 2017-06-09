<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 2/06/17
 * Time: 11:43 PM
 */

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Token, token, TOKEN');
header('Content-Type: application/x-www-form-urlencoded');

require '../users_functions.php';

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstname'])
    && isset($_POST['lastname']) && isset($_POST['image'])
) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $image = $_POST['image'];

    echo register($username, $password, $firstname, $lastname, $image);
}