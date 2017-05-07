<?php namespace App\Models;

use App\Models\BaseModel;

class RegionModel extends BaseModel{
    
    protected $table      = 'region';
    protected $primaryKey = 'id';
    public    $timestamps = false;
    
    
    public function hasRegionName(){
        return $this->hasOne(RegionModel::class, 'parent_id', id);
    }
//    static function getPkId($_id){
//        return AdminRoleGroupModel::where('users_bonus_coupons_id',$_id)->first();
//    }
//    
//    static function getRoleGroupByType($group_id,$type = 0){
//        $groupModel = AdminRoleGroupModel::where('type',$type);
//        if($group_id){
//            $groupModel = $groupModel->where('role_parent_id',$group_id);
//        }
//        $group_data = $groupModel->orderBy('create_time','DESC')
//        ->get()
//        ->toArray();
//
//        return $group_data;
//
//    }
    
}