<?php 
/**
    +----------------------------------------------------------------------
    | @date: 2015-09-27
    +----------------------------------------------------------------------
    | @controller AdminRoleGroupModel.php: 分组表
    +----------------------------------------------------------------------
    | @Author: liudawei <304646940@qq.com>
    +----------------------------------------------------------------------
*/
namespace App\Models\Admin;

use App\Models\BaseModel;
use App\Models\Admin\AdminUsersModel;


class AdminRoleGroupModel extends BaseModel{
    
    protected $table      = 'admin_role_group';
    protected $primaryKey = 'role_group_id';
    public    $timestamps = false;

    protected $fields_create;
    protected $fillable = [
                'role_name',
                'role_description',
                'role_parent_id',
                'type',
                'create_time',
                'update_time'
            ];
    protected $fields_all;
    protected $fields_show;

    public function __construct(array $attributes = array()) {
        parent::__construct($attributes);
        $this->fields_all = [
            'role_name'       => ['show' => '用户组名称'],
            'create_time'     => ['as'=>'create_time','show' => '创建时间','algorithm'=>'>='],
        ];
        $this->fields_show = ['role_name','create_time'];
    }


    public function fromDateTime($value){ return strtotime(parent::fromDateTime($value)); }

    static function getPkId($_id){
        return AdminRoleGroupModel::where('role_group_id',$_id)->first();
    }
    
    static function getRoleGroupByType($group_id,$type = 0){
        $groupModel = AdminRoleGroupModel::where('type',$type);
        if($group_id){
            $groupModel = $groupModel->where('role_parent_id',$group_id);
        }
        $group_data = $groupModel->orderBy('create_time','DESC')
        ->get()
        ->toArray();

        return $group_data;

    }

    /*
     * 获取用户组列表
     *
     */
    public function getGroupList($input,$req){
        $order_by_key  = $input['order'][0]['column'];
        $order_by      = $input['order'][0]['dir'];
        $order_by_data = $input['columns'][$order_by_key]['data'];
        $groupObj      = $this->orderBy($order_by_data,$order_by);

        unset($input['columns']);
        foreach ($input as $field => $value) {
            if (empty($value) || $value < 0 || !isset($this->fields_all[$field])){
                continue;
            }
            $search = $this->fields_all[$field];
            if(isset($search['search'])){
                $groupObj->whereRaw($search['search'], [$value]);
            }else{
                $algorithm = '=';
                if(isset($search['as'])){
                    $field     = $search['as'];
                    $algorithm = $search['algorithm'];
                }
                $groupObj->where("$field","$algorithm","$value");
            }
        }
        if(isset($input['role_group_id']) && $input['role_group_id'] >= 0)
                    $groupObj->where("role_group_id","=",$input['role_group_id']);

        $group_count   = $groupObj->where('role_parent_id', '=', 0)->count();
        $paginate      = $input['page_number']>0?$input['page_number']:\Config::get('system.page_limit');

        if($input['start'] > 0 ){
            $req->query->set('page',ceil($input['start'] / ($paginate-1)));
        }

        $group_list    = $this->getShowList($groupObj->paginate($paginate));
        return array($group_count,$group_list);

    }

    public function getShowList($role_list){
        foreach($role_list as $key => $value){
            $obj_data[$key]['role_name']       = $value->role_name;
            $obj_data[$key]['create_time']     = date('Y-m-d H:i:s', $value->create_time);
            $obj_data[$key]['action']          = '<a href="/admin/role/groupedit/'.$value->role_group_id.'" class="btn btn-primary btn-rounded"><i class="fa fa-search"></i> 编辑</a>
            <a href="/admin/role/createrole/'.$value->role_group_id.'" class="btn btn-info btn-rounded"><i class="glyphicon glyphicon-pencil"></i> 添加角色</a> <a href="/admin/role/grouprole/'.$value->role_group_id.'" class="btn btn-danger btn-rounded"><i class="glyphicon glyphicon-pencil"></i> 角色列表</a>';
        }
        return $obj_data;
    }

    public function hasRoleGroupList(){
        return $this->hasMany('App\Models\Admin\AdminRoleGroupModel', 'role_parent_id', 'role_group_id');
    }

    public function getShowRoleList($role_list){
        foreach($role_list as $key => $value){
            $obj_data[$key]['role_name']       = $value->role_name;
            $obj_data[$key]['create_time']     = date('Y-m-d H:i:s', $value->create_time);
            $obj_data[$key]['role_number']     = AdminUsersModel::where('role_id', '=', $value->role_group_id)->count();
            $obj_data[$key]['group_name']      = AdminRoleGroupModel::find($value->role_parent_id)->role_name;
            $obj_data[$key]['action']          = '<a href="/admin/role/grouproleedit/'.$value->role_group_id.'" class="btn btn-primary btn-rounded"><i class="fa fa-search"></i> 编辑</a>
            <a href="/admin/role/rolepermission/'.$value->role_group_id.'" class="btn btn-info btn-rounded"><i class="glyphicon glyphicon-pencil"></i> 编辑权限</a> <a href="/admin/role/rolelist/'.$value->role_group_id.'" class="btn btn-danger btn-rounded"><i class="glyphicon glyphicon-pencil"></i> 用户列表</a>';
        }
        return $obj_data;
    }
    /**
     * 获取用户组下面的角色列表
     */
    public function getGroupRoleList($input, $req){
        $order_by_key  = $input['order'][0]['column'];
        $order_by      = $input['order'][0]['dir'];
        $order_by_data = $input['columns'][$order_by_key]['data'];
        $groupObj      = $this->orderBy($order_by_data,$order_by);

        unset($input['columns']);

        if(isset($input['role_group_id']) && $input['role_group_id'] >= 0) {
            $groupObj->where('role_parent_id', '=', $input['role_group_id']);
        }else{
            $groupObj->where("role_parent_id", "!=", 0);
        }

        $group_count   = $groupObj->count();
        $paginate      = $input['page_number']>0?$input['page_number']:\Config::get('system.page_limit');

        if($input['start'] > 0 ){
            $req->query->set('page',ceil($input['start'] / ($paginate-1)));
        }

        $group_list    = $this->getShowRoleList($groupObj->paginate($paginate));
        return array($group_count,$group_list);
    }
    /*
     * 根据角色查询同一组角色
     */
    static function getRoleAll($id){
        $role_parent_id = AdminRoleGroupModel::find($id)->role_parent_id;
        return AdminRoleGroupModel::where(['role_parent_id'=>$role_parent_id])->get()->toArray();
    }

    public function hasOneRoleGroup(){
        return $this->hasOne('App\Models\Admin\AdminRoleGroupModel', 'role_parent_id', 'role_group_id');
    }

    public function getGroupLists($input){
        $page_number  = $input['page_number'];
        $dao          = $this->where('type',0);
        if($input['role_name']){
            $dao->where('role_name','like','%'.$input['role_name'].'%');
        }
        $paginate     = $page_numsber>0 ? $page_number: $this->pageLimit();
        return $dao->paginate($paginate);
    }
    
    public function getRoleList($input,$id=0){
        $page_number  = $input['page_number'];
        $dao          = $this->where('type',1);
     
        if($input['role_name']){
            $dao->where('role_name','like','%'.$input['role_name'].'%');
        }
        if($id){
            $dao->where('role_parent_id',$id);
        }
        $paginate     = $page_numsber>0 ? $page_number: $this->pageLimit();
        return $dao->paginate($paginate);
    }

}
