<?php

Route::get('/', 'IndexController@index');
Route::get('/index', 'IndexController@index');
Route::group(['prefix'=>'admin', 'namespace' => 'Admin'],function(){
    Route::get('/',              [ 'as' => 'admin', 'uses' => 'IndexController@index']);
    Route::any('/login',         [ 'as' => 'admin', 'uses' => 'UsersController@login']);
    Route::any('/logout',        [ 'as' => 'admin', 'uses' => 'AuthController@getLogout']);
    Route::any('/login/submit',  [ 'as' => 'admin', 'uses' => 'AuthController@postLogin']);
    Route::controller('/role',     'RoleController');
    // 获取登记表数据
    Route::get('/registration/index', 'RegistrationController@index');
    // 添加登记表数据
    Route::post('/registration/register', 'RegistrationController@register');
    // 文件上传
    Route::post('/registration/upload', 'RegistrationController@upload');
    // 变更
    Route::post('/registration/fillpermit', 'RegistrationController@fillPermit');
    // 换证
    Route::post('/registration/replacement', 'RegistrationController@replacement');
    // 撤销
    Route::post('/registration/cancellation', 'RegistrationController@cancellation');
    // 获取车牌信息
    Route::get('/registration/name', 'RegistrationController@getName');
    // 补证
    Route::post('/registration/newfillpermit', 'RegistrationController@newFillPermit');
    // 修改登记表信息
    Route::post('/registration/modifyreg', 'RegistrationController@reReg');
});

