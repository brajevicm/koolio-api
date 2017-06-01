<?php
/**
 * Created by PhpStorm.
 * User: brajevicm
 * Date: 1/06/17
 * Time: 3:16 PM
 */

include_once 'shared.php';

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
        $query = 'INSERT INTO ' . DB_TABLE_POSTS . ' (user_id, title, image, upvotes, comments) 
        VALUES (?, ?, ?, ?, ?)';
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

/**
 * Finished
 * @return string
 */
function getPosts()
{
    global $conn;
    $message = array();
    $query = 'SELECT * FROM ' . DB_TABLE_POSTS;
    $posts = array();
    if ($statement = $conn->prepare($query)) {
        $statement->execute();
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
            $post = array();
            $post['id'] = $row['id'];
            $post['user_id'] = $row['user_id'];
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
 * Finished
 * @param $post_id
 * @return string
 */
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