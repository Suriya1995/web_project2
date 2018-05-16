<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
@ob_start();
@session_start();
require_once '../../connect/connect_DB_personal.php';
header("Content-type: application/json;charset=utf-8");
if (isset($_POST["FN"]) && !empty($_POST["FN"])) {
    switch ($_POST["FN"]) {
        case "sl_data_geninfo":sl_data_geninfo();
            break;
        case "sl_data_address":sl_data_address();
            break;
        case "sl_table_chName":sl_data_chName();
            break;
        case "ACN":add_chName();
            break;
        case "DCN": del_chName();
            break;
        case "sl_table_marry":sl_data_marry();
            break;
        case "AMR":add_marry();
            break;
        case "DMR": del_marry();
            break;
        case "sl_table_heir":sl_data_heir();
            break;
        case "AH":add_heir();
            break;
        case "DH": del_heir();
            break;
        case "sl_table_blame":sl_data_blame();
            break;
        case "AB":add_blame();
            break;
        case "DB": del_blame();
            break;
        case "sl_data_amphur": sl_data_amphur();
            break;
        case "sl_data_district": sl_data_district();
            break;
        case "sl_table_edu": sl_table_edu();
            break;
        case "AED":add_education();
            break;
        case "DED": del_education();
            break;
    }
}

function sl_data_chName() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $id = $get_data[0];
        if ($id == '') {
            $sql = "SELECT * from ps_changname ORDER BY chang_date ASC";
        } else {
            $sql = "SELECT * from ps_changname WHERE pro_id = '$id' ORDER BY chang_date ASC";
        }
        $rs = $cn->select($sql);
        $json = json_encode($rs);
        echo $json;
    }
    exit();
}

function sl_data_geninfo() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $id = $get_data[0];
        $sql = "SELECT * from ps_geninformation WHERE pro_id = '$id'";
        $rs = $cn->select($sql);
        $json = json_encode($rs);
        echo $json;
    }
    exit();
}

function add_chName() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $sql = "INSERT INTO ps_changname (chang_nameold, chang_namenew, chang_date, pro_id)"
                . "VALUES('$get_data[0]', '$get_data[1]', '$get_data[2]', '$get_data[3]')";
        $rs = $cn->execute($sql);
        echo $rs;
    }
    exit();
}

function del_chName() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $sql = "DELETE FROM ps_changname WHERE chang_id = '$get_data[0]'";
        $rs = $cn->execute($sql);
        echo $rs;
    }
    exit();
}

function sl_data_marry() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $id = $get_data[0];
        if ($id == '') {
            $sql = "SELECT * from ps_hismarry ORDER BY marry_name ASC";
        } else {
            $sql = "SELECT * from ps_hismarry WHERE pro_id = '$id' ORDER BY marry_name ASC";
        }
        $rs = $cn->select($sql);
        $json = json_encode($rs);
        echo $json;
    }
    exit();
}

function add_marry() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $sql = "INSERT INTO ps_hismarry (marry_name, marry_status, pro_id)"
                . "VALUES('$get_data[0]', '$get_data[1]', '$get_data[2]')";
        $rs = $cn->execute($sql);
        echo $rs;
    }
    exit();
}

function del_marry() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $sql = "DELETE FROM ps_hismarry WHERE marry_id = '$get_data[0]'";
        $rs = $cn->execute($sql);
        echo $rs;
    }
    exit();
}

function sl_data_heir() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $id = $get_data[0];
        if ($id == '') {
            $sql = "SELECT * from ps_heir ORDER BY heir_name ASC";
        } else {
            $sql = "SELECT * from ps_heir WHERE pro_id = '$id' ORDER BY heir_name ASC";
        }
        $rs = $cn->select($sql);
        $json = json_encode($rs);
        echo $json;
    }
    exit();
}

function add_heir() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $sql = "INSERT INTO ps_heir (heir_name, heir_relationship, pro_id)"
                . "VALUES('$get_data[0]', '$get_data[1]', '$get_data[2]')";
        $rs = $cn->execute($sql);
        echo $rs;
    }
    exit();
}

function del_heir() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $sql = "DELETE FROM ps_heir WHERE id_heir = '$get_data[0]'";
        $rs = $cn->execute($sql);
        echo $rs;
    }
    exit();
}

function sl_data_blame() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $id = $get_data[0];
        if ($id == '') {
            $sql = "SELECT * from ps_blame ORDER BY blame_date ASC";
        } else {
            $sql = "SELECT * from ps_blame WHERE pro_id = '$id' ORDER BY blame_date ASC";
        }
        $rs = $cn->select($sql);
        $json = json_encode($rs);
        echo $json;
    }
    exit();
}

function add_blame() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $sql = "INSERT INTO ps_blame (blame_name, blame_somename, blame_date, pro_id)"
                . "VALUES('$get_data[0]', '$get_data[1]', '$get_data[2]', '$get_data[3]')";
        $rs = $cn->execute($sql);
        echo $rs;
    }
    exit();
}

function del_blame() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $sql = "DELETE FROM ps_blame WHERE blame_id = '$get_data[0]'";
        $rs = $cn->execute($sql);
        echo $rs;
    }
    exit();
}

function sl_data_amphur() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $id = $get_data[0];
        if ($id == '') {
            $sql = "select * from ps_amphur ORDER BY AMPHUR_NAME ASC";
        } else if ($id == 'get_code') {
            $sql = "select POSTCODE from ps_amphur WHERE AMPHUR_ID = '$get_data[1]'";
        } else {
            $sql = "select * from ps_amphur WHERE PROVINCE_ID = '$id' ORDER BY AMPHUR_NAME ASC";
        }
        $rs = $cn->select($sql);
        $json = json_encode($rs);
        echo $json;
    }
    exit();
}

function sl_data_district() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $id = $get_data[0];
        if ($id == '') {
            $sql = "select * from ps_district ORDER BY DISTRICT_NAME ASC";
        } else {
            $sql = "select * from ps_district WHERE AMPHUR_ID = '$id' ORDER BY DISTRICT_NAME ASC";
        }
        $rs = $cn->select($sql);
        $json = json_encode($rs);
        echo $json;
    }
    exit();
}

function sl_data_address() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $id = $get_data[0];
        $sql = "SELECT * FROM `ps_address` AS ad JOIN ps_preaddress AS pad ON ad.pro_id = pad.pro_id WHERE ad.pro_id = '$id'";
        $rs = $cn->select($sql);
        $json = json_encode($rs);
        echo $json;
    }
    exit();
}

function sl_table_edu() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $id = $get_data[0];
        if ($id == '') {
            $sql = "select * from ps_education AS ed LEFT JOIN ps_leveleducation AS lve ON ed.edu_id = lve.edu_id ORDER BY ed.hised_year DESC";
        } else {
            $sql = "select * from ps_education AS ed LEFT JOIN ps_leveleducation AS lve ON ed.edu_id = lve.edu_id  WHERE ed.pro_id = '$id' ORDER BY ed.hised_year DESC";
        }
        $rs = $cn->select($sql);
        $json = json_encode($rs);
        echo $json;
    }
    exit();
}

function add_education() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $sql = "INSERT INTO ps_education (edu_id, hised_year, hised_background, hised_major, hised_address, hised_country, pro_id)"
                . "VALUES('$get_data[0]', '$get_data[1]', '$get_data[2]', '$get_data[3]', '$get_data[4]', '$get_data[5]', '$get_data[6]')";
        $rs = $cn->execute($sql);
        echo $rs;
    }
    exit();
}

function del_education() {
    $cn = new management;
    $cn->con_db();
    if ($cn->Connect) {
        $get_data = explode("|", $_POST["PARM"]);
        $sql = "DELETE FROM ps_education WHERE hised_id = '$get_data[0]'";
        $rs = $cn->execute($sql);
        echo $rs;
    }
    exit();
}
?>
