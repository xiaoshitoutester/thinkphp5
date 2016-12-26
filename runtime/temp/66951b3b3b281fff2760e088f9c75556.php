<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:87:"E:\phpenv\Apache24\htdocs\thinkphp5\public/../application/index\view\student\index.html";i:1482759566;}*/ ?>
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
                    <form role="form" action="<?php echo url(); ?>" method="get" class="form-inline">
                        <div class="form-group">
                            <label class="sr-only col=md-2" for="name">姓名</label>
                            <div class="col-md-2">
                                <input type="text" class="form-control" name="name" id="name" placeholder="姓名" value="<?php echo input('get.name'); ?>">
                            </div>
                        </div>
                        <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i>&nbsp;查询</button>

                    </form>
                </div>
                <div class="col-md-4 text-right">
                    <a href="#" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp;新增</a>
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
                        <td><?php echo $student->sex; ?></td>
                        <td><?php echo $student->getData('email'); ?></td>
                        <td><?php echo $student->Klass->name; ?></td>
                        <td><?php echo $student->Klass->Teacher->name; ?></td>
                        <td><?php echo $student->create_time; ?></td>
                        <td><?php echo $student->update_time; ?></td>
                        <td>
                            <a href="#" class="btn btn-danger  btn-sm"><i class="glyphicon glyphicon-trash"></i>&nbsp;删除</a>
                            <a href="<?php echo url('edit?id='.$student->getData('id')); ?>" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i>&nbsp;修改</a>
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