<?php

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
    return view('createSupportTicket');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/support-ticket', [App\Http\Controllers\SupportTicketController::class, 'index'])->name('SupportTicket');
Route::post('/support-ticket-create', [App\Http\Controllers\SupportTicketController::class, 'store'])->name('SupportTicketCreate');
Route::get('/support-ticket-info', [App\Http\Controllers\SupportTicketController::class, 'show'])->name('SupportTicketInfo');
Route::get('/support-ticket-number-info', [App\Http\Controllers\SupportTicketController::class, 'info'])->name('SupportTicketNumberInfo');

Route::middleware(['auth'])->group(function () {
    Route::get('/support-ticket-number-grid', [App\Http\Controllers\SupportTicketController::class, 'grid'])->name('SupportTicketGrid');
    Route::get('/support-ticket-number-list', [App\Http\Controllers\SupportTicketController::class, 'list'])->name('SupportTicketList');

    Route::get('/support-ticket-reply/{id}', [App\Http\Controllers\SupportTicketController::class, 'reply'])->name('SupportTicketReply');
    Route::post('/support-ticket-reply-save', [App\Http\Controllers\SupportTicketController::class, 'replySave'])->name('SupportTicketReplySave');
})->middleware(['guest']);



