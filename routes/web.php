<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Super\SuperController;
use App\Http\Controllers\Super\CmspageController;
use App\Http\Controllers\Super\FieldController;
use App\Http\Controllers\Super\FieldarController;
use App\Http\Controllers\Super\FieldbnController;

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



Route::get('/', [AdminController::class, 'index'])->name('admin');
// Route::get('/super', [SuperController::class, 'index'])->middleware(['super', 'verified'])->name('super');
// Route::get('/super/login', [SuperController::class, 'login'])->name('super.login');

// Super Admin Area Start
Route::prefix('super')->group(function () {
    // Login Option
    Route::match(['get', 'post'], '/login', [SuperController::class, 'login'])->name('super.login');
    Route::group(['middleware' => ['super']], function() {
        Route::get('/', [SuperController::class, 'index']);

        // Log Out Option
        Route::get('logout', [SuperController::class, 'superLogout'])->name('super.logout');

        // Profile
        Route::get('/profile', [SuperController::class, 'superProfile'])->name('super.profile');

        // Profile Information Update
        Route::get('/profile/info', [SuperController::class, 'superProfileInfo'])->name('super.profile.info');
        Route::post('/profile/infoUpdate', [SuperController::class, 'superProfileInfoUpdate'])->name('super.profile.infoUpdate');

        // Username Update
        Route::get('/profile/username', [SuperController::class, 'superProfileUsername'])->name('super.profile.username');
        Route::post('/profile/usernameUpdate', [SuperController::class, 'superProfileUsernameUpdate'])->name('super.profile.usernameUpdate');

        // E-Mail Update
        Route::get('/profile/email', [SuperController::class, 'superProfileEmail'])->name('super.profile.email');
        Route::post('/profile/emailUpdate', [SuperController::class, 'superProfileEmailUpdate'])->name('super.profile.emailUpdate');

        // Image Update
        Route::get('/profile/image', [SuperController::class, 'superProfileImage'])->name('super.profile.image');
        Route::post('/profile/imageUpdate', [SuperController::class, 'superProfileImageUpdate'])->name('super.profile.imageUpdate');

        // Password Update
        Route::get('/profile/password', [SuperController::class, 'superProfilePassword'])->name('super.profile.password');
        Route::post('/profile/passwordUpdate', [SuperController::class, 'superProfilePasswordUpdate'])->name('super.profile.passwordUpdate');
        
        // Theme Update
        Route::get('/theme', [SuperController::class, 'superProfileTheme'])->name('super.theme');
        Route::post('/themeUpdate', [SuperController::class, 'superProfileThemeUpdate'])->name('super.themeUpdate');
    });
});

// Meta Area Start
Route::group(['middleware' => ['super']], function() {
    Route::get('/super/meta', [CmspageController::class, 'index'])->name('super.meta');
    Route::get('/super/meta/create', [CmspageController::class, 'create'])->name('super.meta.create');
    Route::post('/super/meta/store', [CmspageController::class, 'store'])->name('super.meta.store');
    Route::get('/super/meta/destroy/{id}', [CmspageController::class, 'destroy'])->name('super.meta.destroy');
    Route::get('/super/meta/edit/{id}', [CmspageController::class, 'edit'])->name('super.meta.edit');
    Route::post('/super/meta/update/{id}', [CmspageController::class, 'update'])->name('super.meta.update');
});
// Meta Area End

// English Field Option Area Start
Route::group(['middleware' => ['super']], function() {
    Route::get('/super/field', [FieldController::class, 'index'])->name('super.field');
    Route::get('/super/field/create', [FieldController::class, 'create'])->name('super.field.create');
    Route::post('/super/field/store', [FieldController::class, 'store'])->name('super.field.store');
    Route::get('/super/field/show/{id}', [FieldController::class, 'show'])->name('super.field.show');
    Route::get('/super/field/destroy/{id}', [FieldController::class, 'destroy'])->name('super.field.destroy');
    
    // Basic Information Update
    Route::get('/super/field/edit/{id}', [FieldController::class, 'edit'])->name('super.field.edit');
    Route::post('/super/field/update/{id}', [FieldController::class, 'update'])->name('super.field.update');

    // Title Update
    Route::get('/super/field/editTitle/{id}', [FieldController::class, 'editTitle'])->name('super.field.editTitle');
    Route::post('/super/field/updateTitle/{id}', [FieldController::class, 'updateTitle'])->name('super.field.updateTitle');

    // Small Title Update
    Route::get('/super/field/editSmallTitle/{id}', [FieldController::class, 'editSmallTitle'])->name('super.field.editSmallTitle');
    Route::post('/super/field/updateSmallTitle/{id}', [FieldController::class, 'updateSmallTitle'])->name('super.field.updateSmallTitle');

    // License Number Update
    Route::get('/super/field/editLicense/{id}', [FieldController::class, 'editLicense'])->name('super.field.editLicense');
    Route::post('/super/field/updateLicense/{id}', [FieldController::class, 'updateLicense'])->name('super.field.updateLicense');

    // Logo Update
    Route::get('/super/field/editLogo/{id}', [FieldController::class, 'editLogo'])->name('super.field.editLogo');
    Route::post('/super/field/updateLogo/{id}', [FieldController::class, 'updateLogo'])->name('super.field.updateLogo');
});
// English Field Option Area End

// Arabic Field Option Area Start
Route::group(['middleware' => ['super']], function() {
    Route::get('/super/fieldar', [FieldarController::class, 'index'])->name('super.fieldar');
    Route::get('/super/fieldar/create', [FieldarController::class, 'create'])->name('super.fieldar.create');
    Route::post('/super/fieldar/store', [FieldarController::class, 'store'])->name('super.fieldar.store');
    Route::get('/super/fieldar/show/{id}', [FieldarController::class, 'show'])->name('super.fieldar.show');
    Route::get('/super/fieldar/destroy/{id}', [FieldarController::class, 'destroy'])->name('super.fieldar.destroy');
    
    // Basic Information Update
    Route::get('/super/fieldar/edit/{id}', [FieldarController::class, 'edit'])->name('super.fieldar.edit');
    Route::post('/super/fieldar/update/{id}', [FieldarController::class, 'update'])->name('super.fieldar.update');

    // Title Update
    Route::get('/super/fieldar/editTitle/{id}', [FieldarController::class, 'editTitle'])->name('super.fieldar.editTitle');
    Route::post('/super/fieldar/updateTitle/{id}', [FieldarController::class, 'updateTitle'])->name('super.fieldar.updateTitle');

    // License Number Update
    Route::get('/super/fieldar/editLicense/{id}', [FieldarController::class, 'editLicense'])->name('super.fieldar.editLicense');
    Route::post('/super/fieldar/updateLicense/{id}', [FieldarController::class, 'updateLicense'])->name('super.fieldar.updateLicense');
});
// Arabic Field Option Area End

// Bengali Field Option Area Start
Route::group(['middleware' => ['super']], function() {
    Route::get('/super/fieldbn', [FieldbnController::class, 'index'])->name('super.fieldbn');
    Route::get('/super/fieldbn/create', [FieldbnController::class, 'create'])->name('super.fieldbn.create');
    Route::post('/super/fieldbn/store', [FieldbnController::class, 'store'])->name('super.fieldbn.store');
    Route::get('/super/fieldbn/show/{id}', [FieldbnController::class, 'show'])->name('super.fieldbn.show');
    Route::get('/super/fieldbn/destroy/{id}', [FieldbnController::class, 'destroy'])->name('super.fieldbn.destroy');
    
    // Basic Information Update
    Route::get('/super/fieldbn/edit/{id}', [FieldbnController::class, 'edit'])->name('super.fieldbn.edit');
    Route::post('/super/fieldbn/update/{id}', [FieldbnController::class, 'update'])->name('super.fieldbn.update');

    // Title Update
    Route::get('/super/fieldbn/editTitle/{id}', [FieldbnController::class, 'editTitle'])->name('super.fieldbn.editTitle');
    Route::post('/super/fieldbn/updateTitle/{id}', [FieldbnController::class, 'updateTitle'])->name('super.fieldbn.updateTitle');

    // License Number Update
    Route::get('/super/fieldbn/editLicense/{id}', [FieldbnController::class, 'editLicense'])->name('super.fieldbn.editLicense');
    Route::post('/super/fieldbn/updateLicense/{id}', [FieldbnController::class, 'updateLicense'])->name('super.fieldbn.updateLicense');
});
// Bengali Field Option Area End


// Super Admin Area End




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
