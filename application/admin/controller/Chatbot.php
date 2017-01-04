<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2017/1/4
 * Time: 9:40
 */

namespace app\admin\controller;


class Chatbot extends Index
{
    // 聊天机器人页面
    public function index(){
        $res = $this->getData();

        return $this->fetch();
    }

    // 获取数据
    public function getData(){
        $msg = input('msg');
        $appKey = "92eea6d6b9d03d20429fcb8e9a7bcdab";
        $url = 'http://op.juhe.cn/robot/index';

        $postData = array(
            'key' => $appKey,
            'info' => $msg,
            'dtype' => 'json',
            'userid' => 'L0'
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result);
    }

}