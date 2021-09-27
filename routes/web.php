<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', \App\Http\Livewire\HomeComponent::class)->name('home');
Route::get('/store', \App\Http\Livewire\StoreComponent::class)->name('store');
Route::get('/store/{slug}', \App\Http\Livewire\CategoryComponent::class)->name('category');
Route::get('/contact', \App\Http\Livewire\ContactComponent::class)->name('contact');
Route::get('/cart', \App\Http\Livewire\CartComponent::class)->name('cart');
Route::get('/profile', \App\Http\Livewire\ProfileComponent::class)->name('profile')->middleware(['auth', 'verified']);
Route::get('/product/{slug}', \App\Http\Livewire\ProductComponent::class)->name('product');

Route::prefix('backend')->name('admin.')->middleware('admin')->group(function () {
    Route::get('/dashboard', \App\Http\Livewire\Admin\Dashboard::class)->name('dashboard');
    Route::get('/category', \App\Http\Livewire\Admin\Category\AdminCategory::class)->name('category');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
