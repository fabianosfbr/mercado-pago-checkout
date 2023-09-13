<?php

use App\Livewire\Public\Home;
use App\Livewire\Public\Category;
use App\Livewire\Public\Product;
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

Route::get('/', Home::class)->name('public.home');
Route::get('/category', Category::class)->name('public.category');
Route::get('/product', Product::class)->name('public.product');
