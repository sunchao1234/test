<?php

namespace App\Http\Controllers\Admin;

/**
*    +----------------------------------------------------------------------
*    | @date: 2015-09-25
*    +----------------------------------------------------------------------
*    | @controller BaseController.php: 中间层
*    +----------------------------------------------------------------------
*    | @Author: liudawei <304646940@qq.com>
*    +----------------------------------------------------------------------
*/

use Illuminate\Contracts\Auth\Guard,
    Illuminate\Routing\Route;

use App\Models\Admin\AdminModModel,
    App\Models\Admin\AdminRoleGroupModel;

use Illuminate\Routing\Controller;
use Validator;
use Request;

class BaseController extends Controller
{

    protected $layout = 'back.layout';

    /**
     * 构造方法
     *
     * @author liudawei <304646940@qq.com>
     */
    public function __construct(Route $route, Guard $auth)
    {

        error_reporting(0);
        $this->middleware('auth');
        $this->middleware('permission');
        $this->auth      = $auth;
        $this->route     = $route;
        $this->user_info = $this->initUser();
        $this->getActionName();
        $this->initViewShare();
    }

    public function initUser()
    {
        if (!$this->auth->guest()){
            $user_info = $this->auth->user();
            return [
                'info'  => $user_info,
                'group' => AdminRoleGroupModel::getPkId($user_info['group_id']),
                'role'  => AdminRoleGroupModel::getPkId($user_info['role_id'])
            ];
        }

    }

    public function assigned()
    {
        return AdminModModel::Assigned(
                $this->user_info['info']->group_id,
                $this->user_info['info']->role_id
            );
    }

    public function initViewShare()
    {
        if (!$this->auth->guest()){
            $this->_page = \Config::get('system.page');
            view()->share('base_url', \Config::get('system.base_url'));
            view()->share('menu',$this->assigned());
            view()->share('admin_info',$this->user_info);
            view()->share('controller_name',$this->controller_name);
            view()->share('action_name',$this->action_name);
            view()->share('ca_name',$this->ca);
            view()->share('top_menu',  @AdminModModel::getTopMenu($this->controller_name,$this->action_name));
        }
    }

    public function getActionName()
    {
        $route                 = $this->route;
        $action_array          = explode('@',$route->getActionName());
        $parameters            = $route->parameters();
        if($action_array[1] == 'missingMethod') $action_array[1] = explode ('/', $parameters['_missing'])[0];
        $controller_array      = explode('\\', $action_array[0]);
        $this->controller_name = end($controller_array);
        $this->action_name     = strtolower($action_array[1]);
        $end = 0;
        $end = strpos($this->action_name, 'post') === 0 ? 4 : 3;

        if($end){
            $this->action_name = substr($this->action_name,$end,strlen($this->action_name));
        }

        $this->ca = get_in();
    }
    protected function valid($valid, $message=[], $request='') {
        if('POST' == Request::method()) {
            if(!Request::has('_token')) {
                throw new \Exception('_token不能为空');
            }
        }
        $request = !empty($request)?$request:Request::input();
        $validator = Validator::make($request, $valid, $message);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        return $request;
    }


}
