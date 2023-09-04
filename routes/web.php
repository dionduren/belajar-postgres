<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TiketController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'homepage']);
Route::get('/user', [HomeController::class, 'home_user']);

Route::get('/helpdesk', [HomeController::class, 'home_helpdesk']);
Route::get('/helpdesk/detail/{id}', [TiketController::class, 'helpdesk_detail_tiket']);

// Route::get('/vp-user', [HomeController::class, 'home_vp_user']);
Route::get('/teamlead/{id}', [HomeController::class, 'home_teamlead']);
Route::get('/teamlead/detail/{id}', [TiketController::class, 'teamlead_detail_tiket']);

Route::get('/technical/{id}', [HomeController::class, 'home_technical']);
Route::get('/technical/detail/{id}', [TiketController::class, 'technical_detail_tiket']);


Route::get('/create-tiket', [TiketController::class, 'create_tiket']);
