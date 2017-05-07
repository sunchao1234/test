<?php
namespace App\Http\Middleware;
/**
*    +----------------------------------------------------------------------
*    | @date: 2015-09-28
*    +----------------------------------------------------------------------
*    | @controller permission.php: 权限中间件
*    +----------------------------------------------------------------------
*    | @Author: liudawei <304646940@qq.com>
*    +----------------------------------------------------------------------
*/

use Closure;
use Illuminate\Routing\Route;
use App\models\Admin\AdminAssignedModel;
use Illuminate\Contracts\Auth\Guard;

class Permission {
    const _NotPermissionMsg = '请联系管理员或部门主管增加权限';
    public function __construct(Route $route, Guard $auth) {
        $this->auth  = $auth;
        $this->route = $route;
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        $this->is_ajax = $request->ajax();
        $this->init();
        return $next($request);
    }

    /**
     * @run init
     * @param  not
     * @return not
     */
    public function init(){
        $this->getActionName();
        $this->userInfo();
        $this->assigned();
        $this->run();
    }

    public function userInfo(){
        $this->user_info = $this->auth->user();
    }

    public function assigned(){
        $this->assigned  = AdminAssignedModel::getAllAssigned (
                    $this->user_info->group_id,
                    $this->user_info->role_id
        );
    }

    public function run(){
        $assigned  = $this->assigned;
        $run_is_ok = 0;
        $is_ajax   = $this->is_ajax;
        foreach($assigned as $value){
            if(ucwords($value->controller_name).'Controller' == $this->controller_name
                    &&
                    (strtolower($value->action_name) == $this->action_name
                        || 'get'.ucwords($value->action_name) == $this->action_name
                        || 'post'.ucwords($value->action_name) == $this->action_name
                    )
                ){
                $run_is_ok = 1;
            }
        }
        if(!$run_is_ok){
            if($is_ajax){
                die(json_encode(['code' => -9999,'msg' => self::_NotPermissionMsg]));
            }else{
                echo view('errors.show_error',[
                    'code'    => -9999,
                    'msg'     => self::_NotPermissionMsg,
                    'content' => $this->controller_name.'控制器'.$this->action_name.'方法  '.'权限验证失败'
                ]);
                exit;
//                return view('back.show_error',[
//                    'code'    => -9999,
//                    'msg'     => self::_NotPermissionMsg,
//                    'content' => $this->controller_name.'控制器'.$this->action_name.'方法  '.'权限验证失败'
//                ]);
            }
        }
    }

    public function getActionName(){
        $this->controller_name = get_controller_name();
        $this->action_name     = get_action_name();
        $this->in              = get_in();
    }

}
