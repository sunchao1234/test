<?php

/**
*    +----------------------------------------------------------------------
*    | @date: 2015-09-27
*    +----------------------------------------------------------------------
*    | @controller BaseModel.php: 中间层
*    +----------------------------------------------------------------------
*    | @Author: liudawei <304646940@qq.com>
*    +----------------------------------------------------------------------
*/

namespace App\Models;
use Log;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model{

    public $unixtime;

    public function fromDateTime($value){
        if($this->unixtime){return strtotime(parent::fromDateTime($value));}
    }

    public function pageLimit(){
        return \Config::get('system.page_limit');
    }

}
