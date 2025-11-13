<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProcedureController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home']);
Route::get('/contact', [PageController::class, 'contact']);
Route::get('/procedures', [ProcedureController::class, 'index']);
Route::get('/about', [PageController::class, 'about']);

// ADMIN PANEL (protected)
Route::middleware('admin')->group(function () {
    Route::get('/admin', [ProcedureController::class, 'adminIndex']);
    Route::get('/admin/edit/{code}', [ProcedureController::class, 'edit']);
    Route::post('/admin/update/{code}', [ProcedureController::class, 'update']);
    Route::get('/admin/create', [ProcedureController::class, 'create']);
    Route::post('/admin/store', [ProcedureController::class, 'store']);
    Route::post('/admin/delete/{code}', [ProcedureController::class, 'delete']);
});

// AUTH
Route::get('/admin/login', [PageController::class, 'login'])->middleware('guestAdmin');
Route::post('/admin/login', [PageController::class, 'authenticate'])->middleware('guestAdmin');
Route::get('/admin/logout', [PageController::class, 'logout'])->middleware('admin');