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
    $query = 'SELECT ' . DB_TABLE_USERS . '.id, username, password, firstname, lastname, image,
        (SELECT name FROM ' . DB_TABLE_FLAGS . ' WHERE id = ' . DB_TABLE_USERS . '.flag_id) AS flag, 
        (SELECT name FROM ' . DB_TABLE_ROLES . ' WHERE id = ' . DB_TABLE_USERS . '.role_id) as role 
        FROM ' . DB_TABLE_USERS;
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
            $user['image'] = $row['image'];
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
function getFilteredUsers()
{
    global $conn;
    $message = array();
    $query = 'SELECT ' . DB_TABLE_USERS . '.id, username, password, firstname, lastname, image 
        (SELECT name FROM ' . DB_TABLE_FLAGS . ' WHERE id = ' . DB_TABLE_USERS . '.flag_id) AS flag, 
        (SELECT name FROM ' . DB_TABLE_ROLES . ' WHERE id = ' . DB_TABLE_USERS . '.role_id) as role 
        FROM ' . DB_TABLE_USERS . ' WHERE flag_id = 1';
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
            $user['image'] = $row['image'];
            array_push($users, $user);
        }
    }
    $message['users'] = $users;
    return json_encode($message);
}

function getUser($token)
{
    $token = str_replace('"', "", $token);
    $id = tokenToId($token);
    global $conn;
    $message = array();
    $query = 'SELECT ' . DB_TABLE_USERS . '.id, username, firstname, lastname, image, 
        flag_id, role_id, token, password, 
        (SELECT name FROM ' . DB_TABLE_FLAGS . ' WHERE id = ' . DB_TABLE_USERS . '.flag_id) AS flag, 
        (SELECT name FROM ' . DB_TABLE_ROLES . ' WHERE id = ' . DB_TABLE_USERS . '.role_id) AS role 
        FROM ' . DB_TABLE_USERS . ' WHERE flag_id = 1 AND id = ?';
    $user = array();
    $statement = $conn->prepare($query);
    $statement->bind_param('i', $id);
    if ($statement->execute()) {
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
            $user['id'] = $row['id'];
            $user['role_id'] = $row['role_id'];
            $user['role'] = $row['role'];
            $user['flag_id'] = $row['flag_id'];
            $user['flag'] = $row['flag'];
            $user['username'] = $row['username'];
            $user['password'] = $row['password'];
            $user['firstname'] = $row['firstname'];
            $user['lastname'] = $row['lastname'];
            $user['image'] = $row['image'];
            $user['token'] = $row['token'];
//            array_push($users, $user);
        }
    }
//    $message['user'] = $user;
    return json_encode($user);
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
            $message['success'] = 'You have successfully removed the users. ';
        } else {
            $message['error'] = 'Database connection error. ';
        }
    } else {
        $message['error'] = 'Please log in . ';
        header('HTTP / 1.1 401 Unauthorized');
    }
    return json_encode($message);
}