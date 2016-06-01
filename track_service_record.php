<?php
require_once __DIR__ . '/common.php';

function service_record_get_by_device_id($device_id) {
    return helper_mysql_get_rows('SELECT * FROM track_service_record WHERE device_id = ' . intval($device_id));
}

function service_record_save($id, $device_id, $report_time, $issue, $owner, $fix_time, $result) {
    if (empty($id)) {
        helper_mysql_exec('INSERT INTO track_service_record VALUES(null, '
            . helper_strval($device_id) . ', '
            . helper_strval($report_time) . ', '
            . helper_strval($issue) . ', '
            . helper_strval($owner) . ', '
            . helper_strval($fix_time) . ', '
            . helper_strval($result) . ')');
    } else {
        helper_mysql_exec('UPDATE track_service_record SET '
            . 'device_id = '   . helper_strval($device_id) . ', '
            . 'report_time = ' . helper_strval($report_time) . ', '
            . 'issue = '       . helper_strval($issue) . ', '
            . 'owner = '       . helper_strval($owner) . ', '
            . 'fix_time = '    . helper_strval($fix_time) . ', '
            . 'result = '      . helper_strval($result) . ' '
            . 'WHERE id = '    . intval($id));
    }

}

function service_record_delete($id) {
    helper_mysql_exec('DELETE FROM track_service_record WHERE id = ' . intval($id));
}
