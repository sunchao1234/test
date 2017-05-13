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

        try{
            $number = $this->regModel->register();
            $this->driverModel->addInfo($number);
            $this->regDetailModel->addDetail($number);
            $this->uploadModel->addData($number);
            return ['code'=>0,'msg'=>'success','data'=>[]];
        } catch(\Exception $e) {
            return ['code'=>5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
    }
    public function index() {
        try {

            $reg = $this->regModel->index();
            if(empty($reg)) {
            }
            $regDetail = $this->regDetailModel->getDetail($reg->number);

        }catch(\Exception $e){}
    }

    public function upload() {

        try{
            $res = $this->uploadModel->upload();
            return ['code'=>0,'msg'=>'success','data'=>$res];
        }catch(\Execption $e) {
            return ['code'=>5000+$e->getLine(),'msg'=>$e->getMessage(),'data'=>[]];
        }
    }
}