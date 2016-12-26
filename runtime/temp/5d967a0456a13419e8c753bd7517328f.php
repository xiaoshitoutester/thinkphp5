<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:83:"D:\phpenv\Apache24\htdocs\thinkphp5\public/../application/index\view\klass\add.html";i:1482727353;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加班级</title>
    <link type="text/css" rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" action="<?php echo url('save'); ?>" method="post" role="form">
                <div class="form-group">
                    <label class="control-label col-md-2" for="name">班级名称：</label>
                    <div class="col-md-2">
                        <input type="text"  name="name" id="name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2" for="teacherId">辅导员：</label>
                    <div class="col-md-2">
                        <select name="teacher_id" id="teacherId" class="form-control">
                            <?php foreach($teachers as $teacher): ?>
                                <option value="<?php echo $teacher->getData('id'); ?>">
                                    <?php echo $teacher->getData('name'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-1 col-md-offset-2">
                        <input type="submit" value="保存" class="btn btn-primary">
                    </div>
                    <div>
                        <input type="reset" value="重置" class="btn btn-default">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>