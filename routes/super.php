<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Super\SuperController;
use App\Http\Controllers\Super\CmspageController;
use App\Http\Controllers\Super\FieldarController;
use App\Http\Controllers\Super\FieldbnController;
use App\Http\Controllers\Super\FieldController;
use App\Http\Controllers\Super\HeaderfooterController;
use App\Http\Controllers\Super\SuperuserController;
use App\Http\Controllers\Super\TravelCmspageController;
use App\Http\Controllers\Super\TravelSetupController;
use App\Http\Controllers\Super\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Super Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Super Admin Page Start
// Super Admin Area Start
Route::prefix('/super')->group(function () {

    Route::namespace('Auth')->middleware('guest:super')->group(function(){
        Route::match(['get', 'post'], 'login', [SuperController::class, 'login'])->name('super.users.login');
        Route::match(['get', 'post'], 'login/store', [SuperController::class, 'superStore'])->name('super.users.store');
        // Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('super.home.login');
        // Route::post('/store', [AuthenticatedSessionController::class, 'store'])->name('super.home.store');
    });
    
    Route::group(['middleware' => 'super'], function() {
        Route::get('/', [SuperController::class, 'index'])->name('super.home.index');

        // Logout Option
        Route::get('/logout', [SuperController::class, 'superLogout'])->name('super.logout');

        // Super Profile
        Route::get('/profile', [SuperController::class, 'superProfile'])->name('super.profile');

        // Profile Info Update
        Route::get('/profile/info', [SuperController::class, 'superProfileInfo'])->name('super.profile.info');
        Route::post('/profile/infoUpdate', [SuperController::class, 'superProfileInfoUpdate'])->name('super.profile.infoUpdate');

        // Username Update
        Route::get('/profile/username', [SuperController::class, 'superProfileUsername'])->name('super.profile.username');
        Route::post('/profile/usernameUpdate', [SuperController::class, 'superProfileUsernameUpdate'])->name('super.profile.usernameUpdate');

        // Email Update
        Route::get('/profile/email', [SuperController::class, 'superProfileEmail'])->name('super.profile.email');
        Route::post('/profile/emailUpdate', [SuperController::class, 'superProfileEmailUpdate'])->name('super.profile.emailUpdate');

        // Photo Update
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

// Meta Area Start
Route::group(['middleware' => 'super'], function() {
    // Super Meta Home Page
    Route::get('/super/meta', [CmspageController::class, 'index'])->name('super.meta');
    Route::post('/super/meta/store', [CmspageController::class, 'store'])->name('super.meta.store');

    // Meta Info Update
    Route::get('/super/meta/edit/{id}', [CmspageController::class, 'edit'])->name('super.meta.edit');
    Route::post('/super/meta/update/{id}', [CmspageController::class, 'update'])->name('super.meta.update');

    // Meta Delete
    Route::get('/super/meta/destroy/{id}', [CmspageController::class, 'destroy'])->name('super.meta.destroy');

    // Meta Inactive
    Route::post('/super/meta/inactive/{id}', [CmspageController::class, 'inactive'])->name('super.meta.inactive');

    // Meta Active
    Route::post('/super/meta/active/{id}', [CmspageController::class, 'active'])->name('super.meta.active');
});
// Meta Area End

// English Site Option Area Start
Route::group(['middleware' => 'super'], function() {
    // Super English Site Option Home Page
    Route::get('/super/field', [FieldController::class, 'index'])->name('super.field');
    Route::post('/super/field/store', [FieldController::class, 'store'])->name('super.field.store');

    Route::get('/super/field/show/{id}', [FieldController::class, 'show'])->name('super.field.show');

    // English Site Option Info Update
    Route::get('/super/field/edit/{id}', [FieldController::class, 'edit'])->name('super.field.edit');
    Route::post('/super/field/update/{id}', [FieldController::class, 'update'])->name('super.field.update');

    // English Site Option Title Update
    Route::get('/super/field/editTitle/{id}', [FieldController::class, 'editTitle'])->name('super.field.editTitle');
    Route::post('/super/field/updateTitle/{id}', [FieldController::class, 'updateTitle'])->name('super.field.updateTitle');

    // English Site Option Small Title Update
    Route::get('/super/field/editSmallTitle/{id}', [FieldController::class, 'editSmallTitle'])->name('super.field.editSmallTitle');
    Route::post('/super/field/updateSmallTitle/{id}', [FieldController::class, 'updateSmallTitle'])->name('super.field.updateSmallTitle');

    // English Site Option License Update
    Route::get('/super/field/editLicense/{id}', [FieldController::class, 'editLicense'])->name('super.field.editLicense');
    Route::post('/super/field/updateLicense/{id}', [FieldController::class, 'updateLicense'])->name('super.field.updateLicense');

    // English Site Option Logo Update
    Route::get('/super/field/editLogo/{id}', [FieldController::class, 'editLogo'])->name('super.field.editLogo');
    Route::post('/super/field/updateLogo/{id}', [FieldController::class, 'updateLogo'])->name('super.field.updateLogo');

    // English Site Option Delete
    Route::get('/super/field/destroy/{id}', [FieldController::class, 'destroy'])->name('super.field.destroy');

    // English Site Option Inactive
    Route::post('/super/field/inactive/{id}', [FieldController::class, 'inactive'])->name('super.field.inactive');

    // English Site Option Active
    Route::post('/super/field/active/{id}', [FieldController::class, 'active'])->name('super.field.active');
});
// English Site Option Area End

// Arabic Site Option Area Start
Route::group(['middleware' => 'super'], function() {
    // Super Arabic Site Option Home Page
    Route::get('/super/fieldar', [FieldarController::class, 'index'])->name('super.fieldar');
    Route::post('/super/fieldar/store', [FieldarController::class, 'store'])->name('super.fieldar.store');

    Route::get('/super/fieldar/show/{id}', [FieldarController::class, 'show'])->name('super.fieldar.show');

    // Arabic Site Option Info Update
    Route::get('/super/fieldar/edit/{id}', [FieldarController::class, 'edit'])->name('super.fieldar.edit');
    Route::post('/super/fieldar/update/{id}', [FieldarController::class, 'update'])->name('super.fieldar.update');

    // Arabic Site Option Title Update
    Route::get('/super/fieldar/editTitle/{id}', [FieldarController::class, 'editTitle'])->name('super.fieldar.editTitle');
    Route::post('/super/fieldar/updateTitle/{id}', [FieldarController::class, 'updateTitle'])->name('super.fieldar.updateTitle');

    // Arabic Site Option License Update
    Route::get('/super/fieldar/editLicense/{id}', [FieldarController::class, 'editLicense'])->name('super.fieldar.editLicense');
    Route::post('/super/fieldar/updateLicense/{id}', [FieldarController::class, 'updateLicense'])->name('super.fieldar.updateLicense');

    // Arabic Site Option Delete
    Route::get('/super/fieldar/destroy/{id}', [FieldarController::class, 'destroy'])->name('super.fieldar.destroy');

    // Arabic Site Option Inactive
    Route::post('/super/fieldar/inactive/{id}', [FieldarController::class, 'inactive'])->name('super.fieldar.inactive');

    // Arabic Site Option Active
    Route::post('/super/fieldar/active/{id}', [FieldarController::class, 'active'])->name('super.fieldar.active');
});
// Arabic Site Option Area End

// Bengali Site Option Area Start
Route::group(['middleware' => 'super'], function() {
    // Super Bengali Site Option Home Page
    Route::get('/super/fieldbn', [FieldbnController::class, 'index'])->name('super.fieldbn');
    Route::post('/super/fieldbn/store', [FieldbnController::class, 'store'])->name('super.fieldbn.store');

    Route::get('/super/fieldbn/show/{id}', [FieldbnController::class, 'show'])->name('super.fieldbn.show');

    // Bengali Site Option Info Update
    Route::get('/super/fieldbn/edit/{id}', [FieldbnController::class, 'edit'])->name('super.fieldbn.edit');
    Route::post('/super/fieldbn/update/{id}', [FieldbnController::class, 'update'])->name('super.fieldbn.update');

    // Bengali Site Option Title Update
    Route::get('/super/fieldbn/editTitle/{id}', [FieldbnController::class, 'editTitle'])->name('super.fieldbn.editTitle');
    Route::post('/super/fieldbn/updateTitle/{id}', [FieldbnController::class, 'updateTitle'])->name('super.fieldbn.updateTitle');

    // Bengali Site Option License Update
    Route::get('/super/fieldbn/editLicense/{id}', [FieldbnController::class, 'editLicense'])->name('super.fieldbn.editLicense');
    Route::post('/super/fieldbn/updateLicense/{id}', [FieldbnController::class, 'updateLicense'])->name('super.fieldbn.updateLicense');

    // Bengali Site Option Delete
    Route::get('/super/fieldbn/destroy/{id}', [FieldbnController::class, 'destroy'])->name('super.fieldbn.destroy');

    // Bengali Site Option Inactive
    Route::post('/super/fieldbn/inactive/{id}', [FieldbnController::class, 'inactive'])->name('super.fieldbn.inactive');

    // Bengali Site Option Active
    Route::post('/super/fieldbn/active/{id}', [FieldbnController::class, 'active'])->name('super.fieldbn.active');
});
// Bengali Site Option Area End

// Header and Footer Setting Area Start
Route::group(['middleware' => 'super'], function() {
    // Super Header and Footer Setting Home Page
    Route::get('/super/setting', [HeaderfooterController::class, 'index'])->name('super.setting');

     // Header and Footer Setting Create
    Route::get('/super/setting/create', [HeaderfooterController::class, 'create'])->name('super.setting.create');
    Route::post('/super/setting/store', [HeaderfooterController::class, 'store'])->name('super.setting.store');

    Route::get('/super/setting/show/{id}', [HeaderfooterController::class, 'show'])->name('super.setting.show');

    // Header and Footer Setting Info Update
    Route::get('/super/setting/edit/{id}', [HeaderfooterController::class, 'edit'])->name('super.setting.edit');
    Route::post('/super/setting/update/{id}', [HeaderfooterController::class, 'update'])->name('super.setting.update');

    // Header and Footer Setting Delete
    Route::get('/super/setting/destroy/{id}', [HeaderfooterController::class, 'destroy'])->name('super.setting.destroy');

    // Header and Footer Setting Inactive
    Route::post('/super/setting/inactive/{id}', [HeaderfooterController::class, 'inactive'])->name('super.setting.inactive');

    // Header and Footer Setting Active
    Route::post('/super/setting/active/{id}', [HeaderfooterController::class, 'active'])->name('super.setting.active');
});
// Header and Footer Setting Area End

// Super Operator Area Start
Route::group(['middleware' => 'super'], function() {
    // Super Operator Home Page
    Route::get('/super/operator', [SuperuserController::class, 'index'])->name('super.operator');

     // Super Operator Create
    Route::get('/super/operator/create', [SuperuserController::class, 'create'])->name('super.operator.create');
    Route::post('/super/operator/store', [SuperuserController::class, 'store'])->name('super.operator.store');

    Route::get('/super/operator/show/{id}', [SuperuserController::class, 'show'])->name('super.operator.show');

    // Super Operator Info Update
    Route::get('/super/operator/edit/{id}', [SuperuserController::class, 'edit'])->name('super.operator.edit');
    Route::post('/super/operator/update/{id}', [SuperuserController::class, 'update'])->name('super.operator.update');

    // Super Operator Delete
    Route::get('/super/operator/destroy/{id}', [SuperuserController::class, 'destroy'])->name('super.operator.destroy');

    // Super Operator Inactive
    Route::post('/super/operator/inactive/{id}', [SuperuserController::class, 'inactive'])->name('super.operator.inactive');

    // Super Operator Active
    Route::post('/super/operator/active/{id}', [SuperuserController::class, 'active'])->name('super.operator.active');
});
// Super Operator Area End

// Travel Area Start
// Travel Meta Area Start
Route::group(['middleware' => 'super'], function() {
    // Super Travel Meta Home Page
    Route::get('/super/travelmeta', [TravelCmspageController::class, 'index'])->name('super.travelmeta');
    Route::post('/super/travelmeta/store', [TravelCmspageController::class, 'store'])->name('super.travelmeta.store');

    // Travel Meta Info Update
    Route::get('/super/travelmeta/edit/{id}', [TravelCmspageController::class, 'edit'])->name('super.travelmeta.edit');
    Route::post('/super/travelmeta/update/{id}', [TravelCmspageController::class, 'update'])->name('super.travelmeta.update');

    // Travel Meta Delete
    Route::get('/super/travelmeta/destroy/{id}', [TravelCmspageController::class, 'destroy'])->name('super.travelmeta.destroy');

    // Travel Meta Inactive
    Route::post('/super/travelmeta/inactive/{id}', [TravelCmspageController::class, 'inactive'])->name('super.travelmeta.inactive');

    // Travel Meta Active
    Route::post('/super/travelmeta/active/{id}', [TravelCmspageController::class, 'active'])->name('super.travelmeta.active');
});
// Travel Meta Area End

// Travel Header and Footer Setting Area Start
Route::group(['middleware' => 'super'], function() {
    // Super Travel Header and Footer Setting Home Page
    Route::get('/super/travelset', [TravelSetupController::class, 'index'])->name('super.travelset');

     // Travel Header and Footer Setting Create
    Route::get('/super/travelset/create', [TravelSetupController::class, 'create'])->name('super.travelset.create');
    Route::post('/super/travelset/store', [TravelSetupController::class, 'store'])->name('super.travelset.store');

    Route::get('/super/travelset/show/{id}', [TravelSetupController::class, 'show'])->name('super.travelset.show');

    // Travel Header and Footer Setting Info Update
    Route::get('/super/travelset/edit/{id}', [TravelSetupController::class, 'edit'])->name('super.travelset.edit');
    Route::post('/super/travelset/update/{id}', [TravelSetupController::class, 'update'])->name('super.travelset.update');

    // Travel Header and Footer Setting Delete
    Route::get('/super/travelset/destroy/{id}', [TravelSetupController::class, 'destroy'])->name('super.travelset.destroy');

    // Travel Header and Footer Setting Inactive
    Route::post('/super/travelset/inactive/{id}', [TravelSetupController::class, 'inactive'])->name('super.travelset.inactive');

    // Travel Header and Footer Setting Active
    Route::post('/super/travelset/active/{id}', [TravelSetupController::class, 'active'])->name('super.travelset.active');
});
// Travel Header and Footer Setting Area End

// Travel Area End

// Super Admin Page End