<?php
/**
*    +----------------------------------------------------------------------
*    | @date: 2015-09-27
*    +----------------------------------------------------------------------
*    | @controller AdminModModel.php: 模块表
*    +----------------------------------------------------------------------
*    | @Author: liudawei <304646940@qq.com>
*    +----------------------------------------------------------------------
*/
namespace App\Models\Admin;

use App\Models\BaseModel;

class AdminModModel extends BaseModel{

    protected $table      = 'admin_mod';
    protected $primaryKey = 'mod_id';
    public    $timestamps = false;

    static  function Assigned($group_id,$role_id){
        $assigned_data  = AdminAssignedModel::getAllAssigned($group_id,$role_id,1);
        foreach($assigned_data as $key => $value){
            if(!$value->parent_id && $value->is_show_menu){
                $assigned[$value->mod_id] = $value;
                foreach($assigned_data as $k => $v){
                    if($v->parent_id == $value->mod_id && $v->is_show_menu){
                        $assigned[$value->mod_id]->menu[] = $v;
                    }
                }
            }
        }
        return $assigned;
    }

    static $top_menu;
    static $key = 0;
    static function getTopMenu($controller_name,$action_name){
        $controller_array = explode('Controller',$controller_name);
        $mod_data = AdminModModel::where('controller_name',$controller_array[0])->where('action_name',$action_name)->get()->toArray();
        self::getBackstepping($mod_data[0]['mod_id']);
        krsort(self::$top_menu);
        return self::$top_menu;
    }

    static function getBackstepping($mod_id){
        $k        = self::$key++;
        $mod_data = AdminModModel::where('mod_id',$mod_id)->get()->toArray();

        self::$top_menu[$k]['mod_name']        = $mod_data[0]['mod_name'];
        self::$top_menu[$k]['url']             = $mod_data[0]['url'];
        self::$top_menu[$k]['action_name']     = $mod_data[0]['action_name'];
        self::$top_menu[$k]['controller_name'] = $mod_data[0]['controller_name'];
        if($mod_data[0]['parent_id']){
            $parent_mod_data = AdminModModel::where('mod_id',$mod_data[0]['parent_id'])->get()->toArray();
            self::$top_menu[$k]['parent_action_name'] = $parent_mod_data[0]['action_name'];
        }

        if($mod_data[0]['parent_id']){
            self::getBackstepping($mod_data[0]['parent_id']);
        }
    }

    static function getAllMod(){
        $Dao = self::orderBy('mod_id','ASC')
               ->orderBy('parent_id','ASC')
               ->get()->toArray();
        return $Dao;
    }


}
