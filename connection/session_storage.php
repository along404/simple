<?php
session_start();
include_once 'db_config.php';
$modul_id_get = filter_input(INPUT_POST, 'modul_id');
$db = db_connect();


$qSessionSidebar = 'select * from sysm_sidebar_master where sysm_menu_id =' . $modul_id_get . '';
$resSessionSidebar = $db->query($qSessionSidebar);
$rowSessionSidebar = $resSessionSidebar->fetch_assoc();

$_SESSION['sysm_menu_id'] = $modul_id_get;
$_SESSION['sysm_name'] = $rowSessionSidebar['sysm_name'];