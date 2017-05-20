<?php namespace App\Http\Controllers\Admin;

/**
*    +----------------------------------------------------------------------
*    | @date: 2015-09-28
*    +----------------------------------------------------------------------
*    | @controller AdminController.php: 处理层
*    +----------------------------------------------------------------------
*    | @Author: liudawei <304646940@qq.com>
*    +----------------------------------------------------------------------
*/
use DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Models\Registration\MiddleModels;
class IndexController extends BaseController
{
    public $is_debug = false;
    public function index(MiddleModels $mid)
    {
        $res = $mid->regList();
        return view('admin.index',['res'=>$res]);
    }

    public function setCache($key, $data, $expires = NULL) {
        $this->redis_expires =  Carbon::now()->addMinutes(5);
        $expires = !is_null($expires) ? $expires : $this->redis_expires;
        $is_set = Cache::put($key, $data, $expires);
        return $is_set;
    }

    public function getCache($key) {
        return Cache::get($key);
    }
}
