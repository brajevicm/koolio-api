<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 1/06/17
 * Time: 2:57 PM
 */

include_once 'shared_functions.php';

/**
 * Finished
 * @param $user_id
 * @param $post_id
 * @param $text
 * @return string
 */
function addComment($user_id, $post_id, $text)
{
    global $conn;
    $message = array();
    if (checkIfLoggedIn()) {
        $query = 'INSERT INTO ' . DB_TABLE_COMMENTS . ' (user_id, post_id, text, flag, upvotes) VALUES (?, ?, ?, ?, ?)';
        $result = $conn->prepare($query);
        $flag = 1;
        $upvotes = 0;
        $result->bind_param('iisi', $user_id, $post_id, $text, $flag, $upvotes);
        if ($result->execute()) {
            $message['success'] = 'You have successfully uploaded a comment.';
        } else {
            $message['error'] = 'Database connection error.';
        }
    } else {
        $message['error'] = 'Please log in.';
        header('HTTP/1.1 401 Unauthorized');
    }
    return json_encode($message);
}

/**
 * Finished
 * @return string
 */
function getUnfilteredComments()
{
    global $conn;
    $message = array();
    $query = 'SELECT ' . DB_TABLE_COMMENTS . '.id, text, upvotes, timestamp, post_id, 
        (SELECT name FROM ' . DB_TABLE_FLAGS . ' WHERE id = ' . DB_TABLE_COMMENTS . '.flag_id) AS flag, 
        (SELECT username FROM ' . DB_TABLE_USERS . ' WHERE id = ' . DB_TABLE_COMMENTS . '.user_id) as user 
        FROM ' . DB_TABLE_COMMENTS;
    $comments = array();
    if ($statement = $conn->prepare($query)) {
        $statement->execute();
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
            $comment = array();
            $comment['user'] = $row['user'];
            $comment['post_id'] = $row['post_id'];
            $comment['flag'] = $row['flag'];
            $comment['text'] = $row['text'];
            $comment['upvotes'] = $row['upvotes'];
            $comment['timestamp'] = $row['timestamp'];
            array_push($comments, $comment);
        }
    }
    $message['comments'] = $comments;
    return json_encode($message);
}

/**
 * Finished.
 * @return string
 */
function getFilteredComments()
{
    global $conn;
    $message = array();
    $query = 'SELECT ' . DB_TABLE_COMMENTS . '.id, user_id, post_id, flag_id text, upvotes, timestamp, post_id, 
        (SELECT username FROM ' . DB_TABLE_USERS . ' WHERE id = ' . DB_TABLE_COMMENTS . '.user_id) as user,
         (SELECT title FROM ' . DB_TABLE_POSTS . ' WHERE id = ' . DB_TABLE_COMMENTS . '.user_id) as post
        FROM ' . DB_TABLE_COMMENTS . ' WHERE flag_id = 1';
    echo $query;
    $comments = array();
    if ($statement = $conn->prepare($query)) {
        $statement->execute();
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
            $comment = array();
            $comment['id'] = $row['id'];
            $comment['user_id'] = $row['user_id'];
            $comment['user'] = $row['user'];
            $comment['post_id'] = $row['post_id'];
            $comment['post'] = $row['post'];
            $comment['flag_id'] = $row['flag_id'];
            $comment['text'] = $row['text'];
            $comment['upvotes'] = $row['upvotes'];
            $comment['timestamp'] = $row['timestamp'];
            array_push($comments, $comment);
        }
    }
    $message['comments'] = $comments;
    return json_encode($message);
}

/**
 * Finished
 * @param $comment_id
 * @return string
 */
function upvoteComment($comment_id)
{
    global $conn;
    $message = array();
    if (checkIfLoggedIn()) {
        $query = 'UPDATE ' . DB_TABLE_COMMENTS . ' SET upvotes = upvotes + 1 WHERE id = ?';
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

/**
 * Finished
 * @param $comment_id
 * @return string
 */
function downvoteComment($comment_id)
{
    global $conn;
    $message = array();
    if (checkIfLoggedIn()) {
        $query = 'UPDATE ' . DB_TABLE_COMMENTS . ' SET upvotes = upvotes - 1 WHERE id = ?';
        $result = $conn->prepare($query);
        $result->bind_param('i', $comment_id);
        if ($result->execute()) {
            $message['success'] = 'You have successfully downvoted the comment. ';
        } else {
            $message['error'] = 'Database connection error. ';
        }
    } else {
        $message['error'] = 'Please log in . ';
        header('HTTP / 1.1 401 Unauthorized');
    }
    return json_encode($message);
}

function removeComment($comment_id)
{
    global $conn;
    $message = array();
    if (checkIfLoggedIn()) {
        $query = 'UPDATE ' . DB_TABLE_COMMENTS . ' SET flag_id = 2 WHERE id = ?';
        $result = $conn->prepare($query);
        $result->bind_param('i', $comment_id);
        if ($result->execute()) {
            $message['success'] = 'You have successfully removed the comment. ';
        } else {
            $message['error'] = 'Database connection error. ';
        }
    } else {
        $message['error'] = 'Please log in . ';
        header('HTTP / 1.1 401 Unauthorized');
    }
    return json_encode($message);
}