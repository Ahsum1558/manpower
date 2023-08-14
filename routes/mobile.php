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
use App\Http\Controllers\Visa\LinkController;
use App\Http\Controllers\Account\AccountCategoryController;
use App\Http\Controllers\Account\BankAccountController;
use App\Http\Controllers\Account\MobileAccountController;
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

// Mobile Account Area Start
Route::middleware(['auth'])->group(function () {
    // Mobile Account Home Page
    Route::get('/mobile', [MobileAccountController::class, 'index'])->name('admin.mobile');

    // Mobile Account Create
    Route::get('/mobile/create', [MobileAccountController::class, 'create'])->name('admin.mobile.create');
    Route::post('/mobile/store', [MobileAccountController::class, 'store'])->name('admin.mobile.store');

    // Get Division
    Route::get('/mobile/getDivision', [MobileAccountController::class, 'getDivision'])->name('admin.mobile.getDivision');
    // Get District
    Route::get('/mobile/getDistrict', [MobileAccountController::class, 'getDistrict'])->name('admin.mobile.getDistrict');

    Route::get('/mobile/show/{id}', [MobileAccountController::class, 'show'])->name('admin.mobile.show');

    // Mobile Account Update
    Route::get('/mobile/edit/{id}', [MobileAccountController::class, 'edit'])->name('admin.mobile.edit');
    Route::post('/mobile/update/{id}', [MobileAccountController::class, 'update'])->name('admin.mobile.update');

    // Mobile Account Number Update
    Route::get('/mobile/editAccount/{id}', [MobileAccountController::class, 'editAccount'])->name('admin.mobile.editAccount');
    Route::post('/mobile/updateAccount/{id}', [MobileAccountController::class, 'updateAccount'])->name('admin.mobile.updateAccount');

    // Mobile Account Holder Image Update
    Route::get('/mobile/editImage/{id}', [MobileAccountController::class, 'editImage'])->name('admin.mobile.editImage');
    Route::post('/mobile/updateImage/{id}', [MobileAccountController::class, 'updateImage'])->name('admin.mobile.updateImage');

    // Mobile Account Delete
    Route::get('/mobile/destroy/{id}', [MobileAccountController::class, 'destroy'])->name('admin.mobile.destroy');

    // Mobile Account Inactive
    Route::post('/mobile/inactive/{id}', [MobileAccountController::class, 'inactive'])->name('admin.mobile.inactive');

    // Mobile Account Active
    Route::post('/mobile/active/{id}', [MobileAccountController::class, 'active'])->name('admin.mobile.active');
});
// Mobile Account Area End