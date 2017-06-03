<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 1/06/17
 * Time: 2:56 PM
 */

include_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    die();
}

/**
 * Finished
 * @return bool
 */
function checkIfLoggedIn()
{
    global $conn;
    if (isset($_SERVER['HTTP_TOKEN'])) {
        $token = $_SERVER['HTTP_TOKEN'];
        $query = 'SELECT EXISTS (SELECT * FROM ' . DB_TABLE_USERS . ' WHERE token=? AND flag_id = 1)';
        $result = $conn->prepare($query);
        $result->bind_param('s', $token);
        $result->execute();
        $result->store_result();
        if ($result == 1) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

/**
 * Finished
 * @param $username
 * @param $password
 * @return string
 */
function login($username, $password)
{
    global $conn;
    $message = array();
    $password = trim($password);
    $hashedPassword = md5($password);
    if (checkLogin($username, $hashedPassword)) {
        $id = sha1(uniqid());
        $query = 'UPDATE ' . DB_TABLE_USERS . ' SET token=? WHERE username=?';
        $result = $conn->prepare($query);
        $result->bind_param('s', $id);
        $result->execute();
        $message['token'] = $id;
    } else {
        header('HTTP/1.1 404 Unauthorized');
        $message = 'Invalid username or password';
    }
    return json_encode($message);
}

/**
 * Finished
 * @param $username
 * @param $password
 * @return bool
 */
function checkLogin($username, $password)
{
    global $conn;
    $query = 'SELECT EXISTS (SELECT * FROM ' . DB_TABLE_USERS . ' WHERE username=? AND password=? AND flag_id = 1)';
    $statement = $conn->prepare($query);
    $statement->bind_param("ss", $username, $password);
    $statement->execute();
    $result = $statement->get_result()->fetch_row()[0];
    if ($result == 1) {
        return true;
    } else {
        return false;
    }
}

/**
 * Finished
 * @param $username
 * @return bool
 */
function checkIfUserExists($username)
{
    global $conn;
    $query = 'SELECT EXISTS (SELECT * FROM ' . DB_TABLE_USERS . ' WHERE username=?)';
    $statement = $conn->prepare($query);
    $statement->bind_param("s", $username);
    $statement->execute();
    $result = $statement->get_result()->fetch_row()[0];
    if ($result == 1) {
        return true;
    } else {
        return false;
    }
}

/**
 * Finished
 * @param $username
 * @param $password
 * @param $firstname
 * @param $lastname
 * @return string
 */
function register($username, $password, $firstname, $lastname, $image)
{
    global $conn;
    $message = array();
    $errors = '';
    if (!checkIfUserExists($username)) {
        $errors .= 'Username already exists.';
    }
    if (strlen($username) < 3) {
        $errors .= 'Username must have at least 3 characters.';
    }
    if (strlen($password) < 8) {
        $errors .= 'Password must have at least 8 characters.';
    }
    if (strlen($firstname) < 2) {
        $errors .= 'First name must have at least 3 characters.';
    }
    if (strlen($lastname) < 2) {
        $errors .= 'Last name must have at least 3 characters.';
    }
    if ($errors == '') {
        $query = 'INSERT INTO ' . DB_TABLE_USERS . ' (username, password, firstname, lastname, flag_id, role_id, image) 
            VALUES (?, ?, ?, ?, ?, ?, ?)';
        $statement = $conn->prepare($query);
        $password = trim($password);
        $hashedPassword = md5($password);
        $flag_id = 1;
        $role_id = 1;
        $statement->bind_param('ssssiis', $username, $hashedPassword, $firstname, $lastname, $flag_id, $role_id, $image);
        if ($statement->execute()) {
            $id = sha1(uniqid());
            $query2 = 'UPDATE ' . DB_TABLE_USERS . ' SET token=? WHERE username=?';
            $result = $conn->prepare($query2);
            $result->bind_param('ss', $id, $username);
            $result->execute();
            $message['token'] = $id;
        } else {
            header('HTTP/1.1 400 Bad Request');
            $message['error'] = 'Database connection error.';
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        $message['error'] = json_encode($errors);
    }
    return json_encode($message);
}