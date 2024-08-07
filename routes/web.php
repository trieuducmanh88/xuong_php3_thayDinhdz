<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\DonHangController;
use App\Http\Controllers\Admin\KhuyenMaiController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ClientProductController;
use App\Http\Controllers\Client\OderController;
use App\Http\Controllers\Client\OrderController;
use App\Http\Middleware\CheckRoleAdminMiddlewware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/',function(){
//     return view('welcome');
// });

Route::get('/auth',function(){
    return view('layout.auth');
});

Route::get('login',[AuthController::class,'showFormLogin']);
Route::post('login',[AuthController::class,'login'])->name('login');

Route::get('register',[AuthController::class,'showFormRegister']);
Route::post('register',[AuthController::class,'register'])->name('register');

Route::post('logout',[AuthController::class,'logout'])->name('logout');

Route::get('/home',function(){
    return view('home');
})->middleware('auth'); // Check đăng nhập mới vô được trang home




 

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::get('/danhmucs', function () {
//     return view('admins.danhmucs.index');
// });



// Route admin
Route::middleware(['auth','auth.admin'])->prefix('admins')->as('admins.')
    ->group(function(){
        Route::get('dashboard',function(){return view('admins.dashboard');})->name('dashboard');
        Route::get('/',function(){return view('admins.dashboard');})->name('dashboard');

        // Route danh mục
        Route::prefix('danhmucs')
        ->as('danhmucs.')
        ->group(function(){
            Route::get('/',[DanhMucController::class,'index'])->name('index');
            Route::get('/create',[DanhMucController::class,'create'])->name('create');
            Route::post('/store',[DanhMucController::class,'store'])->name('store');
            Route::get('/show/{id}',[DanhMucController::class,'show'])->name('show');
            Route::get('/{id}/edit',[DanhMucController::class,'edit'])->name('edit');
            Route::put('/{id}/update',[DanhMucController::class,'update'])->name('update');
            Route::delete('/{id}/destroy',[DanhMucController::class,'destroy'])->name('destroy');
        });

        // Route sản phẩm
        Route::prefix('sanphams')
        ->as('sanphams.')
        ->group(function(){
            Route::get('/',[SanPhamController::class,'index'])->name('index');
            Route::get('/create',[SanPhamController::class,'create'])->name('create');
            Route::post('/store',[SanPhamController::class,'store'])->name('store');
            Route::get('/show/{id}',[SanPhamController::class,'show'])->name('show');
            Route::get('/{id}/edit',[SanPhamController::class,'edit'])->name('edit');
            Route::put('/{id}/update',[SanPhamController::class,'update'])->name('update');
            Route::delete('/{id}/destroy',[SanPhamController::class,'destroy'])->name('destroy');
        });


        // Route banner
        Route::prefix('banners')
        ->as('banners.')
        ->group(function(){
            Route::get('/',[BannerController::class,'index'])->name('index');
            Route::get('/create',[BannerController::class,'create'])->name('create');
            Route::post('/store',[BannerController::class,'store'])->name('store');
            Route::get('/show/{id}',[BannerController::class,'show'])->name('show');
            Route::get('/{id}/edit',[BannerController::class,'edit'])->name('edit');
            Route::put('/{id}/update',[BannerController::class,'update'])->name('update');
            Route::delete('/{id}/destroy',[BannerController::class,'destroy'])->name('destroy');
        });

         // Route banner
         Route::prefix('khuyenmais')
         ->as('khuyenmais.')
         ->group(function(){
             Route::get('/',[KhuyenMaiController::class,'index'])->name('index');
             Route::get('/create',[KhuyenMaiController::class,'create'])->name('create');
             Route::post('/store',[KhuyenMaiController::class,'store'])->name('store');
             Route::get('/show/{id}',[KhuyenMaiController::class,'show'])->name('show');
             Route::get('/{id}/edit',[KhuyenMaiController::class,'edit'])->name('edit');
             Route::put('/{id}/update',[KhuyenMaiController::class,'update'])->name('update');
             Route::delete('/{id}/destroy',[KhuyenMaiController::class,'destroy'])->name('destroy');
         });


         // Route banner
         Route::prefix('users')
         ->as('users.')
         ->group(function(){
             Route::get('/',[UserController::class,'index'])->name('index');
             Route::get('/show/{id}',[UserController::class,'show'])->name('show');
             Route::get('/{id}/edit',[UserController::class,'edit'])->name('edit');
             Route::put('/{id}/update',[UserController::class,'update'])->name('update');
             Route::delete('/{id}/destroy',[UserController::class,'destroy'])->name('destroy');
         });


        // Route đơn hàng
        Route::prefix('donhangs')
        ->as('donhangs.')
        ->group(function(){
            Route::get('/',[DonHangController::class,'index'])->name('index');
            Route::get('/show/{id}',[DonHangController::class,'show'])->name('show');
            Route::put('/{id}/update',[DonHangController::class,'update'])->name('update');
            Route::delete('/{id}/destroy',[DonHangController::class,'destroy'])->name('destroy');
        });


});







 
// Route client
// Route::get('/',function(){
//     return view('clients.home');
// })->name('home.clients');

// Route::get('/gio-hang',function(){
//     return view('clients.cart');
// });
Route::get('/dat-hang',function(){
    return view('clients.checkout');
});
Route::get('/cam-on',function(){
    return view('clients.camon');
});


Route::get('/',[ClientProductController::class,'sanPhamHome'])->name('home.clients');
Route::get('/sanpham/detail/{id}', [ClientProductController::class, 'chiTietSanPham'])->name('sanphams.chitiet');

Route::get('/list-cart',[CartController::class,'listCart'])->name('cart.list');
Route::post('/add-to-cart',[CartController::class,'addCart'])->name('cart.add');
Route::post('/update-cart',[CartController::class,'updateCart'])->name('cart.update');



Route::middleware('auth')->prefix('/donhang')->as('donhangs.')
->group(function(){
    Route::get('/',             [OrderController::class,'index'])->name('index');
    Route::get('/create',       [OrderController::class,'create'])->name('create');
    Route::post('/store',        [OrderController::class,'store'])->name('store');
    Route::put('/{id}/update',  [OrderController::class,'update'])->name('update');
    Route::get('/{id}/show',    [OrderController::class,'show'])->name('show');
})


?>

