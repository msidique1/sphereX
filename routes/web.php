<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MahasiswaController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// All Kaprodi Routes
Route::middleware(['auth', 'role:kaprodi'])->group(function() {
    Route::get('/kaprodi/dashboard', [KaprodiController::class, 'index'])->name('kaprodi.dashboard');
    Route::get('/kaprodi/management-dosen', [KaprodiController::class, 'dosenView'])->name('kaprodi.management-dosen');
    Route::get('/kaprodi/management-kelas', [KaprodiController::class, 'kelasView'])->name('kaprodi.management-kelas');
    Route::get('/kaprodi/plotting', [KaprodiController::class, 'plottingOption'])->name('kaprodi.plotting');
    Route::get('/kaprodi/show-mahasiswa', [KaprodiController::class, 'showMahasiswa'])->name('kaprodi.show-mahasiswa');
    
    // Dosen session
    Route::get('/kaprodi/add-edit-dosen/{id?}', [KaprodiController::class, 'interfaceAddEditDosen'])->name('kaprodi.add-edit-dosen');
    Route::post('/kaprodi/add-edit-dosen', [KaprodiController::class, 'submitDosen'])->name('kaprodi.submit-dosen');
    Route::put('/kaprodi/add-edit-dosen/{id?}', [KaprodiController::class, 'submitDosen'])->name('kaprodi.update-dosen');
    Route::delete('/kaprodi/delete-dosen/{id}', [KaprodiController::class, 'deleteDataDosen'])->name('kaprodi.delete-dosen');

    // Kelas session
    Route::get('/kaprodi/add-edit-kelas/{id?}', [KaprodiController::class, 'interfaceManageKelas'])->name('kaprodi.add-edit-kelas');
    Route::post('/kaprodi/add-edit-kelas', [KaprodiController::class, 'storeKelas'])->name('kaprodi.store-kelas');
    Route::put('/kaprodi/add-edit-kelas/{id?}', [KaprodiController::class, 'storeKelas'])->name('kaprodi.update-kelas');
    Route::delete('/kaprodi/delete-kelas/{id}', [KaprodiController::class, 'deleteDataKelas'])->name('kaprodi.delete-kelas');

    // Plotting session
    Route::get('/kaprodi/plotting/{type}', [KaprodiController::class, 'plotDetailView'])->name('kaprodi.plot-detail');
    Route::post('/kaprodi/plotting/dosen', [KaprodiController::class, 'plotDosen'])->name('kaprodi.plot-dosen');
    Route::post('/kaprodi/plotting/mahasiswa', [KaprodiController::class, 'plotMahasiswa'])->name('kaprodi.plot-mahasiswa');
});

// All Dosen Routes
Route::middleware(['auth', 'role:dosen'])->group(function() {
    Route::get('/dosen/dashboard', [DosenController::class, 'index'])->name('dosen.dashboard');
    Route::get('/dosen/management-mahasiswa', [DosenController::class, 'mahasiswaManageView'])->name('dosen.management-mahasiswa');
    Route::get('/dosen/daftar-mahasiswa', [DosenController::class, 'daftarMahasiswaView'])->name('dosen.daftar-mahasiswa');
    Route::get('/dosen/request-edit', [DosenController::class, 'requestEditView'])->name('dosen.request-edit');

    // Mahasiswa session
    Route::get('/dosen/management-mahasiswa/add-edit-mahasiswa/{id?}', [DosenController::class, 'addEditMahasiswaView'])->name('dosen.add-edit-mahasiswa');
    Route::post('/dosen/management-mahasiswa/add', [DosenController::class, 'storeMahasiswa'])->name('dosen.store-mahasiswa');
    Route::put('/dosen/management-mahasiswa/edit/{id}', [DosenController::class, 'updateMahasiswa'])->name('dosen.update-mahasiswa');
    Route::delete('/dosen/management-mahasiswa/delete/{id}', [DosenController::class, 'deleteMahasiswa'])->name('dosen.delete-mahasiswa');

    // Request session
    Route::post('/dosen/request-edit/{id}/{action}', [DosenController::class, 'handleEditRequest'])->name('dosen.handle-request');
});

// All Mahasiswa Routes
Route::middleware(['auth', 'role:mahasiswa'])->group(function() {
    Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'index'])->name('mahasiswa.dashboard');
    Route::get('/mahasiswa/detail/{id}', [MahasiswaController::class, 'show'])->name('mahasiswa.detail');

    // Request session
    Route::get('/mahasiswa/request-edit', [MahasiswaController::class, 'requestEditView'])->name('mahasiswa.request-edit');
    Route::post('/mahasiswa/store-request-edit', [MahasiswaController::class, 'storeEditRequest'])->name('mahasiswa.store-edit-request');
    Route::put('/mahasiswa/update-data/{id}', [MahasiswaController::class, 'updateMahasiswaByRequest'])->name('mahasiswa.update-data-request');
});

require __DIR__.'/auth.php';
