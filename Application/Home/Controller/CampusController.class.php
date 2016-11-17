<?php
/**
 * Created by PhpStorm.
 * User: DoubleWei
 * Date: 2016/11/15
 * Time: 17:38
 */

namespace Home\Controller;


class CampusController extends HomeController
{
    public function index(){
        //获取列表所有数据
        $data=M('campus')->select();

        //获取头像
        $length=count($data);
        for($i=0;$i<$length;$i++){
            $pic=M('picture')->where([
                'id'=>$data[$i]['img']
            ])->select();
            $data[$i]['headPic']=$pic[0]['path'];

        }

        $this->data=$data;
        //判断手机还是PC端打开
        if(!is_mobile())
            $this->display();
        else
            $this->display("../wap/Campus/index");
    }

    public function info(){
        $id=I('id');            //获取传过来的ID
        $data=M('campus')->where([
            'id'=>$id
        ])->select();               //根据ID查询数据

        $pic=M('picture')->where([
                'id'=>$data[0]['img']
            ])->select();
            $data[0]['headPic']=$pic[0]['path'];        //根据图片ID 获取图片

        $this->data=$data;

        $condition['id']=array('neq',$id);              //查询ID 不为当前ID 的数据
        $other=M('campus')->where($condition)->select();

        $pic=M('picture')->where([
            'id'=>$other[0]['img']
        ])->select();
        $other[0]['headPic']=$pic[0]['path'];              //根据图片ID 获取图片
        $this->other=$other[0];
        //判断手机还是PC端打开
        if(!is_mobile())
            $this->display();
        else
            $this->display("../wap/Campus/info");
    }

}