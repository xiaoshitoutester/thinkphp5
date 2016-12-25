<?php
/**
 * Created by PhpStorm.
 * User: LuSonghua
 * Date: 2016/12/25
 * Time: 20:46
 */

namespace app\common\model;
use think\Model;
/*
 * 班级
 */

class Klass extends Model
{
    private $teacher;

    /*
     * 根据teacher_id
     * 返回一个teacher对象
     */
    public function getTeacher(){
        if (is_null($this->teacher)){
            $teacherId = $this->getData('teacher_id');
            $this->teacher = Teacher::get($teacherId);
        }
        // 返回的是一个teacher对象
        return $this->teacher;
    }

}