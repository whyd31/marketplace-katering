<?php

use App\Models\Footer;
use App\Models\Profil;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ImagePropertyController;
use App\Http\Controllers\UserManagementController;
use App\Models\Product;
use App\Models\ImageProperty;
use App\Enums\UserRole;

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

    return view('home', [
        "includeHero" => true,
        'footers' => Footer::latest()->get(),
        'profile' => Profil::latest()->get(),
        'products' => Product::latest()->get(),
        'propertiez'  => ImageProperty::where('property', 'Banner')->latest()->get(),
        'properties' => ImageProperty::where('property', 'Logo')->latest()->get()
    ]);
})->name('home')->middleware(Spatie\Csp\AddCspHeaders::class);

Route::get('/profil', function () {
    return view('profil', [
        "includeHero" => false,
        'footers' => Footer::latest()->get(),
        'profile' => Profil::latest()->get(),
        'propertiez'  => ImageProperty::where('property', 'Banner')->latest()->get(),
        'properties' => ImageProperty::where('property', 'Logo')->latest()->get()
    ]);
})->middleware(Spatie\Csp\AddCspHeaders::class);

Route::get('/service', function(){
    return view('service', [
        "includeHero" => false,
        'footers' => Footer::latest()->get(),
        'profile' => Profil::latest()->get(),
        
        'services' => Service::latest()->get(),
        'propertiez'  => ImageProperty::where('property', 'Banner')->latest()->get(),
        'properties' => ImageProperty::where('property', 'Logo')->latest()->get()
    ]);
})->middleware(Spatie\Csp\AddCspHeaders::class);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('white.list','guest',Spatie\Csp\AddCspHeaders::class);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::post('/register', [RegisterController::class, 'store'])->name('register')->middleware('white.list','guest',Spatie\Csp\AddCspHeaders::class);
Route::get('/register-costumer', [RegisterController::class, 'costumer'])->name('register.costumer')->middleware('white.list','guest',Spatie\Csp\AddCspHeaders::class);
Route::get('/register-merchant', [RegisterController::class, 'merchant'])->name('register.merchant')->middleware('white.list','guest',Spatie\Csp\AddCspHeaders::class);

Route::get('/dashboard', function(){
    return view ('dashboard.index',[
        'properties' => ImageProperty::where('property', 'Logo')->latest()->get(),
        'profile' => Profil::latest()->get(),   
    ]);
})->middleware(['auth', 'user-role:0,1,2']);

Route::resource('/dashboard/footers', FooterController::class)->except('show')->middleware(['auth', 'user-role:0,1,2']);

Route::resource('/dashboard/properties', ImagePropertyController::class)->except('show')->middleware(['auth', 'user-role:0,1,2']);

Route::resource('/dashboard/profils', ProfilController::class)->middleware(['auth', 'user-role:0,1,2']);

Route::resource('/dashboard/products', ProductController::class)->except('show')->middleware(['auth', 'user-role:0,1,2']);

Route::post('/dashboard/products/{id}/add-to-cart', [ProductController::class, 'addToCart'])->name('products.addToCart');

Route::get('/dashboard/cart', [ProductController::class, 'cart'])->name('cart');
Route::post('/dashboard/cart/update/{id}', [ProductController::class, 'updateCart'])->name('cart.update');
Route::delete('/dashboard/cart/remove/{id}', [ProductController::class, 'removeFromCart'])->name('cart.remove');
Route::get('/dashboard/cart/checkout', [ProductController::class, 'checkout'])->name('cart.checkout');

Route::resource('/dashboard/invoice', OrderController::class)->except('show')->middleware(['auth', 'user-role:0,1,2']);

Route::get('/dashboard/profiles', [RegisterController::class, 'profile'])->middleware(['auth']);

Route::get('/dashboard/profiles/{id}/edit', [RegisterController::class, 'edit'])->middleware('auth')->name('profiles.edit');

Route::put('/dashboard/profiles/{id}', [RegisterController::class, 'update'])->middleware('auth')->name('profiles.update');

