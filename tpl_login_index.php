<html>
<head>
    <title>用户登陆</title>
</head>
<body>
    <a href="/pis/index.php">返回首页</a><br />
    <form action="/pis/index.php" method="GET">
        <input type="hidden" name="action" value="login" />

        用户名:<input type="text" name="name" value="" /><br />
        密码:<input type="text" name="passwd" value="" /><br />

        <input type="submit" name="submit" value="登陆"/>
    </form>

</body>
</html>
