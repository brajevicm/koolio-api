<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 1/06/17
 * Time: 3:16 PM
 */

include_once 'shared_functions.php';

/**
 * Finished
 * @param $user_id
 * @param $title
 * @param $image
 * @return string
 */
function addPost($user_id, $title, $image)
{
    global $conn;
    $message = array();
    if (checkIfLoggedIn()) {
        $query = 'INSERT INTO ' . DB_TABLE_POSTS . ' (user_id, title, image, upvotes, comments, flag_id) 
        VALUES (?, ?, ?, ?, ?, ?)';
        $result = $conn->prepare($query);
        $upvotes = 0;
        $comments = 0;
        $flag = 1;
        $result->bind_param('issiii', $user_id, $title, $image, $upvotes, $comments, $flag);
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

/**
 * Finished
 * @return string
 */
function getUnfilteredPosts()
{
    global $conn;
    $message = array();
    $query = 'SELECT ' . DB_TABLE_POSTS . '.id, user_id, flag_id, title, image, upvotes, timestamp, comments,  
        (SELECT username FROM ' . DB_TABLE_USERS . ' WHERE id = ' . DB_TABLE_POSTS . '.user_id) as users 
        FROM ' . DB_TABLE_POSTS;
    $posts = array();
    if ($statement = $conn->prepare($query)) {
        $statement->execute();
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
            $post = array();
            $post['id'] = $row['id'];
            $post['user_id'] = $row['user_id'];
            $post['users'] = $row['users'];
            $post['flag_id'] = $row['flag_id'];
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

/**
 * Finished.
 * @return string
 */
function getFilteredPosts()
{
    global $conn;
    $message = array();
    $query = 'SELECT ' . DB_TABLE_POSTS . '.id, ' . DB_TABLE_POSTS . '.user_id, 
        ' . DB_TABLE_POSTS . '.flag_id, ' . DB_TABLE_POSTS . '.title, ' . DB_TABLE_POSTS . '.image, 
        ' . DB_TABLE_POSTS . '.timestamp,  
        (SELECT username FROM ' . DB_TABLE_USERS . ' WHERE id = ' . DB_TABLE_POSTS . '.user_id) as users,
         (SELECT COUNT(*) FROM ' . DB_TABLE_COMMENTS . ' WHERE post_id = ' . DB_TABLE_POSTS . '.id) as comments,
         (SELECT COUNT(*) FROM ' . DB_TABLE_UPVOTED_POSTS . ' WHERE post_id = ' . DB_TABLE_POSTS . '.id) as upvotes
        FROM ' . DB_TABLE_POSTS . ' WHERE flag_id = 1';
    $posts = array();
    if ($statement = $conn->prepare($query)) {
        $statement->execute();
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
            $post = array();
            $post['id'] = $row['id'];
            $post['user_id'] = $row['user_id'];
            $post['users'] = $row['users'];
            $post['flag_id'] = $row['flag_id'];
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

/**
 * Finished.
 * @param $user_id
 * @param $post_id
 * @return bool
 */
function checkIfUpvoted($user_id, $post_id)
{
    global $conn;
    $query = 'SELECT EXISTS (SELECT * FROM ' . DB_TABLE_UPVOTED_POSTS . ' WHERE user_id = ? AND post_id = ?)';
    $result = $conn->prepare($query);
    $result->bind_param('ii', $user_id, $post_id);
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
 * @param $post_id
 * @return string
 */
function upvotePost($user_id, $post_id)
{
    global $conn;
    $message = array();
    if (checkIfLoggedIn() && !checkIfUpvoted($user_id, $post_id)) {
        $query = 'INSERT INTO ' . DB_TABLE_UPVOTED_COMMENTS . ' (user_id, post_id) VALUES(?, ?)';
        $result = $conn->prepare($query);
        $result->bind_param('ii', $user_id, $post_id);
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
 * @param $post_id
 * @return string
 */
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
        header('HTTP / 1.1 401 Unauthorized');
    }
    return json_encode($message);
}

/**
 * @param $post_id
 * @return string
 */
function removePost($post_id)
{
    global $conn;
    $message = array();
    if (checkIfLoggedIn()) {
        $query = 'UPDATE ' . DB_TABLE_POSTS . ' SET flag_id = 2 WHERE id=?';
        $result = $conn->prepare($query);
        $result->bind_param('i', $post_id);
        if ($result->execute()) {
            $message['success'] = 'You have successfully removed the post . ';
        } else {
            $message['error'] = 'Database connection error . ';
        }
    } else {
        $message['error'] = 'Please log in . ';
        header('HTTP / 1.1 401 Unauthorized');
    }
    return json_encode($message);
}