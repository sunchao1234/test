<?php namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesCommands;
use Illuminate\Routing\Controller as BaseControllers;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class Controller extends BaseControllers {
    const HTTP_SUCCESS = 200;
    const HTTP_ERROR  = -200;
    use DispatchesCommands, ValidatesRequests;
}
