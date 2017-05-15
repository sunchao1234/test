<?php

namespace App\Models\Registration;

use Request;

class UploadPic extends BaseModel {


    public function upload() {

        if(!Request::hasFile('img')) {

            throw new \Exception('img不能为空');
        }
        $pics = Request::file('img');
        $type = Request::input('type');
        $type = ['type'=>$type];
        $file_path = 'upload';
        if(!file_exists($file_path)) mkdir($file_path,0777,true);

        $new_path = [];
        $url = [];
        foreach($pics as $pic) {
            $client_name = $pic->getClientOriginalName();
            $extension   = $pic->getClientOriginalExtension();
            $new_name    = md5(date('ymdhis').$client_name).".".$extension;
            $path        = $pic->move($file_path,$new_name);
            array_push($url, $file_path . '/' . $new_name);
        }
        $url = ['imgs'=>$url];
        $new_path = array_merge($url,$type);
        return $new_path;
    }
    public function addData($number) {
        $request = Request::input('images',[]);
        if(empty($request)) {
            throw new \Exception('images不能为空');
        }
        $insertData = [];
        foreach($request as $key=>$val) {
            foreach($val as $v) {

                $insertData[] = [
                    'number'  => $number,
                    'pic_url' => $v,
                    'type'    => $key,
                    'create_time' => time(),
                    'update_time' => time()
                ];
            }
        }
        $res = app('db')->table('admin_registration_pic')->insert($insertData);

        if(!$res) {
            throw new \Exception('写入数据失败');
        }
    }
    public function modifyData() {
        $request = Request::input();

        if(empty($request)) {
            throw new \Exception('没有数据');
        }

        $insertData = [];
        foreach($request['images'] as $key=>$val) {
            foreach ($val as $v) {
                if(app('db')->table('admin_registration_pic')
                   ->where('delete_time',0)
                   ->where('number',$request['number'])
                   ->where('type',$key)->exists()) {
                    app('db')->table('admin_registration_pic')
                        ->where('delete_time',0)
                        ->where('number',$request['number'])
                        ->where('type',$key)
                        ->update(['pic_url'=>$v,'update_time'=>time()]);
                }else {
                    $insertData = [
                        'number'  => $request['number'],
                        'pic_url' => $v,
                        'type'    => $key,
                        'create_time' => time(),
                        'update_time' => time()
                    ];
                }
            }
        }
        $res = app('db')->table('admin_registration_pic')->insert($insertData);

        if(!$res) {
            throw new \Exception('写入数据失败');
        }            
    }
    public function getData($number) {
        if(empty($number)) {
            throw new \Exception('number不能为空');
        }
        $result = app('db')->table('admin_registration_pic')
                ->where('delete_time',0)
                ->where('number',$number)
                ->select('id','number','pic_url','type')
                ->get();
        return $result;
    }
}