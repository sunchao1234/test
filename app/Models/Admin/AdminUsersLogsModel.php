<?php

/**
*    +----------------------------------------------------------------------
*    | @date: 2016-02-13
*    +----------------------------------------------------------------------
*    | @controller AdminUsersLogsModel.php: 中间层
*    +----------------------------------------------------------------------
*    | @Author: liudawei <304646940@qq.com>
*    +----------------------------------------------------------------------
*/

namespace App\Models\Admin;

use App\Models\BaseModel;

class AdminUsersLogsModel extends BaseModel{

    public    $timestamps = false;
    
    protected $table    = 'admin_users_logs';
    protected $fillable = ['id','user_id','email','nick_name','group_id','role_id','log','add_time'];

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

    public function getLog($input){
        $dao = $this->orderBy('create_time', 'desc');
        if($input['user_id']){
            $dao->where('user_id',$input['user_id']);
        }
        $paginate     = $input['page_number'] >0 ? $input['page_number']: $this->pageLimit();
        return $dao->paginate($paginate);
    }
    
    /* 数组形式写入数据 */
    public function setLog($input=[]){
        // return AdminUsersLogsModel::create($input);
        return AdminUsersLogsModel::insert($input);;
    }

}
