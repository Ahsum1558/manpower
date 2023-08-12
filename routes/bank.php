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

 // Bank Account Area Start
Route::middleware(['auth'])->group(function () {
    // Bank Account Home Page
    Route::get('/bank', [BankAccountController::class, 'index'])->name('admin.bank');

    // Bank Account Create
    Route::get('/bank/create', [BankAccountController::class, 'create'])->name('admin.bank.create');
    Route::post('/bank/store', [BankAccountController::class, 'store'])->name('admin.bank.store');

    // Get Division
    Route::get('/bank/getDivision', [BankAccountController::class, 'getDivision'])->name('admin.bank.getDivision');
    // Get District
    Route::get('/bank/getDistrict', [BankAccountController::class, 'getDistrict'])->name('admin.bank.getDistrict');

    Route::get('/bank/show/{id}', [BankAccountController::class, 'show'])->name('admin.bank.show');

    // Bank Account Update
    Route::get('/bank/edit/{id}', [BankAccountController::class, 'edit'])->name('admin.bank.edit');
    Route::post('/bank/update/{id}', [BankAccountController::class, 'update'])->name('admin.bank.update');

    // Bank Account Number Update
    Route::get('/bank/editAccount/{id}', [BankAccountController::class, 'editAccount'])->name('admin.bank.editAccount');
    Route::post('/bank/updateAccount/{id}', [BankAccountController::class, 'updateAccount'])->name('admin.bank.updateAccount');

    // Bank Account Holder Image Update
    Route::get('/bank/editImage/{id}', [BankAccountController::class, 'editImage'])->name('admin.bank.editImage');
    Route::post('/bank/updateImage/{id}', [BankAccountController::class, 'updateImage'])->name('admin.bank.updateImage');

    // Bank Account Delete
    Route::get('/bank/destroy/{id}', [BankAccountController::class, 'destroy'])->name('admin.bank.destroy');

    // Bank Account Inactive
    Route::post('/bank/inactive/{id}', [BankAccountController::class, 'inactive'])->name('admin.bank.inactive');

    // Bank Account Active
    Route::post('/bank/active/{id}', [BankAccountController::class, 'active'])->name('admin.bank.active');
});
// Bank Account Area End