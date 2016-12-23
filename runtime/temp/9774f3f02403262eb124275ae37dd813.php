<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"D:\phpenv\Apache24\htdocs\thinkphp5\public/../application/index\view\teacher\index.html";i:1482461529;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>教室管理</title>
    <link type="text/css" rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
</head>
<body class="container">
    <div class="row">
        <div class="col-md-12">
            <table class="table table-hover table-bordered">
                <tr>
                    <th>序号</th>
                    <th>姓名</th>
                    <th>性别</th>
                    <th>用户名</th>
                    <th>邮箱</th>
                    <th>创建时间</th>
                    <th>更新时间</th>
                </tr>
                <?php foreach($teachers as $teacher): ?>
                <tr>
                    <td><?php echo $teacher['id']; ?></td>
                    <td><?php echo $teacher['name']; ?></td>
                    <td><?php if($teacher['sex'] == '0'): ?>男<?php else: ?>女<?php endif; ?></td>
                    <td><?php echo $teacher['username']; ?></td>
                    <td><?php echo $teacher['email']; ?></td>
                    <td><?php echo $teacher['create_time']; ?></td>
                    <td><?php echo $teacher['update_time']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</body>
</html>