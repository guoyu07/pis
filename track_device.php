<?php
require_once __DIR__ . '/common.php';

function device_get_by_device_sn($device_type, $device_sn) {
    return helper_mysql_get_row('SELECT * FROM track_device WHERE device_type = ' . helper_strval($device_type) . ' AND device_sn = ' . helper_strval($device_sn));
}
function device_search_by_device_sn($device_type, $device_sn) {
    return helper_mysql_get_rows('SELECT * FROM track_device WHERE device_type = ' . helper_strval($device_type) . ' AND device_sn LIKE ' . helper_strval('%' . $device_sn . '%'));
}

function device_save($id, $sn, $device_type, $device_name, $device_model,
        $device_sn, $device_amount, $owner_inc, $owner_contact, $work_order,
        $setup_address, $use_person_contact, $company_principle, $insite_time,
        $start_time, $use_time, $accept_time) {
    if (empty($id)) {
        helper_mysql_exec('INSERT INTO track_device VALUES(null, '
            . helper_strval($sn) . ', '
            . helper_strval($device_type) . ', '
            . helper_strval($device_name) . ', '
            . helper_strval($device_model) . ', '
            . helper_strval($device_sn) . ', '
            . helper_strval($device_amount) . ', '
            . helper_strval($owner_inc) . ', '
            . helper_strval($owner_contact) . ', '
            . helper_strval($work_order) . ', '
            . helper_strval($setup_address) . ', '
            . helper_strval($use_person_contact) . ', '
            . helper_strval($company_principle) . ', '
            . helper_strval($insite_time) . ', '
            . helper_strval($start_time) . ', '
            . helper_strval($use_time) . ', '
            . helper_strval($accept_time) . ')');
    } else {
        helper_mysql_exec('UPDATE track_device SET '
            . 'sn = '                 . helper_strval($sn) . ', '
            . 'device_type = '        . helper_strval($device_type) . ', '
            . 'device_name = '        . helper_strval($device_name) . ', '
            . 'device_model = '       . helper_strval($device_model) . ', '
            . 'device_sn = '          . helper_strval($device_sn) . ', '
            . 'device_amount = '     . helper_strval($device_amount) . ', '
            . 'owner_inc = '          . helper_strval($owner_inc) . ', '
            . 'owner_contact = '      . helper_strval($owner_contact) . ', '
            . 'work_order = '         . helper_strval($work_order) . ', '
            . 'setup_address = '      . helper_strval($setup_address) . ', '
            . 'use_person_contact = ' . helper_strval($use_person_contact) . ', '
            . 'company_principle = '  . helper_strval($company_principle) . ', '
            . 'insite_time = '        . helper_strval($insite_time) . ', '
            . 'start_time = '         . helper_strval($start_time) . ', '
            . 'use_time = '           . helper_strval($use_time) . ', '
            . 'accept_time = '        . helper_strval($accept_time) . ' '
            . 'WHERE id = ' . intval($id));
    }
}


function device_delete($id) {
    helper_mysql_exec('DELETE FROM track_device WHERE id = ' . intval($id));
    helper_mysql_exec('DELETE FROM track_setup_record WHERE device_id = ' . intval($id));
    helper_mysql_exec('DELETE FROM track_product_record WHERE device_id = ' . intval($id));
    helper_mysql_exec('DELETE FROM track_process_record WHERE device_id = ' . intval($id));
    helper_mysql_exec('DELETE FROM track_service_record WHERE device_id = ' . intval($id));
}
