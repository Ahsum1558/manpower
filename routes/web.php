<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Super\SuperController;

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
