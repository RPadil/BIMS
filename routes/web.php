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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Suppliers
Route::resource('suppliers', 'SuppliersController');
Route::get('suppliers.destroy/{id}', [
    'uses' => 'SuppliersController@destroy',
    'as'   => 'suppliers.destroy'
  ]);
Route::get('suppliers_deactivate/{id}', [
    'uses' => 'SuppliersController@suppliersdeactivate',
    'as'   => 'suppliersdeactivate'
  ]);
Route::get('suppliers_activate/{id}', [
    'uses' => 'SuppliersController@suppliersactivate',
    'as'   => 'suppliersactivate'
  ]);

//Categories
Route::resource('categories', 'CategoriesController');
Route::get('categories.destroy/{id}', [
    'uses' => 'CategoriesController@destroy',
    'as'   => 'categories.destroy'
  ]);
Route::get('categories_deactivate/{id}', [
    'uses' => 'CategoriesController@categoriesdeactivate',
    'as'   => 'categoriesdeactivate'
  ]);
Route::get('categories_activate/{id}', [
    'uses' => 'CategoriesController@categoriesactivate',
    'as'   => 'categoriesactivate'
  ]);

//Subcategories
Route::resource('subcategories', 'SubcategoriesController');
Route::get('subcategories.destroy/{id}', [
    'uses' => 'CategoriesController@destroy',
    'as'   => 'subcategories.destroy'
  ]);
Route::get('subcategories_deactivate/{id}', [
    'uses' => 'SubcategoriesController@subcategoriesdeactivate',
    'as'   => 'subcategoriesdeactivate'
  ]);
Route::get('subcategories_activate/{id}', [
    'uses' => 'SubcategoriesController@subcategoriesactivate',
    'as'   => 'subcategoriesactivate'
  ]);

//Parent SKUs
Route::resource('parentsku', 'ParentskuController');
Route::get('parentsku.destroy/{id}', [
    'uses' => 'ParentskuController@destroy',
    'as'   => 'parentsku.destroy'
  ]);
Route::get('parentsku_deactivate/{id}', [
    'uses' => 'ParentskuController@parentskudeactivate',
    'as'   => 'parentskudeactivate'
  ]);
Route::get('parentsku_activate/{id}', [
    'uses' => 'ParentskuController@parentskuactivate',
    'as'   => 'parentskuactivate'
  ]);

//SKUs
Route::resource('sku', 'SkuController');
Route::get('skus.destroy/{id}', [
    'uses' => 'SkuController@destroy',
    'as'   => 'skus.destroy'
  ]);
Route::get('skus_deactivate/{id}', [
    'uses' => 'SkuController@skusdeactivate',
    'as'   => 'skusdeactivate'
  ]);
Route::get('skus_activate/{id}', [
    'uses' => 'SkuController@skusactivate',
    'as'   => 'skusactivate'
  ]);

//Items
Route::resource('item', 'ItemController');
Route::get('items.destroy/{id}', [
    'uses' => 'ItemController@destroy',
    'as'   => 'items.destroy'
  ]);
Route::get('items_deactivate/{id}', [
    'uses' => 'ItemController@itemsdeactivate',
    'as'   => 'itemsdeactivate'
  ]);
Route::get('items_activate/{id}', [
    'uses' => 'ItemController@itemsactivate',
    'as'   => 'itemsactivate'
  ]);


Route::get('subcatdd/{id}','SkuController@subcatdd');
Route::get('subcatskudd/{catid}/{subcatid}','ItemController@subcatskudd');