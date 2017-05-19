<?php

namespace App\Models\Registration;

class MiddleModels {


    protected $regModel;
    protected $regDetailModel;
    protected $driverModel;
    protected $uploadModel;
    public function __construct() {
        $this->regModel = new Registration();
        $this->regDetailModel = new RegistrationDetail();
        $this->driverModel = new DriverInfo();
        $this->uploadModel = new UploadPic();
    }
    public function register() {

        $number = $this->regModel->register();
        $this->driverModel->addInfo($number);
        $this->regDetailModel->addDetail($number);
        $this->uploadModel->addData($number);
        return ['code'=>0,'msg'=>'success','data'=>[]];
    }
    public function index() {
        $reg = $this->regModel->index();
        if(!empty($reg)) {
            $driver = $this->driverModel->getInfo($reg->number);
            $imgs   = $this->uploadModel->getData($reg->number);
            $detail = $this->regDetailModel->getDetail($reg->number);
            $res    = ['registration'=>$reg,'driver_info'=>$driver,
                       'imgs'=>$imgs,'detail'=>$detail];
        }else {
            $res    = [];
        }

        return ['code'=>0,'msg'=>'success','data'=>$res];
    }
    public function query() {
        $reg = $this->regModel->query();
        if(!empty($reg)) {
            $driver = $this->driverModel->getInfo($reg->number);
            $imgs   = $this->uploadModel->getData($reg->number);
            $detail = $this->regDetailModel->getDetail($reg->number);
            $res    = ['registration'=>$reg,'driver_info'=>$driver,
                       'imgs'=>$imgs,'detail'=>$detail];
        }else {
            $res    = [];
        }

        return ['code'=>0,'msg'=>'success','data'=>$res];
    }

    public function upload() {

        $res = $this->uploadModel->upload();
        return ['code'=>0,'msg'=>'success','data'=>$res];
    }
    public function fillPermit() {
        $this->uploadModel->modifyData();
        $this->regModel->updateData();
        return ['code'=>0,'msg'=>'success','data'=>[]];
    }
    public function replacement() {
        $this->uploadModel->modifyData();
        return ['code'=>0,'msg'=>'success','data'=>[]];
    }
    public function cancellation() {
        $this->regModel->updateData(['cancellation'=>time()]);
        $this->uploadModel->modifyData();
        return ['code'=>0,'msg'=>'success','data'=>[]];
    }
    public function getName() {
        $res = $this->regModel->getName();
        return ['code'=>0,'msg'=>'success','data'=>$res];
    }
    public function newFillPermit() {
        $this->uploadModel->modifyData();
        return ['code'=>0,'msg'=>'success','data'=>[]];
    }
    public function reReg() {
        $number = $this->regModel->updateData();
        $this->regDetailModel->addDetail($number);
        $this->driverModel->addInfo($number);
        return ['code'=>0,'msg'=>'success','data'=>[]];
    }
    public function detailDel() {
        $this->regDetailModel->deleteData();
        return ['code'=>0,'msg'=>'success','data'=>[]];
    }
    public function driverDel() {
        $this->regDriverModel->deleteData();
        return ['code'=>0,'msg'=>'success','data'=>[]];
    }
    public function regList() {
        $res = $this->regModel->regList();
        return ['code'=>0,'msg'=>'success','data'=>$res];
    }
}