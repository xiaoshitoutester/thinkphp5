<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2016/12/26
 * Time: 17:41
 */

namespace app\index\controller;
use app\common\model\Student as StudentModel;
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
}