<?php
require_once('dbService.php');
class Account extends DbServices
{
    function register($data)
    {
        $res1 = $this->getBy("account", ['name' => 'username', 'value' => $data['username']]);
        $res2 = $this->getBy("account", ['name' => 'email', 'value' => $data['email']]);

        if (count($res1) > 0 || count($res2) > 0) {
            return ['message' => "User đã tồn tại!", "status" => false];
        } else {
            $res = $this->create("account", $data);
            if ($res) {
                return ['message' => "Đăng kí thành công.", "status" => true];
            }
        }
    }
    function login($data)
    {
        $res = $this->getBy("account", ['name' => 'username', 'value' => $data['username']]);
        if (count($res) == 0)
            return ['message' => "Không tồn tại tài khoản.", "status" => false];
        else if ($res[0]['password'] == sha1($data['password'])) {
            return ['message' => "Đăng nhập thành công.", "status" => true, "token" => $this->encrypt($res[0]['user_id']), 'username' => $res[0]['username']];
        } else return ['message' => "Mật khẩu hoặc tên tài khoản không đúng.", "status" => false];
    }
    function validateUser($token)
    {
        $res = $this->getBy("account", ['name' => 'user_id', 'value' => $this->decrypt($token)]);
        if ($res)
            return ['message' => "Xác thực tài khoản thành công."];
        else return ['message' => "Xác thực tài khoản thất bại."];
    }
}
