<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"D:\phpenv\Apache24\htdocs\thinkphp5\public/../application/index\view\student\index.html";i:1482746457;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>学生管理</title>
    <link type="text/css" rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <hr>
            <div class="row">
                <div class="col-md-8">
                    <form role="form" action="<?php echo url(); ?>" method="post" class="form-inline">
                        <label class="sr-only">姓名</label>
                    </form>
                </div>
            </div>
            <hr>
            <table class="table table-hover table-bordered">
                <tr class="info">
                    <th>序号</th>
                    <th>姓名</th>
                    <th>学号</th>
                    <th>性别</th>
                    <th>邮箱</th>
                    <th>班级</th>
                    <th>辅导员</th>
                    <th>创建时间</th>
                    <th>更新时间</th>
                    <th>操作</th>
                </tr>
                <?php foreach($students as $student): ?>
                    <tr>
                        <td><?php echo $student->getData('id'); ?></td>
                        <td><?php echo $student->getData('name'); ?></td>
                        <td><?php echo $student->getData('num'); ?></td>
                        <td><?php echo $student->getData('sex'); ?></td>
                        <td><?php echo $student->getData('email'); ?></td>
                        <td><?php echo $student->getData('klass_id'); ?></td>
                        <td></td>
                        <td><?php echo $student->getData('create_time'); ?></td>
                        <td><?php echo $student->getData('update_time'); ?></td>
                        <td>
                            <a>修改</a>
                            <a>删除</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php echo $students->render(); ?>
        </div>
    </div>
</div>
</body>
</html>