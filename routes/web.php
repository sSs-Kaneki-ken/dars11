<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;

use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'main'])->name('user.main');
Route::post('/create-user', [UserController::class, 'store'])->name('user.store');
Route::get('/create-delete-all', [UserController::class, 'deleteAll'])->name('user.delete.all');
Route::delete('/user/{id}', [UserController::class, 'delete'])->name('user.delete');
Route::put('/update/{user}', [UserController::class, 'update'])->name('user.update');
Route::get('/user/{id}', [UserController::class, 'show'])->name('user.show');
Route::get('/user-search', [UserController::class, 'search'])->name('user.search');

Route::get('/companies', [CompanyController::class, 'main'])->name('company.main');
Route::post('/create-company', [CompanyController::class, 'store'])->name('company.store');
Route::delete('/company/{id}', [CompanyController::class, 'delete'])->name('company.delete');
Route::put('/update/company/{company}', [CompanyController::class, 'update'])->name('company.update');
Route::get('/company/{id}', [CompanyController::class, 'show'])->name('company.show');
Route::get('/company-search', [CompanyController::class, 'search'])->name('company.search');
Route::get('/company-delete-all', [CompanyController::class, 'deleteAll'])->name('company.delete_all');

Route::get('/products', [ProductController::class, 'main'])->name('product.main');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');
Route::post('/create-product', [ProductController::class, 'store'])->name('product.store');
Route::delete('/product/{id}', [ProductController::class, 'delete'])->name('product.delete');
Route::put('/update/product/{product}', [ProductController::class, 'update'])->name('product.update');
Route::get('/product-delete-all', [ProductController::class, 'deleteAll'])->name('product.delete_all');
Route::get('/product-search', [ProductController::class, 'search'])->name('product.search');

Route::get('/laravel', function () {
    return view('welcome');
});
