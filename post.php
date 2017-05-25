<?php
/*
 * post.php
 * - receive public posts from users
 * - store posts in database
 */

require('config.php');

/** check permission **/
if(empty($_SESSION['username'])){
    $msg = 'You need to login first.';
    header('Location: index.php?msg='.$msg);
    die($msg);
}

/** add post into database **/
if(!empty($_POST['title']) && !empty($_POST['message'])) {

    $sql = 'insert into posts(owner, title, message) values (?,?,?);';
    $stmt = $db->prepare($sql);
    $stmt->execute(
        [
            $_SESSION['username'],
            $_POST['title'],
            $_POST['message']
        ]
    );
    if($stmt->rowCount()>0){
        //successfully posted
        header('Location: user.php?success_msg=Your message is posted. See it at Home page.');
    } else {
        //failed to post
        header('Location: user.php?error_msg=Failed to post the message.');
    }
} else {
    header('Location: user.php?error_msg=Title and message cannot be empty.');
}
