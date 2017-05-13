<?php

namespace App\Http\Controllers\Admin;

use Response;
use Request;
use App\Models\Registration\Registration;
use App\Models\Registration\DriverInfo;
use App\Models\Registration\RegistrationDetail;
use App\Models\Registration\MiddleModels;

class RegistrationController extends BaseController {

    public function register(MiddleModels $mid) {
        try{
            $res = $mid->register();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function index(Registration $reg) {
        try{
            $res = $reg->index();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function addDriverInfo(DriverInfo $info) {
        $res = $reg->addInfo();
        return response()->json($res);
    }
    public function getDriverInfo(DriverInfo $info) {
        $res = $reg->getInfo();
        return response()->json($res);
    }
    public function addDetail(RegistrationDetail $detail) {
        $res = $detail->addDetail();
        return response()->json($res);
    }

    public function getDetail(RegistrationDetail $detail) {
        $res = $detail->getDetail();
        return response()->json($res);
    }
    public function upload(MiddleModels $middle) {
        $res = $middle->upload();
        return response()->json($res);
    }
}