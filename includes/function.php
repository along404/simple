<?php

function breadcrumbs($home = 'Laman Utama') {
    $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
    if (strtolower($path[1]) == strtolower(SYS_PROJECT_DIR)) {
        unset($path[1]);
    }
    $size = 18;
    $base_url = 'https://' . $_SERVER['HTTP_HOST'] . '/' . SYS_PROJECT_DIR . '/';
    $breadcrumbs = array("<li><a style='font-size: " . $size . "px;'  href=\"" . $base_url . "\"><i style='font-size: " . $size . "px;' class='fa fa-home'></i> " . $home . "</a></li>");
    $tempPost = array_keys($path);
    $last = end($tempPost);
    foreach ($path AS $x => $crumb) {
        $isSubDir = startsWith($crumb, "modul") ? true : false;
        $title = ucwords(str_replace(array('.php', 'modul_', '_'), Array('', '', ' '), (startsWith($crumb, "modul") ? getModuleName($crumb) : $crumb)));
        if ($x != $last) {
            $breadcrumbs[] = '<li><a style="font-size: ' . $size . 'px;" href="' . $base_url . $crumb . '">' . $title . '</a></li>';
        } else {
//            $breadcrumbs[] = '<li class="active"><span  style="font-size: ' . $size . 'px; color:black;" >' . (($isSubDir) ? $title : $_SESSION['hrsm_nickname']) . '</span></li>';
        }
    }
    return implode($breadcrumbs);
}

function startsWith($haystack, $needle) {
    // search backwards starting from haystack length characters from the end
    return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== FALSE;
}

function getModuleName($oriModuleName) {
    $conn = db_connect();
    $queryGetModuleName = "SELECT LOWER(sysm_name) sysm_name FROM sysm_sidebar_master "
            . "WHERE 1=1 "
            . "AND sysm_url = '/" . $oriModuleName . "/' "
            . "AND sysm_parent = '00000' ";
    $result = mysqli_query($conn, $queryGetModuleName);
    $row = mysqli_fetch_assoc($result);
    return $row['sysm_name'];
}

//function session modul
echo $modul_id_get = filter_input(INPUT_POST, 'modul_id');

function DateToDb($dateBefore) {
    $date = DateTime::createFromFormat('d/m/Y', $dateBefore);
    return $date->format('Y-m-d');
}

function DateFromDb($dateBefore) {
    $date = DateTime::createFromFormat('Y-m-d', $dateBefore);
    return $date->format('d/m/Y');
}

function labelStatus($status) {
    if ($status == 1) {
        echo 'badge-primary';
    } else {
        echo 'badge-danger';
    }
}

//----------------------------STUDY PURPOSE----------------------------
function intervalReturn($openingDate, $val, $data) {
    $db = db_connect();
    $qOpening = 'select mr_data_a,mr_data_b from mr_data_master
                where mr_is_opening = 1 and mr_created_date = "' . $openingDate . '" and mr_sypd_value = ' . $data . '                
                order by 1';
    $resOpening = $db->query($qOpening);
    $rowOpening = $resOpening->fetch_assoc();
    $AB = $val - $rowOpening['mr_data_a'];
    return $AB;
}
