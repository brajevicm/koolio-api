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
        $query = 'SELECT EXISTS (SELECT * FROM ' . DB_TABLE_USERS . ' WHERE token=?)';
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
    if (checkLogin($username, $password)) {
        $id = sha1(uniqid());
        $hashedPassword = md5($password);
        $query = 'UPDATE ' . DB_TABLE_USERS . ' SET token=? WHERE username=?';
        $result = $conn->prepare($query);
        $result->bind_param('ss', $id, $hashedPassword);
        $result->execute();
        $message['token'] = $id;
    } else {
        header('HTTP/1.1 404 Unauthorized');
        $message['error'] = 'Invalid username/password';
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
    $hashedPassword = md5($password);
    $query = 'SELECT EXISTS (SELECT * FROM ' . DB_TABLE_USERS . ' WHERE username=? AND password=?)';
    $result = $conn->prepare($query);
    $result->bind_param("ss", $username, $hashedPassword);
    $result->execute();
    $result->store_result();
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
    $result = $conn->prepare($query);
    $result->bind_param('s', $username);
    $result->execute();
    $result->store_result();
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
function register($username, $password, $firstname, $lastname)
{
    global $conn;
    $message = array();
    $errors = '';
    if (checkIfUserExists($username)) {
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
    if ($errors === '') {
        $query = 'INSERT INTO ' . DB_TABLE_USERS . ' (username, password, firstname, lastname) VALUES (?, ?, ?, ?)';
        $statement = $conn->prepare($query);
        $hashedPassword = md5($password);
        $statement->bind_param('ssss', $username, $hashedPassword, $firstname, $lastname);
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