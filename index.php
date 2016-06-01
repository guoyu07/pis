<?php
require_once __DIR__ . '/common.php';
require_once __DIR__ . '/track_user.php';
require_once __DIR__ . '/track_device.php';
require_once __DIR__ . '/track_setup_record.php';
require_once __DIR__ . '/track_product_record.php';
require_once __DIR__ . '/track_process_record.php';
require_once __DIR__ . '/track_service_record.php';
$GLOBALS['is_login'] = isset($_COOKIE['role']) && in_array(base64_decode($_COOKIE['role']), array('只读', '录入员', '管理员'));
$GLOBALS['role'] = isset($_COOKIE['role']) ? base64_decode($_COOKIE['role']) : '';
$GLOBALS['role'] = in_array($GLOBALS['role'], array('只读', '录入员', '管理员')) ? $GLOBALS['role'] : '未登录';
function mustRole($role) {
    $isError = $role == '录入员' && $GLOBALS['role'] == '未登录'
        || $role == '管理员' && $GLOBALS['role'] != '管理员';

    if ($isError || !$GLOBALS['is_login']) {
        helper_redirect('/pis/index.php?action=error&message=无权操作');
    }
}
if (isset($_REQUEST['action'])) {
    switch ($_REQUEST['action']) {
        case 'error';
            helper_render(array('message' => $_REQUEST['message']), 'tpl_error.php');
            break;
        case 'login_index':
            helper_render(array(), 'tpl_login_index.php');
            break;
        case 'logout':
            setcookie('role', base64_encode('未登录'), time() - 7200);
            helper_redirect('/pis/index.php');
            break;
        case 'login':
            $user = user_get_by_uname($_REQUEST['name']);
            if (empty($user)) {
                helper_redirect('/pis/index.php?action=error&message=登陆失败');
            }
            if ($user['passwd'] != $_REQUEST['passwd']) {
                helper_redirect('/pis/index.php?action=error&message=登陆失败');
            }
            setcookie('role', base64_encode($user['role']));
            helper_redirect('/pis/index.php');
            break;
        case 'user_index':
            mustRole('管理员');
            $users = user_get_all();
            helper_render(array('users' => $users), 'tpl_user_index.php');
            break;
        case 'user_add':
            mustRole('管理员');
            user_save(null, $_REQUEST['name'], $_REQUEST['passwd'], $_REQUEST['role']);
            helper_redirect('/pis/index.php?action=user_index');
            break;
        case 'user_modify':
            mustRole('管理员');
            user_save($_REQUEST['id'], $_REQUEST['name'], $_REQUEST['passwd'], $_REQUEST['role']);
            helper_redirect('/pis/index.php?action=user_index');
            break;
        case 'user_del':
            mustRole('管理员');
            user_del($_REQUEST['id']);
            helper_redirect('/pis/index.php?action=user_index');
            break;
        case 'device_search_index':
            if (isset($_REQUEST['device_sn'])) {
                $devices = device_search_by_device_sn($_REQUEST['device_type'], $_REQUEST['device_sn']);
            } else {
                $devices = array();
            }
            helper_render(array(
                'device_type' => $_REQUEST['device_type'],
                'search_device_sn' => isset($_REQUEST['device_sn']) ? $_REQUEST['device_sn'] : '',
                'devices'     => $devices,
            ), 'tpl_device_search_index.php');
            break;
        case 'device_delete':
            device_delete($_REQUEST['device_id']);
            helper_redirect('/pis/index.php?action=device_search_index&device_sn=' . rawurlencode($_REQUEST['search_device_sn']) . '&device_type=' . rawurlencode($_REQUEST['device_type']));
            break;
        case 'device_add_index':
            mustRole('录入员');
            helper_render(array('device_type' => $_REQUEST['device_type']), 'tpl_device_add_index.php');
            break;
        case 'device_add':
            mustRole('录入员');
            device_save(null, $_REQUEST['sn'], $_REQUEST['device_type'], $_REQUEST['device_name'],
                $_REQUEST['device_model'], $_REQUEST['device_sn'], $_REQUEST['device_amount'],
                $_REQUEST['owner_inc'], $_REQUEST['owner_contact'], $_REQUEST['work_order'],
                $_REQUEST['setup_address'], $_REQUEST['use_person_contact'],
                $_REQUEST['company_principle'], $_REQUEST['insite_time'],
                $_REQUEST['start_time'], $_REQUEST['use_time'], $_REQUEST['accept_time']);
            helper_redirect('/pis/index.php?action=device_edit_index&device_sn=' . rawurlencode($_REQUEST['device_sn']) . '&device_type=' . rawurlencode($_REQUEST['device_type']));
            break;
        case 'device_edit_index':
            $device = device_get_by_device_sn($_REQUEST['device_type'], $_REQUEST['device_sn']);
            if (empty($device)) {
                helper_redirect('/pis/index.php?action=error&message=' . '设备[' . $_REQUEST['device_type'] . '.' . $_REQUEST['device_sn'] . ']不存在');
            }
            $setup_records = setup_record_get_by_device_id($device['id']);
            $product_records = product_record_get_by_device_id($device['id']);
            $service_records = service_record_get_by_device_id($device['id']);
            $process_records = process_record_get_by_device_id($device['id']);
            helper_render(array(
                'device' => $device,
                'setup_records' => $setup_records,
                'product_records' => $product_records,
                'service_records' => $service_records,
                'process_records' => $process_records,
            ), 'tpl_device_edit_index.php');
            break;
        case 'device_edit':
            mustRole('管理员');
            device_save($_REQUEST['id'], $_REQUEST['sn'], $_REQUEST['device_type'], $_REQUEST['device_name'],
                $_REQUEST['device_model'], $_REQUEST['device_sn'], $_REQUEST['device_amount'],
                $_REQUEST['owner_inc'], $_REQUEST['owner_contact'], $_REQUEST['work_order'],
                $_REQUEST['setup_address'], $_REQUEST['use_person_contact'],
                $_REQUEST['company_principle'], $_REQUEST['insite_time'],
                $_REQUEST['start_time'], $_REQUEST['use_time'], $_REQUEST['accept_time']);
            helper_redirect('/pis/index.php?action=device_edit_index&device_sn=' . rawurlencode($_REQUEST['device_sn']) . '&device_type=' . rawurlencode($_REQUEST['device_type']));
            break;
        case 'setup_record_add':
            mustRole('录入员');
            setup_record_save(null, $_REQUEST['device_id'], $_REQUEST['company'], $_REQUEST['job_content'], $_REQUEST['locale_owner_contact'], $_REQUEST['remark']);
            helper_redirect('/pis/index.php?action=device_edit_index&device_sn=' . rawurlencode($_REQUEST['device_sn']) . '&device_type=' . rawurlencode($_REQUEST['device_type']));
            break;
        case 'setup_record_edit':
            mustRole('管理员');
            setup_record_save($_REQUEST['id'], $_REQUEST['device_id'], $_REQUEST['company'], $_REQUEST['job_content'], $_REQUEST['locale_owner_contact'], $_REQUEST['remark']);
            helper_redirect('/pis/index.php?action=device_edit_index&device_sn=' . rawurlencode($_REQUEST['device_sn']) . '&device_type=' . rawurlencode($_REQUEST['device_type']));
            break;
        case 'setup_record_delete':
            mustRole('管理员');
            setup_record_delete($_REQUEST['id']);
            helper_redirect('/pis/index.php?action=device_edit_index&device_sn=' . rawurlencode($_REQUEST['device_sn']) . '&device_type=' . rawurlencode($_REQUEST['device_type']));
            break;
        case 'product_record_add':
            mustRole('录入员');
            product_record_save(null, $_REQUEST['device_id'], $_REQUEST['name'], $_REQUEST['specification'], $_REQUEST['amount'], $_REQUEST['company'], $_REQUEST['contact'], $_REQUEST['remark']);
            helper_redirect('/pis/index.php?action=device_edit_index&device_sn=' . rawurlencode($_REQUEST['device_sn']) . '&device_type=' . rawurlencode($_REQUEST['device_type']));
            break;
        case 'product_record_edit':
            mustRole('管理员');
            product_record_save($_REQUEST['id'], $_REQUEST['device_id'], $_REQUEST['name'], $_REQUEST['specification'], $_REQUEST['amount'], $_REQUEST['company'], $_REQUEST['contact'], $_REQUEST['remark']);
            helper_redirect('/pis/index.php?action=device_edit_index&device_sn=' . rawurlencode($_REQUEST['device_sn']) . '&device_type=' . rawurlencode($_REQUEST['device_type']));
            break;
        case 'product_record_delete':
            mustRole('管理员');
            product_record_delete($_REQUEST['id']);
            helper_redirect('/pis/index.php?action=device_edit_index&device_sn=' . rawurlencode($_REQUEST['device_sn']) . '&device_type=' . rawurlencode($_REQUEST['device_type']));
            break;
        case 'service_record_add':
            mustRole('录入员');
            service_record_save(null, $_REQUEST['device_id'], $_REQUEST['report_time'], $_REQUEST['issue'], $_REQUEST['owner'], $_REQUEST['fix_time'], $_REQUEST['result']);
            helper_redirect('/pis/index.php?action=device_edit_index&device_sn=' . rawurlencode($_REQUEST['device_sn']) . '&device_type=' . rawurlencode($_REQUEST['device_type']));
            break;
        case 'service_record_edit':
            mustRole('管理员');
            service_record_save($_REQUEST['id'], $_REQUEST['device_id'], $_REQUEST['report_time'], $_REQUEST['issue'], $_REQUEST['owner'], $_REQUEST['fix_time'], $_REQUEST['result']);
            helper_redirect('/pis/index.php?action=device_edit_index&device_sn=' . rawurlencode($_REQUEST['device_sn']) . '&device_type=' . rawurlencode($_REQUEST['device_type']));
            break;
        case 'service_record_delete':
            mustRole('管理员');
            service_record_delete($_REQUEST['id']);
            helper_redirect('/pis/index.php?action=device_edit_index&device_sn=' . rawurlencode($_REQUEST['device_sn']) . '&device_type=' . rawurlencode($_REQUEST['device_type']));
            break;
        case 'process_record_add':
            mustRole('录入员');
            process_record_save(null, $_REQUEST['device_id'], $_REQUEST['time'], $_REQUEST['content'], $_REQUEST['issue'], $_REQUEST['remark'], $_REQUEST['sign']);
            helper_redirect('/pis/index.php?action=device_edit_index&device_sn=' . rawurlencode($_REQUEST['device_sn']) . '&device_type=' . rawurlencode($_REQUEST['device_type']));
            break;
        case 'process_record_edit':
            mustRole('管理员');
            process_record_save($_REQUEST['id'], $_REQUEST['device_id'], $_REQUEST['time'], $_REQUEST['content'], $_REQUEST['issue'], $_REQUEST['remark'], $_REQUEST['sign']);
            helper_redirect('/pis/index.php?action=device_edit_index&device_sn=' . rawurlencode($_REQUEST['device_sn']) . '&device_type=' . rawurlencode($_REQUEST['device_type']));
            break;
        case 'process_record_delete':
            mustRole('管理员');
            process_record_delete($_REQUEST['id']);
            helper_redirect('/pis/index.php?action=device_edit_index&device_sn=' . rawurlencode($_REQUEST['device_sn']) . '&device_type=' . rawurlencode($_REQUEST['device_type']));
            break;
        case 'export_device':
            $device = device_get_by_device_sn($_REQUEST['device_type'], $_REQUEST['device_sn']);
            if (empty($device)) {
                helper_redirect('/pis/index.php?action=error&message=' . '设备[' . $_REQUEST['device_type'] . '.' . $_REQUEST['device_sn'] . ']不存在');
            }
            $setup_records = setup_record_get_by_device_id($device['id']);
            $product_records = product_record_get_by_device_id($device['id']);
            #export_device($device, $setup_records, $product_records);
            break;
        default:
            break;
    }
}
?>
<html>
<head>
    <title>产品安装维修信息管理</title>
</head>
<body>
    <?php if ($GLOBALS['role'] == '管理员') { ?>
    <a href="/pis/index.php?action=user_index">用户管理</a><br />
    <?php } ?>

    <?php if ($GLOBALS['role'] == '未登录') { ?>
    <a href="/pis/index.php?action=login_index">用户登陆</a><br />
    <?php } else { ?>
    <a href="/pis/index.php?action=logout">用户登出</a><br />
    <?php } ?>
    <br />
    <?php if ($GLOBALS['is_login']) { ?>
    <a href="/pis/index.php?action=device_search_index&device_type=搅拌站">搅拌站</a><br />
    <a href="/pis/index.php?action=device_search_index&device_type=起重设备">起重设备</a><br />
    <a href="/pis/index.php?action=device_search_index&device_type=盾构设备">盾构设备</a><br />
    <a href="/pis/index.php?action=device_search_index&device_type=桩工机械">桩工机械</a><br />
    <?php } ?>
</body>
</html>
