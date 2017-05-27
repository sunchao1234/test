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
            $message = [
                'license_plate.required' => '车牌号码不能为空',
            ];
            $this->valid([
                'license_plate'  => 'required',
            ],$message);
            $res = $mid->register();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function index(MiddleModels $mid) {
        try{
            $msg = [
                'license_plate.required' => '车牌号不能为空'
            ];
            $this->valid([
                'license_plate' => 'required'
            ],$msg);
            $res = $mid->index();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function query(MiddleModels $mid) {
        try{
            $msg = [
                'license_plate.required' => '车牌号不能为空',
            ];
            $this->valid([
                'license_plate' => 'required',
            ],$msg);
            $res = $mid->query();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function fillPermit(MiddleModels $mid) {
        try{
            $msg = [
                'number.required' => '登记证编号不能为空',
                'images.required' => '图片不能为空'
            ];
            $this->valid([
                'number' => 'required',
                'images' => 'required'
            ],$msg);
            $res = $mid->fillPermit();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function replacement(MiddleModels $mid) {
        try{
            $msg = [
                'number.required' => '登记证编号不能为空',
                'images.required' => '图片不能为空'
            ];
            $this->valid([
                'number' => 'required',
                'images' => 'required'
            ],$msg);
            $res = $mid->replacement();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function cancellation(MiddleModels $mid) {
        try{
            $msg = [
                'number.required' => '登记证编号不能为空',
                'images.required' => '图片不能为空'
            ];
            $this->valid([
                'number' => 'required',
                'images' => 'required'
            ],$msg);
            $res = $mid->cancellation();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function getName(MiddleModels $mid) {
        try{
            $msg = [
                'license_plate.required' => '车牌号不能为空'
            ];
            $this->valid([
                'license_plate' => 'required',
            ],$msg);
            $res = $mid->getName();
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function newFillPermit(MiddleModels $mid) {
        try{
            $msg = [
                'number.required' => '登记证编号不能为空',
                'images.required' => '图片不能为空'
            ];
            $this->valid([
                'number' => 'required',
                'images' => 'required'
            ],$msg);
            $res = $mid->newFillPermit();
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function newfillpermit1(MiddleModels $mid) {
        try{
//            $msg = [
//                'images.required' => '图片不能为空'
//            ];
//            $this->valid([
//                'images'  => 'required'
//            ],$msg);
            $res = $mid->reReg();
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function upload(MiddleModels $middle) {
        try{
            $msg = [
                'type.required' => '图片类型不能为空',
            ];
            $this->valid([
                'type' => 'required'
            ],$msg);
            $res = $middle->upload();
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function singleUpload(MiddleModels $middle) {
        try{
            $msg = [
                'type.required' => '图片类型不能为空',
            ];
            $this->valid([
                'type' => 'required'
            ],$msg);
            $res = $middle->singleUpload();
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function delDetail(MiddleModels $mid) {
        try{
            $msg = [
                'id.required' => 'id不能为空',
            ];
            $this->valid([
                'id'  => 'required',
            ],$msg);
            $res = $mid->detailDel();
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function delDriver(MiddleModels $mid) {
        try{
            $msg = [
                'id.required' => 'id不能为空',
            ];
            $this->valid([
                'id'  => 'required',
            ],$msg);
            $res = $mid->driverDel();
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function regList(MiddleModels $mid) {
        try{
            $res = $mid->regList();
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function addPicInfo(MiddleModels $mid) {
        try{
            $msg = [
                'images.required' => '图片不能为空'
            ];
            $this->valid([
                'images' => 'required'
            ],$msg);
            $res = $mid->addPicInfo();
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function updateInfo(MiddleModels $mid) {
        try{
            $msg = [
                'number.required' => '编号不能为空',
            ];
            $this->valid([
                'number'         => 'required',
            ],$msg);
            $res = $mid->updateInfo();
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function newRegister(MiddleModels $mid) {
        try{
            // $this->valid([]);
            $res = $mid->newRegister();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
}