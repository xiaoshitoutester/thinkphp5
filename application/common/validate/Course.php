<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2016/12/27
 * Time: 16:06
 */

namespace app\common\validate;
use think\Validate;

class Course extends Validate
{
    protected $rule = [
        'name' => 'require',

    ];

}