<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/4/10
 * Time: 14:52
 */

namespace application\admin\model;

use think\Db;

class User extends \think\Model {

    public function getInfo($id) {
        $res = $this->field('id,user_id,pwd,realname')
            ->where(array('id' => $id))
            ->find();
        if ($res) {
            $res = $res->data;
        }
        return $res;
    }
}