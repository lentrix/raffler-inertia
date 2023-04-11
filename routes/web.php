<?php

use App\Http\Controllers\RaffleController;
use App\Http\Controllers\SiteController;
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

Route::get('/',[SiteController::class, 'loginForm'])->name('login');
Route::post('/login',[SiteController::class, 'login']);

Route::group(['middleware'=>'auth'], function(){
    Route::get('/home',[SiteController::class, 'home']);

    Route::get('/raffles/create', [RaffleController::class, 'create']);
    Route::post('/raffles', [RaffleController::class, 'store']);

    Route::post('/logout',[SiteController::class,'logout']);
});
