<?php
require_once __DIR__ . '/common.php';

function user_get_all() {
    return helper_mysql_get_rows('SELECT * FROM track_user');
}

function user_get_by_uid($uid) {
    return helper_mysql_get_row('SELECT * FROM track_user WHERE id = ' . intval($uid));
}

function user_get_by_uname($uname) {
    return helper_mysql_get_row('SELECT * FROM track_user WHERE name = ' . helper_strval($uname));
}

function user_save($id, $name, $passwd, $role) {
    if (empty($id)) {
        helper_mysql_exec('INSERT INTO track_user VALUES(null, '
            . helper_strval($name) . ', '
            . helper_strval($passwd) . ', '
            . helper_strval($role) . ')');
    } else {
        helper_mysql_exec('UPDATE track_user SET '
            . 'name =' . helper_strval($name) . ', '
            . 'passwd =' . helper_strval($passwd) . ', '
            . 'role =' . helper_strval($role) . ' '
            . 'WHERE id = ' . intval($id));
    }
}

function user_del($id) {
    helper_mysql_exec('DELETE FROM track_user WHERE id = ' . intval($id));
}
