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
    public function index(MiddleModels $mid) {
        try{
            $res = $mid->index();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function fillPermit(MiddleModels $mid) {
        try{
            $res = $mid->fillPermit();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function replacement(MiddleModels $mid) {
        try{
            $res = $mid->replacement();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function cancellation(MiddleModels $mid) {
        try{
            $res = $mid->cancellation();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function getName(MiddleModels $mid) {
        try{
            $res = $mid->getName();
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function newFillPermit(MiddleModels $mid) {
        try{
            $res = $mid->newFillPermit();
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function upload(MiddleModels $middle) {
        $res = $middle->upload();
        return response()->json($res);
    }
}