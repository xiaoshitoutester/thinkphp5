<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2017/1/3
 * Time: 14:26
 */

namespace app\admin\controller;
use app\common\model\Message as MessageModel;

class Message extends Index
{
    // 留言板主页
    public function index()
    {
        $messages = MessageModel::showMessages();
        $this->assign('messages', $messages);
        return $this->fetch();
    }

    // 保存留言信息
    public function saveMessage(){
        $data = input();
        if (empty($data['message'])){
            return $this->error('留言内容为空，请重新输入',url('Message/index'));
        }
        if (!MessageModel::saveMessage($data['message'])){
            return $this->error('添加留言失败',url('Message/index'));
        }

        return $this->success('添加留言成功',url('Message/index'));
    }

}