<?php

use Illuminate\Support\Facades\Route;
//Admin 
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;

//Frontend
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\BlogsController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\Frontend\SearchController;
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
    return view('auth.login');
});
Route::get('/test', [App\Http\Controllers\MailController::class, 'index']);
Route::group([
    'prefix' => 'frontend',
], function () {
    Route::get('/home', [App\Http\Controllers\Frontend\HomeController::class, 'index']);
    Route::post('/home/add', [App\Http\Controllers\Frontend\HomeController::class, 'addCart']);
    Route::post('/home/price-range', [App\Http\Controllers\Frontend\HomeController::class, 'priceRange']);
    Route::get('/product-detail/{id}', [App\Http\Controllers\Frontend\HomeController::class, 'detailProd']);

    Route::any('/search', [App\Http\Controllers\Frontend\SearchController::class, 'index']);
    Route::any('/search-advanced', [App\Http\Controllers\Frontend\SearchController::class, 'searchAdv']);

    Route::get('/cart', [App\Http\Controllers\Frontend\CartController::class, 'index']);
    Route::post('/cart/delete', [App\Http\Controllers\Frontend\CartController::class, 'deleteProd']);
    Route::post('/cart/downup', [App\Http\Controllers\Frontend\CartController::class, 'downupProd']);
   
    Route::get('/checkout', [App\Http\Controllers\Frontend\CheckoutController::class, 'index']);
    Route::post('/checkout', [App\Http\Controllers\MailController::class, 'index']);
    Route::post('/checkout/register', [App\Http\Controllers\Frontend\CheckoutController::class, 'register']);

    // Route::get('/login', [App\Http\Controllers\Frontend\MemberController::class, 'login']);
    // Route::get('/logout', [App\Http\Controllers\Frontend\MemberController::class, 'logout']);
    // Route::post('/login', [App\Http\Controllers\Frontend\MemberController::class, 'getLogin']);

    // Route::get('/register', [App\Http\Controllers\Frontend\MemberController::class, 'register']);
    // Route::post('/register', [App\Http\Controllers\Frontend\MemberController::class, 'getRegister']);

    // Route::get('/account', [App\Http\Controllers\Frontend\MemberController::class, 'account']);
    // Route::post('/account', [App\Http\Controllers\Frontend\MemberController::class, 'updateAcc']);

    // Route::get('/account/my-product', [App\Http\Controllers\Frontend\ProductController::class, 'myProd']);

    // Route::get('/account/add-product', [App\Http\Controllers\Frontend\ProductController::class, 'addProd']);
    // Route::post('/account/add-product', [App\Http\Controllers\Frontend\ProductController::class, 'getProd']);

    // Route::get('/account/update-product/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'updateProd']);
    // Route::post('/account/update-product/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'getUpdate']);

    // Route::get('/account/delete-product/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'deleteProd']);

    Route::get('/blog-list', [App\Http\Controllers\Frontend\BlogsController::class, 'index']);
    Route::get('/blog-list/detail/{id}', [App\Http\Controllers\Frontend\BlogsController::class, 'blogdetail']);
    // Route::post('/blog-list/detail/rate', [App\Http\Controllers\Frontend\BlogsController::class, 'rate']);
    // Route::post('/blog-list/detail/comment', [App\Http\Controllers\Frontend\BlogsController::class, 'comment']);
    
    Route::group(['middleware' => 'memberNotLogin'], function () {
        Route::get('/login', [App\Http\Controllers\Frontend\MemberController::class, 'login']);
        Route::get('/logout', [App\Http\Controllers\Frontend\MemberController::class, 'logout']);
        Route::post('/login', [App\Http\Controllers\Frontend\MemberController::class, 'getLogin']);

        Route::get('/register', [App\Http\Controllers\Frontend\MemberController::class, 'register']);
        Route::post('/register', [App\Http\Controllers\Frontend\MemberController::class, 'getRegister']);
   });

    Route::group(['middleware' => 'member'], function () {

        //product
        Route::get('/account/my-product', [App\Http\Controllers\Frontend\ProductController::class, 'myProd']);

        Route::get('/account/add-product', [App\Http\Controllers\Frontend\ProductController::class, 'addProd']);
        Route::post('/account/add-product', [App\Http\Controllers\Frontend\ProductController::class, 'getProd']);

        Route::get('/account/update-product/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'updateProd']);
        Route::post('/account/update-product/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'getUpdate']);

        Route::get('/account/delete-product/{id}', [App\Http\Controllers\Frontend\ProductController::class, 'deleteProd']);

        //member
        Route::get('/account', [App\Http\Controllers\Frontend\MemberController::class, 'account']);
        Route::post('/account', [App\Http\Controllers\Frontend\MemberController::class, 'updateAcc']);
        Route::get('/logout', [App\Http\Controllers\Frontend\MemberController::class, 'logout']);

        // blog
        Route::post('/blog-list/detail/rate', [App\Http\Controllers\Frontend\BlogsController::class, 'rate']);
        Route::post('/blog-list/detail/comment', [App\Http\Controllers\Frontend\BlogsController::class, 'comment']);
    });
});





Auth::routes();

Route::group([
    'prefix' => 'admin', //add "admin" before link
    'middleware' => ['admin']
], function () {

    //Dashboard
    Route::get('/home', [App\Http\Controllers\Admin\DashboardController::class, 'index']);
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index']);

    //User
    Route::get('/list', [App\Http\Controllers\Admin\UserController::class, 'list']);
    Route::get('/profile', [App\Http\Controllers\Admin\UserController::class, 'index']);
    Route::post('/profile', [App\Http\Controllers\Admin\UserController::class, 'update']);

    //Country
    Route::get('/country', [App\Http\Controllers\Admin\CountryController::class, 'index']);
    Route::post('/country', [App\Http\Controllers\Admin\CountryController::class, 'create']);
    Route::get('/country/{id}', [App\Http\Controllers\Admin\CountryController::class, 'delete']);

    //Brand
    Route::get('/brand', [App\Http\Controllers\Admin\BrandController::class, 'index']);
    Route::post('/brand', [App\Http\Controllers\Admin\BrandController::class, 'create']);
    Route::get('/brand/{id}', [App\Http\Controllers\Admin\BrandController::class, 'delete']);

    //Category
    Route::get('/category', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
    Route::post('/category', [App\Http\Controllers\Admin\CategoryController::class, 'create']);
    Route::get('/category/{id}', [App\Http\Controllers\Admin\CategoryController::class, 'delete']);

    //BLog
    Route::get('/list-blog', [App\Http\Controllers\Admin\BlogController::class, 'index']);
    Route::get('/list-blog/add', [App\Http\Controllers\Admin\BlogController::class, 'indexCreate']);
    Route::post('/list-blog/add', [App\Http\Controllers\Admin\BlogController::class, 'create']);
    Route::get('/list-blog/edit/{id}', [App\Http\Controllers\Admin\BlogController::class, 'edit']);
    Route::post('/list-blog/edit/{id}', [App\Http\Controllers\Admin\BlogController::class, 'update']);
    Route::get('/list-blog/delete/{id}', [App\Http\Controllers\Admin\BlogController::class, 'delete']);

});