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
function addPost($token, $title, $image)
{
    $user_id = tokenToId($token);
    global $conn;
    $message = array();
    if (checkIfLoggedIn($token)) {
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
function getFilteredPostsForUser($token)
{
    $user_id = tokenToId($token);
    global $conn;
    $message = array();
    $query = 'SELECT pt1 . id, pt1 . user_id, pt1 . flag_id, pt1 . title, pt1 . image, pt1 . timestamp,
        (SELECT username FROM users WHERE id = pt1 . user_id) AS user,
        (SELECT COUNT(*) FROM comments WHERE post_id = pt1 . id) AS comments,
        (SELECT COUNT(*) FROM upvoted_posts WHERE post_id = pt1 . id) AS upvotes,
        (SELECT EXISTS(SELECT * FROM upvoted_posts WHERE upvoted_posts . post_id = pt1.id AND upvoted_posts.user_id = ?)) AS upvoted
        FROM posts AS pt1';
//    $query = 'SELECT ' . DB_TABLE_POSTS . '.id, ' . DB_TABLE_POSTS . '.user_id,
//        ' . DB_TABLE_POSTS . '.flag_id, ' . DB_TABLE_POSTS . '.title, ' . DB_TABLE_POSTS . '.image,
//        ' . DB_TABLE_POSTS . '.timestamp,
//        (SELECT username FROM ' . DB_TABLE_USERS . ' WHERE id = ' . DB_TABLE_POSTS . '.user_id) as user,
//         (SELECT COUNT(*) FROM ' . DB_TABLE_COMMENTS . ' WHERE post_id = ' . DB_TABLE_POSTS . '.id) as comments,
//         (SELECT COUNT(*) FROM ' . DB_TABLE_UPVOTED_POSTS . ' WHERE post_id = ' . DB_TABLE_POSTS . '.id) as upvotes,
//         (SELECT * FROM ' . DB_TABLE_UPVOTED_POSTS . ' WHERE ' . DB_TABLE_UPVOTED_POSTS . '.user_id = ?) as upvoted
//        FROM ' . DB_TABLE_POSTS . ' WHERE flag_id = 1';
    $posts = array();
    $statement = $conn->prepare($query);
    $statement->bind_param('i', $user_id);
    if ($statement->execute()) {
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
            $post['upvoted'] = $row['upvoted'];
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
        (SELECT username FROM ' . DB_TABLE_USERS . ' WHERE id = ' . DB_TABLE_POSTS . '.user_id) as user,
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
            $post['user'] = $row['user'];
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

function getPostsFromUser($token)
{
    $token = str_replace('"', "", $token);
    global $conn;
    $user_id = tokenToId($token);
    $message = array();
    $query = 'SELECT ' . DB_TABLE_POSTS . '.id, ' . DB_TABLE_POSTS . '.user_id, 
        ' . DB_TABLE_POSTS . '.flag_id, ' . DB_TABLE_POSTS . '.title, ' . DB_TABLE_POSTS . '.image, 
        ' . DB_TABLE_POSTS . '.timestamp,  
        (SELECT username FROM ' . DB_TABLE_USERS . ' WHERE id = ' . DB_TABLE_POSTS . '.user_id) as user,
        (SELECT COUNT(*) FROM ' . DB_TABLE_COMMENTS . ' WHERE post_id = ' . DB_TABLE_POSTS . '.id) as comments,
        (SELECT COUNT(*) FROM ' . DB_TABLE_UPVOTED_POSTS . ' WHERE post_id = ' . DB_TABLE_POSTS . '.id) as upvotes
        FROM ' . DB_TABLE_POSTS . '
        JOIN ' . DB_TABLE_USERS . ' ON ' . DB_TABLE_POSTS . '.user_id = ' . DB_TABLE_USERS . '.id
        WHERE ' . DB_TABLE_USERS . '.id = ?';
    $posts = array();
    $statement = $conn->prepare($query);
    $statement->bind_param('i', $user_id);
    if ($statement->execute()) {
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
            $post = array();
            $post['id'] = $row['id'];
            $post['user_id'] = $row['user_id'];
            $post['user'] = $row['user'];
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
 * @return string
 */
function getUpvotedPosts($token)
{
    $token = str_replace('"', "", $token);
    global $conn;
    $user_id = tokenToId($token);
    $message = array();
    $query = 'SELECT ' . DB_TABLE_POSTS . '.id, ' . DB_TABLE_POSTS . '.user_id, 
        ' . DB_TABLE_POSTS . '.flag_id, ' . DB_TABLE_POSTS . '.title, ' . DB_TABLE_POSTS . '.image, 
        ' . DB_TABLE_POSTS . '.timestamp,  
        (SELECT username FROM ' . DB_TABLE_USERS . ' WHERE id = ' . DB_TABLE_POSTS . '.user_id) as user,
        (SELECT COUNT(*) FROM ' . DB_TABLE_COMMENTS . ' WHERE post_id = ' . DB_TABLE_POSTS . '.id) as comments,
        (SELECT COUNT(*) FROM ' . DB_TABLE_UPVOTED_POSTS . ' WHERE post_id = ' . DB_TABLE_POSTS . '.id) as upvotes
        FROM ' . DB_TABLE_POSTS . '
        JOIN ' . DB_TABLE_UPVOTED_POSTS . ' ON ' . DB_TABLE_POSTS . '.id = ' . DB_TABLE_UPVOTED_POSTS . '.post_id
        WHERE ' . DB_TABLE_UPVOTED_POSTS . '.user_id = ?';
    $posts = array();
    $statement = $conn->prepare($query);
    $statement->bind_param('i', $user_id);
    if ($statement->execute()) {
        $result = $statement->get_result();
        while ($row = $result->fetch_assoc()) {
            $post = array();
            $post['id'] = $row['id'];
            $post['user_id'] = $row['user_id'];
            $post['user'] = $row['user'];
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
    $query = 'SELECT EXISTS (SELECT * FROM ' . DB_TABLE_UPVOTED_POSTS . '
        WHERE ' . DB_TABLE_UPVOTED_POSTS . '.user_id = ? AND ' . DB_TABLE_UPVOTED_POSTS . '.post_id = ?)';
    $statement = $conn->prepare($query);
    $statement->bind_param('ii', $user_id, $post_id);
    $statement->execute();
    $result = $statement->get_result()->fetch_row()[0];
    if ($result == 1) {
        return true;
    } else {
        return false;
    }
}

/**
 * Finished.
 * @param $token
 * @param $post_id
 * @return string
 */
function upvotePost($token, $post_id)
{
    $user_id = (int)tokenToId($token);
    $post_id = (int)$post_id;
    global $conn;
    $message = array();
    echo $token;
    if (checkIfLoggedIn($token)) {
        if (!checkIfUpvoted($user_id, $post_id)) {
            $query = 'INSERT INTO ' . DB_TABLE_UPVOTED_POSTS . ' (user_id, post_id) VALUES (?, ?)';
            $result = $conn->prepare($query);
            $result->bind_param('ii', $user_id, $post_id);
            if ($result->execute()) {
                $message['success'] = 'You have successfully upvoted the post.';
            } else {
                $message['error'] = 'Database connection error.';
            }
        } else {
            $message['error'] = 'You have already upvoted.';
        }
    } else {
        $message['error'] = 'Please log in.';
        header('HTTP/1.1 401 Unauthorized');
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
    if (checkIfLoggedIn($token)) {
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