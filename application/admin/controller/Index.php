<?php

/**
 * Created by PhpStorm.
 * User: LuSonghua
 * Date: 2017/1/1
 * Time: 17:01
 */
namespace app\admin\controller;
use think\Input;
use think\Controller;
use Captcha;

class index extends Controller
{
    public function index(){
        return $this->fetch();
    }

}