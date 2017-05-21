<?php
$log = array(
    strftime('%F %T', $_SERVER['REQUEST_TIME']),
    $_SERVER['REMOTE_ADDR'],
    $_SERVER['REQUEST_METHOD'],
    $_SERVER['REQUEST_URI'],
    $_SERVER['HTTP_REFERER'],
    $_SERVER['HTTP_USER_AGENT']
);
$log = implode("\t",$log).PHP_EOL;
file_put_contents('data.txt', $log, FILE_APPEND);
