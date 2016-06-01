<?php
require_once __DIR__ . '/common.php';

function process_record_get_by_device_id($device_id) {
    return helper_mysql_get_rows('SELECT * FROM track_process_record WHERE device_id = ' . intval($device_id));
}

function process_record_save($id, $device_id, $time, $content, $issue, $remark, $sign) {
    if (empty($id)) {
        helper_mysql_exec('INSERT INTO track_process_record VALUES(null, '
            . helper_strval($device_id) . ', '
            . helper_strval($time) . ', '
            . helper_strval($content) . ', '
            . helper_strval($issue) . ', '
            . helper_strval($remark) . ', '
            . helper_strval($sign) . ')');
    } else {
        helper_mysql_exec('UPDATE track_process_record SET '
            . 'device_id = ' . helper_strval($device_id) . ', '
            . 'time = '      . helper_strval($time) . ', '
            . 'content = '   . helper_strval($content) . ', '
            . 'issue = '     . helper_strval($issue) . ', '
            . 'remark = '    . helper_strval($remark) . ', '
            . 'sign = '      . helper_strval($sign) . ' '
            . 'WHERE id = '  . intval($id));
    }

}

function process_record_delete($id) {
    helper_mysql_exec('DELETE FROM track_process_record WHERE id = ' . intval($id));
}
