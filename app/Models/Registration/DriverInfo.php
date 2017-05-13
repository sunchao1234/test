<?php

namespace App\Models\Registration;

use Request;


class DriverInfo extends BaseModel {

    public function addInfo() {
        $request = Request::input('driver_data');
        $insertData = array_map(function($key,$val) {
            return [
                'number'        => $val['number'],
                'name'          => $val['name'],
                'id_card'       => $val['id_card'],
                'remark'        => $val['remark'],
                'create_time'   => time(),
                'update_time'   => time()
            ];
        },$request);
            
        $res = app('db')->table('admin_driver_info')->insert($insertData);
        if(!res) {
            throw new \Exception('写入数据失败');
        }
        return ['code'=>0,'msg'=>'success','data'=>$insertData];
    }
    public function getInfo($number) {
        // $number = Request::input('number','');
        // if(empty($number)) {
        //     throw new \Exception('number不能为空');
        // }
        $result = $db->where('number',$number)
                ->select('id','number','name','id_card','remark','create_time')
                ->where('delete_time',0)
                ->get();
        return $result;
    }
}