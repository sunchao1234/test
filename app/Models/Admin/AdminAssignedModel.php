<?php
/**
*    +----------------------------------------------------------------------
*    | @date: 2015-09-27
*    +----------------------------------------------------------------------
*    | @controller AdminAssignedModel.php: 权限表
*    +----------------------------------------------------------------------
*    | @Author: liudawei <304646940@qq.com>
*    +----------------------------------------------------------------------
*/
namespace App\Models\Admin;

use Illuminate\Support\Facades\DB;
use App\Models\BaseModel;
use App\Models\Admin\AdminModModel;

class AdminAssignedModel extends BaseModel{

    protected $table      = 'admin_assigned';
    protected $primaryKey = 'assigned_id';
    public    $timestamps = false;

    protected $fillable = [
                    'group_id',
                    'role_id',
                    'mod_id',
                    'create_time',
                    'update_time'
                ];

    static public function getAllData(){

    }

    static public function getAllAssigned($group_id,$role_id){
        $assigned_data = DB::table('admin_assigned')
//                ->where('admin_assigned.group_id',$group_id)
                ->where('admin_assigned.role_id',$role_id)
                ->join('admin_mod', 'admin_assigned.mod_id', '=', 'admin_mod.mod_id')
                ->orderBy('admin_mod.menu_sort', 'ASC')
                ->orderBy('admin_mod.mod_id', 'ASC')
                ->get();
        return $assigned_data;
    }

    /*
     *设置角色权限
     * @arr  表单提交的权限数组
     */
    static function saveData(array $arr){
        $err       = '';
        $flag      = true;
        $is_delete = AdminAssignedModel::where(['group_id' => $arr['group_id'],'role_id'  => $arr['role_id']])->delete();
        //严谨判断是否删除成功

        foreach($arr['mod_id'] as $value){
            $save_array = [
                'group_id' => $arr['group_id'],
                'role_id'  => $arr['role_id'],
                'mod_id'   => $value,
                'create_time'=> mktime()
            ];
            $is_save = AdminAssignedModel::create($save_array);
            if(!$is_save){
                $mod_name = AdminModModel::find($value)->mod_name;
                $err .= $mod_name.', ';
                $flag = false;
            }
        }
        return array($flag, $err);
    }
    /*
     * 获取当前角色拥有的权限
     * @id   角色id
     */
    static function getRoleMod($id){
        $mod_data = AdminAssignedModel::where('role_id',$id)->get()->toArray();
        $role_mod_data = [];
        foreach($mod_data as $value){
            array_push($role_mod_data, $value['mod_id']);
        }
        return $role_mod_data;
    }

}
