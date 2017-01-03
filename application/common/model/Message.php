<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2017/1/3
 * Time: 14:53
 */

namespace app\common\model;
use think\Model;

class Message extends Model
{
    // 查出所有的留言信息
    public static function showMessages(){
        return Message::where([])->order('id desc')->select();
    }

    // 保存留言
    public static function saveMessage($message){
        $msg = new Message();
        $msg->message = $message;
        if ($msg->save()){
            return true;
        }
        return false;
    }

}