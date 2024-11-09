<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('students/{subject?}', App\Livewire\Students\Index::class)->name('students.index');
    Route::get('users', App\Livewire\Users\Index::class)->name('users.index');
    Route::get('subjects', App\Livewire\Subjects\Index::class)->name('subjects.index');

    Route::get('students/{student}/certificate', [App\Http\Controllers\CertificateController::class, 'previewCertificate'])->name('students.certificate');
});

require __DIR__.'/auth.php';
