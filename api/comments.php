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
        header('HTTP/1.1 401 Unauthorized');
    }
    return json_encode($message);
}

/**
 * Finished
 * @return string
 */
function getComments()
{
    global $conn;
    $message = array();
    $query = 'SELECT * FROM ' . DB_TABLE_COMMENTS;
    $comments = array();
    if ($statement = $conn->prepare($query)) {
        $statement->execute();
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
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
        $query = 'UPDATE ' . DB_TABLE_COMMENTS . ' SET upvotes = upvotes + 1 WHERE id=?';
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
        $query = 'UPDATE ' . DB_TABLE_COMMENTS . ' SET upvotes = upvotes - 1 WHERE id=?';
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