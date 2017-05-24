<?php
/*
 * post.php
 * - receive public posts from users
 * - store posts in database
 */

require('config.php');

if(empty($_SESSION['username'])){
    $msg = 'You need to login first.';
    header('Location: user.php?error_msg='.$msg);
    die($msg);
}

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
    header('Location: user.php?success_msg=Your message is posted.');
} else {
    header('Location: user.php?error_msg=Title and message cannot be empty.');
}
