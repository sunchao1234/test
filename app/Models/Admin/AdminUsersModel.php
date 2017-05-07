<?php

/**
*    +----------------------------------------------------------------------
*    | @date: 2015-09-27
*    +----------------------------------------------------------------------
*    | @controller BaseModel.php: 中间层
*    +----------------------------------------------------------------------
*    | @Author: liudawei <304646940@qq.com>
*    +----------------------------------------------------------------------
*/
namespace App\Models\Admin;

use Illuminate\Auth\Authenticatable,
    Illuminate\Auth\Passwords\CanResetPassword,
    Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract,
    Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

use App\Models\BaseModel;

class AdminUsersModel extends BaseModel implements AuthenticatableContract,
                                                     CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	protected $table    = 'admin_users';
	protected $fillable = [ 'nick_name','email','user_name',
                            'password','sex','phone','group_id','role_id','status',
                            'avatar_name','avatar_path','des','last_login_time'];

	protected $hidden   = ['remember_token'];//记录token

    const DELETED_AT = 'delete_time';
    const UPDATED_AT = 'update_time';
    const CREATED_AT = 'create_time';

    public function fromDateTime($value){ return strtotime(parent::fromDateTime($value)); }

    public function hasGroup(){
        return $this->hasOne(
                    "App\Models\Admin\AdminRoleGroupModel",
                    'role_group_id',
                    'group_id'
                );
    }

    public function hasRole(){
        return $this->hasOne(
                    "App\Models\Admin\AdminRoleGroupModel",
                    'role_group_id',
                    'role_id'
                );
    }

    static function updateLastLoginTime($id) {
        self::find($id)->update(['last_login_time'=>time()]);
    }

    public function getShowList($role_list){
        foreach($role_list as $key => $value){
            $obj_data[$key]['id']              = $value->id;
            $obj_data[$key]['avatar']          = '<div class="profile-image"><img src = "'.\Config::get('system.img_url').$value->avatar_path.'/'.$value->avatar_name .'" width = "60" height = "90" /></div>';
            $obj_data[$key]['email']           = $value->email;
            $obj_data[$key]['nick_name']       = $value->nick_name;
            $obj_data[$key]['phone']           = $value->phone;
            $obj_data[$key]['sex']             = $value->sex+0 == 1?'男':'女';
            $obj_data[$key]['group_id']        = $value->_group->role_name;
            $obj_data[$key]['role_id']         = $value->_role->role_name;
            $obj_data[$key]['create_time']     = $value->create_time->format('Y-m-d H:i:s');
            $obj_data[$key]['update_time']     = $value->update_time->format('Y-m-d H:i:s');
            $obj_data[$key]['last_login_time'] = date('Y-m-d H:i:s',$value->last_login_time);
            $obj_data[$key]['delete_time']     = date('Y-m-d H:i:s',$value->delete_time);
            $obj_data[$key]['status']          = $value->status?'<span class="label label-danger label-form">禁用</span>':'<span class="label label-info label-form">正常</span>';
            if($value->status){
                $status_class = 'btn btn-warning btn-rounded';
                $status = '开启';
            }else{
                $status_class = 'btn btn-danger btn-rounded';
                $status = '禁用';
            }
            $obj_data[$key]['action']          = '<a href="/admin/role/info/'.$value->id.'" class="btn btn-primary btn-rounded"><i class="fa fa-search"></i> 查看</a> <a href="/admin/role/edit/'.$value->id.'" class="btn btn-info btn-rounded"><i class="glyphicon glyphicon-pencil"></i> 编辑</a>  <a href="javascript:;" onclick="disableUser(this)" id="'.$value->id.'" class="'.$status_class.'"><i class="glyphicon glyphicon-warning-sign"></i> '.$status.'</a>';
        }
        return $obj_data;
    }
    public function getUserList($input){
        $dao = $this->orderBy('create_time', 'desc');

        if($input['nick_name'])    $dao->where('nick_name','like','%'.$input['nick_name'].'%');
        if($input['email'])        $dao->where('email'    ,'like','%'.$input['email'].'%');
        if($input['group_id'])     $dao->where('group_id','=' ,$input['group_id']);
        if($input['role_id'])      $dao->where('role_id' ,'=' ,$input['role_id']);
        if($input['sex'] > 0)     $dao->where('sex'     ,'=' ,$input['sex']);
        if($input['status_time'])  $dao->where('status_time', '>=', strtotime($input['status_time']));
        if($input['end_time'])     $dao->where('end_time'   , '<=', strtotime($input['end_time']));

        $page_number  = $input['page_number'];
        $paginate     = $page_number>0 ? $page_number: $this->pageLimit();
        return $dao->paginate($paginate);
    }

}
