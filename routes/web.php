<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectGalleryController;
use App\Http\Controllers\PortfolioController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('post')->name('post.')->middleware('auth')->group(function () {

    Route::get('/profile-saya', function () {
        return view('post.profile-saya');
    })->name('profile-saya');

    Route::get('/admin-test', function () {
        return 'Selamat datang, Admin!';
    })->middleware('admin')->name('admin-test');

    Route::resource('dashboard', DashboardController::class);
    Route::resource('projects', ProjectController::class);

    Route::post(
        'projects/{project}/gallery',
        [ProjectGalleryController::class, 'store']
    )->name('projects.gallery.store');

    Route::delete(
        'projects/{project}/gallery/{image}',
        [ProjectGalleryController::class, 'destroy']
    )->name('projects.gallery.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/projects', [PortfolioController::class, 'projects'])
    ->name('projects');

Route::get('/projects/{project}', [PortfolioController::class, 'show'])
    ->name('projects.show');

require __DIR__ . '/auth.php';
