<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2016/12/27
 * Time: 16:07
 */

namespace app\index\controller;
use app\common\model\Course as CourseModel;
use think\Request;

class Course extends Index
{
    public function index(){
        $courseMode = CourseModel::all();
        $this->assign('courses',$courseMode);
        return $this->fetch();
    }

    // 新增课程页面
    public function add(){
        return $this->fetch();
    }

    // 保存数据到course表中
    public function save(){
        $postData = Request::instance()->param();
        dump($postData);
        return ;
    }

}