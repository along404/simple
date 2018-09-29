<?php

include_once 'connection/db_config.php';
session_start();
$db = db_connect();
$login_id = $_SESSION['sys_id'];
$login_username = $_SESSION['sys_username'];


$q = "select count(*)bil from sys_user where sys_username='$login_username' and sys_id='$login_id'";
$res = $db->query($q);
$row = $res->fetch_assoc();
$sessionTrace = $row['bil'];


if ($sessionTrace != 1) {
    session_destroy();
    header("location:login.php");
}