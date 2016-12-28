<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2016/12/26
 * Time: 17:39
 */

namespace app\common\model;
use think\Model;

/*
 * 学生表 student
 */
class Student extends Model
{
    /*
     * 输出学生的性别sex
     * 0 男 1 女
     */
    public function getSexAttr($value){
        $status = array('0'=>'男','1'=>'女');
        $sex = $status[$value];
        if (empty($sex)){
            // 为空 返回男
            return $value[0];
        }else{
            // 返回相应的性别
            return $sex;
        }
    }

    /*
     * 使用获取器
     * 返回 创建时间
     */
    public function getCreateTimeAttr($value){
        return date('Y-m-d H:i:s',$value);
    }

    /*
     * 使用获取器
     * 返回 更新时间
     */
    public function getUpdateTimeAttr($value){
        return date('Y-m-d H:i:s',$value);
    }

    /*
     * 相应的关联,多对1关联
     */
    public function Klass(){
        return $this->belongsTo('Klass');
    }

}