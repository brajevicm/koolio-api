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
function addComment($token, $post_id, $text)
{
    $user_id = tokenToId($token);
    global $conn;
    $message = array();
    if (checkIfLoggedIn()) {
        $query = 'INSERT INTO ' . DB_TABLE_COMMENTS . ' (user_id, post_id, text, flag_id, upvotes) VALUES (?, ?, ?, ?, ?)';
        $result = $conn->prepare($query);
        $flag = 1;
        $upvotes = 0;
        $result->bind_param('iisii', $user_id, $post_id, $text, $flag, $upvotes);
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
        (SELECT username FROM ' . DB_TABLE_USERS . ' WHERE id = ' . DB_TABLE_COMMENTS . '.user_id) as users 
        FROM ' . DB_TABLE_COMMENTS;
    $comments = array();
    if ($statement = $conn->prepare($query)) {
        $statement->execute();
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
            $comment = array();
            $comment['users'] = $row['users'];
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
function getFilteredComments($post_id)
{
    global $conn;
    $message = array();
    $query = 'SELECT ' . DB_TABLE_COMMENTS . '.id, ' . DB_TABLE_COMMENTS . '.user_id, ' . DB_TABLE_COMMENTS . '.post_id, 
        ' . DB_TABLE_COMMENTS . '.flag_id, ' . DB_TABLE_COMMENTS . '.text, ' . DB_TABLE_COMMENTS . '.timestamp, 
        (SELECT username FROM ' . DB_TABLE_USERS . ' WHERE id = ' . DB_TABLE_COMMENTS . '.user_id) as user,
        (SELECT image FROM ' . DB_TABLE_USERS . ' WHERE id = ' . DB_TABLE_COMMENTS . '.user_id) as avatar,
         (SELECT title FROM ' . DB_TABLE_POSTS . ' WHERE id = ' . DB_TABLE_COMMENTS . '.user_id) as post,
         (SELECT COUNT(*) FROM ' . DB_TABLE_UPVOTED_COMMENTS . ' WHERE comment_id = ' . DB_TABLE_COMMENTS . '.id) as upvotes
        FROM ' . DB_TABLE_COMMENTS . '
        JOIN ' . DB_TABLE_USERS . ' ON ' . DB_TABLE_COMMENTS . '.user_id = ' . DB_TABLE_USERS . '.id 
        WHERE ' . DB_TABLE_COMMENTS . '.flag_id = 1 and ' . DB_TABLE_COMMENTS . '.post_id = ?';
    $statement = $conn->prepare($query);
    $statement->bind_param('i', $post_id);
    $comments = array();
    if ($statement->execute()) {
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
            $comment = array();
            $comment['id'] = $row['id'];
            $comment['user_id'] = $row['user_id'];
            $comment['user'] = $row['user'];
            $comment['avatar'] = $row['avatar'];
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

function getCommentsFromUser($token)
{
    $token = str_replace('"', "", $token);
    global $conn;
    $user_id = tokenToId($token);
    $message = array();
    $query = 'SELECT ' . DB_TABLE_COMMENTS . '.id, ' . DB_TABLE_COMMENTS . '.user_id, ' . DB_TABLE_COMMENTS . '.post_id, 
        ' . DB_TABLE_COMMENTS . '.flag_id, ' . DB_TABLE_COMMENTS . '.text, ' . DB_TABLE_COMMENTS . '.timestamp, 
        (SELECT username FROM ' . DB_TABLE_USERS . ' WHERE id = ' . DB_TABLE_COMMENTS . '.user_id) as user,
        (SELECT image FROM ' . DB_TABLE_USERS . ' WHERE id = ' . DB_TABLE_COMMENTS . '.user_id) as avatar,
         (SELECT title FROM ' . DB_TABLE_POSTS . ' WHERE id = ' . DB_TABLE_COMMENTS . '.user_id) as post,
         (SELECT COUNT(*) FROM ' . DB_TABLE_UPVOTED_COMMENTS . ' WHERE comment_id = ' . DB_TABLE_COMMENTS . '.id) as upvotes
        FROM ' . DB_TABLE_COMMENTS . '
        JOIN ' . DB_TABLE_USERS . ' ON ' . DB_TABLE_COMMENTS . '.user_id = ' . DB_TABLE_USERS . '.id 
        WHERE ' . DB_TABLE_COMMENTS . '.flag_id = 1 and ' . DB_TABLE_COMMENTS . '.user_id = ?';
    $statement = $conn->prepare($query);
    $statement->bind_param('i', $user_id);
    $comments = array();
    if ($statement->execute()) {
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
            $comment = array();
            $comment['id'] = $row['id'];
            $comment['user_id'] = $row['user_id'];
            $comment['user'] = $row['user'];
            $comment['avatar'] = $row['avatar'];
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
 * @param $user_id
 * @param $comment_id
 * @return bool
 */
function checkIfUpvoted($user_id, $comment_id)
{
    global $conn;
    $query = 'SELECT EXISTS (SELECT * FROM ' . DB_TABLE_UPVOTED_COMMENTS . ' WHERE user_id = ? AND post_id = ?)';
    $result = $conn->prepare($query);
    $result->bind_param('ii', $user_id, $comment_id);
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
 * @param $user_id
 * @param $comment_id
 * @return string
 */
function upvoteComment($token, $comment_id)
{
    $user_id = tokenToId($token);
    global $conn;
    $message = array();
    if (checkIfLoggedIn()) {
//        if (checkIfUpvoted($user_id, $comment_id)) {
        $query = 'INSERT INTO ' . DB_TABLE_UPVOTED_COMMENTS . ' (user_id, comment_id) VALUES(?, ?)';
        $result = $conn->prepare($query);
        $result->bind_param('ii', $user_id, $comment_id);
        if ($result->execute()) {
            $message['success'] = 'You have successfully upvoted the comment.';
        } else {
            $message['error'] = 'Database connection error.';
        }
//        } else {
//            $message['error'] = 'You have already upvoted.';
//        }
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
