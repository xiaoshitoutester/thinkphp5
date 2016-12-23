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


class Teacher extends Controller
{
    public function index(){
        $teacher = new TeacherModel();
        // teacher 表中所有的数据
        $teachers = $teacher->select();
        $this->assign('teachers',$teachers);

        return $this->fetch();
    }

    public function insert(){
        $Teacher = new TeacherModel();

        // 为对象赋值
        $Teacher->name = "流年";
        $Teacher->sex = "0";
        $Teacher->username = "xiaoshitou";
        $Teacher->email = "xiaoshitou@qq.com";
//        $Teacher->create_time = time();
//        $Teacher->update_time = time();

        // 保存数据
        $Teacher->save();

        return "新增成功".$Teacher->id;
    }
}