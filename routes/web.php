<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


Route::prefix('admin')->group(function(){
    
    Auth::routes();

    Route::group(['middleware'=>'auth'],function(){

        Route::get('/','HomeController@index');
        Route::get('/home', 'HomeController@index')->name('home');

        //SLUG DE LAS VISTAS
        Route::group(['middleware'=>'verifyAccessRoute'],function(){
            Route::get('/{slug}','MenuController@index');
        });
        

        // DATATABLES
        Route::prefix('data')->group(function(){
            // Route::get('cateproducto-data', 'CatProductoController@getData')->name('cateproducto.data');
            Route::get('users-data/{slug}', 'UserController@getData')->name('users.data');
        });
        

        //ACCESO A CONTROLADORES
        Route::prefix('controller')->group(function(){

            //CATEGORIA PRODUCTOS
            // Route::resource('categoriaproducto','CatProductoController');
            
            //USUARIOS
            Route::resource('users','UserController');
        });


    });


});


    

