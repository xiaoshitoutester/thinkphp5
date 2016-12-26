<?php
/**
 * Created by PhpStorm.
 * User: LuSonghua
 * Date: 2016/12/25
 * Time: 20:48
 */

namespace app\index\controller;
use app\common\model\Klass as KlassModel;
use app\common\model\Teacher as TeacherModel;
use think\Request;

class Klass extends Index
{
    public function index(){
        $klasses = KlassModel::paginate();
        $this->assign('klasses',$klasses);
        return $this->fetch();
    }

    // 添加班级
    public function add(){
        // 获取素所有教师的信息
        $teachers = TeacherModel::all();
        $this->assign('teachers',$teachers);
        return $this->fetch();
    }

    // 保存数据到klass表中
    public function save(){
        // 获取用户提交的数据
        $postData = Request::instance()->param();

        // 实例Klass对象
        $klass = new KlassModel();
        // 为klass对象赋值
        $klass->name = $postData['name'];
        $klass->teacher_id = $postData['teacher_id'];

        // 保存到数据库中,增加自动验证
        $status = $klass->validate(true)->save($klass->getData());
        if ($status){
            // 保存成功 跳转到index
            $this->success('增加成功',url('index'));
        }else{
            // 添加失败
            $this->error('增加失败：'.$klass->getError(),url('add'));
        }
    }

}