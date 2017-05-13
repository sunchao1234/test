<?php

namespace App\Models\Registration;

use Request;


class RegistrationDetail extends BaseModel {

    public function addDetail($number) {
        $request = Request::input('reg_det_data');
        if(empty($request)) {
            throw new \Exception('reg_det_data不能为空');
        }
        if(empty($number)) {
            throw new \Exception('number不能为空');
        }
        $insertData = array_map(function($val)use ($number) {
            return [
                'number'        => $number,
                'device_number' => $val['device_number'],
                'made_unit'     => $val['made_unit'],
                'made_date'     => $val['made_date'],
                'product_number'=> $val['product_number'],
                'volume'        => $val['volume'],
                'next_time_check_date'  => strtotime($val['next_time_check_date']),
                'create_time'   => time(),
                'update_time'   => time()
            ];
        },$request);
        $res = app('db')->table('admin_registration_detail')->insert($insertData);
        if(!res) {
            throw new \Exception('写入数据失败');
        }
        return ['code'=>0,'msg'=>'success','data'=>$insertData];
    }
    public function getDetail($number) {
        if(empty($number)) {
            throw new \Exception('number不能为空');
        }
        // $number = Request::input('number');
        // if(empty($number)) {
        //     throw new \Exception('id不能为空');
        // }
        $result = app('db')->where('number',$number)
                ->select('id','number','device_number','made_unit','made_date',
                         'product_number','volume','next_time_check_date','create_time')
                ->where('detele_time',0)
                ->get();
        return $result;
    }
    public function check() {
        try{
            $number = Request::input('number','');

            if(empty($number)) {
                throw new \Exception('登记证编号不能都为空');
            }

            $condition = ['number'=>$number];

            if(app('db')->table('admin_registration')->where($condition)->exists()) {
                throw new \Exception('已存在');
            }
            return ['code'=>0,'msg'=>'未存在','data'=>[]];
        }catch (\Exception $e) {
            return ['code'=>5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
    }
}