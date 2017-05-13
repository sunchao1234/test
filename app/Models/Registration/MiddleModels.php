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

    public function upload() {

        try{
            $res = $this->uploadModel->upload();
            return ['code'=>0,'msg'=>'success','data'=>$res];
        }catch(\Execption $e) {
            return ['code'=>5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
    }
    public function fillPermit() {
        $this->uploadModel->insertData();
        return ['code'=>0,'msg'=>'success','data'=>[]];
    }
}