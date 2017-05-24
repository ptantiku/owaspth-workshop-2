<?php
/*
 * remove_post.php
 * - remove post
 * - admin access only
 */

require('config.php');

/** check permission **/
if(empty($_SESSION['username'])){
    $msg = 'You need to login first.';
    header('Location: index.php?msg='.$msg);
    die($msg);
}elseif($_SESSION['username']!=='admin'){
    $msg = 'Admin only!';
    header('Location: index.php?msg='.$msg);
    die($msg);
}

/** delete post **/
if(!empty($_GET['post_id'])) {

    $sql = 'delete from posts where id=?;';
    $stmt = $db->prepare($sql);
    $stmt->execute( [ $_GET['post_id'] ] );
    if($stmt->rowCount()>0){
	//successfully deleted
        header('Location: index.php');
    } else {
	//failed to delete
        header('Location: index.php?msg=Cannot delete post '.$_GET['post_id'].'.');
    }
} else {
    //invalid
    header('Location: index.php?msg=Invalid operation delete post.');
}
