<html>
<head>
    <title>设备检索[<?php echo $tplData['device_type']; ?>]</title>
    <script type="text/javascript" src="/pis/jquery-2.2.3.js"></script>
    <script type="text/javascript">
$(function() {
    $('.delete-device-button').click(function(e) {
        if (!window.confirm('确定要删除设备[' + $(this).attr('device_sn') + ']吗?')) {
            e.preventDefault();
            e.stopPropagation();
        }
    });
});
    </script>
</head>
<body>
    <a href="/pis/index.php">返回首页</a><br />
    <?php if ($GLOBALS['role'] != '只读') {?>
    <a href="/pis/index.php?action=device_add_index&device_type=<?php echo $tplData['device_type']; ?>">添加设备</a>
    <?php } ?>
    <h3>[<?php echo $tplData['device_type']; ?>]设备检索</h3>
    <form action="/pis/index.php" method="GET">
        <input type="hidden" name="device_type" value="<?php echo $tplData['device_type']; ?>" />
        <input type="hidden" name="action" value="device_search_index" />
        设备编号: <input type="text" name="device_sn"/>
        <input type="submit" name="submit" value="检索"/>
    </form>
    <table border="0" cellpading="0" cellspacing="0" width="680">
    <?php foreach ($tplData['devices'] as $device) {
        $detail_link = '/pis/index.php?action=device_edit_index&device_type=' . rawurlencode($device['device_type']) . '&device_sn=' . rawurlencode($device['device_sn']);
        $delete_link = '/pis/index.php?action=device_delete&device_id=' . rawurlencode($device['id']) . '&device_type=' . rawurlencode($tplData['device_type']) . '&search_device_sn=' . rawurlencode($tplData['search_device_sn']);
        if ($GLOBALS['role'] == '管理员') {
            echo "<tr><td width='600'><a href='$detail_link'>[" . $device['device_sn'] . "]</a></td><td width='80'><a device_sn='{$device['device_sn']}' class='delete-device-button' href='$delete_link'>删除</a></td></tr>\n";
        } else {
            echo "<tr><td width='680'><a href='$detail_link'>[" . $device['device_sn'] . "]</a></td></tr>\n";
        }
    } ?>
    </table>
</body>
</html>
