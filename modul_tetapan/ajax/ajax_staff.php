

<?php

include_once '../../connection/db_config.php';
session_start();
$action = filter_input(INPUT_POST, 'action');
$action2 = filter_input(INPUT_POST, 'action2');
$db = db_connect();
if ($action == 'saveJawatan') {
    $hrjc_name = filter_input(INPUT_POST, 'hrjc_name');


    $qJawatan = 'INSERT INTO hrjc_jawatan_config (hrjc_name,hrjc_created_date,hrjc_created_by) VALUES("' . $hrjc_name . '",NOW(),"' . $_SESSION['hrsm_staff_id'] . '")';
    if ($db->query($qJawatan)) {
        echo 1;
    } else {
        echo 0;
    }
} else if ($action == 'updateJawatan') {
    $id = filter_input(INPUT_POST, 'id');
    $hrjc_name = filter_input(INPUT_POST, 'hrjc_name');
    $hrjc_is_active = filter_input(INPUT_POST, 'hrjc_is_active');


    $qJawatan = 'UPDATE hrjc_jawatan_config
                    SET hrjc_name = "' . $hrjc_name . '", 
                        hrjc_is_active = ' . $hrjc_is_active . ',
                        hrjc_updated_date = CURRENT_TIMESTAMP(),
                        hrjc_updated_by = "' . $_SESSION['hrsm_staff_id'] . '"
                    WHERE hrjc_id = "' . $id . '";';
    if ($db->query($qJawatan)) {
        echo 1;
    } else {
        echo 0;
    }
} elseif ($action == 'delete') {
    $id = filter_input(INPUT_POST, 'id');

    $qJawatan = 'DELETE FROM hrjc_jawatan_config
                    WHERE hrjc_id = "' . $id . '";';
    if ($db->query($qJawatan)) {
        echo 1;
    } else {
        echo 0;
    }
} else if ($action2 == "select") {
    $q = "SELECT * FROM hrjc_jawatan_config";
    $res = $db->query($q);
    while ($row = $res->fetch_assoc()) {
        $itemData = array();
        $itemData['value'] = $row['hrjc_id'];
        $itemData['name'] = $row['hrjc_name'];
        $options[] = $itemData;
    }
    echo json_encode($options);
    $db->close();
}

