<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProcedureController;
use Illuminate\Support\Facades\Route;

// Páginas públicas
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/about', [PageController::class, 'about'])->name('about');

// Procedures público
Route::get('/procedures', [ProcedureController::class, 'index'])->name('procedures.index');
Route::get('/procedures/{code}', [ProcedureController::class, 'show'])->name('procedures.show');

// ADMIN PANEL (protected)
Route::middleware('admin')->group(function () {
    Route::get('/admin', [ProcedureController::class, 'adminIndex'])->name('admin.index');
    Route::get('/admin/edit/{code}', [ProcedureController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/update/{code}', [ProcedureController::class, 'update'])->name('admin.update');
    Route::get('/admin/create', [ProcedureController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [ProcedureController::class, 'store'])->name('admin.store');
    Route::post('/admin/delete/{code}', [ProcedureController::class, 'delete'])->name('admin.delete');
    Route::post('/admin/upload-xml', [ProcedureController::class, 'uploadXml'])->name('admin.uploadXml');
});

// AUTH
Route::get('/admin/login', [PageController::class, 'login'])
    ->middleware('guestAdmin')
    ->name('admin.login');

Route::post('/admin/login', [PageController::class, 'authenticate'])
    ->middleware('guestAdmin')
    ->name('admin.login.submit');

Route::get('/admin/logout', [PageController::class, 'logout'])
    ->middleware('admin')
    ->name('admin.logout');