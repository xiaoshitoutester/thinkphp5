<?php
namespace app\index\controller;
use think\Controller;
use app\common\model\Teacher as TeacherModel;

class Index extends Controller
{
    public function __construct()
    {
        // 调用父类的构造函数
        parent::__construct();
        // 验证用户是否登录
        if (!TeacherModel::isLogin()){
            return $this->error('非法访问，请先登录',url('Login/index'));
        }
    }

}
