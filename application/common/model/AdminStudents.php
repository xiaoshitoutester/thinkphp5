<?php
/**
 * Created by PhpStorm.
 * User: LuSonghua
 * Date: 2017/1/4
 * Time: 21:29
 */

namespace app\common\model;
use think\Model;

class AdminStudents extends Model
{
    // 获取器 自动转化性别
    public function getSexAttr($val){
        $status = [
            0 => '男',
            1 => '女'
        ];
        return $status[$val];
    }

    // 自动转化创建时间，更新时间
    public function getCreateTimeAttr($val){
        return date('Y-m-d H:i:s',$val);
    }

    public function getUpdateTimeAttr($val){
        return date('Y-m-d H:i:s',$val);
    }

    // 获取AdminStudents表中的所有数据
    public static function getAllData(){
        return AdminStudents::where([])->order('id asc')->paginate(10);
    }

    // 删除记录
    public static function deleteRow($id){
        $adminStudents = AdminStudents::get($id);
        if ($adminStudents->delete()){
            return true;
        }
        return false;
    }

    // 新增或者更新数据
    public static function saveData($adminStudent){
        if ($adminStudent->save()){
            return true;
        }
        return false;
    }
}