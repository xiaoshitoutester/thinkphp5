<?php
/**
 * Created by PhpStorm.
 * User: LuSonghua
 * Date: 2016/12/23
 * Time: 21:03
 */

namespace app\common\validate;
use think\Validate;

class Teacher extends Validate
{
    protected $rule = [
        'email' => 'require|email',
        'username' => 'require|unique:teacher',
        'name' => 'require',
        'sex' => 'number|between:0,1',
    ];
}