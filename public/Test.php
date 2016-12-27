<?php

/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2016/12/27
 * Time: 15:05
 */

class Test
{
    private $data = array(
        'name' => '张三',
        'sex'   => '0'
    );

    public function __get($name)
    {
        // 校验在$this->data中是否存在这个健值。
        // 如果存在，即返回，如果不存在，则返回$this->data整个数组。
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        } else {
            return $this->data;
        }
    }
}

$Test = new Test();
echo $Test->name;
echo $Test->sex;
var_dump($Test->hello);