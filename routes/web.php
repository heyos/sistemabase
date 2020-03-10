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

Auth::routes();

Route::group(['middleware'=>'auth'],function(){

    Route::get('/','HomeController@index');
    Route::get('/home', 'HomeController@index')->name('home');

    //SLUG DE LAS VISTAS
    Route::get('/{slug}','MenuController@index');

    // DATATABLES
    Route::prefix('data')->group(function(){
        // Route::get('cateproducto-data', 'CatProductoController@getData')->name('cateproducto.data');
    });
    

    //ACCESO A CONTROLADORES
    Route::prefix('controller')->group(function(){

        //CATEGORIA PRODUCTOS
        // Route::resource('categoriaproducto','CatProductoController');

    });


});