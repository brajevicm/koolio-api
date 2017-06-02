<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 1/06/17
 * Time: 2:57 PM
 */

include_once 'shared_functions.php';

/**
 * Finished.
 * @return string
 */
function getAllUsers()
{
    global $conn;
    $message = array();
    $query = 'SELECT ' . DB_TABLE_USERS . '.id, username, password, firstname, lastname, 
        (SELECT name FROM ' . DB_TABLE_FLAGS . ' WHERE id = ' . DB_TABLE_USERS . '.flag_id) AS flag, 
        (SELECT name FROM ' . DB_TABLE_ROLES . ' WHERE id = ' . DB_TABLE_USERS . '.role_id) as role 
        FROM ' . DB_TABLE_USERS;
    echo $query;
    $users = array();
    if ($statement = $conn->prepare($query)) {
        $statement->execute();
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
            $user = array();
            $user['id'] = $row['id'];
            $user['flag'] = $row['flag'];
            $user['role'] = $row['role'];
            $user['username'] = $row['username'];
            $user['password'] = $row['password'];
            $user['firstname'] = $row['firstname'];
            $user['lastname'] = $row['lastname'];
            $user['token'] = $row['token'];
            array_push($users, $user);
        }
    }
    $message['users'] = $users;
    return json_encode($message);
}

/**
 * Finished
 * @return string
 */
function getSafeUsers()
{
    global $conn;
    $message = array();
    $query = 'SELECT ' . DB_TABLE_USERS . '.id, username, password, firstname, lastname, 
        (SELECT name FROM ' . DB_TABLE_FLAGS . ' WHERE id = ' . DB_TABLE_USERS . '.flag_id) AS flag, 
        (SELECT name FROM ' . DB_TABLE_ROLES . ' WHERE id = ' . DB_TABLE_USERS . '.role_id) as role 
        FROM ' . DB_TABLE_USERS . ' WHERE flag_id = 1';
    echo $query;
    $users = array();
    if ($statement = $conn->prepare($query)) {
        $statement->execute();
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
            $user = array();
            $user['id'] = $row['id'];
            $user['role'] = $row['role'];
            $user['username'] = $row['username'];
            $user['password'] = $row['password'];
            $user['firstname'] = $row['firstname'];
            $user['lastname'] = $row['lastname'];
            $user['token'] = $row['token'];
            array_push($users, $user);
        }
    }
    $message['users'] = $users;
    return json_encode($message);
}

/**
 * @param $user_id
 * @return string
 */
function removeUser($user_id)
{
    global $conn;
    $message = array();
    if (checkIfLoggedIn()) {
        $query = 'UPDATE ' . DB_TABLE_USERS . ' SET flag_id = 2 WHERE id = ?';
        $result = $conn->prepare($query);
        $result->bind_param('i', $user_id);
        if ($result->execute()) {
            $message['success'] = 'You have successfully removed the user. ';
        } else {
            $message['error'] = 'Database connection error. ';
        }
    } else {
        $message['error'] = 'Please log in . ';
        header('HTTP / 1.1 401 Unauthorized');
    }
    return json_encode($message);
}