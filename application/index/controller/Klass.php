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
        // 接收按照班级名称来查询的name
        $selectName = Request::instance()->param('name');
        $klass = new KlassModel();
        // 定制查询条件
        if (!is_null($klass)){
            $klass->where('name','like','%'.$selectName.'%');
        }
        // 分页
        $klasses = $klass->paginate(8, false, [
            'query'=>[
                'name' => $selectName,
            ],
        ]);
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

    // 修改班级页面
    public function edit(){
        // 获取素所有教师的信息
        $teachers = TeacherModel::all();
        $this->assign('teachers',$teachers);

        // 获取需要修改班级的信息，根据id
        $klassId = Request::instance()->param('id');
        $klass = KlassModel::get($klassId);
        if (!$klass){
            return $this->error('系统未找到ID为：'.$klassId.'的记录');
        }
        $this->assign('klass',$klass);
        return $this->fetch();
    }

    // 更新修改班级信息
    public function update(){
        $postData = Request::instance()->param();
        // 将修改的信息 保存到klass表中
        $klass = new KlassModel();
        $state = $klass->validate(true)->isUpdate(true)->save($postData);
        // 根据结果 提示信息
        if ($state){
            return $this->success('修改成功',url('index'));
        }else{
            return $this->error('修改失败'.$klass->getError());
        }
    }

    // 删除班级信息
    public function delete(){
        $id = Request::instance()->param('id/d');
        // 获取删除对象
        $klass = KlassModel::get($id);
        if (!is_null($klass)){
            // id存在
            if ($klass->delete()){
                return $this->success('删除成功',url('index'));
            }
        }
        // id不存在或者删除失败
        return $this->error('删除失败');
    }

}