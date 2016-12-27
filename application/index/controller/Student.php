<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2016/12/26
 * Time: 17:41
 */

namespace app\index\controller;
use app\common\model\Student as StudentModel;
use app\common\model\Klass as KlassModel;
use think\Request;

class Student extends Index
{
    public function Index(){
        // 接收查询条件name的值
        $selectName = Request::instance()->param('name');

        // 获取所有的学生
        $studentModel = new StudentModel();
        //组装查询条件
        if (!empty($selectName)){
            $studentModel->where('name','like','%'.$selectName.'%');
        }
        // 分页获取数据
        $students = $studentModel->paginate(8, false, [
            'query'=>[
                'name' => $selectName,
            ],
        ]);
        // 将数据传递给View层
        $this->assign('students',$students);
        return $this->fetch();
    }

    // 修改学生页面
    public function edit(){
        $id = Request::instance()->param('id/d');
        $student = StudentModel::get($id);
        $this->assign('student',$student);
        return $this->fetch();
    }

    // 保存修改的值到student表
    public function update(){
        // 接收数据
        $postData = Request::instance()->param();
        // 将修改的数据保存到student表中
        $studentModel = new StudentModel();
        // 自动验证
        $status = $studentModel->validate(true)->isUpdate(true)->save($postData);
        if ($status){
            $this->success('修改成功',url('index'));
        }
        $this->error('修改失败：'.$studentModel->getError());
    }

    // 删除student
    public function delete(){
        $id = Request::instance()->param('id/d');
        // 获取$id的student
        $studentModel = StudentModel::get($id);
        if (empty($studentModel)){
            return $this->error('删除失败，没有找到ID为：'.$id.'的记录');
        }
        $status = $studentModel->delete();
        if ($status){
            return $this->success('删除成功',url('index'));
        }
        return $this->error('删除失败：'.$studentModel->getError());

    }

    // 新增student页面
    public function add(){
        $klasses = KlassModel::all();
        $this->assign('klasses',$klasses);
        return $this->fetch();
    }

    // 报错新增的student到student表中
    public function save(){
        $postData = Request::instance()->param();

        // 给对象赋值
        $studentModel = new StudentModel();
        $studentModel->name = $postData['name'];
        $studentModel->num = $postData['num'];
        $studentModel->sex = $postData['sex'];
        $studentModel->klass_id = $postData['klass_id'];
        $studentModel->email = $postData['email'];
        // 保存到student表中
        $status = $studentModel->validate(true)->save($studentModel->getData());
        // 处理保存结果
        if ($status){
            return $this->success('新增成功',url('index'));
        }
        return $this->error('新增失败：'.$studentModel->getError());
    }
}