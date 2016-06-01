<html>
<head>
    <title>用户管理</title>
</head>
<body>
    <a href="/pis/index.php">返回首页</a>
    <h3>新增用户</h3>
    <form action="/pis/index.php" method="GET">
        <input type="hidden" name="action" value="user_add" />
        用户名: <input type="text" name="name"/>
        密码: <input type="text" name="passwd"/>
        角色: <select name="role">
            <option value="管理员">管理员</option>
            <option value="录入员" selected>录入员</option>
            <option value="只读">只读</option>
        </select>
        <input type="submit" name="submit" value="添加"/>
    </form>
    <br />

    <h3>管理用户</h3>
    <?php foreach ($tplData['users'] as $user) { ?>
        <form action="/pis/index.php" method="GET">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>" />
            <input type="hidden" name="action" value="user_modify" />
            用户名: <input type="text" name="name" value="<?php echo $user['name']; ?>" />
            密码: <input type="text" name="passwd" value="<?php echo $user['passwd']; ?>" />
            角色: <select name="role">
                <option value="管理员" <?php if ($user['role'] == '管理员') {echo 'selected';} ?>>管理员</option>
                <?php if ($user['id'] != 1) { ?>
                <option value="录入员" <?php if ($user['role'] == '录入员') {echo 'selected';} ?>>录入员</option>
                <option value="只读" <?php if ($user['role'] == '只读') {echo 'selected';} ?>>只读</option>
                <?php } ?>
            </select>
            <input type="submit" name="submit" value="修改"/>
            <?php if ($user['id'] != 1) { ?>
            <a href="/pis/index.php?action=user_del&id=<?php echo $user['id']; ?>"><input type="button" name="del" value="删除"/></a>
            <?php } ?>
        </form>
    <?php } ?>
</body>
</html>
