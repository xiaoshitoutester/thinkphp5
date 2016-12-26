<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2016/12/26
 * Time: 9:35
 */

namespace app\index\controller;
use app\common\model\Teacher as TeacherModel;

class Test
{
    public function test(){
        return TeacherModel::encryptPassword('123456');
    }

}