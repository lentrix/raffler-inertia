<?php

use App\Http\Controllers\EntryController;
use App\Http\Controllers\PrizeController;
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

    Route::post('/logout',[SiteController::class,'logout']);

    Route::get('/raffles/create', [RaffleController::class, 'create']);
    Route::post('/raffles', [RaffleController::class, 'store']);

    Route::group(['middleware'=>'owner'], function(){
        Route::get('/raffles/{raffle}', [RaffleController::class, 'show']);
        Route::get('/raffles/{raffle}/add-prizes',[PrizeController::class, 'create']);
        Route::post('/raffles/{raffle}/prizes',[PrizeController::class, 'store']);
        Route::get('/raffles/{raffle}/entries',[EntryController::class, 'index']);
        Route::post('/raffles/{raffle}/entries',[EntryController::class, 'store']);
        Route::post('/raffles/{raffle}/import-entries',[EntryController::class, 'importEntries']);
        Route::get('/raffles/draw/{raffle}',[RaffleController::class, 'drawPage']);
        Route::post('/raffles/draw/{raffle}',[RaffleController::class, 'draw']);
        Route::get('/raffles/edit/{raffle}',[RaffleController::class,'edit']);
        Route::put('/raffles/{raffle}',[RaffleController::class,'update']);
        Route::delete('/raffles/{raffle}',[RaffleController::class,'destroy']);
    });

    Route::delete('/prizes/{prize}', [PrizeController::class, 'destroy']);

    Route::delete('/entries/{entry}',[EntryController::class, 'destroy']);
});
