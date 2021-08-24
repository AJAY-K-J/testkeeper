<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\storekeeper\UserController;
use App\Http\Controllers\storekeeper\RoleController;
use App\Http\Controllers\storekeeper\SupplierController;
use App\Http\Controllers\storekeeper\CategoryController;
use App\Http\Controllers\storekeeper\ItemController;
use App\Http\Controllers\storekeeper\SectionController;
use App\Http\Controllers\storekeeper\StoreArrivalController;
use App\Http\Controllers\sections\SectionPageController;
use App\Http\Controllers\sections\SectionResponseController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/addarrivals',[StoreArrivalController::class,'store']);

// Route::post('/adduser',[UserController::class,'store']);
Route::get('/adduser',[UserController::class,'userslist']);
Route::delete('/delete/{id}',[UserController::class,'destroy']);

Route::post('/add_category',[CategoryController::class,'store']);
Route::get('/add_category',[CategoryController::class,'categorylist']);
Route::delete('/add_category/{id}',[CategoryController::class,'destroy']);

Route::post('/add_supplier',[SupplierController::class,'store']);
Route::get('/add_supplier',[SupplierController::class,'supplierlist']);
Route::delete('/add_supplier/{id}',[SupplierController::class,'destroy']);

Route::post('/add_section',[SectionController::class,'store']);
Route::get('/add_section',[SectionController::class,'sectionslist']);
Route::delete('/add_section/{id}',[SectionController::class,'destroy']);
Route::get('/section',[SectionController::class,'sectiondata']);

Route::post('/add_item',[ItemController::class,'store']);
Route::get('/add_item',[ItemController::class,'itemlist']);
Route::delete('/add_item/{id}',[ItemController::class,'destroy']);


Route::get('/add_role',[RoleController::class,'roleslist']);
Route::delete('/add_role/{id}',[RoleController::class,'destroy']);

