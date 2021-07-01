<?php

use App\Http\Middleware\authLogin;
use App\Http\Middleware\websitePage;
use Illuminate\Support\Facades\Route;
use App\http\Controllers\websiteController;
use App\http\Controllers\UsersController;
use App\http\Controllers\overviewController;
use App\http\Controllers\settingController;
use App\http\Controllers\pagesController;
use App\http\Controllers\postsController;
use App\http\Controllers\erpUserController;
use App\http\Controllers\testimonyController;
use App\http\Controllers\productController;
use App\http\Controllers\contactController;
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

Route::group(['middleware' => websitePage::class], function () {
    Route::get('/', [websiteController::class, 'index'])->name('website.index');
    Route::post('/contact', [websiteController::class, 'contactPost'])->name('website.contact');
   
});

Route::group(['prefix' => 'administrator'],function() {
    Route::get('login', [UsersController::class, 'loginGet'])->name('admin.login.get');
    Route::post('login', [UsersController::class, 'loginPost'])->name('admin.login.post');
    Route::get('logout', [UsersController::class, 'logout'])->name('admin.logout.get');

    Route::group(['middleware' => authLogin::class], function () {
        Route::get('/', [overviewController::class, 'index'])->name('overview.index');
        
        Route::get('/user/change-password', [UsersController::class, 'changePassword'])->name('admin.change_password.get');
        Route::post('/user/change-password', [UsersController::class, 'changePasswordPost'])->name('admin.change_password.post');
        
        Route::get('/settings', [settingController::class, 'index'])->name('setting.index');
        Route::post('/settings', [settingController::class, 'indexPost']);

        Route::get('/settings', [settingController::class, 'website'])->name('website.setting.index');
        Route::post('/settings', [settingController::class, 'websitePost']);

        Route::get('/pages', [pagesController::class, 'index'])->name('website.pages.index');
        Route::post('/pages', [pagesController::class, 'editPost']);

        Route::get('/users', [erpUserController::class,'index'])->name('website.users.index');

        Route::get('/posts', [postsController::class, 'index'])->name('website.posts.index');
        Route::get('/posts/create', [postsController::class, 'create'])->name('website.posts.create');
        Route::post('/posts/create', [postsController::class, 'createPost']);
        Route::get('/posts/edit/{id}', [postsController::class, 'edit'])->name('website.posts.edit');
        Route::post('/posts/edit/{id}', [postsController::class, 'editPost']);
        Route::get('/posts/delete/{id}', [postsController::class, 'deletePost'])->name('website.posts.delete');
        
        Route::get('/testimony', [testimonyController::class, 'index'])->name('website.testimony.index');
        Route::get('/testimony/create',  [testimonyController::class, 'create'])->name('website.testimony.create');
        Route::post('/testimony/create',  [testimonyController::class, 'createPost']);
        Route::get('/testimony/delete/{id}',  [testimonyController::class, 'delete'])->name('website.testimony.delete');

        Route::get('/products', [productController::class, 'index'])->name('website.product.index');
        Route::get('/products/create', [productController::class, 'create'])->name('website.product.create');
        Route::post('/products/create', [productController::class, 'createPost']);
        Route::get('/products/edit/{id}', [productController::class, 'edit'])->name('website.product.edit');
        Route::post('/products/edit/{id}', [productController::class, 'editPost']);
        Route::get('/products/delete/{id}', [productController::class, 'deletePost'])->name('website.product.delete');
        

        Route::get('/contacts', [contactController::class, 'index'])->name('website.contacts.index');
        Route::get('/contacts/detail/{id}', [contactController::class, 'detail'])->name('website.contacts.detail');
        Route::get('/contacts/delete/{id}', [contactController::class, 'delete'])->name('website.contacts.delete');
    });
});