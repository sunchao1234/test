<?php namespace App\Http\Controllers\Admin;

/**
*    +----------------------------------------------------------------------
*    | @date: 2015-09-25
*    +----------------------------------------------------------------------
*    | @controller UsersController.php: 跳转类
*    +----------------------------------------------------------------------
*    | @Author: liudawei <304646940@qq.com>
*    +----------------------------------------------------------------------
*/

use Illuminate\Contracts\Auth\Guard;

class UsersController extends \App\Http\Controllers\BaseController
{
    public function login(Guard $auth)
    {
        $this->auth = $auth;
        if($this->auth->check()){
            return redirect()->guest('admin');
        }
        return view('admin.login');
    }
}
