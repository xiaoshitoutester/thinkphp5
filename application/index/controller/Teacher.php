<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2016/12/22
 * Time: 16:43
 */

namespace app\index\controller;
use app\common\model\Teacher as TeacherModel;
use think\Request;


class Teacher extends Index
{
    // 显示teacher表中的所有数据
    public function index(){
        // 验证是谁登录了
        $loginName = TeacherModel::loginUser();
        // 如果loginName为空 跳转到登录页面
        if (is_null($loginName)){
            return $this->error('非法访问,请登录',url('Login/index'));
        }
        // 接收name
        $name = Request::instance()->param('name');

        // 每页显示的数据
        $pageSize = 8;
        // 实例化teacher
        $teacher = new TeacherModel();
        // 获取所有的记录数
        $countNums = $teacher->count();

        // 定制查询条件
        if (!empty($name)){
            $teacher->where('name','like','%'.$name.'%');
        }
        // 调用分页
        $teachers = $teacher->paginate($pageSize, false, [
            'query'=>[
                'name' => $name,
            ],
        ]);
        // 向View传输数据
        $this->assign('loginName',$loginName);
        $this->assign('nums',$countNums);
        $this->assign('teachers',$teachers);

        return $this->fetch();

    }

    // 向teacher表中插入数据
    public function save(){
        $teacher = new TeacherModel();
        // 给teacher的密码设置默认值
        $teacher->password = $teacher->encryptPassword('123456');
        // 新增数据
        if (false === $this->saveTeacher($teacher)){
            return $this->error('新增失败：'.$teacher->getError());
        }
        return $this->success('新增成功',url('index'));

    }

    // 添加teacher数据页面
    public function add(){
        // 实例化
        $teacher = new TeacherModel();
        // 设置默认值
        $teacher->id = '';
        $teacher->name = '';
        $teacher->sex = 1;
        $teacher->username = '';
        $teacher->email = '';
        $this->assign('teacher',$teacher);
        // 调用edit模版
        return $this->fetch('edit');
    }


    // 删除数据
    public function delete(){
        try{
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
            // 直接向向上抛出让thinkphp自己处理
        }catch (\think\Exception\HttpResponseException $exception){
            throw $exception;
        }catch (\Exception $e){
            return '系统错误'.$e->getMessage();
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

    // 修改action
    public function edit(){
        // 获取用户提交的id
        $id = Request::instance()->param('id/d');

        // 获取Id对应的记录
        $teacher = TeacherModel::get($id);
        if (is_null($teacher)){
            return $this->error("没有找到id为：".$id."的记录。");
        }
        $this->assign('teacher',$teacher);
        return $this->fetch();

    }

    // 更新数据
    public function update()
    {
        // 接收数据 id
        $updateId = Request::instance()->param('id/d');
        // 获取teacher对象
        $teacher = TeacherModel::get($updateId);
        // 更新数据到teacher表
        if (!empty($teacher)) {
            if (false === $this->saveTeacher($teacher, true)) {
                return $this->error('修改失败：' . $teacher->getError());
            }
        } else {
            return $this->error('不存在ID为：' . $updateId);
        }

        return $this->success('修改成功', url('index'));
    }

    // 重构save 和 update方法：保存Teacher数据到数据库
    /*
     * @param $teacher teacher对象
     * @isUpdate 是否更新,默认值false
     * @return false|intenger
     */
    private function saveTeacher($teacher, $isUpdate = false){
        // 需要写入的数据
        if (!$isUpdate){
            $teacher->username = input('username');
        }
        $teacher->name = input('name');
        $teacher->sex = input('sex');
        $teacher->email = input('email');
        // 保存或者更新
        return $teacher->validate(true)->save($teacher->getData());
    }

    // 测试方法
    public function test(){
        return dump($this->request->action());
    }


}