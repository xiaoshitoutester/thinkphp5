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
        return AdminStudents::where([])->select();
    }

}