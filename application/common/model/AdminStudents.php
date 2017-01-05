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
    // 获取AdminStudents表中的所有数据
    public static function getAllData(){
        return AdminStudents::where([])->order('id asc')->paginate(5);
    }

    // 删除记录
    public static function deleteRow($id){
        $adminStudents = AdminStudents::get($id);
        if ($adminStudents->delete()){
            return true;
        }
        return false;
    }
}