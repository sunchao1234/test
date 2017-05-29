<?php namespace App\Http\Controllers\Admin;

/**
 *    +----------------------------------------------------------------------
 *    | @date: 2016-02-01
 *    +----------------------------------------------------------------------
 *    | @controller RoleController.php: 角色控制器
 *    +----------------------------------------------------------------------
 *    | @Author: liudawei <304646940@qq.com>
 *    +----------------------------------------------------------------------
 */

use DB;
use Input, \Illuminate\Http\Request;
use App\Models\Admin\AdminUsersModel,
    App\Models\Admin\AdminRoleGroupModel,
    App\Models\Admin\AdminAssignedModel,
    App\Models\Admin\AdminModModel;

class RoleController extends BaseController
{

    public function getIndex(Request $req)
    {

        $adminUsersModel = new AdminUsersModel();
        $input = Input::all();
        $user_list_data = $adminUsersModel->getUserList($input);

        if ($input['group_id']) {
            $role_group = AdminRoleGroupModel::getRoleGroupByType($input['group_id'], 1);
        } else {
            $role_group = [];
        }

        $view_data = ['data' => [
            'group_data' => AdminRoleGroupModel::getRoleGroupByType(0),
            'role_data' => $role_group,
            'user_list_data' => $user_list_data,
            'input' => $input,
            'appends' => [
                'page_number' => $input['page_number'],
                'nick_name' => $input['nick_name'],
                'email' => $input['email'],
                'group_id' => $input['group_id'],
                'role_id' => $input['role_id'],
                'sex' => $input['sex'],
                'status_time' => $input['status_time'],
                'end_time' => $input['end_time']
            ]
        ]
        ];

        return view('admin.role.index', $view_data);
    }

    //登记基础信息
    public function getAddusage()
    {
//        return view('admin.usage.add');
        return view('admin.usage.add');
    }

    //上传基础证件
    public function getAddusageimg()
    {
        return view('admin.usage.addImg');
    }

//换证
    public
    function getAddusage1()
    {
        return view('admin.usage.findq');
    }

//补证
    public
    function getAddusage2()
    {
        return view('admin.usage.changeq');
    }

//注销
    public
    function getAddusage3()
    {
        return view('admin.usage.cancelq');
    }

//变更
    public
    function getAddusage4()
    {
        return view('admin.usage.amendq');
    }

//编辑
    public
    function getEditusage()
    {
        return view('admin.usage.editq');
    }

    public
    function getLookusage()
    {
        return view('admin.usage.look');
    }

    public
    function getReadusage()
    {
        return view('admin.usage.readq');
    }



    public function getAddnewusage(){
        return view('admin.newusage.add');
    }

    public function getEditnewusage(){
        return view('admin.newusage.edit');
    }

    /**
     * @action Create User Role
     * @return array and json
     */
    public
    function getCreate($group_id = 0)
    {

        if ($group_id) {
            $role_group = AdminRoleGroupModel::getRoleGroupByType($group_id, 1);
            die(json_encode($role_group));
        }
        $group_data = AdminRoleGroupModel::getRoleGroupByType(0);
        return view('admin.role.create', [
            'group_data' => $group_data
        ]);
    }

    /**
     * @action Create User Role
     * @return array and json
     */
    public
    function postCreate()
    {

        $input = Input::all();
        $fileObj = Input::file('icon_file');
        if ($fileObj->isValid()) {
            list($avatar_name, $avatar_path) = upLoadAvatar($fileObj, 'upload');
        }

        $input['password'] = password_hash($input['password'], 1);
        $input['status'] += 0;
        $input['avatar_name'] = $avatar_name;
        $input['avatar_path'] = $avatar_path;

        if (AdminUsersModel::where('user_name', $input['user_name'])->where('delete_time', 0)->exists()) {
            adminMsg('100', '用户存在', [], '/admin/role/');
        }
        $is_save = AdminUsersModel::create($input);
        $code = 200;
        if (!$is_save) $code = -200;

        $msg = ['200' => '编辑用户成功', '-200' => '编辑用户失败'];
        adminMsg($code, $msg[$code], [], '/admin/role/');
    }

    /**
     * @action Disable User Role
     * @return json
     */
    public
    function getDisable($id)
    {
        if (!$id + 0)
            die(json_encode(array('code' => -200)));

        $user = AdminUsersModel::find($id);

        if (!$user)
            die(json_encode(array('code' => -200)));

        if ($user->status == 1) {
            $user->status = 0; //开启
        } else {
            $user->status = 1; //删除
        }

        $up = $user->save();
        if ($up) die(json_encode(array('code' => 200)));

    }

    /*
     * @action Edit User Page
     * @return array
     */
    public
    function getEdit($id, Request $req)
    {
        $id = intval($id);
        $adminUsersModel = new AdminUsersModel();
        $admin_user_list = $adminUsersModel->find($id);

        if ($admin_user_list) {
            $group_id = $admin_user_list->group_id;
            $group_data = AdminRoleGroupModel::getRoleGroupByType(0);
            $role_data = AdminRoleGroupModel::getRoleGroupByType($group_id, 1);
            return view('admin.role.create', [
                'id' => $id,
                'user_list' => $admin_user_list,
                'group_data' => $group_data,
                'role_data' => $role_data
            ]);
        } else {
            adminMsg(-200, '查询数据错误', [], '/admin/role/');

        }

        $group_data = AdminRoleGroupModel::getRoleGroupByType(0);
        return view('admin.role.create', [
            'id' => $id,
            'group_data' => $group_data
        ]);
    }

    /*
     * @action Edit User Page
     * @return array
     */
    public
    function postEdit()
    {
        $input = Input::all();
        $fileObj = Input::file('icon_file');

        $admin_user_info = AdminUsersModel::find($input['id']);

        if ($fileObj && @$fileObj->isValid()) {
            list($avatar_name, $avatar_path) = upLoadAvatar($fileObj);
        }

        if ($input['password']) {
            $input['password'] = password_hash($input['password'], 1);
        }

        if ($input['status'] + 0 === 0) {
            $input['status'] = 0;
        } else {
            $input['status'] = 1;
        }

        if ($fileObj) {
            $input['avatar_name'] = $avatar_name;
            $input['avatar_path'] = $avatar_path;
        }

        $is_updata = $admin_user_info->update($input);

        $code = 200;
        if (!$is_updata) $code = -200;

        $msg = ['200' => '编辑用户成功', '-200' => '编辑用户失败'];
        adminMsg($code, $msg[$code], [], '/admin/role/');

    }

    public
    function getInfo($id)
    {
        $code = 200;

        $user_info = AdminUsersModel::find($id);

        if (!$user_info) {
            $msg = ['-200' => '查询用户失败'];
            $code = -200;
            adminMsg($code, $msg[$code], [], '/admin/role/');
        }

        $tmp_data[0] = $user_info;
        $user_info = (new AdminUsersModel())->getShowList($tmp_data);
        $user_info[0]['id'] = $id;

        return view('admin.role.info', ['user_info' => $user_info[0]]);

    }


    /*
     * 用户组列表
     */
    public
    function getGrouplist()
    {
        $adminRoleGroupModel = new AdminRoleGroupModel();
        $input = Input::all();
        $query = $adminRoleGroupModel->getGroupLists($input);
        $query_array = $query->toArray();

        foreach ($query_array['data'] as $key => $value) {
            $query_array['data'][$key]['role_number'] = AdminRoleGroupModel::where('role_parent_id', '=', $value['role_group_id'])->count();
        }

        $view_data = ['data' => [
            'list_data' => $query_array['data'],
            'list_obj' => $query,
            'input' => $input,
            'appends' => ['role_name' => $input['role_name']]
        ]
        ];
        return view('admin.role.grouplist', $view_data);

    }


    /*
     * 创建用户组
     */
    public
    function getCreategroup()
    {
        return view('admin.role.creategroup');
    }


    public
    function postCreategroup()
    {
        $input = Input::all();
        $input['create_time'] = mktime();

        $is_save = AdminRoleGroupModel::create($input);
        $code = 200;
        if (!$is_save) $code = -200;
        $msg = ['200' => '创建用户组成功', '-200' => '创建用户组失败'];
        adminMsg($code, $msg[$code], [], '/admin/role/grouplist');
    }


    public
    function getGrouprole($id)
    {
        $id = intval($id) > 0 ? intval($id) : 0;
        $input = Input::all();
        $adminRoleGroupModel = new AdminRoleGroupModel();
        $query = $adminRoleGroupModel->getRoleList($input, $id);
        $query_array = $query->toArray();
        foreach ($query_array['data'] as $key => $value) {
            $query_array['data'][$key]['user_number'] = AdminUsersModel::where('role_id', '=', $value['role_group_id'])->count();
        }
        $view_data = ['data' => [
            'role_parent_id' => $id,
            'list_data' => $query_array['data'],
            'list_obj' => $query,
            'input' => $input,
            'appends' => ['role_name' => $input['role_name']]
        ]
        ];
        return view('admin.role.grouprolelist', $view_data);

    }


    public
    function getGrouprolelist(Request $req)
    {

        $adminRoleGroupModel = new AdminRoleGroupModel();
        $input = Input::all();

        list($group_count, $group_list) = $adminRoleGroupModel->getGroupRoleList($input, $req);
        adminAjaxData($input['draw'], count($group_list), $group_count, $group_list === null ? array() : $group_list);

    }

//    public function ()

    /*
     * 编辑用户组
     */
    public
    function getGroupedit($id)
    {
        return view('admin.role.creategroup', [
            'group_data_one' => AdminRoleGroupModel::find($id)
        ]);
    }


    public
    function postGroupedit()
    {
        $input = Input::all();
        $input['update_time'] = mktime();
        $is_updata = AdminRoleGroupModel::find($input['role_group_id'])->update($input);

        $code = 200;
        if (!$is_updata) $code = -200;
        $msg = ['200' => '编辑用户组成功', '-200' => '编辑用户组失败'];
        adminMsg($code, $msg[$code], [], '/admin/role/grouplist');
    }


    /**
     * 用户角色创建
     */
    public
    function getCreaterole($id)
    {
        $id = intval($id) > 0 ? intval($id) : 1;

        return view('admin.role.createrole', [
            'role_parent_id' => $id,
            'group_data' => AdminRoleGroupModel::getRoleGroupByType(0)
        ]);
    }


    public
    function postCreaterole()
    {
        $input = Input::all();
        $input['create_time'] = mktime();
        if (isset($input['role_parent_id']) && $input['role_parent_id'] > 0) $input['type'] = 1;
        $is_save = AdminRoleGroupModel::create($input);

        $code = 200;
        if (!$is_save) $code = -200;
        $msg = ['200' => '创建角色成功', '-200' => '创建角色失败'];
        adminMsg($code, $msg[$code], [], '/admin/role/grouprole/' . $input['role_parent_id']);
    }


    /*
     * 编辑用户角色
     */
    public
    function getGrouproleedit($id)
    {
        $id = intval($id);
        $adminRoleGroupModel = new AdminRoleGroupModel();
        $admin_role_group_list = $adminRoleGroupModel->find($id);

        if ($admin_role_group_list) {
            $group_data = AdminRoleGroupModel::getRoleGroupByType(0);
            return view('admin.role.createrole', [
                'role_parent_id' => $admin_role_group_list->role_parent_id,
                'group_data' => $group_data,
                'role_data' => $admin_role_group_list
            ]);
        } else {
            adminMsg(-200, '查询数据错误', [], '/admin/role/grouprole');
        }

        $group_data = AdminRoleGroupModel::getRoleGroupByType(0);
        return view('admin.role.grouprole', [
            'role_parent_id' => $id,
            'group_data' => $group_data
        ]);
    }


    public
    function postGrouproleedit()
    {

        $input = Input::all();
        $input['update_time'] = mktime();

        $role_info = AdminRoleGroupModel::find($input['role_group_id']);


        $is_updata = $role_info->update($input);
        $code = 200;
        if (!$is_updata) $code = -200;

        $msg = ['200' => '编辑角色成功', '-200' => '编辑角色失败'];
        adminMsg($code, $msg[$code], [], '/admin/role/grouprole/' . $input['role_parent_id']);

    }


    public
    function modTree($list, $pid = 0, $level = 0, $html = '&nbsp;&nbsp;&nbsp;&nbsp;')
    {
        static $tree = array();

        foreach ($list as $v) {
            if ($v['parent_id'] == $pid) {
                $v['sort'] = $level;
                $v['html'] = str_repeat($html, $level);
                $tree[] = $v;
                $this->modTree($list, $v['mod_id'], $level + 1);
            }
        }
        return $tree;
    }


    /*
     * 编辑权限
     */
    public
    function getRolepermission($id)
    {

        $data = $this->modTree(AdminModModel::getAllMod());
        $role_mod_data = AdminAssignedModel::getRoleMod($id);

        return view('admin.role.rolepermission', [
            'role_id' => $id,
            'mod_data' => $data,
            'role_mod_data' => $role_mod_data
        ]);
    }

    public
    function postRolepermission()
    {
        $input = Input::all();

        $input['group_id'] = AdminRoleGroupModel::find($input['role_id'])->role_parent_id;
        list($flag, $err) = AdminAssignedModel::saveData($input);

        $code = 200;
        if (!$flag) $code = -200;
        $msg = ['200' => '编辑权限成功', '-200' => $err . '编辑权限失败'];
        adminMsg($code, $msg[$code], [], '/admin/role/grouprole/' . $input['group_id']);
    }


    public
    function getMod(Request $req)
    {

        $all_mod_data = AdminModModel::paginate(10);
        if (!empty($all_mod_data)) {
            $mod_data = $all_mod_data->toArray();
        }
        $mod_data = $this->modTree($mod_data['data']);
        $input = $req->all();
        $view_data = ['data' => [
            'mod_data' => $all_mod_data,
            'appends' => [
                'page_number' => 10,
                'mod_id' => $input['mod_id'],
                'mod_name' => $input['mod_name'],
            ]
        ]
        ];
        return view('admin.role.mod', $view_data);
    }


    public
    function postModify()
    {
        $adminModModel = new AdminModModel();
        $input = Input::all();
        $info = $adminModModel->where('mod_id', '=', $input['mod_id'])->first()->toArray();
        if ($input['menu_sort'] == '') {
            $input['menu_sort'] = $info['menu_sort'];
        } elseif ($input['fa_class'] == '') {
            $input['fa_class'] = $info['fa_class'];
        } elseif ($input['is_show_menu'] == '') {
            $input['is_show_menu'] = $info['is_show_menu'];
        }

        $filte = [
            'mod_name' => $input['mod_name'],
            'parent_id' => $input['parent_id'],
            'controller_name' => $input['controller_name'],
            'action_name' => $input['action_name'],
            'url' => $input['url'],
            'is_show_menu' => $input['is_show_menu'],
            'update_time' => time(),
            'menu_sort' => $input['menu_sort'],
            'fa_class' => $input['fa_class']
        ];
        if (!empty($input)) {
            $is_update_mod = $adminModModel->where('mod_id', '=', $input['mod_id'])->update($filte);
            if (!$is_update_mod) {
                $data = array(
                    'code' => -200,
                    'msg' => '修改失败',
                );
                die(json_encode($data));
                exit;
            }
            $data = array(
                'code' => 200,
                'msg' => '修改成功'
            );
            die(json_encode($data));
            exit;
        }
    }

    public
    function postAddmod()
    {
        $adminModModel = new AdminModModel();
        $adminAssignedModel = new AdminAssignedModel();
        $input = Input::all();
        if (empty($input['menu_sort'])) {
            $input['menu_sort'] = 9999;
        }
        $filte = [
            'mod_name' => $input['mod_name'],
            'parent_id' => $input['parent_id'],
            'controller_name' => $input['controller_name'],
            'action_name' => $input['action_name'],
            'url' => $input['url'],
            'is_show_menu' => $input['is_show_menu'],
            'create_time' => time(),
            'menu_sort' => $input['menu_sort'],
            'fa_class' => $input['fa_class']
        ];
        if (!empty($input)) {
            DB::beginTransaction();
            $is_add = $adminModModel->insert($filte);
            if (!$is_add) {
                DB::rollBack();
                $data = array(
                    'code' => -200,
                    'msg' => '添加失败',
                );
                die(json_encode($data));
                exit;
            }
//                $adminModDetail = $adminModModel->select('mod_id')->where($filte)->first()->toArray();
//                $adminModDetail['create_time'] = time();
//                $is_admin_assigned = $adminAssignedModel->insert($adminModDetail);
//                if(!$is_admin_assigned){
//                    DB::rollBack();
//                    $data = array(
//                        'code' => -200,
//                        'msg'  => '添加失败',
//                    );
//                    die(json_encode($data));
//                    exit;
//                }
            DB::commit();
            $data = array(
                'code' => 200,
                'msg' => '添加成功',
            );
            die(json_encode($data));
            exit;

        }

    }

    public
    function postDel()
    {
        $input = Input::all();
        $mod_id = $input['mod_id'];
        $adminModModel = new AdminModModel();
        $adminAssignedModel = new AdminAssignedModel();
        DB::beginTransaction();
        $is_del_mod = $adminModModel->where('mod_id', $mod_id)->delete();
        if (!$is_del_mod) {
            DB::rollBack();
            $data = array(
                'code' => -201,
                'msg' => '删除失败',
            );
            die(json_encode($data));
            exit;
        }
        $get_assigned = $adminAssignedModel->where('mod_id', $mod_id)->get();
        if ($get_assigned->toArray()) {
            $is_del_assigned = $adminAssignedModel->where('mod_id', $mod_id)->delete();
            if (!$is_del_assigned) {
                DB::rollBack();
                $data = array(
                    'code' => -200,
                    'msg' => '删除失败',
                );
                die(json_encode($data));
                exit;
            }
        }

        DB::commit();
        $data = array(
            'code' => 200,
            'msg' => '删除成功',
        );
        die(json_encode($data));
        exit;
    }

    public
    function getAdminlog()
    {
        $input = Input::all();
        $log_obj = DB::table('admin_users_logs')->where('user_id', '>', 0);

        if (!empty($input['type'])) {
            $log_obj->where('type', $input['type']);
        }

        if (!empty($input['keywords'])) {
            $log_obj->where('log', 'like', '%' . $input['keywords'] . '%');
        }
        if (!empty($input['start_time'])) {
            $log_obj->where('create_time', '>=', strtotime($input['start_time']));
        }
        if (!empty($input['end_time'])) {
            $log_obj->where('create_time', '<=', strtotime($input['end_time']));
        }

        $log_obj->orderBy('create_time', 'DESC');

        $log_list = $log_obj->paginate(10);

        // $log_list = $log_list->toArray();
        // dd($log_list);

        $log_type_arr = array(
            'goods' => array(
                'menu_name' => '商品管理',
                'child_name' => array(
                    'indexclass' => '品类列表',
                    'indexclassattr1' => '品类属性',
                    'indexbrand' => '品牌列表',
                    'goods' => '商品列表',
                    'supplier' => '供货商列表',
                    'gifts' => '礼包列表',
                    'arealist' => '专区列表',
                ),
            ),
            'order' => array(
                'menu_name' => '订单管理',
                'child_name' => array(
                    'cancelorder' => '取消订单',
                    'refund' => '退款售后',
                    'admin_export' => '总后台-我要导出',
                ),
            ),
            'activity' => array(
                'menu_name' => '活动管理',
                'child_name' => array(
                    'indexyhq' => '优惠券配置',
                    'indexms' => '秒杀管理',
                    'indexyy' => '一元购列表',
                    'indexzc' => '众筹',
                    'indexmj' => '满减包邮',
                    'indexfls' => '福利社'
                ),
            ),
            // 'agent'     =>  array(
            //         'menu_name' =>  '代理管理',
            //         'child_name'=>  ''
            //     ),
            // 'content'   =>  array(
            //         'menu_name' =>  '文章管理',
            //         'child_name'=>  ''
            //     ),
            'payment' => array(
                'menu_name' => '账务管理',
                'child_name' => array(
                    'withdrawal' => '提现'
                )
            ),
        );
        return view('admin.role.adminlog', [
            'log_list' => $log_list,
            'log_type_arr' => $log_type_arr,
            'input' => $input
        ]);
    }

    public
    function getSupplierlog()
    {
        $input = Input::all();
        $log_obj = DB::table('shop_goods_supplier_log')->where('log', '!=', '');

        if (!empty($input['type'])) {
            $log_obj->where('type', $input['type']);
        }

        if (!empty($input['keywords'])) {
            $log_obj->where('log', 'like', '%' . $input['keywords'] . '%');
        }
        if (!empty($input['start_time'])) {
            $log_obj->where('create_time', '>=', strtotime($input['start_time']));
        }
        if (!empty($input['end_time'])) {
            $log_obj->where('create_time', '<=', strtotime($input['end_time']));
        }

        $log_obj->orderBy('create_time', 'DESC');

        $log_list = $log_obj->paginate(10);

        // $log_list = $log_list->toArray();
        // dd($log_list);

        $log_type_arr = array(
            'supplier_login' => array(
                'menu_name' => '供应商登录',
                'child_name' => array(
                    'login' => '登录',
                    'logout' => '退出登录'
                ),
            ),
            'supplier_userinfo' => array(
                'menu_name' => '个人中心',
                'child_name' => array(
                    'edit_passwd' => '修改密码',
                ),
            ),
            'supplier_order' => array(
                'menu_name' => '订单管理',
                'child_name' => array(
                    'sendgoods' => '供应商发货',
                    'supplier_export' => '供应商-我要导出',
                    'supplier_export_sendgoods' => '供应商-导出发货信息',
                    'supplier_import_sendgoods' => '供应商-导入发货信息',
                ),
            ),
        );
        return view('admin.role.supplierlog', [
            'log_list' => $log_list,
            'log_type_arr' => $log_type_arr,
            'input' => $input
        ]);
    }

    public
    function getLogdetail($id, $from)
    {
        if ($from == 'adminlog') {
            $admin_log = DB::table('admin_users_logs')->find($id);
            $admin_log->input = json_decode($admin_log->input);
            // dd($admin_log);
            return view('admin.role.adminlog_detail', [
                'log_info' => $admin_log,
            ]);
        } elseif ($from == 'supplierlog') {
            $supplier_log = DB::table('shop_goods_supplier_log')->find($id);
            $supplier_log->input = json_decode($supplier_log->input);
            // dd($supplier_log);
            return view('admin.role.supplierlog_detail', [
                'log_info' => $supplier_log,
            ]);
        } else {
            dd('参数错误！');
        }

    }
}
