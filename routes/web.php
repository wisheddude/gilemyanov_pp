<?php

use App\Http\Controllers\AgendaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('agendas.index');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/agendas', [AgendaController::class, 'index'])->name('agendas.index');
    Route::get('/agendas/{agenda}', [AgendaController::class, 'show'])->name('agendas.show');
    Route::middleware(['admin'])->group(function () {
        Route::get('/agendas/create', [AgendaController::class, 'create'])->name('agendas.create');
        Route::post('/agendas', [AgendaController::class, 'store'])->name('agendas.store');

        Route::get('/agendas/{agenda}/edit', [AgendaController::class, 'edit'])->name('agendas.edit');
        Route::put('/agendas/{agenda}', [AgendaController::class, 'update'])->name('agendas.update');

        Route::delete('/agendas/{agenda}', [AgendaController::class, 'destroy'])->name('agendas.destroy');
    });
});
