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
    Route::post('/registration/register', 'RegistrationController@register');
    Route::post('/registration/upload', 'RegistrationController@upload');
    Route::post('/registration/fillpermit', 'RegistrationController@fillPermit');
    Route::post('/registration/replacement', 'RegistrationController@replacement');
    Route::post('/registration/cancellation', 'RegistrationController@cancellation');
    Route::get('/registration/getname', 'RegistrationController@getName');
    Route::post('/registration/newfillpermit', 'RegistrationController@newFillPermit');
    Route::post('/registration/modifyreg', 'RegistrationController@reReg');
});

