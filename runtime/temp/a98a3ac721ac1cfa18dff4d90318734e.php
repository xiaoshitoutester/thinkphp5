<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:86:"E:\phpenv\Apache24\htdocs\thinkphp5\public/../application/index\view\teacher\edit.html";i:1482553584;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>修改教师</title>
    <link type="text/css" rel="stylesheet" href="/static/bootstrap/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form action="<?php echo url('update'); ?>" method="post" role="form" class="form-horizontal">
                <div class="form-group">
                    <label class="control-label col-md-2">用户名</label>
                    <div class="col-md-10">
                        <input type="hidden" name="id" value="<?php echo $teacher['id']; ?>">
                        <input name="username" type="text" value="<?php echo $teacher['username']; ?>" readonly="readonly">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">姓名</label>
                    <div class="col-md-10">
                        <input name="name" type="text" value="<?php echo $teacher['name']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">性别</label>
                    <div class="col-md-1">
                        <select name="sex" class="form-control">
                            <option value="0" <?php if($teacher['sex'] == '0'): ?>selected="selected"<?php endif; ?>>男</option>
                            <option value="1" <?php if($teacher['sex'] == '1'): ?>selected="selected"<?php endif; ?>>女</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-2">邮箱</label>
                    <div class="col-md-10">
                        <input type="text" name="email" value="<?php echo $teacher['email']; ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-1 col-md-offset-2">
                        <input type="submit" value="保存" class="btn btn-primary">
                    </div>
                    <div>
                        <input type="button" value="取消" class="btn btn-danger">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>