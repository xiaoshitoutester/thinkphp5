<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2016/12/22
 * Time: 16:43
 */

namespace app\index\controller;
use app\common\model\Teacher as TeacherModel;
use think\Controller;
use think\Request;


class Teacher extends Controller
{
    // 显示teacher表中的所有数据
    public function index(){
        $teacher = new TeacherModel();
        // teacher 表中所有的数据
        $teachers = $teacher->select();
        $this->assign('teachers',$teachers);

        return $this->fetch();
    }

    // 向teacher表中插入数据
    public function insert(){
        $postData = Request::instance()->post();
        dump($postData);
        return ;
        $Teacher = new TeacherModel();

        // 为对象赋值
        $Teacher->name = "流年";
        $Teacher->sex = "0";
        $Teacher->username = "xiaoshitou";
        $Teacher->email = "xiaoshitou@qq.com";

        // 保存数据
        $Teacher->save();

        return "新增成功".$Teacher->id;
    }

    // 添加teacher数据页面
    public function add(){
        return $this->fetch();
    }
}