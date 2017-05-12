<?php

namespace App\Models\Registration;

use Validator;
use Request;

class BaseModel {

    protected static $pageNumber = 15;
    protected function valid($valid, $message) {
        $request = Request::input();
        if('POST' == Request::method()) {
            if(Request::has('_token')) {
                throw new \Exception('_token不能为空');
            }
        }
        $validator = Validator::make($request, $vaild, $message);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        return $request();
    }
}