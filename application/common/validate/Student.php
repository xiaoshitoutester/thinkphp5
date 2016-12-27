<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2016/12/27
 * Time: 10:08
 */

namespace app\common\validate;
use think\Validate;

class Student extends Validate
{
    protected $rule = [
        'name' => 'require',
        'num' => 'require|unique:student',
        'sex' => 'require|number|between:0,1',
        'klass_id' => 'require|number',

    ];

}