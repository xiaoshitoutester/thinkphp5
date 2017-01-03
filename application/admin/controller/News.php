<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2017/1/3
 * Time: 16:19
 */

namespace app\admin\controller;


class News extends Index
{
    // 新闻首页
    public function index(){
        $content = $this->getWebContent();
        preg_match_all('/(\d{2}:\d{2}:\d{2})/', $content, $times);
        preg_match_all('/<h4>(.+?)<\/h4>/', $content, $datas);
//        $this->assign('content', $content);
//        return $this->fetch();
        return dump($datas);
    }

    //获取新闻内容
    private function getWebContent(){
        // 初始化
        $ch = curl_init();
        // 配置选项
        curl_setopt($ch, CURLOPT_URL, "https://www.jin10.com/");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); //不验证证书
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); //不验证证书
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }


}