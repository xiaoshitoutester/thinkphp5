<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"E:\phpenv\Apache24\htdocs\thinkphp5\public/../application/index\view\student\edit.html";i:1482761980;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改学生信息</title>
    <link type="text/css" rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form class="form-horizontal" action="<?php echo url('save'); ?>" method="post" role="form">
                <div class="form-group">
                    <label class="control-label col-md-2" for="name">姓名：</label>
                    <div class="col-md-3">
                        <input type="hidden" name="id" value="<?php echo $student->getData('id'); ?>">
                        <input type="text" name="name" id="name" class="form-control" value="<?php echo $student->getData('name'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2" for="num">学号：</label>
                    <div class="col-md-3">
                        <input type="text" name="num" id="num" class="form-control" value="<?php echo $student->getData('num'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">性别：</label>
                    <div class="col-md-10">
                        <div class="radio col-md-1">
                            <label>
                                <input type="radio" name="sex" value="0" <?php if($student->getData('sex') == '0'): ?>checked="checked"<?php endif; ?>>男
                            </label>
                        </div>
                        <div class="radio col-md-1">
                            <label>
                                <input type="radio" name="sex" value="1" <?php if($student->getData('sex') == '1'): ?>checked="checked"<?php endif; ?>>女
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2" for="klassId">班级：</label>
                    <div class="col-md-3">
                        <select name="klass_id" id="klassId" class="form-control">
                            <option value="">全部</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2" for="email">邮箱：</label>
                    <div class="col-md-3">
                        <input type="text" name="email" id="email" class="form-control" value="<?php echo $student->getData('email'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2 col-md-offset-2">
                        <input type="submit" value="保存" class="btn btn-primary">
                    </div>
                    <div>
                        <input type="reset" value="重置" class="btn btn-danger">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>