<?php

namespace App\Models\Registration;

use Request;

class UploadPic extends BaseModel {


    public function upload() {

        if(!Request::hasFile('img')) {

            throw new \Exception('img不能为空');
        }
        $pics = Request::file('img');
        $file_path = 'upload';
        if(!file_exists($file_path)) mkdir($file_path,0777,true);

        $new_path = [];
        foreach($pics as $pic) {
            $client_name = $pic->getClientOriginalName();
            $extension   = $pic->getClientOriginalExtension();
            $new_name    = md5(date('ymdhis').$client_name).".".$extension;
            $path        = $pic->move($file_path,$new_name);
            array_push($new_path, $file_path . '/' . $new_name);
        }
        return $new_path;
    }
}