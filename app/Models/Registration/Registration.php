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
        $insertData = [
            'number'        => $request['number'],
            'license_plate' => $request['license_plate'],
            'product'       => $request['product'],
            'use_unit'      => $request['use_unit'],
            'car_brand'     => $request['cat_brand'],
            'install_unit'  => $request['install_unit'],
            'install_date'  => strtotime($request['install_date']),
            'create_time'   => time(),
            'update_time'   => time()
        ];
        $res = app('db')->table('admin_registration')->insert($insertData);
        if(!res) {
            throw new \Exception('写入数据失败');
        }
        return ['code'=>0,'msg'=>'success','data'=>$insertData];
    }
    public function index() {
        $where = ['number','license_plate'];
        $db = app('db')->table('admin_registration');
        $db = $this->setWhere($db,$where);

        $result = $db->select('id','number','license_plate','product','use_unit',
                              'car_brand','install_date','install_unit','create_time')
                // ->paginate(self::$pageNumber);
                ->orderBy('id','desc')
                ->first();

        return $result;
    }
    public function updateData() {

        $id = Request::input('id');
        $request = Request::input();
        $updateData = [
            'number'        => $request['number'],
            'license_plate' => $request['license_plate'],
            'product'       => $request['product'],
            'use_unit'      => $request['use_unit'],
            'car_brand'     => $request['cat_brand'],
            'install_unit'  => $request['install_unit'],
            'install_date'  => strtotime($request['install_date']),
            'update_time'   => time()
        ];
        $res = app('db')->table('admin_registration')->where('id',$id)->update($updateData);
        if(!$res) {
            throw new \Exception('更新数据失败');
        }
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
    public function getRegistration() {
        try{
            $id = Request::input('id',0);
            if(empty($id)) {
                throw new \Exception('id不能为空');
            }
            $result = $db->where('id',$id)
                    ->select('id','number','license_plate','product','use_unit',
                        'car_brand','install_date','install_unit','create_time')
                    ->first();
            return ['code'=>0,'msg'=>'success','data'=>$result];
        }catch(\Exception $e) {
            return ['code'=>5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
    }
    public function check() {
        try{
            $number = Request::input('number','');
            $license_plate = Request::input('license_plate','');

            if(empty($number) && empty($license_plate)) {
                throw new \Exception('登记证编号和车牌号码不能都为空');
            }

            $condition = !empty($number)?['number'=>$number]:['license_plate'=>$license_plate];

            if(app('db')->table('admin_registration')->where($condition)->exists()) {
                throw new \Exception('已存在');
            }
            return ['code'=>0,'msg'=>'未存在','data'=>[]];
        }catch (\Exception $e) {
            return ['code'=>5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
    }
}