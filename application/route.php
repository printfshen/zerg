<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;

//Route::rule('·�ɱ��ʽ','·�ɵ�ַ','��������','·�ɲ���(����)','��������(����)');
//�������� GET  POST DELETE  PUT *
//Route::rule('hello','sample/Test/hello','GET|POST',['https'=>false]);
//Route::get('hello','sample/Test/hello');
//Route::post('hello/:id','sample/Test/hello');
//Route::any('hello','sample/Test/hello');

//Banner ·��
Route::get('api/:version/Banner/:id','api/:version.Banner/getBanner');
//Theme ·��
Route::get('api/:version/Theme','api/:version.Theme/getSimpleList');


//
Route::get('api/:version/Theme/:id','api/:version.Theme/getComplexOne');



Route::get('api/:version/Product/recent','api/:version.Product/getRecent');

Route::get('api/:version/Product/by_category','api/:version.Product/getAllInCategory');

Route::get('api/:version/Product/:id','api/:version.Product/getOne', [], ['id' => '\d+']);
//·�ɷ���  ��ͬ����  Ч�ʸ�
//Route::group('api/:version/product', function (){
//    Route::get('/by_category', 'api/:version.Product/getAllInCategory');
//    Route::get('/recent', 'api/:version.Product/getRecent');
//    Route::get('/:id', 'api/:version.Product/getOne', [], ['id' => '/d+']);
//});


//�����б�ӿ�
Route::get('api/:version/Category/all','api/:version.Category/getAllCategories');
//

//Token
Route::post('api/:version/Token/user','api/:version.Token/getToken');




