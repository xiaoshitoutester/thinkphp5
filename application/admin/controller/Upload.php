<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2017/1/4
 * Time: 15:34
 */

namespace app\admin\controller;


class Upload extends Index
{
    // 上传文件页面
    public function index(){
        return $this->fetch();
    }

    // 处理上传文件请求
    public function upload(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('file');
        // 移动到框架应用根目录/public/uploads/ 目录下
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            return "上传成功";
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }

}