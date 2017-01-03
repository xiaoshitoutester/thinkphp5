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
        $content = $this->getHtmlContent($this->getWebContent());
        // 利用正则表达式取出 新闻的时间，内容
        preg_match_all('/<div class="jin-flash_time">(\d{2}:\d{2}:\d{2})<\/div>.*?<h4>(.+?)<\/h4>/', $content, $datas);
        $news = array();
        foreach ($datas[1] as $key => $value){
            $tmp = array();
            $tmp['time'] = $value;
            $tmp['content'] = $datas[2][$key];
            array_push($news, $tmp);
        }
        $this->assign('news', $news);
        return $this->fetch();
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

    // 去除内容中空白字符
    private function getHtmlContent($content){
        $str = trim($content);
        $str = str_replace('\t', '', $str);
        $str = str_replace('\r\n', '', $str);
        $str = str_replace('\r', '', $str);
        $str = str_replace('\n', '', $str);
        return trim($str);
    }


}