<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return view('welcome');
});
Route::get('/search',[BookController::class,'searchBook'])->name('book.search');

Route::middleware(['auth'])->group(function(){

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
Route::middleware(['role:admin|user'])->group(function(){

    Route::prefix('/books')->group(function(){
        Route::get('',[BookController::class,'table'])->name('book.index');
        Route::get('/create',[BookController::class,'create'])->name('book.create');
        Route::post('/create',[BookController::class,'store']);
        Route::get('/{book}',[BookController::class,'show'])->name('books.show');
        Route::get('/{book}/edit',[BookController::class,'edit'])->name('book.edit')->middleware(['role:admin']);
        Route::put('/{book}/edit',[BookController::class,'update'])->middleware(['role:admin']);
        Route::delete('/{book}',[BookController::class,'destroy'])->name('book.delete')->middleware(['role:admin']);
    });

});

Route::middleware(['role:admin'])->group(function(){
    Route::prefix('categories')->group(function(){
        Route::get('',[CategoryController::class,'table'])->name('category.index');
        Route::get('/create',[CategoryController::class,'create'])->name('category.create');
        Route::post('/create',[CategoryController::class,'store']);
        Route::get('/{category}',[CategoryController::class,'show'])->name('category.show');
        Route::get('/{category}/edit',[CategoryController::class,'edit'])->name('category.edit');
        Route::put('/{category}/edit',[CategoryController::class,'update']);
        Route::delete('/{category}',[CategoryController::class,'destroy'])->name('category.delete');
    });
});


});
