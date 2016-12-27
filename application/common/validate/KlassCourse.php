<?php
/**
 * Created by PhpStorm.
 * User: LuSonghua
 * Date: 2016/12/27
 * Time: 21:17
 */

namespace app\common\validate;
use think\Validate;

class KlassCourse extends Validate
{
    protected $rule = [
        'course_id' => 'require|number',
        'klass_id' => 'require|number',
    ];

}