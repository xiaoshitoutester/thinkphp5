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
        $courseModel = new CourseModel();
        $this->assign('course',$courseModel);
        return $this->fetch();
    }

    // 保存数据到course表中
    public function save(){
        // 课程的名字,保存课程到course表中
        $courseModel = new CourseModel();
        $courseModel->name = Request::instance()->param('name');
        $status = $courseModel->validate(true)->save($courseModel->getData());
        if (!$status){
            return $this->error('添加失败：'.$courseModel->getError());
        }
        /* 第一种方法
        // -----将课程和班级的关系存入klass_course表中----
        // 将课程 和班级存放成二维数组
        //array(5) {[0] => array(2) {["klass_id"] => string(1) "1"["course_id"] => string(1) "8"}}
        // 接收klass_id数组
        $klassIds = Request::instance()->param('klass_id/a');
        if (!empty($klassIds)){
            $datas = array();
            foreach ($klassIds as $klassId){
                $data = array();
                $data['klass_id'] = $klassId;
                $data['course_id'] = $courseModel->id;
                array_push($datas,$data);
            }
        }
        // 利用saveall把二维数组的值保存到 klass_course表中
        if (!empty($datas)){
            $klassCourseModel = new KlassCourseModel();
            $status = $klassCourseModel->validate(true)->saveAll($datas);
            if (!$status){
                return $this->error('班级--课程表保存错误：'.$klassCourseModel->getError());
            }
            unset($klassCourseModel);// 释放$klassCourseModel变量
        }
        // -----------------------------------------------
        */
        // 第二种方法：新增课程-班级表
        $klassIds = Request::instance()->param('klass_id/a');
        if (!empty($klassIds)){
            if (!$courseModel->Klasses()->saveAll($klassIds)){
                return $this->error('班级--课程表保存错误：'.$courseModel->Klasses()->getError());
            }
        }
        unset($courseModel); // 释放$courseModel变量
        return $this->success('添加成功',url('index'));
    }

    public function test(){
        $test = new CourseModel();
        $result = $test->Klasses()->select();
        dump($result[5]);
        return ;
    }

    // 编辑页面
    public function edit(){
        $courseId = Request::instance()->param('id/d');
        $courseModel = CourseModel::get($courseId);
        $this->assign('course',$courseModel);
        return $this->fetch();
    }

    // 保存更新数据
    public function update(){
        // 获取id 的course对象
        $courseId = Request::instance()->param('id/d');
        if (is_null($courseModel = CourseModel::get($courseId))){
            return $this->error('不存在ID为：'.$courseId."的记录。");
        }
        // 更新课程名
        $courseModel->name = Request::instance()->param('name');
        if (!$courseModel->validate(true)->save()){
            return $this->error('更新课程名错误：'.$courseModel->getError());
        }

        // 删除关联表中course_id 为 id 的所有记录
        $where = ['course_id' => $courseId];
        // 执行删除操作，返回值为false，或者删除的条数，为0时 我们也认为删除成功
        if (false === $courseModel->KlassCourse()->where($where)->delete()){
            return $this->error('删除班级--课程关联表信息错误：'.$courseModel->KlassCourse()->getError());
        }

        // 向关联表中添加 course_id 和 klass_id 关联的记录
        $klassIds = Request::instance()->param('klass_id/a');
        if (!empty($klassIds)){
            if (!$courseModel->Klasses()->saveAll($klassIds)){
                return $this->error('班级--课程表保存错误：'.$courseModel->Klasses()->getError());
            }
        }

        return $this->success('更新成功',url('index'));
    }

    // 删除 course 课程记录
    public function delete(){
        // 获取id
        $courseId = Request::instance()->param('id/d');
        // 查找出 相关记录
        $courseModel = CourseModel::get($courseId);
        if (empty($courseModel)){
            return $this->error('不存在ID为：'.$courseId."的记录。");
        }
        // 然后删除
        if (!$courseModel->delete()){
            return $this->error('删除课程信息失败：'.$courseModel->getError());
        }

        return $this->error('删除成功',url('index'));
    }

}