<?php

namespace App\Models\Registration;

use Request;


class RegistrationDetail extends BaseModel {

    public function addDetail() {
        $request = Request::input('reg_det_data');
        if(empty($request)) {
            throw new \Exception('请不要漏填');
        }
        $insertData = array_map(function($key,$val) {
            return [
                'number'        => $val['number'],
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
        // $number = Request::input('number');
        // if(empty($number)) {
        //     throw new \Exception('id不能为空');
        // }
        $result = $db->where('number',$number)
                ->select('id','number','device_number','made_unit','made_date',
                         'product_number','volume','next_time_check_date','create_time')
                ->where('detele_time',0)
                ->get();
        return ['code'=>0,'msg'=>'success','data'=>$result];
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