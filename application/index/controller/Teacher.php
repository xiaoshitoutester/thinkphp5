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
        // 接收传入数据
        $postData = Request::instance()->post();

        $Teacher = new TeacherModel();

        // 为对象赋值
        $Teacher->name = $postData['name'];
        $Teacher->sex = $postData['sex'];
        $Teacher->username = $postData['username'];
        $Teacher->email = $postData['email'];

        // 新增数据到teacher表 增加自动验证
        $res = $Teacher->validate(true)->save($Teacher->getData());

        // 反馈结果
        if ($res){
            return "新增教师成功。ID为：".$Teacher->id;
        }else{
            return "新增失败：".$Teacher->getError();
        }

    }

    // 添加teacher数据页面
    public function add(){
        return $this->fetch();
    }

    // 测试验证功能
    public function test(){
        $data = array();
        $data['name'] = '123123';
        $data['username'] = 'xiaoshitou1';
        $data['sex'] = '0';
        $data['email'] = 'xiaoshitou1@qq.com';

        var_dump($this->validate($data,'Teacher'));
    }

    // 删除数据
    public function delete(){
        $id = Request::instance()->param('id/d');
        if (is_null($id) || $id === 0){
            return $this->error('为获取到ID信息');
        }

        // 获取删除对象
        $teacher = TeacherModel::get($id);

        // 删除的对象存在
        if (!is_null($teacher)){
            // 删除对象
            if ($teacher->delete()){
                return $this->success('删除成功',url('index'));
            }else{
                return $this->error('删除失败'.$teacher->getError());
            }
        }else{
            return $this->error('ID为:'.$id."的教师不存在，删除失败");
        }

        /*
         * 第二种删除的方式
         * 当批量删除时用第二种方式
         */
        /*
        if ($count = TeacherModel::destroy(2)){
            return "成功删除".$count."条";
        }
        return "删除失败";*/
    }
}