<?php
/**
 * Created by PhpStorm.
 * User: LuSonghua
 * Date: 2016/12/25
 * Time: 20:48
 */

namespace app\index\controller;
use app\common\model\Klass as KlassModel;

class Klass extends Index
{
    public function index(){
        $klasses = KlassModel::paginate();
        $this->assign('klasses',$klasses);
        return $this->fetch();
    }

}