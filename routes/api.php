<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RouteController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('product/list',[RouteController::class,'productList']);
Route::get('category/list',[RouteController::class,'CategoryList']);
Route::get('user/list',[RouteController::class,'userList']);
Route::get('pizza/list',[RouteController::class,'pizzaList']);
Route::get('order/list',[RouteController::class,'orderList']);
Route::post('create/category',[RouteController::class, 'createCategory']);
Route::post('create/contact',[RouteController::class, 'createContact']);
Route::post('category/delete',[RouteController::class,'deleteCategory']);
Route::get('category/delete/{id}',[RouteController::class, 'deleteCate']);
Route::post('category/details',[RouteController::class,'categoryDetails']);
Route::get('category/details/{id}',[RouteController::class,'cateDetails']);
Route::post('category/update',[RouteController::class,'categoryUpdate']);
