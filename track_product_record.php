<?php
require_once __DIR__ . '/common.php';

function product_record_get_by_device_id($device_id) {
    return helper_mysql_get_rows('SELECT * FROM track_product_record WHERE device_id = ' . intval($device_id));
}

function product_record_save($id, $device_id, $name, $specification, $amount, $company, $contact, $remark) {
    if (empty($id)) {
        helper_mysql_exec('INSERT INTO track_product_record VALUES(null, '
            . helper_strval($device_id) . ', '
            . helper_strval($name) . ', '
            . helper_strval($specification) . ', '
            . helper_strval($amount) . ', '
            . helper_strval($company) . ', '
            . helper_strval($contact) . ', '
            . helper_strval($remark) . ')');
    } else {
        helper_mysql_exec('UPDATE track_product_record SET '
            . 'device_id = '     . helper_strval($device_id) . ', '
            . 'name = '          . helper_strval($name) . ', '
            . 'specification = ' . helper_strval($specification) . ', '
            . 'amount = '        . helper_strval($amount) . ', '
            . 'company = '       . helper_strval($company) . ', '
            . 'contact = '       . helper_strval($contact) . ', '
            . 'remark = '        . helper_strval($remark) . ' '
            . 'WHERE id = ' . intval($id));
    }

}

function product_record_delete($id) {
    helper_mysql_exec('DELETE FROM track_product_record WHERE id = ' . intval($id));
}
