<?php

namespace App\Models\Registration;

use Request;


class DriverInfo extends BaseModel {

    public function addInfo($number) {
        $request = Request::input('driver_data');
        if(empty($number)) {
            throw new \Exception('number不能为空');
        }
        $insertData = array_map(function($val)use ($number) {
            return [
                'number'        => $number,
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
        return $insertData;
    }
    public function getInfo($number) {
        if(empty($number)) {
            throw new \Exception('number不能为空');
        }
        // $number = Request::input('number','');
        // if(empty($number)) {
        //     throw new \Exception('number不能为空');
        // }
        $result = app('db')->table('admin_driver_info')->where('number',$number)
                ->select('id','number','name','id_card','remark','create_time')
                ->where('delete_time',0)
                ->get();
        return $result;
    }
    public function deleteData() {
        $id = Request::input('id');
        $res = app('db')->table('admin_driver_info')
            ->where('delete_time',0)
            ->where('id',$id)
            ->update(['delete_time'=>time()]);
        if(!$res) {
            throw new \Exception('删除失败');
        }
    }
}