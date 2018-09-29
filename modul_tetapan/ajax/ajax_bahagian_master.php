<?php

include_once '../../connection/db_config.php';
session_start();
$action = filter_input(INPUT_POST, 'action');
$db = db_connect();
if ($action == 'saveBahagian') {
    $hrbc_name = filter_input(INPUT_POST, 'hrbc_name');


    $qBahagian = 'INSERT INTO hrbc_bahagian_config (hrbc_name,hrbc_created_date,hrbc_created_by) VALUES("' . $hrbc_name . '",NOW(),"' . $_SESSION['hrsm_staff_id'] . '")';
    if ($db->query($qBahagian)) {
        echo 1;
    } else {
        echo 0;
    }
} else if ($action == 'updateBahagian') {
    $id = filter_input(INPUT_POST, 'id');
    $hrbc_name = filter_input(INPUT_POST, 'hrbc_name');
    $hrbc_is_active = filter_input(INPUT_POST, 'hrbc_is_active');


    $qBahagian = 'UPDATE hrbc_bahagian_config
                    SET hrbc_name = "' . $hrbc_name . '", 
                        hrbc_is_active = ' . $hrbc_is_active . ',
                        hrbc_updated_date = CURRENT_TIMESTAMP(),
                        hrbc_updated_by = "' . $_SESSION['hrsm_staff_id'] . '"
                    WHERE hrbc_id = "' . $id . '";';
    if ($db->query($qBahagian)) {
        echo 1;
    } else {
        echo 0;
    }
} elseif ($action == 'delete') {
    $id = filter_input(INPUT_POST, 'id');

    $qBahagian = 'DELETE FROM hrbc_bahagian_config
                    WHERE hrbc_id = "' . $id . '";';
    if ($db->query($qBahagian)) {
        echo 1;
    } else {
        echo 0;
    }
}
