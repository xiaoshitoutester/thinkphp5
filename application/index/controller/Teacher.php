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
        $this->assign('nums',$countNums);
        $this->assign('teachers',$teachers);

        return $this->fetch();

    }

    // 向teacher表中插入数据
    public function insert(){
        $message = '';
        try{
            // 接收传入数据
            $postData = Request::instance()->post();

            $Teacher = new TeacherModel();

            // 为对象赋值
            $Teacher->name = $postData['name'];
            $Teacher->sex = $postData['sex'];
            $Teacher->username = $postData['username'];
            $Teacher->email = $postData['email'];
            $Teacher->password = $Teacher::encryptPassword($postData['password']);

            // 新增数据到teacher表 增加自动验证
            $res = $Teacher->validate(true)->save($Teacher->getData());

            // 反馈结果
            if ($res){
                return $this->success('用户'.$Teacher->username.'新增成功',url('index'));
            }else{
                $message = '新增失败'.$Teacher->getError();
            }
            // 捕获thinkphp内置的异常，向上抛出 让thinkphp处理
        } catch (\think\Exception\HttpResponseException $e){
            throw $e;
        } catch (\Exception $e){
            return "系统错误".$e->getMessage();
        }

        return $this->error($message);

    }

    // 添加teacher数据页面
    public function add(){
        try{
            return $this->fetch();
        }catch (\Exception $e){
            return "系统错误".$e->getMessage();
        }
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
        try{
            // 获取用户提交的id
            $id = Request::instance()->param('id/d');

            // 获取Id对应的记录
            $teacher = TeacherModel::get($id);
            if (is_null($teacher)){
                return $this->error("没有找到id为：".$id."的记录。");
            }
            $this->assign('teacher',$teacher->getData());
            return $this->fetch();
        }catch (\think\Exception\HttpResponseException $exception){
            throw $exception;
        }catch (\Exception $e){
            return "系统错误".$e->getMessage();
        }

    }

    // 更新数据
    public function update(){
        try{
            // 接收数据
            $postData = Request::instance()->param();

            // 将数据存入teacher标配
            $teacher = new TeacherModel();
            $state = $teacher->validate(true)->isUpdate(true)->save($postData);

            // 根据结果 提示信息
            if ($state){
                return $this->success('修改成功',url('index'));
            }else{
                return $this->error('修改失败'.$teacher->getError());
            }
        }catch (\think\Exception\HttpResponseException $exception){
            throw $exception;
        }catch (\Exception $e){
            return '系统错误'.$e->getMessage();
        }
    }


}