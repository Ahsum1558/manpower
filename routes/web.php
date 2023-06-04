<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Super\SuperController;
use App\Http\Controllers\Admin\AdminuserController;
use App\Http\Controllers\Super\CmspageController;
use App\Http\Controllers\Super\FieldarController;
use App\Http\Controllers\Super\FieldbnController;
use App\Http\Controllers\Super\FieldController;
use App\Http\Controllers\Super\HeaderfooterController;
use App\Http\Controllers\Super\SuperuserController;
use App\Http\Controllers\Visa\VisaController;
use App\Http\Controllers\Visa\VisatradeController;
use App\Http\Controllers\Visa\VisatypeController;
use App\Http\Controllers\Visa\VisapdfController;
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

// Visa Type Area Start
Route::middleware(['auth'])->group(function () {
    // Visa Type Home Page
    Route::get('/visaType', [VisatypeController::class, 'index'])->name('admin.visaType');

    // Visa Type Create
    Route::post('/visaType/store', [VisatypeController::class, 'store'])->name('admin.visaType.store');

    Route::get('/visaType/show/{id}', [VisatypeController::class, 'show'])->name('admin.visaType.show');

    // Visa Type Name Update
    Route::get('/visaType/edit/{id}', [VisatypeController::class, 'edit'])->name('admin.visaType.edit');
    Route::post('/visaType/update/{id}', [VisatypeController::class, 'update'])->name('admin.visaType.update');

    // Visa Type Delete
    Route::get('/visaType/destroy/{id}', [VisatypeController::class, 'destroy'])->name('admin.visaType.destroy');

    // Visa Type Inactive
    Route::post('/visaType/inactive/{id}', [VisatypeController::class, 'inactive'])->name('admin.visaType.inactive');

    // Visa Type Active
    Route::post('/visaType/active/{id}', [VisatypeController::class, 'active'])->name('admin.visaType.active');
});
// Visa Type Area End

// Visa Trade Area Start
Route::middleware(['auth'])->group(function () {
    // Visa Trade Home Page
    Route::get('/visaTrade', [VisatradeController::class, 'index'])->name('admin.visaTrade');

    // Visa Trade Create
    Route::post('/visaTrade/store', [VisatradeController::class, 'store'])->name('admin.visaTrade.store');

    Route::get('/visaTrade/show/{id}', [VisatradeController::class, 'show'])->name('admin.visaTrade.show');

    // Visa Trade Name Update
    Route::get('/visaTrade/edit/{id}', [VisatradeController::class, 'edit'])->name('admin.visaTrade.edit');
    Route::post('/visaTrade/update/{id}', [VisatradeController::class, 'update'])->name('admin.visaTrade.update');

    // Visa Trade Delete
    Route::get('/visaTrade/destroy/{id}', [VisatradeController::class, 'destroy'])->name('admin.visaTrade.destroy');

    // Visa Trade Inactive
    Route::post('/visaTrade/inactive/{id}', [VisatradeController::class, 'inactive'])->name('admin.visaTrade.inactive');

    // Visa Trade Active
    Route::post('/visaTrade/active/{id}', [VisatradeController::class, 'active'])->name('admin.visaTrade.active');
});
// Visa Trade Area End

// Visa Area Start
Route::middleware(['auth'])->group(function () {
    // Visa Home Page
    Route::get('/visa', [VisaController::class, 'index'])->name('admin.visa');

    // Visa Create
    Route::get('/visa/create', [VisaController::class, 'create'])->name('admin.visa.create');
    Route::post('/visa/store', [VisaController::class, 'store'])->name('admin.visa.store');

    Route::get('/visa/show/{id}', [VisaController::class, 'show'])->name('admin.visa.show');

    // Visa Update
    Route::get('/visa/edit/{id}', [VisaController::class, 'edit'])->name('admin.visa.edit');
    Route::post('/visa/update/{id}', [VisaController::class, 'update'])->name('admin.visa.update');

    // Visa Number Update
    Route::get('/visa/editVisa/{id}', [VisaController::class, 'editVisa'])->name('admin.visa.editVisa');
    Route::post('/visa/updateVisa/{id}', [VisaController::class, 'updateVisa'])->name('admin.visa.updateVisa');

    // Visa Delegation Number Update
    Route::get('/visa/editDelegation/{id}', [VisaController::class, 'editDelegation'])->name('admin.visa.editDelegation');
    Route::post('/visa/updateDelegation/{id}', [VisaController::class, 'updateDelegation'])->name('admin.visa.updateDelegation');

    // Visa Delete
    Route::get('/visa/destroy/{id}', [VisaController::class, 'destroy'])->name('admin.visa.destroy');

    // Visa Inactive
    Route::post('/visa/inactive/{id}', [VisaController::class, 'inactive'])->name('admin.visa.inactive');

    // Visa Active
    Route::post('/visa/active/{id}', [VisaController::class, 'active'])->name('admin.visa.active');

    Route::get('/visa/pdf', [VisapdfController::class, 'getpdf'])->name('admin.visa.pdf');
});
// Visa Area End



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';