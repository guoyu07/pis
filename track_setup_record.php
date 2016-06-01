<?php
require_once __DIR__ . '/common.php';

function setup_record_get_by_device_id($device_id) {
    return helper_mysql_get_rows('SELECT * FROM track_setup_record WHERE device_id = ' . intval($device_id));
}

function setup_record_save($id, $device_id, $company, $job_content, $locale_owner_contact, $remark) {
    if (empty($id)) {
        helper_mysql_exec('INSERT INTO track_setup_record VALUES(null, '
            . helper_strval($device_id) . ', '
            . helper_strval($company) . ', '
            . helper_strval($job_content) . ', '
            . helper_strval($locale_owner_contact) . ', '
            . helper_strval($remark) . ')');
    } else {
        helper_mysql_exec('UPDATE track_setup_record SET '
            . 'device_id = '            . helper_strval($device_id) . ', '
            . 'company = '              . helper_strval($company) . ', '
            . 'job_content = '          . helper_strval($job_content) . ', '
            . 'locale_owner_contact = ' . helper_strval($locale_owner_contact) . ', '
            . 'remark = '               . helper_strval($remark) . ' '
            . 'WHERE id = ' . intval($id));
    }

}

function setup_record_delete($id) {
    helper_mysql_exec('DELETE FROM track_setup_record WHERE id = ' . intval($id));
}
