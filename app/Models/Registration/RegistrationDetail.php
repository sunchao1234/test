<?php

namespace App\Models\Registration;

use Request;


class RegistrationDetail extends BaseModel {

    public function addDetail($number) {
        if(empty($number)) {
            throw new \Exception('number不能为空');
        }
        $request = Request::input('reg_det_data','');
        if(!empty($request)) {
            $insertData = array_map(function($val)use ($number) {
                return [
                    'number'        => $number,
                    'device_number' => $this->set_def($val['device_number']),
                    'made_unit'     => $this->set_def($val['made_unit']),
                    'made_date'     => $this->set_def(strtotime($val['made_date']),0),
                    'product_number'=> $this->set_def($val['product_number']),
                    'volume'        => $this->set_def($val['volume'],0),
                    'next_time_check_date'  => $this->set_def(strtotime($val['next_time_check_date']),0),
                    'in_unit_number'=> $this->set_def($val['in_unit_number']),
                    'create_time'   => time(),
                    'update_time'   => time()
                ];
            },$request);
            $res = app('db')->table('admin_registration_detail')->insert($insertData);
            if(!res) {
                throw new \Exception('写入数据失败');
            }
            return $insertData;
        }
        
    }
    public function getDetail($number) {
        if(empty($number)) {
            throw new \Exception('number不能为空');
        }
        // $number = Request::input('number');
        // if(empty($number)) {
        //     throw new \Exception('id不能为空');
        // }
        $result = app('db')->table('admin_registration_detail')->where('number',$number)
                ->select('id','number','device_number','made_unit','made_date',
                         'product_number','volume','next_time_check_date','create_time',
                         'in_unit_number')
                ->where('delete_time',0)
                ->get();
        foreach($result as $v) {
            $v->made_date = date("Y-m",$v->made_date);
            $v->next_time_check_date = date("Y-m",$v->next_time_check_date);
        }
        return $result;
    }
    public function check() {
        try{
            $number = Request::input('number','');

            if(empty($number)) {
                throw new \Exception('登记证编号不能都为空');
            }

            $condition = ['number'=>$number];

            if(app('db')->table('admin_registration')->where($condition)->where('delete_time',0)->exists()) {
                throw new \Exception('已存在');
            }
            return ['code'=>0,'msg'=>'未存在','data'=>[]];
        }catch (\Exception $e) {
            return ['code'=>5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
    }
    public function deleteData() {
        $id = Request::input('id');
        $res = app('db')->table('admin_registration_detail')
            ->where('delete_time',0)
            ->where('id',$id)
            ->update(['delete_time'=>time()]);
        if(!$res) {
            throw new \Exception('删除失败');
        }
    }
    public function updateData() {
        $request = Request::input('reg_det_data');
        $number  = Request::input('number');
        $where   = ['device_number','made_unit','made_date','product_number','volume',
                    'next_time_check_date','in_unit_number'];
        $update   = array_where($request,function($key,$val) use ($where) {
            return in_array($key,$where);
        });
        if(!empty($update)) {
            $res = app('db')->table('admin_dirver_info')
                 ->where('delete_time',0)
                 ->where('number',$number)
                 ->update($update);
            if(!$res) {
                throw new \Exception('更新数据失败');
            }
        }
    }
}