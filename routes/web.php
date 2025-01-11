<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;


Route::middleware(['admin_auth'])->group(function(){
    //login,register
Route::redirect('/','loginPage');
Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
    //admin
    Route::middleware(['admin_auth'])->group(function(){
        Route::prefix('category')->group(function(){
            Route::get('list',[CategoryController::class,'list'])->name('category#listPage');
            Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#createData');
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#editPage');
            Route::post('update/{id}',[CategoryController::class,'update'])->name('category#updateData');
        });

        //admin account
        Route::prefix('admin')->group(function(){
            Route::get('password/ChangePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');
            //change role with select option
            Route::get('change/role',[AdminController::class,'adminChangeRole'])->name('admin#adminChangeRole');

              //account profile
            Route::get('details',[AdminController::class,'details'])->name('admin#details');
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');
            Route::get('list',[AdminController::class,'adminList'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'adminDelete'])->name('admin#adminDelete');
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::post('change/{id}',[AdminController::class,'change'])->name('admin#changeRoleData');


        });

        //product
        Route::prefix('products')->group(function(){
            Route::get('list',[ProductController::class,'list'])->name('products#list');
            Route::get('create/pizza/page',[ProductController::class,'createPizzaPage'])->name('products#createPizzaPage');
            Route::post('create',[ProductController::class,'create'])->name('products#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('products#delete');
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('products#edit');
            Route::get('updatePage/{id}',[ProductController::class,'updatePage'])->name('products#updatePage');
            Route::post('update',[ProductController::class,'update'])->name('products#update');
        });

        //Order
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'orderList'])->name('admin#orderList');
            Route::get('change/status',[OrderController::class,'changeStatus'])->name('admin#changeStatus');
            Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name('admin#ajaxChangeStatus');
            Route::get('listInfo/{orderCode}',[OrderController::class,'listInfo'])->name('admin#listInfo');
        });

        //user
        Route::prefix('user')->group(function(){
            Route::get('list',[UserController::class,'userList'])->name('admin#userList');
            Route::get('change/role',[UserController::class,'userChangeRole'])->name('admin#userChangeRole');
            Route::get('delete/account/{id}',[UserController::class,'deleteUserAccount'])->name('admin#deleteUserAccount');
            Route::get('edit/account/{id}',[UserController::class,'editAccount'])->name('admin#editUserAccount');
            Route::post('update/account/{id}',[UserController::class,'updateAccount'])->name('admin#updateUserAccount');
            Route::get('message',[ContactController::class,'userMessage'])->name('admin#userMessage');
        });
    });
    //category

        //home
        Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){

            Route::get('home',[UserController::class,'home'])->name('user#home');
            Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
            Route::get('contact',[UserController::class,'contact'])->name('user#userContact');
            Route::prefix('pizza')->group(function(){
            Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('user#details');
            Route::get('history',[UserController::class,'history'])->name('user#history');
            });

            //cart list
            Route::prefix('cart')->group(function(){
                Route::get('list',[UserController::class,'cartList'])->name('user#cartList');
            });
            //user passwords
            Route::prefix('passwords')->group(function(){
                   Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
                   Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');

             });
            Route::prefix('account')->group(function(){
                    Route::get('change',[UserController::class,'accountChangePage'])->name('user#accountChangePage');
                    Route::post('change/{id}',[UserController::class,'accountChange'])->name('user#accountChange');
            });

            Route::prefix('contact')->group(function(){
                    Route::post('create/message',[ContactController::class,'sendMessage'])->name('user#createMessage');
            });

            //create sorting with ajax
            Route::prefix('ajax')->group(function(){
                Route::get('pizza/list',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
                Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
                Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
                Route::get('cart/clear',[AjaxController::class,'clear'])->name('ajax#cartClear');
                Route::get('clear/product',[AjaxController::class,'clearProduct'])->name('ajax#clearProduct');
                Route::get('increase/viewCount',[AjaxController::class,'viewCount'])->name('ajax#viewCount');
            });

    });
});





//admin





//user

