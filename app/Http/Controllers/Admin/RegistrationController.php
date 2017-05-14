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
            $this->valid([
                'number'         => 'required',
                'license_plate'  => 'required|string',
                'product'        => 'required',
                'use_unit'       => 'required',
                'car_brand'      => 'required|string',
                'install_unit'   => 'required|string',
                'install_date'   => 'required',
                'reg_det_data'   => 'required',
                'driver_data'    => 'required'
            ]);
            $res = $mid->register();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function index(MiddleModels $mid) {
        try{
            $this->valid([
                'license_plate' => 'required'
            ]);
            $res = $mid->index();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function fillPermit(MiddleModels $mid) {
        try{
            $this->valid([
                'number' => 'required',
                'images' => 'required'
            ]);
            $res = $mid->fillPermit();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function replacement(MiddleModels $mid) {
        try{
            $this->valid([
                'number' => 'required',
                'images' => 'required'
            ]);
            $res = $mid->replacement();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function cancellation(MiddleModels $mid) {
        try{
            $this->valid([
                'number' => 'required',
                'images' => 'required'
            ]);
            $res = $mid->cancellation();
        } catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function getName(MiddleModels $mid) {
        try{
            $this->valid([
                'license_plate' => 'required',
            ]);
            $res = $mid->getName();
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function newFillPermit(MiddleModels $mid) {
        try{
            $this->valid([
                'number' => 'required',
                'images' => 'required'
            ]);
            $res = $mid->newFillPermit();
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function reReg(MiddleModels $mid) {
        try{
            $res = $mid->reReg();
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
        return response()->json($res);
    }
    public function upload(MiddleModels $middle) {
        try{
            $this->valid([
                'img'  => 'required',
                'type' => 'required'
            ]);
            $res = $middle->upload();
            return response()->json($res);
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
    }
    public function delDetail(MiddleModels $mid) {
        try{
            $this->valid([
                'id'  => 'required',
            ]);
            $res = $mid->detailDel();
            return response()->json($res);
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
    }
    public function delDriver(MiddleModels $mid) {
        try{
            $this->valid([
                'id'  => 'required',
            ]);
            $res = $mid->driverDel();
            return response()->json($res);
        }catch(\Exception $e) {
            $res = ['code'=> 5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
    }
}