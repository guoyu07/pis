<html>
<head>
    <title>设备详情[<?php echo $tplData['device']['device_type'] . '.' . $tplData['device']['device_sn']; ?>]</title>
    <script type="text/javascript" src="/pis/jquery-2.2.3.js"></script>
    <script type="text/javascript">
$(function() {
    $('.hide-setup-record').click(function() {
        $(this).parent().parent().hide();
        $('#setup-record-title-cell').attr('rowspan', $('#setup-record-title-cell').attr('rowspan') - 1);
    });
    $('.hide-product-record').click(function() {
        $(this).parent().parent().hide();
        $('#product-record-title-cell').attr('rowspan', $('#product-record-title-cell').attr('rowspan') - 1);
    });
    $('.hide-process-record').click(function() {
        $(this).parent().parent().hide();
        $('#process-record-title-cell').attr('rowspan', $('#process-record-title-cell').attr('rowspan') - 1);
    });
    $('.hide-service-record').click(function() {
        $(this).parent().parent().hide();
        $('#service-record-title-cell').attr('rowspan', $('#service-record-title-cell').attr('rowspan') - 1);
    });
    $('.delete-setup-record').click(function() {
        if (!window.confirm('确定要删除记录吗?')) {
            e.preventDefault();
            e.stopPropagation();
            return ;
        }
        window.location.href = "/pis/index.php?action=" + encodeURIComponent('setup_record_delete')
            + "&id=" + encodeURIComponent($(this).attr('record_id'))
            + "&device_sn=" + encodeURIComponent($(this).attr('device_sn'))
            + "&device_type=" + encodeURIComponent($(this).attr('device_type'));
    });
    $('.delete-product-record').click(function() {
        if (!window.confirm('确定要删除记录吗?')) {
            e.preventDefault();
            e.stopPropagation();
            return ;
        }
        window.location.href = "/pis/index.php?action=" + encodeURIComponent('product_record_delete')
            + "&id=" + encodeURIComponent($(this).attr('record_id'))
            + "&device_sn=" + encodeURIComponent($(this).attr('device_sn'))
            + "&device_type=" + encodeURIComponent($(this).attr('device_type'));
    });
    $('.delete-process-record').click(function() {
        if (!window.confirm('确定要删除记录吗?')) {
            e.preventDefault();
            e.stopPropagation();
            return ;
        }
        window.location.href = "/pis/index.php?action=" + encodeURIComponent('process_record_delete')
            + "&id=" + encodeURIComponent($(this).attr('record_id'))
            + "&device_sn=" + encodeURIComponent($(this).attr('device_sn'))
            + "&device_type=" + encodeURIComponent($(this).attr('device_type'));
    });
    $('.delete-service-record').click(function() {
        if (!window.confirm('确定要删除记录吗?')) {
            e.preventDefault();
            e.stopPropagation();
            return ;
        }
        window.location.href = "/pis/index.php?action=" + encodeURIComponent('service_record_delete')
            + "&id=" + encodeURIComponent($(this).attr('record_id'))
            + "&device_sn=" + encodeURIComponent($(this).attr('device_sn'))
            + "&device_type=" + encodeURIComponent($(this).attr('device_type'));
    });

});
    </script>
    <style>
body {
    margin-left: auto;
    margin-right: auto;
    line-height: 14px;
}
input[type=text] {
    width: 100%;
    border: none;
}
textarea {
    width: 100%;
    overflow-y: visible;
    resize: none;
    border: none;
}
    </style>
    <style media="print">
.no-print {
    display: none;
}
    </style>
</head>
<body>
    <a href="/pis/index.php" class="no-print">返回首页</a><br />
    <h3>[<?php echo $tplData['device']['device_type'] . '.' . $tplData['device']['device_sn']; ?>]设备详情</h3>
    <form action="/pis/index.php" method="POST">
    <table border="1" cellspacing="0" cellpading="0" width="1024">
        <input type="hidden" name="id" value="<?php echo $tplData['device']['id']; ?>" />
        <input type="hidden" name="device_type" value="<?php echo $tplData['device']['device_type']; ?>" />
        <input type="hidden" name="action" value="device_edit" />
        <tr>
            <td align="right" colspan="9">编号:<input type="text" name="sn" value="<?php echo $tplData['device']['sn']; ?>" style="width: 200px; border-bottom: 1px solid black;" /></td>
            <td rowspan="5" class="no-print">
            &nbsp;
            <?php if ($GLOBALS['role'] == '管理员') { ?>
            <input type="submit" name="submit" value="修改"/>
            <?php } ?>
            </td>
        </tr>
        <tr>
            <th rowspan="2">基本信息</th>
            <th>设备名称</th>
            <td><input type="text" name="device_name" value="<?php echo $tplData['device']['device_name']; ?>" /></td>
            <th>设备型号</th>
            <td><input type="text" name="device_model" value="<?php echo $tplData['device']['device_model']; ?>" /></td>
            <th>设备编号</th>
            <td><input type="text" name="device_sn" value="<?php echo $tplData['device']['device_sn']; ?>" /></td>
            <th>设备数量</th>
            <td><input type="text" name="device_amount" value="<?php echo $tplData['device']['device_amount']; ?>" /></td>
        </tr>
        <tr>
            <th>业主公司</th>
            <td colspan="2"><input type="text" name="owner_inc" value="<?php echo $tplData['device']['owner_inc']; ?>" /></td>
            <th>联系人及电话</th>
            <td colspan="2"><input type="text" name="owner_contact" value="<?php echo $tplData['device']['owner_contact']; ?>" /></td>
            <th>工令号</th>
            <td><input type="text" name="work_order" value="<?php echo $tplData['device']['work_order']; ?>" /></td>
        </tr>
        <tr>
            <th id="setup-record-title-cell" rowspan="<?php echo count(@$tplData['setup_records']) + 5; ?>">安装信息</th>
            <th>安装地址</th>
            <td colspan="2"><input type="text" name="setup_address" value="<?php echo $tplData['device']['setup_address']; ?>" /></td>
            <th>使用人及电话</th>
            <td colspan="2"><input type="text" name="use_person_contact" value="<?php echo $tplData['device']['use_person_contact']; ?>" /></td>
            <th>公司负责人</th>
            <td><input type="text" name="company_principle" value="<?php echo $tplData['device']['company_principle']; ?>" /></td>
        </tr>
        <tr>
            <th>进场时间</th>
            <td><input type="text" name="insite_time" value="<?php echo $tplData['device']['insite_time']; ?>" /></td>
            <th>动工时间</th>
            <td><input type="text" name="start_time" value="<?php echo $tplData['device']['start_time']; ?>" /></td>
            <th>使用时间</th>
            <td><input type="text" name="use_time" value="<?php echo $tplData['device']['use_time']; ?>" /></td>
            <th>验收时间</th>
            <td><input type="text" name="accept_time" value="<?php echo $tplData['device']['accept_time']; ?>" /></td>
        </tr>
    </form>
        <tr>
            <th colspan="2">参与单位</th>
            <th colspan="2">工作内容</th>
            <th colspan="2">现场负责人及电话</th>
            <th colspan="2">备注</th>
            <th class="no-print">操作</th>
        <tr>
        <?php
        if (isset($tplData['setup_records'])) {
            foreach ($tplData['setup_records'] as $record) {
        ?>
            <form action="/pis/index.php" method="POST">
        <tr>
            <input type="hidden" name="device_id" value="<?php echo $tplData['device']['id']; ?>" />
            <input type="hidden" name="device_sn" value="<?php echo $tplData['device']['device_sn']; ?>" />
            <input type="hidden" name="device_type" value="<?php echo $tplData['device']['device_type']; ?>" />
            <input type="hidden" name="action" value="setup_record_edit" />
            <input type="hidden" name="id" value="<?php echo $record['id']; ?>" />
            <td colspan="2"><textarea name="company" rows="5"><?php echo $record['company']; ?></textarea></td>
            <td colspan="2"><textarea name="job_content" rows="5"><?php echo $record['job_content']; ?></textarea></td>
            <td colspan="2"><textarea name="locale_owner_contact" rows="5"><?php echo $record['locale_owner_contact']; ?></textarea></td>
            <td colspan="2"><textarea name="remark" rows="5"><?php echo $record['remark']; ?></textarea></td>
            <td class="no-print">
            <input type="button" name="hide" class="hide-setup-record" value="隐藏" />
            <?php if ($GLOBALS['role'] == '管理员') { ?>
                <input type="submit" name="submit" value="修改" />
            <?php } ?>
            <?php if ($GLOBALS['role'] == '管理员') { ?>
                <br /><input type="button" name="delete" class="delete-setup-record" device_sn="<?php echo $tplData['device']['device_sn']; ?>" device_type="<?php echo $tplData['device']['device_type']; ?>" record_id="<?php echo $record['id']; ?>" value="删除" />
            <?php } ?>
            </td>
        </tr>
            </form>
        <?php
            }
        }
        ?>
        <tr>
            <form action="/pis/index.php" method="POST">
            <input type="hidden" name="device_id" value="<?php echo $tplData['device']['id']; ?>" />
            <input type="hidden" name="device_sn" value="<?php echo $tplData['device']['device_sn']; ?>" />
            <input type="hidden" name="device_type" value="<?php echo $tplData['device']['device_type']; ?>" />
            <input type="hidden" name="action" value="setup_record_add" />
            <td colspan="2"><textarea name="company" rows="5"></textarea></td>
            <td colspan="2"><textarea name="job_content" rows="5"></textarea></td>
            <td colspan="2"><textarea name="locale_owner_contact" rows="5"></textarea></td>
            <td colspan="2"><textarea name="remark" rows="5"></textarea></td>
            <td class="no-print">&nbsp;<?php if ($GLOBALS['role'] != '只读') {?><input type="submit" name="submit" value="添加" /><?php } ?></td>
            </form>
        </tr>
        <tr>
            <th id="product-record-title-cell" rowspan="<?php echo count(@$tplData['product_records']) + 3; ?>">产品信息</th>
            <th>名称</th>
            <th>规则/型号</th>
            <th>数量</th>
            <th colspan="2">生产厂家</th>
            <th>联系人及电话</th>
            <th colspan="2">备注</th>
            <th class="no-print">操作</th>
        <tr>
        <?php
        if (isset($tplData['product_records'])) {
            foreach ($tplData['product_records'] as $record) {
        ?>
        <tr>
            <form action="/pis/index.php" method="POST">
            <input type="hidden" name="device_id" value="<?php echo $tplData['device']['id']; ?>" />
            <input type="hidden" name="device_sn" value="<?php echo $tplData['device']['device_sn']; ?>" />
            <input type="hidden" name="device_type" value="<?php echo $tplData['device']['device_type']; ?>" />
            <input type="hidden" name="action" value="product_record_edit" />
            <input type="hidden" name="id" value="<?php echo $record['id']; ?>" />

            <td><textarea name="name" rows="5"><?php echo $record['name']; ?></textarea></td>
            <td><textarea name="specification" rows="5"><?php echo $record['specification']; ?></textarea></td>
            <td><textarea name="amount" rows="5"><?php echo $record['amount']; ?></textarea></td>
            <td colspan="2"><textarea name="company" rows="5"><?php echo $record['company']; ?></textarea></td>
            <td><textarea name="contact" rows="5"><?php echo $record['contact']; ?></textarea></td>
            <td colspan="2"><textarea name="remark" rows="5"><?php echo $record['remark']; ?></textarea></td>
            <td class="no-print">
            <input type="button" name="hide" class="hide-product-record" value="隐藏" />
            <?php if ($GLOBALS['role'] == '管理员') { ?>
                <input type="submit" name="submit" value="修改" />
            <?php } ?>
            <?php if ($GLOBALS['role'] == '管理员') { ?>
                <br /><input type="button" name="delete" class="delete-product-record" device_sn="<?php echo $tplData['device']['device_sn']; ?>" device_type="<?php echo $tplData['device']['device_type']; ?>" record_id="<?php echo $record['id']; ?>" value="删除" />
            <?php } ?>
            </td>
            </form>
            </form>
        </tr>
        <?php
            }
        }
        ?>
        <tr>
            <form action="/pis/index.php" method="POST">
            <input type="hidden" name="device_id" value="<?php echo $tplData['device']['id']; ?>" />
            <input type="hidden" name="device_sn" value="<?php echo $tplData['device']['device_sn']; ?>" />
            <input type="hidden" name="device_type" value="<?php echo $tplData['device']['device_type']; ?>" />
            <input type="hidden" name="action" value="product_record_add" />
            <td><textarea name="name" rows="5"></textarea></td>
            <td><textarea name="specification" rows="5"></textarea></td>
            <td><textarea name="amount" rows="5"></textarea></td>
            <td colspan="2"><textarea name="company" rows="5"></textarea></td>
            <td><textarea name="contact" rows="5"></textarea></td>
            <td colspan="2"><textarea name="remark" rows="5"></textarea></td>
            
            <td class="no-print">&nbsp;<?php if ($GLOBALS['role'] != '只读') {?><input type="submit" name="submit" value="添加" /><?php } ?></td>
            </form>
        </tr>
        <tr>
            <th id="process-record-title-cell" rowspan="<?php echo count(@$tplData['process_records']) + 3; ?>">过程信息</th>
            <th>时间</th>
            <th colspan="2">工作内容</th>
            <th colspan="2">困难及问题</th>
            <th colspan="2">备注</th>
            <th>签字</th>
            <th class="no-print">操作</th>
        <tr>
        <?php
        if (isset($tplData['process_records'])) {
            foreach ($tplData['process_records'] as $record) {
        ?>
        <tr>
            <form action="/pis/index.php" method="POST">
            <input type="hidden" name="device_id" value="<?php echo $tplData['device']['id']; ?>" />
            <input type="hidden" name="device_sn" value="<?php echo $tplData['device']['device_sn']; ?>" />
            <input type="hidden" name="device_type" value="<?php echo $tplData['device']['device_type']; ?>" />
            <input type="hidden" name="action" value="process_record_edit" />
            <input type="hidden" name="id" value="<?php echo $record['id']; ?>" />

            <td><textarea name="time" rows="5"><?php echo $record['time']; ?></textarea></td>
            <td colspan="2"><textarea name="content" rows="5"><?php echo $record['content']; ?></textarea></td>
            <td colspan="2"><textarea name="issue" rows="5"><?php echo $record['issue']; ?></textarea></td>
            <td colspan="2"><textarea name="remark" rows="5"><?php echo $record['remark']; ?></textarea></td>
            <td><textarea name="sign" rows="5"><?php echo $record['sign']; ?></textarea></td>
            <td class="no-print">
            <input type="button" name="hide" class="hide-process-record" value="隐藏" />
            <?php if ($GLOBALS['role'] == '管理员') { ?>
                <input type="submit" name="submit" value="修改" />
            <?php } ?>
            <?php if ($GLOBALS['role'] == '管理员') { ?>
                <br /><input type="button" name="delete" class="delete-process-record" device_sn="<?php echo $tplData['device']['device_sn']; ?>" device_type="<?php echo $tplData['device']['device_type']; ?>" record_id="<?php echo $record['id']; ?>" value="删除" />
            <?php } ?>
            </td>
            </form>
        </tr>
        <?php
            }
        }
        ?>
        <tr>
            <form action="/pis/index.php" method="POST">
            <input type="hidden" name="device_id" value="<?php echo $tplData['device']['id']; ?>" />
            <input type="hidden" name="device_sn" value="<?php echo $tplData['device']['device_sn']; ?>" />
            <input type="hidden" name="device_type" value="<?php echo $tplData['device']['device_type']; ?>" />
            <input type="hidden" name="action" value="process_record_add" />
            <td><textarea name="time" rows="5"></textarea></td>
            <td colspan="2"><textarea name="content" rows="5"></textarea></td>
            <td colspan="2"><textarea name="issue" rows="5"></textarea></td>
            <td colspan="2"><textarea name="remark" rows="5"></textarea></td>
            <td><textarea name="sign" rows="5"></textarea></td>
            
            <td class="no-print">&nbsp;<?php if ($GLOBALS['role'] != '只读') {?><input type="submit" name="submit" value="添加" /><?php } ?></td>
            </form>
        </tr>
        <tr>
            <th id="service-record-title-cell" rowspan="<?php echo count(@$tplData['service_records']) + 3; ?>">服务信息</th>
            <th>报修时间</th>
            <th colspan="3">问题描述</th>
            <th>责任人</th>
            <th>修复时间</th>
            <th colspan="2">判定结果</th>
            <th class="no-print">操作</th>
        <tr>
        <?php
        if (isset($tplData['service_records'])) {
            foreach ($tplData['service_records'] as $record) {
        ?>
        <tr>
            <form action="/pis/index.php" method="POST">
            <input type="hidden" name="device_id" value="<?php echo $tplData['device']['id']; ?>" />
            <input type="hidden" name="device_sn" value="<?php echo $tplData['device']['device_sn']; ?>" />
            <input type="hidden" name="device_type" value="<?php echo $tplData['device']['device_type']; ?>" />
            <input type="hidden" name="action" value="service_record_edit" />
            <input type="hidden" name="id" value="<?php echo $record['id']; ?>" />

            <td><textarea name="report_time" rows="5"><?php echo $record['report_time']; ?></textarea></td>
            <td colspan="3"><textarea name="issue" rows="5"><?php echo $record['issue']; ?></textarea></td>
            <td><textarea name="owner" rows="5"><?php echo $record['owner']; ?></textarea></td>
            <td><textarea name="fix_time" rows="5"><?php echo $record['fix_time']; ?></textarea></td>
            <td colspan="2"><textarea name="result" rows="5"><?php echo $record['result']; ?></textarea></td>
            <td class="no-print">
            <input type="button" name="hide" class="hide-service-record" value="隐藏" />
            <?php if ($GLOBALS['role'] == '管理员') { ?>
                <input type="submit" name="submit" value="修改" />
            <?php } ?>
            <?php if ($GLOBALS['role'] == '管理员') { ?>
                <br /><input type="button" name="delete" class="delete-service-record" device_sn="<?php echo $tplData['device']['device_sn']; ?>" device_type="<?php echo $tplData['device']['device_type']; ?>" record_id="<?php echo $record['id']; ?>" value="删除" />
            <?php } ?>
            </td>
            </form>
        </tr>
        <?php
            }
        }
        ?>
        <tr>
            <form action="/pis/index.php" method="POST">
            <input type="hidden" name="device_id" value="<?php echo $tplData['device']['id']; ?>" />
            <input type="hidden" name="device_sn" value="<?php echo $tplData['device']['device_sn']; ?>" />
            <input type="hidden" name="device_type" value="<?php echo $tplData['device']['device_type']; ?>" />
            <input type="hidden" name="action" value="service_record_add" />
            <td><textarea name="report_time" rows="5"></textarea></td>
            <td colspan="3"><textarea name="issue" rows="5"></textarea></td>
            <td><textarea name="owner" rows="5"></textarea></td>
            <td><textarea name="fix_time" rows="5"></textarea></td>
            <td colspan="2"><textarea name="result" rows="5"></textarea></td>
            
            <td class="no-print">&nbsp;<?php if ($GLOBALS['role'] != '只读') {?><input type="submit" name="submit" value="添加" /><?php } ?></td>
            </form>
        </tr>
    </table>

</body>
</html>
