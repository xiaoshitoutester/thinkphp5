<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"D:\phpenv\Apache24\htdocs\thinkphp5\public/../application/index\view\klass\index.html";i:1482742865;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>班级管理</title>
    <link type="text/css" rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <hr>
            <div class="row">
                <div class="col-md-8">
                    <form class="form-inline" action="<?php echo url(); ?>" method="get">
                        <div class="form-group">
                            <label class="sr-only" for="name">班级名称</label>
                            <input id="name" name="name" type="text" class="form-control" placeholder="班级名称" value="<?php echo input('get.name'); ?>">
                        </div>
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i>&nbsp;查询</button>
                    </form>
                </div>
                <div class="col-md-4 text-right">
                    <a href="<?php echo url('add'); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus"></i>&nbsp;新增</a>
                </div>
            </div>
            <hr>
            <table class="table table-hover table-bordered">
                <tr class="info">
                    <th>序号</th>
                    <th>班级名称</th>
                    <th>辅导员</th>
                    <th>创建时间</th>
                    <th>更新时间</th>
                    <th>操作</th>
                </tr>
                <?php foreach($klasses as $klass): ?>
                    <tr>
                        <td><?php echo $klass->getData('id'); ?></td>
                        <td><?php echo $klass->getData('name'); ?></td>
                        <td><?php echo $klass->getTeacher()->getData('name'); ?></td>
                        <td><?php echo $klass->getData('create_time'); ?></td>
                        <td><?php echo $klass->getData('update_time'); ?></td>
                        <td>
                            <a href="<?php echo url('delete?id='.$klass->getData('id')); ?>" class="btn btn-danger btn-sm">
                                <i class="glyphicon glyphicon-trash"></i>&nbsp;删除</a>&nbsp;
                            <a href="<?php echo url('edit?id='.$klass->getData('id')); ?>" class="btn btn-primary btn-sm">
                                <i class="glyphicon glyphicon-pencil"></i>&nbsp;修改</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <?php echo $klasses->render(); ?>
        </div>
    </div>
</div>
</body>
</html>