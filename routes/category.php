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

// Account Category Area Start
Route::middleware(['auth'])->group(function () {
    // Account Category Home Page
    Route::get('/category', [AccountCategoryController::class, 'index'])->name('admin.category');

    // Account Category Create
    Route::get('/category/create', [AccountCategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/category/store', [AccountCategoryController::class, 'store'])->name('admin.category.store');

    Route::get('/category/show/{id}', [AccountCategoryController::class, 'show'])->name('admin.category.show');

    // Account Category Update
    Route::get('/category/edit/{id}', [AccountCategoryController::class, 'edit'])->name('admin.category.edit');
    Route::post('/category/update/{id}', [AccountCategoryController::class, 'update'])->name('admin.category.update');

    // Account Category Delete
    Route::get('/category/destroy/{id}', [AccountCategoryController::class, 'destroy'])->name('admin.category.destroy');

    // Account Category Inactive
    Route::post('/category/inactive/{id}', [AccountCategoryController::class, 'inactive'])->name('admin.category.inactive');

    // Account Category Active
    Route::post('/category/active/{id}', [AccountCategoryController::class, 'active'])->name('admin.category.active');
});
// Account Category Area End