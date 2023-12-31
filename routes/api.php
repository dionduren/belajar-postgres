<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\APIGroup;
use App\Http\Controllers\APITiketCreate;
use App\Http\Controllers\APITiket;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/kategori-list', [APITiketCreate::class, 'list_kategori']);
Route::get('/subkategori-list/{id}', [APITiketCreate::class, 'list_subkategori']);
Route::get('/item-kategori-list/{id}', [APITiketCreate::class, 'list_item_kategori']);

Route::post('/submit-tiket', [APITiketCreate::class, 'store']);
Route::post('/submit-tiket-mobile', [APITiketCreate::class, 'store_mobile']);

Route::get('/created-tiket-list/{id}', [APITiket::class, 'created_ticket_list']);
Route::get('/helpdesk-tiket-submitted', [APITiket::class, 'helpdesk_list_submitted']);
Route::get('/helpdesk-tiket-assigned', [APITiket::class, 'helpdesk_list_assigned']);
Route::get('/helpdesk-tiket-detail/{id}', [APITiket::class, 'helpdesk_detail']);
Route::get('/technical-group-list', [APIGroup::class, 'technical_group_list']);
Route::post('/tiket-assign-group', [APIGroup::class, 'tiket_assign_group']);

Route::get('/get-group-id/{id}', [APIGroup::class, 'get_group_id']);
Route::get('/get-teamlead-status/{id}', [APIGroup::class, 'get_teamlead_status']);

Route::get('/teamlead-tiket-waiting-list/{id}', [APITiket::class, 'teamlead_waiting_list']);
Route::get('/teamlead-tiket-ongoing-list/{id}', [APITiket::class, 'teamlead_ongoing_list']);
Route::get('/teamlead-tiket-finished/{id}', [APITiket::class, 'teamlead_finished']);
Route::get('/teamlead-tiket-detail/{id}', [APITiket::class, 'teamlead_detail']);
Route::get('/technical-list/{id}', [APIGroup::class, 'technical_list']);
Route::post('/tiket-assign-technical', [APIGroup::class, 'tiket_assign_technical']);

Route::get('/technical-tiket-ongoing-list/{id}', [APITiket::class, 'technical_ongoing_list']);
Route::get('/technical-tiket-finished-list/{id}', [APITiket::class, 'technical_finished']);
Route::get('/solution-list/{id}', [APITiket::class, 'solution_list']);
Route::post('/submit-solution', [APITiket::class, 'submit_solution']);
Route::post('/submit-new-solution', [APITiket::class, 'submit_new_solution']);

Route::post('/close-tiket', [APITiket::class, 'close_tiket']);
