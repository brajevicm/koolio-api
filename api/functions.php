<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 31/05/17
 * Time: 7:28 PM
 */

require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    die();
}

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
        if ($result === 1) {
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function login($username, $password)
{
    global $conn;
    $message = array();
    if (checkLogin($username, $password)) {
        $id = sha1(uniqid());
        $query = 'UPDATE ' . DB_TABLE_USERS . ' SET token=? WHERE username=?';
        $result = $conn->prepare($query);
        $result->bind_param('ss', $id, $username);
        $result->execute();
        $message['token'] = $id;
    } else {
        header('HTTP/1.1 404 Unauthorized');
        $message['error'] = 'Invalid username/password';
    }
    return json_encode($message);
}

function checkLogin($username, $password)
{
    global $conn;
    $hashedPassword = md5($password);
    $query = 'SELECT EXISTS (SELECT * FROM ' . DB_TABLE_USERS . ' WHERE username=? AND password=?)';
    $result = $conn->prepare($query);
    $result->bind_param("ss", $username, $hashedPassword);
    $result->execute();
    $result->store_result();
    if ($result === 1) {
        return true;
    } else {
        return false;
    }
}

function checkIfUserExists($username)
{
    global $conn;
    $query = 'SELECT EXISTS (SELECT * FROM ' . DB_TABLE_USERS . ' WHERE username=?)';
    $result = $conn->prepare($query);
    $result->bind_param('s', $username);
    $result->execute();
    $result->store_result();
    if ($result === 1) {
        return true;
    } else {
        return false;
    }
}

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
    if ($errors = '') {
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

function getUsers()
{
    global $conn;
    $message = array();
    $query = 'SELECT * FROM ' . DB_TABLE_USERS;
    $statement = $conn->prepare($query);
    $num_rows = $statement->num_rows;
    $users = array();
    if ($num_rows > 0) {
        $result = $conn->prepare($query);
        while ($row = $result->fetch()) {
            $user = array();
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

function addPost($user_id, $title, $image)
{
    global $conn;
    $message = array();
    if (checkIfLoggedIn()) {
        $query = 'INSERT INTO ' . DB_TABLE_POSTS . ' (user_id, title, image, upvotes, comments) 
        VALUES (?, ?, ?, ?, ?, ?)';
        $result = $conn->prepare($query);
        $upvotes = 0;
        $comments = 0;
        $result->bind_param('issii', $user_id, $title, $image, $upvotes, $comments);
        if ($result->execute()) {
            $message['success'] = 'You have successfully uploaded a post.';
        } else {
            $message['error'] = 'Database connection error.';
        }

    } else {
        $message['error'] = 'Please log in.';
        header('HTTP/1.1 401 Unathorized');
    }
    return json_encode($message);
}

function getPosts()
{
    global $conn;
    $message = array();
    $query = 'SELECT * FROM ' . DB_TABLE_POSTS;
    $statement = $conn->prepare($query);
    $num_rows = $statement->num_rows;
    $posts = array();
    if ($num_rows > 0) {
        $result = $conn->prepare($query);
        while ($row = $result->fetch()) {
            $post = array();
            $post['username'] = $row['username'];
            $post['title'] = $row['title'];
            $post['image'] = $row['image'];
            $post['timestamp'] = $row['timestamp'];
            $post['upvotes'] = $row['upvotes'];
            $post['comments'] = $row['comments'];
            array_push($posts, $post);
        }
    }
    $message['posts'] = $posts;
    return json_encode($message);
}

function upvotePost($post_id)
{
    global $conn;
    $message = array();
    if (checkIfLoggedIn()) {
        $query = 'UPDATE ' . DB_TABLE_POSTS . ' SET upvotes = upvotes + 1 WHERE id=?';
        $result = $conn->prepare($query);
        $result->bind_param('i', $post_id);
        if ($result->execute()) {
            $message['success'] = 'You have successfully upvoted the post.';
        } else {
            $message['error'] = 'Database connection error.';
        }

    } else {
        $message['error'] = 'Please log in.';
        header('HTTP/1.1 401 Unathorized');
    }
    return json_encode($message);
}

function downvotePost($post_id)
{
    global $conn;
    $message = array();
    if (checkIfLoggedIn()) {
        $query = 'UPDATE ' . DB_TABLE_POSTS . ' SET upvotes = upvotes - 1 WHERE id=?';
        $result = $conn->prepare($query);
        $result->bind_param('i', $post_id);
        if ($result->execute()) {
            $message['success'] = 'You have successfully downvoted the post . ';
        } else {
            $message['error'] = 'Database connection error . ';
        }

    } else {
        $message['error'] = 'Please log in . ';
        header('HTTP / 1.1 401 Unathorized');
    }
    return json_encode($message);
}

function addComment($user_id, $post_id, $text)
{
    global $conn;
    $message = array();
    if (checkIfLoggedIn()) {
        $query = 'INSERT INTO ' . DB_TABLE_COMMENTS . ' (user_id, post_id, text, upvotes) VALUES (?, ?, ?, ?)';
        $result = $conn->prepare($query);
        $upvotes = 0;
        $result->bind_param('iisi', $user_id, $post_id, $text, $upvotes);
        if ($result->execute()) {
            $message['success'] = 'You have successfully uploaded a comment.';
        } else {
            $message['error'] = 'Database connection error.';
        }

    } else {
        $message['error'] = 'Please log in.';
        header('HTTP/1.1 401 Unathorized');
    }
    return json_encode($message);
}

function getComments()
{
    global $conn;
    $message = array();
    $query = 'SELECT * FROM ' . DB_TABLE_COMMENTS;
    $statement = $conn->prepare($query);
    $num_rows = $statement->num_rows;
    $comments = array();
    if ($num_rows > 0) {
        $result = $conn->prepare($query);
        while ($row = $result->fetch()) {
            $comment = array();
            $comment['user_id'] = $row['user_id'];
            $comment['post_id'] = $row['post_id'];
            $comment['text'] = $row['text'];
            $comment['upvotes'] = $row['upvotes'];
            $comment['timestamp'] = $row['timestamp'];
            array_push($comments, $comment);
        }
    }
    $message['comments'] = $comments;
    return json_encode($message);
}

function upvoteComment($comment_id)
{
    global $conn;
    $message = array();
    if (checkIfLoggedIn()) {
        $query = 'UPDATE ' . DB_TABLE_POSTS . ' SET upvotes = upvotes + 1 WHERE id=?';
        $result = $conn->prepare($query);
        $result->bind_param('i', $comment_id);
        if ($result->execute()) {
            $message['success'] = 'You have successfully upvoted the comment.';
        } else {
            $message['error'] = 'Database connection error.';
        }

    } else {
        $message['error'] = 'Please log in.';
        header('HTTP/1.1 401 Unathorized');
    }
    return json_encode($message);
}

function downvoteComment($comment_id)
{
    global $conn;
    $message = array();
    if (checkIfLoggedIn()) {
        $query = 'UPDATE ' . DB_TABLE_POSTS . ' SET upvotes = upvotes - 1 WHERE id=?';
        $result = $conn->prepare($query);
        $result->bind_param('i', $comment_id);
        if ($result->execute()) {
            $message['success'] = 'You have successfully downvoted the comment. ';
        } else {
            $message['error'] = 'Database connection error. ';
        }

    } else {
        $message['error'] = 'Please log in . ';
        header('HTTP / 1.1 401 Unathorized');
    }
    return json_encode($message);
}

register("admin", "admin", "Milos", "Brajevic");
