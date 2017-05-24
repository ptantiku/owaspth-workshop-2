<?php
/*
 * dm.php
 * - post a direct message to admin
 */

require('config.php');

/** check permission **/
if(empty($_SESSION['username'])){
    $msg = 'You need to login first.';
    header('Location: index.php?msg='.$msg);
    die($msg);
}

/** add the message into database **/
if(!empty($_POST['message'])) {

    $sql = 'insert into messages(sender, receiver, message) values (?,?,?);';
    $stmt = $db->prepare($sql);
    $stmt->execute(
        [
            $_SESSION['username'],
            'admin',
            $_POST['message']
        ]
    );
    if($stmt->rowCount()>0){
        //successfully sent
        header('Location: user.php?success_msg=Your message is sent.');
    } else {
        //failed to post
        header('Location: user.php?error_msg=Failed to send the message.');
    }
} else {
    header('Location: user.php?error_msg=Message cannot be empty.');
}
