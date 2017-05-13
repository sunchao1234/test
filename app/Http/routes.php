<?php

Route::get('/', 'IndexController@index');
Route::get('/index', 'IndexController@index');
Route::group(['prefix'=>'admin', 'namespace' => 'Admin'],function(){
    Route::get('/',              [ 'as' => 'admin', 'uses' => 'IndexController@index']);
    Route::any('/login',         [ 'as' => 'admin', 'uses' => 'UsersController@login']);
    Route::any('/logout',        [ 'as' => 'admin', 'uses' => 'AuthController@getLogout']);
    Route::any('/login/submit',  [ 'as' => 'admin', 'uses' => 'AuthController@postLogin']);
    Route::controller('/role',     'RoleController');
    Route::get('/registration/index', 'RegistrationController@index');
    Route::get('/registration/register', 'RegistrationController@register');
    Route::get('/registration/add_driver_info', 'RegistrationController@addDriverInfo');
    Route::get('/registration/get_driver_info', 'RegistrationController@getDriverInfo');
    Route::get('/registration/add_detail', 'RegistrationController@addDetail');
    Route::get('/registration/get_detail', 'RegistrationController@getDetail');
    Route::post('/registration/upload', 'RegistrationController@upload');
});

