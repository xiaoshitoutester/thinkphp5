<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2016/12/26
 * Time: 13:44
 */

namespace app\common\validate;
use think\Validate;

class Klass extends Validate
{
    protected $rule = [
        'name' => 'require|unique:klass',
        'teacher_id' => 'require|number'
        ];

}