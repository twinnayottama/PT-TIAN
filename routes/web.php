<?php

use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\certificateLabel;
use App\Http\Controllers\User\CodeController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DownloadLabelController;
use App\Http\Controllers\User\LabelController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\LotController;
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
    return redirect()->route('login');
});

// Login User
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'store'])->name('login.store');
Route::post('logout', [LoginController::class, 'destroy'])->name('logout');

// Login Admin
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('login', [AdminLoginController::class, 'index'])->name('login');
    Route::post('login', [AdminLoginController::class, 'store'])->name('login.store');
});

Route::post('admin/logout', [AdminLoginController::class, 'destroy'])->name('admin.logout');

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Lot
    Route::resource('lot', LotController::class);
    Route::get('lot/{id}/download', [DownloadLabelController::class, 'download'])->name('lot.download');
    Route::post('lot/{id}/downloadPdf', [DownloadLabelController::class, 'downloadPdf'])->name('lot.downloadPdf');
    Route::post('lot/{id}/download-generated-pdf', [DownloadLabelController::class, 'downloadGeneratedPdf'])->name('lot.downloadGeneratedPdf');

    // Label
    Route::get('label', [LabelController::class, 'index'])->name('label.index');
    Route::get('label/create', [LabelController::class, 'create'])->name('label.create');
    Route::post('label', [LabelController::class, 'import'])->name('label.import');
    Route::get('label/{lot}', [LabelController::class, 'show'])->name('label.show');
    Route::delete('label/destroy/{lot_id}', [LabelController::class, 'destroy'])->name('label.destroy');

    // Code
    Route::get('code', [CodeController::class, 'index'])->name('code.index');
    Route::get('code/create', [CodeController::class, 'create'])->name('code.create');
    Route::post('code', [CodeController::class, 'import'])->name('code.import');
    Route::get('code/{lot}', [CodeController::class, 'show'])->name('code.show');
    Route::delete('code/destroy/{lot_id}', [CodeController::class, 'destroy'])->name('code.destroy');
});

Route::get('certificate', [certificateLabel::class, 'certificate'])->name('certificate');

Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
