<?php
require_once('dbService.php');
class Account extends DbServices
{
    function register($data)
    {
        $res1 = $this->getOne("account", ['name' => 'username', 'value' => $data['username']]);
        $res2 = $this->getOne("account", ['name' => 'email', 'value' => $data['email']]);

        if (count($res1) > 0 || count($res2) > 0) {
            return ['message'=>"User đã tồn tại!","status"=>false];
        } else {
            $res = $this->create("account", $data);
            if ($res) {
                return ['message'=>"Đăng kí thành công.","status"=>true];
            }

        }
    }
    function login($data)
    {
        $res = $this->getOne("account", ['name' => 'username', 'value' => $data['username']]);
        
        if ($res[0]['password']==sha1($data['password'])) {
            return ['message'=>"Đăng nhập thành công.","status"=>true];
        }
        else return ['message'=>"Mật khẩu hoặc tên tài khoản không đúng.","status"=>false];
    }
}
