<?php

namespace application\admin\controller;

use think\Loader;

class UserController extends CommonController {

    public function index() {
        $res = db('user')->order('id asc')->select();
        $lists = nodeTree($res);
        $this->assign('lists', $lists);
        return $this->fetch();
    }

    public function info() {
        $id = input('id');
        if ($id) {
            //当前用户信息
            $info = model('User')->getInfo($id);

            $this->assign('info', $info);
        }


        return $this->fetch();
    }


    public function add(){
        $data = input();
        $count = db('user')->where('user_id', $data['user_id'])->count();

        if ($count) {
            $this->error('用户已存在');
        }

        if ($data['pwd'] != $data['rpassword']) {
            $this->error('两次密码不一致');
        }

        $data['pwd'] = md5($data['password']);

        unset($data['rpassword']);
        $res = db('User')->insert($data);

        if ($res) {

            $this->success('操作成功', url('index'));
        } else {
            $this->error('操作失败');
        }
    }

    public function del() {
        $id = input('id');
        $res = db('user')->where(['id' => $id])->delete();
        if ($res) {

            $this->success('操作成功', url('index'));
        } else {
            $this->error('操作失败');
        }
    }

    public function edit() {
        $data = input();



            if ($data['pwd'] != $data['rpassword']) {
                $this->error('两次密码不一致!');
            }
            $data['pwd'] = md5($data['password']);
            unset($data['rpassword']);
      $res = db('user') ->where('id',$data['id']) ->update($data);

        if ($res) {
            $this->success('操作成功');
        } else {
            $this->error('操作失败');
        }
    }

    

}
