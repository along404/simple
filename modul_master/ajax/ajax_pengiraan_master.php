<?php

include_once '../../connection/db_config.php';
include_once '../../includes/function.php';

session_start();
$action = filter_input(INPUT_POST, 'action');

if ($action == 'save') {
    $mr_data_a = filter_input(INPUT_POST, 'mr_data_a');
    $mr_data_b = filter_input(INPUT_POST, 'mr_data_b');
    $mr_sample_type = filter_input(INPUT_POST, 'mr_sample_type');
    $mr_created_date = filter_input(INPUT_POST, 'mr_created_date');
    $mr_sypd_value = filter_input(INPUT_POST, 'mr_sypd_value');
    $mr_is_opening = filter_input(INPUT_POST, 'mr_is_opening');

    $db = db_connect();
     $qData = 'INSERT INTO mr_data_master (mr_data_a,mr_data_b,mr_sample_type,mr_created_date,mr_sypd_value,mr_is_opening) VALUES("' . $mr_data_a . '","' . $mr_data_b . '","' . $mr_sample_type . '","' . DateToDb($mr_created_date) . '","' . $mr_sypd_value . '","' . $mr_is_opening . '")';
    if ($db->query($qData)) {
        echo 1;
    } else {
        echo 0;
    }
}
