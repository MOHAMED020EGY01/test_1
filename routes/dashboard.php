<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\Dashboard as DashboardDashboard;
use App\Http\Controllers\Dashboard\Category as Category;
use App\Http\Controllers\Dashboard\Product;
use App\Http\Controllers\Dashboard\Store;
use App\Http\Controllers\Dashboard\UserController;

Route::get('/dashboard',[DashboardDashboard::class,'index'])->name('dashboard');


Route::group(
    [
        'middleware' => ['auth'],
        'as'=>'category.', // with name
        'prefix' => '/dashboard', // with path 


], 
function () {

    #Category trach 
    Route::get('/category/show/{id}',[Category::class,'show'])->name('show');
    Route::get('/category/trash',[Category::class,'trash'])->name('trash');
    Route::put('/category/trash/{id}/restore',[Category::class,'restore'])->name('restore');
    Route::delete('/category/trash/{id}/Force-Delete',[Category::class,'forceDelete'])->name('forceDelete');    
    #   
    #
    #
    Route::get('/category',[Category::class,'index'])->name('index');
    #
    #Create category
    #
    Route::get('/category/create',[Category::class,'create'])->name('create');
    Route::post('/category/create',[Category::class,'store'])->name('store');
    #
    #Update category
    #
    Route::get('/category/edite/{id}',[Category::class,'edit'])->name('edite')->where('id','.*');
    Route::post('/category/edite/{id}',[Category::class,'update'])->where('id','[0-9]+')->name('update');
    #
    #
    #
    Route::delete('/category/delete/{id}',[Category::class,'destroy'])->name('destroy');
    Route::delete('/category/delete/',[Category::class,'AllDestroy'])->name('AllDestroy');
    #

});




Route::group(
    [
        'middleware' => ['auth'],
        'as'=>'product.', // with name
        'prefix' => '/dashboard', // with path 
], 
function () {

    #Product trach 
    // Route::get('/category/show/{id}',[Category::class,'show'])->name('show');
    // Route::get('/category/trash',[Category::class,'trash'])->name('trash');
    // Route::put('/category/trash/{id}/restore',[Category::class,'restore'])->name('restore');
    // Route::delete('/category/trash/{id}/Force-Delete',[Category::class,'forceDelete'])->name('forceDelete');    
    #   
    #
    #
    Route::get('/product',[Product::class,'index'])->name('index');
    #
    #Create category
    #
    Route::get('/product/create',[Product::class,'create'])->name('create');
    Route::post('/product/create',[Product::class,'store'])->name('store');
    #
    #Update category
    #
    Route::get('/product/edite/{id}',[Product::class,'edit'])->name('edite')->where('id','.*');
    Route::put('/product/edite/{id}',[Product::class,'update'])->where('id','[0-9]+')->name('update');
    #
    #
    #
    Route::delete('/product/delete/{id}',[Product::class,'destroy'])->name('destroy');
    Route::delete('/product/delete/',[Product::class,'AllDestroy'])->name('AllDestroy');
    #

});



Route::group(
    [
        'middleware' => ['auth'],
        'as'=>'store.', // with name
        'prefix' => '/dashboard', // with path 


], 
function () {

    #Product trach 
    // Route::get('/category/show/{id}',[Category::class,'show'])->name('show');
    // Route::get('/category/trash',[Category::class,'trash'])->name('trash');
    // Route::put('/category/trash/{id}/restore',[Category::class,'restore'])->name('restore');
    // Route::delete('/category/trash/{id}/Force-Delete',[Category::class,'forceDelete'])->name('forceDelete');    
    #   
    #
    #
    Route::get('/store',[Store::class,'index'])->name('index');
    #
    #Create category
    #
    Route::get('/store/create',[Store::class,'create'])->name('create');
    Route::post('/store/create',[Store::class,'store'])->name('storedata');
    #
    #Update category
    #
    Route::get('/store/edite/{id}',[Store::class,'edit'])->name('edite')->where('id','.*');
    Route::post('/store/edite/{id}',[Store::class,'update'])->where('id','[0-9]+')->name('update');
    #
    #
    #
    Route::delete('/store/delete/{id}',[Store::class,'destroy'])->name('destroy');
    Route::delete('/store/delete/',[Store::class,'AllDestroy'])->name('AllDestroy');
    #

});


Route::group(
    [
        'middleware' => ['auth'],
        'as'=>'user.', // with name
        'prefix' => '/dashboard', // with path 


], 
function () {

    #Product trach 
    // Route::get('/category/show/{id}',[Category::class,'show'])->name('show');
    // Route::get('/category/trash',[Category::class,'trash'])->name('trash');
    // Route::put('/category/trash/{id}/restore',[Category::class,'restore'])->name('restore');
    // Route::delete('/category/trash/{id}/Force-Delete',[Category::class,'forceDelete'])->name('forceDelete');    
    #   
    #
    #
    Route::get('/user',[UserController::class,'index'])->name('index');
    #
    #Create category
    #
    Route::get('/user/create',[UserController::class,'create'])->name('create');
    Route::post('/user/create',[UserController::class,'store'])->name('storedata');
    #
    #Update category
    #
    Route::get('/user/edite/{id}',[UserController::class,'edit'])->name('edite')->where('id','.*');
    Route::post('/user/edite/{id}',[UserController::class,'update'])->where('id','[0-9]+')->name('update');
    #
    #
    #
    Route::delete('/user/delete/{id}',[UserController::class,'destroy'])->name('destroy');
    Route::delete('/user/delete/',[UserController::class,'AllDestroy'])->name('AllDestroy');
    #

});

