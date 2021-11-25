<?php

use App\Http\Livewire\DocumentConnect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('document/upload', [\App\Http\Controllers\DocumentController::class, 'create'])->name('document.create');
    Route::post('tempUpload', [\App\Http\Controllers\DocumentController::class, 'tempUpload']);
    Route::post('document/upload', [\App\Http\Controllers\DocumentController::class, 'store'])->name('document.store');
    Route::post('document/roles', [\App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
    Route::get('link/documents', DocumentConnect::class)->name('document.link');
});

Route::prefix('HOD')->middleware(['auth'])->group(function () {
    Route::get('/Information-technology', [\App\Http\Controllers\HODController::class, 'IT'])->name('hod.it');
    Route::get('/Monitoring-evalution', [\App\Http\Controllers\HODController::class, 'ME'])->name('hod.me');
    Route::get('/Communications', [\App\Http\Controllers\HODController::class, 'Communications'])->name('hod.Communications');
    Route::get('/Accounts', [\App\Http\Controllers\HODController::class, 'Accounts'])->name('hod.Accounts');
    Route::get('/Operations', [\App\Http\Controllers\HODController::class, 'Operations'])->name('hod.Operations');
    Route::get('/Human-Resources', [\App\Http\Controllers\HODController::class, 'HR'])->name('hod.HR');
    Route::get('/Forestry', [\App\Http\Controllers\HODController::class, 'Forestry'])->name('hod.Forestry');
    Route::get('/Miti-magazine', [\App\Http\Controllers\HODController::class, 'MITI'])->name('hod.MITI');
    Route::get('/{document}/Review', [\App\Http\Controllers\HODController::class, 'reviewDoc'])->name('hod.review');
    Route::patch('/{document}/Review', [\App\Http\Controllers\HODController::class, 'update'])->name('hod.update');
});

Route::prefix('QC')->middleware(['auth'])->group(function () {
    Route::get('/List', [\App\Http\Controllers\QCController::class, 'QCTable'])->name('qc.table');
    Route::get('/{document}/Review', [\App\Http\Controllers\QCController::class, 'reviewDoc'])->name('QC.review');
    Route::patch('/{document}/Review', [\App\Http\Controllers\QCController::class, 'update'])->name('qc.update');
});

Route::prefix('MD')->middleware(['auth'])->group(function () {
    Route::get('/List', [\App\Http\Controllers\MDController::class, 'MDTable'])->name('md.table');
    Route::get('/{document}/Review', [\App\Http\Controllers\MDController::class, 'reviewDoc'])->name('MD.review');
    Route::patch('/{document}/Review', [\App\Http\Controllers\MDController::class, 'update'])->name('md.update');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
