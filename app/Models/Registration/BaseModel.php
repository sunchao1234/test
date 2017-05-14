<?php

namespace App\Models\Registration;

use Validator;

class BaseModel {

    protected static $pageNumber = 15;
    protected function valid($request, $valid, $message=[]) {
        $validator = Validator::make($request, $valid, $message);

        if ($validator->fails()) {
            throw new \Exception($validator->errors()->first());
        }
        return $request;
    }
}