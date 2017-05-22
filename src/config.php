<?php
/*
 * config.php
 * - database config
 * - database initial connection
 */
session_start();

error_reporting(E_ALL & ~E_DEPRECATED); #TODO remove
ini_set('display_errors', '1');

$team = 'Team 99';      #TODO Change Here

$mysql_host = 'localhost';
$mysql_port = 3306;
$mysql_database = 'team1';      #TODO Change Here
$mysql_username = 'team1';      #TODO Change Here
$mysql_password = 'password';   #TODO Change Here

$db = new PDO(
    "mysql:host=127.0.0.1;dbname=$mysql_database;charset=utf8",
    $mysql_username,
    $mysql_password,
    array(
        PDO::ATTR_EMULATE_PREPARES => false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    )
);

