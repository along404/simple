<?php

include_once '../connection/db_config.php';
include_once '../security/encrypt_decrypt.php';
session_start();
$db = db_connect();
$action = filter_input(INPUT_POST, 'action');

if ($action === "login") {

    $username = filter_input(INPUT_POST, 'username');
    $password = filter_input(INPUT_POST, 'password');

    $dPassword = cypher($password, 'e');
    
    // username and password sent from form 

    $q = "SELECT *,count(*)bil FROM sys_user "
            . "INNER JOIN hrsm_staff_master ON hrsm_id = sys_hrsm_id "
            . "WHERE sys_username = '$username' and sys_password = '$dPassword'";
    $res = $db->query($q);
    $row = $res->fetch_assoc();


    $count = $row['bil'];
    $login_username = $row['sys_username'];
    $login_id = $row['sys_id'];
    $login_name = $row['sys_name'];


    if ($count == 1) {
        $_SESSION['sys_username'] = $login_username;
        $_SESSION['sys_id'] = $login_id;
        $_SESSION['sys_name'] = $login_name;
        $_SESSION['session_available'] = $count;
        
        $_SESSION['hrsm_staff_id'] = $row['hrsm_staff_id'];
        $_SESSION['hrsm_nickname'] = $row['hrsm_nickname'];
        
        
        echo 1;
    } else {
        echo 0;
    }
}

