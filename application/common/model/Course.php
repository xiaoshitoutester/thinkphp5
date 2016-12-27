<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2016/12/27
 * Time: 16:06
 */

namespace app\common\model;
use think\Model;

/*
 * 课程表
 */
class Course extends Model
{
    /*
     * 课程 -- 班级多对多自动关联
     */
    public function Klasses(){
        return $this->belongsToMany('Klass',config('database.prefix').'klass_course');
    }

}