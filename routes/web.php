<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

Route::get('/', [StudentController::class, 'show'])->name('index');
Route::post('/students', [StudentController::class, 'store'])->name('store');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('update');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('destroy');
Route::get('/students/export', [StudentController::class, 'export'])->name('export');
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('edit');
Route::get('/students/create', [StudentController::class, 'create'])->name('create');
