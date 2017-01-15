<?php
/**
 * Created by PhpStorm.
 * User: LSH
 * Date: 2017/1/12
 * Time: 10:41
 */

namespace app\admin\controller;
use app\common\model\User as UserModel;
use think\Request;

class User extends Index
{
    /*
     * 用户管理模块
     */
    // 用户首页
    public function index(){
        // 初始化查询条件
        $conditon = array();
        $users = User::read($conditon);
        $this->assign('numbers',count($users));
//        return dump($users);
        $this->assign('users',$users);
        return $this->fetch();
    }

    // 新增用户
    public function add(){
        if (Request::instance()->isAjax() && input('type') == 'add'){
            $datas = input();
            // 实例对象
            $userModel = new UserModel();
            // 获取用户名和密码
            $userModel->username = $datas['username'];
            $userModel->password = md5($datas['password']);
            // 向user表中添加数据
            if ($userModel->save()){
                // 想关联表：usermsg保存姓名和电话号码
                $data['name'] = $datas['name'];
                $data['phone'] = $datas['phone'];
                if ($userModel->usermsg()->save($data)){
                    // 两张表都添加成功
                    $res['code'] = 200;
                    $res['message'] = '新增成功';
                    return $res;
                }
            }
        }
        // 添加失败
        $res['code'] = 500;
        $res['message'] = '新增失败';
        return $res;
    }

    // 读取用户信息
    protected static function read($condition,$usermsgConditon=array()){
        $users = UserModel::where($condition)->select();
        $datas = array();
        foreach ($users as $user){
            $userModel = UserModel::get($user['id'],'usermsg');
            if (!empty($userModel)){
                $tmp = array();
                // 给tmp数组赋值
                $tmp['id'] = $userModel->id;
                $tmp['username'] = $userModel->username;
                $tmp['name'] = $userModel->usermsg->name;
                $tmp['address'] = $userModel->usermsg->address;
                $tmp['phone'] = $userModel->usermsg->phone;
                // 过滤usermsg表
                if (!empty($usermsgConditon)){
                    $addFlag = true;
                    foreach ($usermsgConditon as $name=>$value){
                        // 过滤条件,任何一个条件不满足时，返回false，退出循环
                        if ($userModel->usermsg->$name !== $value) {
                            $addFlag = false;
                            break;
                        }
                    }
                    if ($addFlag){
                        // 将需要展示的数据存入到datas数组中
                        array_push($datas, $tmp);
                    }

                }else{
                        // 将需要展示的数据存入到datas数组中
                        array_push($datas,$tmp);
                    }

            }
        }
        return $datas;
    }

    // 修改
    public function edit(){
        if (Request::instance()->isAjax() && input('type') == 'edit'){
            $datas = input();
            // 实例对象
            $userModel = UserModel::find($datas['id']);
            // // 想关联表：usermsg保存姓名,电话号码,地址
            $userModel->usermsg->name = $datas['name'];
            $userModel->usermsg->phone = $datas['phone'];
            $userModel->usermsg->address = $datas['address'];
            if ($userModel->usermsg->save()){
                $res['code'] = 200;
                $res['message'] = '修改成功';
                return $res;
            }
        }
        // 修改失败
        $res['code'] = 500;
        $res['message'] = '修改失败';
        return $res;
    }

    // 删除  关联删除
    public function delete(){
        if (Request::instance()->isAjax() && input('type') == 'delete'){
            $userModel = UserModel::get(input('id'));
            if (!empty($userModel)){
                // 删除user表的数据
                if ($userModel->delete()){
                    // 删除关联表usermsg表的数据
                    if ($userModel->usermsg->delete()){
                        $res['code'] = 200;
                        $res['message'] = '删除成功';
                        return json($res);
                    }
                }
            }
        }

        // 删除失败
        $res['code'] = 500;
        $res['message'] = '删除失败';
        return json($res);
    }

    // 专门处理条件查询
    public function search(){
        if (Request::instance()->isAjax()){
            // 如果是表单提交的post请求，处理查询
            $conditon = array();
            $usermsgConditon = array();
            $datas = input();
            if (!empty($datas['select_username'])){
                $conditon['username'] = $datas['select_username'];
            }
            if (!empty($datas['select_name'])){
                $usermsgConditon['name'] = $datas['select_name'];
            }
            if (!empty($datas['select_phone'])){
                $usermsgConditon['phone'] = $datas['select_phone'];
            }
            $users = User::read($conditon, $usermsgConditon);
            $this->assign('numbers',count($users));
            $this->assign('users',$users);
            return $this->fetch();
        }
    }

    // excel表导出
    public function exportExcel(){
        //创建一个读Excel模板的对象
        $objPHPExcel= new \PHPExcel();
        //获取当前活动的表
        $objActSheet=$objPHPExcel->getActiveSheet();
        $objActSheet->setTitle('用户信息');//设置excel的标题
        $objActSheet->mergeCells('A1:D1');// 合并单元格
        $objActSheet->setCellValue('A1','用户信息导出');
        // 居中
        $objActSheet->getStyle('A1')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objActSheet->mergeCells('A2:D2');
        $objActSheet->setCellValue('A2',date('Y-m-d H:i:s'));
        // 右对齐
        $objActSheet->getStyle('A2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //现在开始输出列头了
        $objActSheet->setCellValue('A3','用户名');
        $objActSheet->setCellValue('B3','姓名');
        $objActSheet->setCellValue('C3','电话');
        $objActSheet->setCellValue('D3','地址');

        //现在就开始填充数据了 （从数据库中）
        $baseRow = 4; //数据从N-1行开始往下输出 这里是避免头信息被覆盖
        //开始获取数据
        $conditon = array();
        $usermsgConditon = array();
        $datas = input();
        if (!empty($datas['select_username'])){
            $conditon['username'] = $datas['select_username'];
        }
        if (!empty($datas['select_name'])){
            $usermsgConditon['name'] = $datas['select_name'];
        }
        if (!empty($datas['select_phone'])){
            $usermsgConditon['phone'] = $datas['select_phone'];
        }
        $list = self::read($conditon, $usermsgConditon);
        //结束获取数据
        foreach ( $list as $r => $dataRow ) {
            $row = $baseRow + $r;
            //将数据填充到相对应的位置，对应上面输出的列头
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $row, $dataRow ['username'] );
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $row, $dataRow ['name'] );
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $row, $dataRow ['phone'] );
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $row, $dataRow ['address'] );
        }

        //导出
        $filename ='用户信息';//excel文件名称
        $filename = iconv('utf-8',"gb2312",$filename);//转换名称编码，防止乱码
        header ( 'Content-Type: application/vnd.ms-excel;charset=utf-8' );
        header ( 'Content-Disposition: attachment;filename="' . $filename . '.xls"' ); //”‘.$filename.’.xls”
        header ( 'Cache-Control: max-age=0');

        $objWriter = \PHPExcel_IOFactory::createWriter ( $objPHPExcel, 'Excel5' ); //在内存中准备一个excel2003文件
        $objWriter->save ('php://output');
    }
}