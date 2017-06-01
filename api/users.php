<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 1/06/17
 * Time: 2:57 PM
 */

include_once 'shared.php';

/**
 * Finished
 * @return string
 */
function getUsers()
{
    global $conn;
    $message = array();
    $query = 'SELECT * FROM ' . DB_TABLE_USERS;
    $users = array();
    if ($statement = $conn->prepare($query)) {
        $statement->execute();
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
            $user = array();
            $user['id'] = $row['id'];
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