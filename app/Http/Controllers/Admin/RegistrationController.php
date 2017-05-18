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
                'number.required'        => '登记证编号不能为空',
                'license_plate.required' => '车牌号码不能为空',
                'product.required'       => '充装介质不能为空',
                'use_unit.required'      => '使用单位不能为空',
                'car_brand.required'     => '车种不能为空',
                'install_unit.required'  => '安装单位不能为空',
                'install_date.required'  => '安装日期不能为空',
                'driver_data.required'   => '驾驶人员信息不能为空',
                'reg_det_data.required'  => '汽车气瓶使用登记证不能为空',
                'images.required'        => '图片不能为空'
            ];
            $this->valid([
                'number'         => 'required',
                'license_plate'  => 'required',
                'product'        => 'required',
                'use_unit'       => 'required',
                'car_brand'      => 'required',
                'install_unit'   => 'required',
                'install_date'   => 'required',
                'reg_det_data'   => 'required',
                'driver_data'    => 'required',
                'images'          => 'required'
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
                'number.required'        => '编号不能为空',
            ];
            $this->valid([
                'license_plate' => 'required',
                'number'        => 'required'
            ],$msg);
            $res = $mid->index();
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
            $msg = [
                'images.required' => '图片不能为空'
            ];
            $this->valid([
                'images'  => 'required'
            ],$msg);
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
    public function delDetail(MiddleModels $mid) {
        try{
            $msg = [
                'id.required' => 'id不能为空',
            ];
            $this->valid([
                'id'  => 'required',
            ],$msg);
            $res = $mid->detailDel();
            return response()->json($res);
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
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
            return response()->json($res);
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
    }
}