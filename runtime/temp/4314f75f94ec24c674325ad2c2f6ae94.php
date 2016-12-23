<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"D:\phpenv\Apache24\htdocs\thinkphp5\public/../application/index\view\teacher\add.html";i:1482486413;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>新增教师</title>
    <link type="text/css" rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
</head>
<body class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="insert" method="post" role="form" class="form-horizontal">
                <div class="form-group">
                    <label class="col-md-2 control-label">姓名：</label>
                    <div class="col-md-10">
                        <input type="text" name="name">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">用户名：</label>
                    <div class="col-md-10">
                        <input type="text" name="username">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">性别：</label>
                    <div class="col-md-1">
                        <select name="sex" class="form-control">
                            <option value="0">男</option>
                            <option value="1">女</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">邮箱：</label>
                    <div class="col-md-10">
                        <input type="text" name="email">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-10 col-md-offset-2">
                        <input type="submit" value="保存" class="btn btn-primary">
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>