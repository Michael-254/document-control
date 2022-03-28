<?php

use App\Http\Livewire\DocumentConnect;
use App\Http\Livewire\DocumentLog;
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
    Route::get('Documents/I-can-access', [\App\Http\Controllers\DocumentController::class, 'myAccess'])->name('my.access');
    Route::get('Documents/I-can-access/{document}', [\App\Http\Controllers\DocumentController::class, 'confirmImp'])->name('confirm.imp');
    Route::patch('Documents/I-can-access/{document}', [\App\Http\Controllers\DocumentController::class, 'confirmUpdate'])->name('confirm.update');
    Route::get('dashboard', [\App\Http\Controllers\DocumentController::class, 'dashboard'])->name('dashboard');
    Route::get('my-document/{document}/view', [\App\Http\Controllers\DocumentController::class, 'viewDocument'])->name('my.upload');
    Route::get('document/upload', [\App\Http\Controllers\DocumentController::class, 'create'])->name('document.create');
    Route::get('document/{document}/Edit', [\App\Http\Controllers\DocumentController::class, 'edit'])->name('document.edit');
    Route::patch('document/{document}/Edit', [\App\Http\Controllers\DocumentController::class, 'update'])->name('document.update');
    Route::post('tempUpload', [\App\Http\Controllers\DocumentController::class, 'tempUpload']);
    Route::post('document/upload', [\App\Http\Controllers\DocumentController::class, 'store'])->name('document.store');
    Route::post('document/roles', [\App\Http\Controllers\RoleController::class, 'store'])->name('role.store');
    Route::get('stream/document/{document}', [\App\Http\Controllers\AccessController::class, 'fileReview'])->name('document.stream');
    Route::get('can-read/{document}', [\App\Http\Controllers\AccessController::class, 'protectedFile'])->name('document.withaccess.stream');
    Route::get('document/logs', DocumentLog::class)->name('document.logs')->middleware('QC');
    Route::get('link/documents', DocumentConnect::class)->name('document.link')->middleware('QC');
    Route::get('users/import', [\App\Http\Controllers\AccessController::class, 'createUsers'])->name('users.create');
    Route::post('users/import', [\App\Http\Controllers\AccessController::class, 'storeUsers'])->name('users.store');
});

Route::prefix('HOD')->middleware(['auth', 'HOD'])->group(function () {
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

Route::prefix('QC')->middleware(['auth', 'QC'])->group(function () {
    Route::get('/List', [\App\Http\Controllers\QCController::class, 'QCTable'])->name('qc.table');
    Route::get('/{document}/Review', [\App\Http\Controllers\QCController::class, 'reviewDoc'])->name('QC.review');
    Route::patch('/{document}/Review', [\App\Http\Controllers\QCController::class, 'update'])->name('qc.update');
});

Route::prefix('MD')->middleware(['auth', 'MD'])->group(function () {
    Route::get('/List', [\App\Http\Controllers\MDController::class, 'MDTable'])->name('md.table');
    Route::get('/{document}/Review', [\App\Http\Controllers\MDController::class, 'reviewDoc'])->name('MD.review');
    Route::patch('/{document}/Review', [\App\Http\Controllers\MDController::class, 'update'])->name('md.update');
});

Route::prefix('Implement')->middleware(['auth', 'QC'])->group(function () {
    Route::get('/List', [\App\Http\Controllers\RoleController::class, 'IMTable'])->name('imp.table');
    Route::get('/{document}/Review', [\App\Http\Controllers\RoleController::class, 'reviewDoc'])->name('role.review');
    Route::patch('/{document}/Review', [\App\Http\Controllers\RoleController::class, 'update'])->name('imp.update');
});


require __DIR__ . '/auth.php';
