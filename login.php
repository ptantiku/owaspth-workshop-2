<?php
/* WARNING: This code is vulnerable. */
/*
 * login.php
 * For login & verify login
 */
require('config.php');

if(!empty($_SESSION['username'])){
    //already logged in
    header('Location: index.php');
    exit;
}

// password checking
if(!empty($_POST['username']) && !empty($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "select * from users where username=? limit 1";
    $stmt = $db->prepare($sql);
    $stmt->execute(array($username));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if(!empty($user) && password_verify($password, $user['password'])){
	session_regenerate_id(TRUE);
        $_SESSION['username'] = $user['username'];
        $success_msg = 'Success: logged in successfully.';
        header('Location: index.php');
	exit;
    }else{
        $error_msg = 'invalid username or password';
        header('Location: index.php?msg='.$error_msg);
	exit;
    }
}else{
    $error_msg = 'invalid access to login page';
    header('Location: index.php?msg='.$error_msg);
    exit;
}
