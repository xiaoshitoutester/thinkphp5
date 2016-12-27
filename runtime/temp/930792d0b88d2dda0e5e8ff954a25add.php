<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:85:"D:\phpenv\Apache24\htdocs\thinkphp5\public/../application/index\view\student\add.html";i:1482818291;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>新增学生</title>
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
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2" for="num">学号：</label>
                    <div class="col-md-3">
                        <input type="text" name="num" id="num" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">性别：</label>
                    <div class="col-md-10">
                        <div class="col-md-1 radio">
                            <label>
                                <input type="radio" name="sex" value="0" checked="checked">男
                            </label>
                        </div>
                        <div class="col-md-1 radio">
                            <label>
                                <input type="radio" name="sex" value="1">女
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-2 control-label">班级：</label>
                    <div class="col-md-3">
                        <select name="klass_id" class="form-control">
                            <option value="">全部</option>
                            <?php foreach($klasses as $klass): ?>
                                <option value="<?php echo $klass->id; ?>"><?php echo $klass->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2" for="email">邮箱：</label>
                    <div class="col-md-3">
                        <input type="text" name="email" id="email" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-1 col-md-offset-2">
                        <input type="submit" value="保存" class="btn btn-primary">
                    </div>
                    <div class="col-md-1 col-md-offset-1">
                        <input type="reset" value="重置" class="btn btn-danger">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>