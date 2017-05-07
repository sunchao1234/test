<?php namespace App\Http\Controllers\Admin;


/**
*    +----------------------------------------------------------------------
*    | @date: 2015-09-25
*    +----------------------------------------------------------------------
*    | @controller AuthController.php: AUTH
*    +----------------------------------------------------------------------
*    | @Author: liudawei <304646940@qq.com>
*    +----------------------------------------------------------------------
*/

use App\Http\Controllers\Controller,
    Illuminate\Contracts\Auth\Guard,
    Illuminate\Contracts\Auth\Registrar,
    Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers,
    Illuminate\Http\Request,
    Illuminate\Http\Response,
    Redirect;
use App\Models\Admin\AdminUsersModel;


class AuthController extends Controller
{

    use AuthenticatesAndRegistersUsers;

    public function __construct(Guard $auth, Registrar $registrar)
    {

        $this->redirectPath      = \Config::get('auth.path.redirect');
        $this->loginPath         = \Config::get('auth.path.login');
        $this->logoutRedirecPath = \Config::get('auth.path.logout_redirec');
        $this->auth      = $auth;
        $this->registrar = $registrar;
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    public function getLogout(){
         $this->auth->logout();
         return Redirect::to('admin/login');
    }

    /*
     * 重写登录
     */
    public function postLogin(Request $request,Response $response)
    {

        if($request->ajax()){
            $this->validate($request, ['user_name' => 'required','password' => 'required']);
            if ($this->auth->attempt($request->only('user_name', 'password'),$request->has('remember'))){
              if($this->auth->user()->status == 1){
                  $this->auth->logout();
                  $json_data = ['code'=>self::HTTP_ERROR,'msg'=>'此用户被禁用','data'=>null];
              }else{
                  AdminUsersModel::updateLastLoginTime($this->auth->user()->id);
                  //$log = "[登录后台系统]：[".date('Y-m-d H:i:s')."]";
                  //adminLog($this->auth->user(),$log);
                  $json_data = ['code'=>self::HTTP_SUCCESS,'msg'=>'登录验证成功','data'=>null];
              }
            }else{
                $json_data = ['code'=>self::HTTP_ERROR,'msg'=>'账号/密码错误！','data'=>null];
            }
            return $response->setContent($json_data);
        }
    }


}
