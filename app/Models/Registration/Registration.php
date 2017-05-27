<?php

namespace App\Models\Registration;

use Request;


class Registration extends BaseModel {

    public function register() {
        $validData = $this->check();
        if($validData['code']) {
            throw new \Exception($validData['msg']);
        }
        $request = Request::input();
//        $imgType = array_keys($request['images']);
//        $imgType = array_unique($imgType);
//        $typeSum = array_sum($imgType);
//        $request['is_personal'] = $this->is_true($request['is_personal']);
//        if($request['is_personal']) {
//            if(28 != $typeSum) {
//                throw new \Exception('少上传文件');
//            }
//        }else {
//            if(22 != $typeSum) {
//                throw new \Exception('少上传文件');
//            }
//        }
        $insertData = [
            'license_plate' => $this->set_def($request['license_plate']),
            'product'       => $this->set_def($request['product'],0),
            'use_unit'      => $this->set_def($request['use_unit']),
            'car_brand'     => $this->set_def($request['car_brand']),
            'install_unit'  => $this->set_def($request['install_unit']),
            'install_date'  => $this->set_def(strtotime(Request::input('install_date',0)),0),
            'is_personal'   => $this->set_def((int)$request['is_personal'],0),
            'device_type'     => $this->set_def($request['device_type']),
            'device_varieties'=> $this->set_def($request['device_varieties']),
            'device_category' => $this->set_def($request['device_category']),
            'product_name'    => $this->set_def($request['product_name']),
            'qp_count'        => $this->set_def($request['qp_count'],0),
            'qp_pressure'     => $this->set_def($request['qp_pressure'],0),
            'inspection_unit' => $this->set_def($request['inspection_unit']),
            'use_unit_address'=> $this->set_def($request['use_unit_address']),
            'credit_code'     => $this->set_def($request['credit_code']),
            'postal_number'   => $this->set_def($request['postal_number']),
            'car_vin'         => $this->set_def($request['car_vin']),
            'use_date'        => $this->set_def($request['use_date'],0),
            'unit_phone'      => $this->set_def($request['unit_phone']),
            'security_admin'  => $this->set_def($request['security_admin']),
            'mobile'          => $this->set_def($request['mobile']),
            'create_time'   => time(),
            'update_time'   => time()
        ];
        $id = app('db')->table('admin_registration')->insertGetId($insertData);
        if(!res) {
            throw new \Exception('写入数据失败');
        }
        $number = str_pad($id,5,'0',STR_PAD_LEFT).'('.date('y').')';
        app('db')->table('admin_registration')
            ->where('delete_time',0)
            ->where('id',$id)
            ->update(['number'=>$number]);
        return $number;
    }
    protected function is_true($val, $return_null=false){
        $boolval = ( is_string($val) ? filter_var($val, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE) : (bool) $val );
        return ( $boolval===null && !$return_null ? false : $boolval );
    }
    public function index() {
        $where = ['number','license_plate'];
        $db = app('db')->table('admin_registration');
        $db = $this->setWhere($db,$where);

        $result = $db->select('id','number','license_plate','product','use_unit',
                              'car_brand','install_date','install_unit',
                              'create_time','is_personal','cancellation')
                // ->paginate(self::$pageNumber);
                ->orderBy('id','desc')
                ->where('delete_time',0)
                ->first();
        $result->install_date = date("Y-m-d",$result->install_date);

        return $result;
    }
    public function query() {
        $request = Request::input();
        $number  = $this->getNumber();
        $db = app('db')->table('admin_registration');
        $db = $db->where('number',$number)
            ->where('license_plate',$request['license_plate']);

        $result = $db->select('id','number','license_plate','product','use_unit',
                              'car_brand','install_date','install_unit',
                              'create_time','is_personal','cancellation','device_type',
                              'device_varieties','device_category','product_name','qp_count',
                              'qp_pressure','inspection_unit','use_unit_address','credit_code',
                              'postal_number','car_vin','use_date','unit_phone','security_admin',
                              'mobile')
                // ->paginate(self::$pageNumber);
                ->orderBy('id','desc')
                ->where('delete_time',0)
                ->first();
        $result->install_date = date("Y-m-d",$result->install_date);

        return $result;
    }
    private function getNumber() {
        $product_number = Request::input('product_number','');
        if(empty($product_number)) {
            throw new \Exception('产品编号不能为空');
        }
        $res = app('db')->table('admin_registration_detail')
             ->where('product_number',$product_number)
             ->where('delete_time',0)
             ->select('number')
             ->first();
        return !empty($res)?$res->number:'';
    }
    public function updateData($update = []) {

        $number = Request::input('number');
        if(empty($number)) {
            throw new \Exception('number不能为空');
        }
        $request = Request::input();
        $columns = ['license_plate','product','use_unit','car_brand','install_unit','install_date'];

        $updateData = array_where($request,function($key,$val) use ($columns) {
            return in_array($key,$columns);
        });
        if(isset($updateData['install_date'])) {
            $updateData['install_date'] = strtotime($updateData['install_date']);
        }
        if(!empty($update)) {
            $updateData = array_merge($updateData,$update);
        }
        if(!empty($updateData)) {
            $updateData = array_add($updateData,'update_time',time());
            $res = app('db')->table('admin_registration')->where('number',$number)->update($updateData);
            if(!$res) {
                throw new \Exception('更新数据失败');
            }
        }
        return $number;
    }
    protected function setWhere($db,$where) {
        $request = Request::input();
        
        $condition = array_where($request,function($key,$val) use ($where) {
            return in_array($key,$where);
        });
        if(empty($condition)) {
            throw new \Exception('number不能为空');
        }

        foreach($condition as $k=>$v) {
            $db = $db->where($k,$v);
        }

        return $db;
    }
    protected function setLIKE($db,$where) {
        $request = Request::input();
        
        $condition = array_where($request,function($key,$val) use ($where) {
            return in_array($key,$where);
        });

        foreach($condition as $k=>$v) {
            $db = $db->where($k,'LIKE','%'.$v.'%');
        }

        return $db;
    }
    public function getName() {
        $request = Request::input();

        $db = app('db')->table('admin_registration')
            ->where('delete_time',0);

        $where = ['license_plate'];
        $db = $this->setLIKE($db,$where);
        $result = $db->select('license_plate')
                ->limit(50)
                ->get();

        return $result;
    }
    public function check() {
        try{
            $number = Request::input('number','');
            $license_plate = Request::input('license_plate','');

            if(app('db')->table('admin_registration')->where('number',$number)
               ->orWhere('license_plate',$license_plate)
               ->where('delete_time',0)
               ->exists()) {
                throw new \Exception('已存在');
            }
            return ['code'=>0,'msg'=>'未存在','data'=>[]];
        }catch (\Exception $e) {
            return ['code'=>5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
    }
    public function regList() {
        $res = app('db')->table('admin_registration')
             ->orderBy('id','desc')
             ->where('delete_time',0)
             ->select('number','license_plate','install_unit','product','install_date')
             ->limit(20)
             ->get();
        return $res;
    }
}