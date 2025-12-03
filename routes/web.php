<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProcedureController;

// Páginas públicas
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/how-it-works', [PageController::class, 'howItWorks'])->name('how.it.works');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

Route::post('/contact/send', [PageController::class, 'sendContact'])->name('contact.send');


// Login admin
Route::get('/admin/login', [PageController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [PageController::class, 'authenticate'])->name('admin.login.submit');
Route::get('/admin/logout', [PageController::class, 'logout'])->name('admin.logout');

// Protected Routes (admin + timeout)
Route::middleware(['admin', 'admin.timeout'])->group(function () {
    Route::get('/admin', [ProcedureController::class, 'adminIndex'])->name('admin.index');

    Route::get('/admin/create', [ProcedureController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [ProcedureController::class, 'store'])->name('admin.store');

    Route::get('/admin/edit/{code}', [ProcedureController::class, 'edit'])->name('admin.edit');
    Route::post('/admin/update/{code}', [ProcedureController::class, 'update'])->name('admin.update');

    Route::delete('/admin/delete/{code}', [ProcedureController::class, 'delete'])->name('admin.delete');

    Route::post('/admin/upload-xml', [ProcedureController::class, 'uploadXml'])
        ->name('admin.uploadXml');
});
