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
use app\common\model\KlassCourse as KlassCourseModel;

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

}