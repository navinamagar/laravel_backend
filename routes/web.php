<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\GalleryController; 
use App\Http\Controllers\ProductController;      
use App\Http\Controllers\SocialMediasController;     
use App\Http\Controllers\SiteController;     

Route::get('/', [SiteController::class, 'getHome'])->name('getHome');
Route::get('/cart/{product}', [SiteController::class, 'getAddCart'])->name('getAddCart');
Route::get('/carts', [SiteController::class, 'getCart'])->name('getCart');
Route::get('/checkout', [SiteController::class,'getCheckOut'])->name('getCheckOut');
Route::post('/order', [SiteController::class, 'postAddOrder'])->name('postAddOrder');



Route::get('/addoption', [UserController::class, 'addoption']);

Route::get('/Gallery', [GalleryController::class, 'getAddGallery'])->name('getAddGallery');
Route::post('/addGallery', [GalleryController::class, 'PostAddGallery'])->name('PostAddGallery1');

Route::get('/category', [CategoryController::class, 'getAddCategory'])->name('getAddCategory');
Route::post('/addcategory', [CategoryController::class, 'PostAddCategory'])->name('PostAddCategory1');//to put it in database
Route::get('/ManageCategory', [CategoryController::class,'getManageCategory'])->name('getManageCategory'); //to pull it form database
Route::get('/Delete/Category/{category}', [CategoryController::class,'getDeleteCategory'])->name('getDeleteCategory');

Route::get('/Edit/Category/{category}', [CategoryController::class,'getEditCategory'])->name('getEditCategory');
Route::post('/category/edit/{categories}',[CategoryController::class,'Posteditcategory'])->name('Posteditcategory');

Route::get('/SocialMedia', [SocialMediasController::class,'getSocialMedia'])->name('getSocialMedia');
Route::post('/SocialMedia', [SocialMediasController::class,'PostSocialMedia'])->name('PostSocialMedia');

Route::get('/Product', [ProductController::class, 'getAddProduct'])->name('getAddProduct');
Route::post('/addproduct',[ProductController::class, 'PostAddProduct'])->name('PostAddProduct');
Route::get('/product/table',[ProductController::class,'getProductTable'])->name('getProductTable');
Route::get('/Product/Delete/{product}',[ProductController::class,'getDeleteProduct'])->name('getDeleteProduct');
Route::get('/Product/Edit/{product}',[ProductController::class,'getEditProduct'])->name('getEditProduct');
Route::post('/Edit/Product/{product}',[ProductController::class,'postEditProduct'])->name('postEditProduct');

Route::get('/shipping', [ProductController::class, 'getAddShipping'])->name('getAddShipping');
Route::post('/addShipping',[ProductController::class, 'PostAddShipping'])->name('PostAddShipping');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::post('/ajax/abc',[ SiteController::class, 'postAjax'])->name('postAjax');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');
	Route::get('virtual-reality', function () {
		return view('pages.virtual-reality');
	})->name('virtual-reality');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');
});