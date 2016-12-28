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

    /*
     * 获取是否存在关联记录
     * @param object 班级
     * @return boolean
     */
    public function getIsChecked(&$Klass){
        // 获取课程id 班级id
        $courseId = $this->id;
        $klassId = $Klass->id;

        // 定制查询条件
        $map = array();
        $map['klass_id'] = $klassId;
        $map['course_id'] = $courseId;

        // 从关联表中获取信息
        $klassCourse = KlassCourse::get($map);
        // 没有查到关联信息返回false
        if (empty($klassCourse)){
            return false;
        }
        return true;
    }

    /*
     * 一对多关联
     */
    public function KlassCourse(){
        return $this->hasMany('KlassCourse');
    }
}