<?php
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShowCategoryController;
use App\Http\Controllers\ViewProductController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/admin', function () {
//     if(Auth::check() && Auth::user()->user_type_id == '1'){
//         return redirect()->route('layouts.adminHome');
//     }else{
//         return view('auth.adminlogin');
//     }
// });

Route::get('/', function () {
        return view('welcome');
});



    Route::group(['prefix' => 'admin'], function() {
        Route::get('/adminlogin',[LoginController::class,'adminlogin'])->name('adminlogin');

        Route::post('/logindata',[LoginController::class,'logindata'])->name('logindata');

        Route::get('/home', 'HomeController@adminHome')->name('admin.home')->middleware('is_admin');

        Route::get('/categories',[CategoryController::class,'categories'])->name('admin.categories');

        Route::get('/createcategory',[CategoryController::class,'createCategory'])->name('admin.createcategory');

        Route::post('/store',[CategoryController::class,'store'])->name('admin.store');

        Route::delete('/delete/{id}',[CategoryController::class,'delete'])->name('admin.delete');

        Route::get('/editcategory/{id}',[CategoryController::class,'edit'])->name('admin.edit');

        Route::put('/update/{id}',[CategoryController::class,'update'])->name('admin.update');

        Route::get('/products',[ProductController::class,'products'])->name('admin.products');

        Route::get('search-products',[ProductController::class,'search'])->name('searchProducts');

        Route::get('filter-products',[ProductController::class,'filter'])->name('filterProducts');

        Route::get('sort-products',[ProductController::class,'sort'])->name('sortProducts');

        Route::get('/createproduct',[ProductController::class,'createProduct'])->name('admin.createproduct');

        Route::get('/editproduct/{id}',[ProductController::class,'editProduct'])->name('admin.editproduct');

        Route::delete('/deleteproduct/{id}',[ProductController::class,'deleteProduct'])->name('admin.deleteproduct');

        Route::post('/storeProduct',[ProductController::class,'storeProduct'])->name('admin.storeproduct');

        Route::put('/updateproduct/{id}',[ProductController::class,'updateProduct'])->name('admin.updateproduct');

        Route::get('/categories/{id}/viewcategory',[CategoryController::class,'viewCategory'])->name('admin.viewcategory');
    });

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/showproduct',[ViewProductController::class,'showProduct'])->name('showproduct');

    Route::get('/showcategory',[ShowCategoryController::class,'showCategory'])->name('showcategory');

    Route::get('/productdetail/{id}',[ViewProductController::class,'productDetail'])->name('productdetail');

    // Route::get('/status-update/{id}',[ProductController::class,'statusUpdate']);

    Route::get('changeStatus',[ProductController::class,'changeStatus']);

