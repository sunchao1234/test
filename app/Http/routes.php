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
    // 查询登记表数据 和上面返回数据一样，区别在与必须同时满足两个条件
    Route::get('/registration/query', 'RegistrationController@query');
    // 添加登记表数据
    Route::post('/registration/register', 'RegistrationController@register');
    // 文件上传(多个文件上传)
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
    Route::post('/registration/newfillpermit1', 'RegistrationController@newfillpermit1');
    // 删除车用气瓶使用登记表
    Route::post('/registration/deldetail', 'RegistrationController@delDetail');
    // 删除驾驶员信息
    Route::post('/registration/deldriver', 'RegistrationController@delDriver');
    // 首页列表，显示20条信息
    Route::get('/registration/reglist', 'RegistrationController@regList');
    // 文件上传（单个文件上传）
    Route::post('/registration/singleupload', 'RegistrationController@singleUpload');
    // 更新内容
    Route::post('/registration/updateinfo', 'RegistrationController@updateInfo');
    // 添加图片信息
    Route::post('/registration/addpicinfo', 'RegistrationController@addPicInfo');
    // 新的录入登记表数据接口
    Route::post('/registration/register2', 'RegistrationController@register2');
});

