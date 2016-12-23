<?php
namespace app\index\controller;
use think\Db;

class Index
{
    public function index()
    {
        $teachers = Db::name('teacher')->select();
        return dump($teachers);
    }

    public function test(){
        return "ok";
    }

}
