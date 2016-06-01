<html>
<head>
    <title>设备添加[<?php echo $tplData['device_type']; ?>]</title>
</head>
<body>
    <a href="/pis/index.php">返回首页</a><br />
    <h3>[<?php echo $tplData['device_type']; ?>]设备添加</h3>
    <form action="/pis/index.php" method="POST">
        <input type="hidden" name="action" value="device_add" />
        <input type="hidden" name="device_type" value="<?php echo $tplData['device_type']; ?>" />
        <table border="1" cellspacing="0" cellpading="0">
            <tr>
                <td align="right" colspan="9">编号:<input type="text" name="sn" value="" /></td>
            </tr>
            <tr>
                <td rowspan="2">基本信息</td>
                <td>设备名称</td>
                <td><input type="text" name="device_name" value="" /></td>
                <td>设备型号:</td>
                <td><input type="text" name="device_model" value="" /></td>
                <td>设备编号</td>
                <td><input type="text" name="device_sn" value="" /></td>
                <td>设备数量</td>
                <td><input type="text" name="device_amount" value="" /></td>
            </tr>
            <tr>
                <td>业主公司</td>
                <td colspan="2"><input type="text" name="owner_inc" value="" /></td>
                <td>联系人及电话</td>
                <td colspan="2"><input type="text" name="owner_contact" value="" /></td>
                <td>工令号</td>
                <td><input type="text" name="work_order" value="" /></td>
            </tr>
            <tr>
                <td rowspan="2">安装信息</td>
                <td>安装地址</td>
                <td colspan="2"><input type="text" name="setup_address" value="" /></td>
                <td>使用人及电话</td>
                <td colspan="2"><input type="text" name="use_person_contact" value="" /></td>
                <td>公司负责人</td>
                <td><input type="text" name="company_principle" value="" /></td>
            </tr>
            <tr>
                <td>进场时间</td>
                <td><input type="text" name="insite_time" value="" /></td>
                <td>动工时间</td>
                <td><input type="text" name="start_time" value="" /></td>
                <td>使用时间</td>
                <td><input type="text" name="use_time" value="" /></td>
                <td>验收时间</td>
                <td><input type="text" name="accept_time" value="" /></td>
            </tr>
        </table>
        <input type="submit" name="submit" value="添加"/>
    </form>
</body>
</html>
