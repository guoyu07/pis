<?php
function helper_mysql_get_conn() {
    static $conn;
    if (is_null($conn)) {
        $conn = mysql_connect('127.0.0.1:3306', 'work', 'work');
        mysql_select_db('pis', $conn);
        mysql_set_charset('utf8mb4', $conn);
    }
    return $conn;
}

function helper_mysql_get_row($sql) {
    $conn = helper_mysql_get_conn();

    $rs = mysql_query($sql, $conn);
    if ($rs === FALSE) {
        return array();
    }
    $row = mysql_fetch_array($rs, MYSQL_ASSOC);
    if ($row === FALSE) {
        return array();
    }
    return $row;
}

function helper_mysql_get_rows($sql) {
    $conn = helper_mysql_get_conn();

    $rs = mysql_query($sql, $conn);
    if ($rs === FALSE) {
        return array();
    }
    $rows = array();
    while ($row = mysql_fetch_array($rs, MYSQL_ASSOC)) {
        $rows[] = $row;
    }
    return $rows;
}

function helper_mysql_exec($sql) {
    $conn = helper_mysql_get_conn();

    return (bool)mysql_query($sql, $conn);
}

function helper_strval($value) {
    return "'" . mysql_escape_string($value) . "'";
}

function helper_render($tplData, $tpl) {
    $role = $GLOBALS['role'];
    include $tpl;
    exit;
}

function helper_redirect($location) {
    header('Location: ' . $location);
    exit(0);
}

