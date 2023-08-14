<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Travel\TravelController;
use App\Http\Controllers\Travel\TraveluserController;
use App\Http\Controllers\Admin\AdminuserController;
use App\Http\Controllers\Super\SuperController;
use App\Http\Controllers\Super\CmspageController;
use App\Http\Controllers\Super\FieldarController;
use App\Http\Controllers\Super\FieldbnController;
use App\Http\Controllers\Super\FieldController;
use App\Http\Controllers\Super\HeaderfooterController;
use App\Http\Controllers\Locaton\CountryController;
use App\Http\Controllers\Locaton\DivisionController;
use App\Http\Controllers\Locaton\DistrictController;
use App\Http\Controllers\Locaton\PolicestationController;
use App\Http\Controllers\Locaton\IssueController;
use App\Http\Controllers\Locaton\CityController;
use App\Http\Controllers\Travel\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Travel Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Travel Admin Area Start
// Home Page and Login Area Start
Route::middleware(['guest'])->group(function () {
	Route::match(['get', 'post'], 'travel/login/store', [TravelController::class, 'travelstore'])->name('travel.users.login');
	Route::get('/travel/login', [AuthenticatedSessionController::class, 'create'])->name('travel.users.login');
	Route::post('/travel/store', [AuthenticatedSessionController::class, 'store'])->name('travel.home.store');
});
Route::group(['middleware' => 'travel'], function() {
    Route::get('/travel', [TravelController::class, 'index'])->name('travel.home.index');
    Route::get('/travel/logout', [TravelController::class, 'destroy'])->name('travel.logout');
});
// Home Page and Login Area End

// User Profile Area Start
Route::group(['middleware' => 'travel'], function() {
    // User Profile
    Route::get('/travel/profile', [TravelController::class, 'userProfile'])->name('travel.profile');

    // Profile Info Update
    Route::get('/travel/profile/info', [TravelController::class, 'profileInfoEdit'])->name('travel.profile.info');
    Route::post('/travel/travel/profile/infoUpdate', [TravelController::class, 'profileInfoUpdate'])->name('travel.profile.infoUpdate');

    // Get Division
    Route::get('/travel/profile/get', [TravelController::class, 'getDivision'])->name('travel.profile.get');
    // Get District
    Route::get('/travel/profile/getDistrict', [TravelController::class, 'getDistrict'])->name('travel.profile.getDistrict');
    // Get City
    Route::get('/travel/profile/getCity', [TravelController::class, 'getCity'])->name('travel.profile.getCity');
    // Get Upzila
    Route::get('/travel/profile/getUpzila', [TravelController::class, 'getUpzila'])->name('travel.profile.getUpzila');

    // Username Update
    Route::get('/travel/profile/username', [TravelController::class, 'profileUsername'])->name('travel.profile.username');
    Route::post('/travel/profile/usernameUpdate', [TravelController::class, 'profileUsernameUpdate'])->name('travel.profile.usernameUpdate');

    // Email Update
    Route::get('/travel/profile/email', [TravelController::class, 'profileEmail'])->name('travel.profile.email');
    Route::post('/travel/profile/emailUpdate', [TravelController::class, 'profileEmailUpdate'])->name('travel.profile.emailUpdate');

    // Photo Update
    Route::get('/travel/profile/image', [TravelController::class, 'profileImage'])->name('travel.profile.image');
    Route::post('/travel/profile/imageUpdate', [TravelController::class, 'profileImageUpdate'])->name('travel.profile.imageUpdate');

    // Password Update
    Route::get('/travel/profile/password', [TravelController::class, 'profilePassword'])->name('travel.profile.password');
    Route::post('/travel/profile/passwordUpdate', [TravelController::class, 'profilePasswordUpdate'])->name('travel.profile.passwordUpdate');

    // Theme Update
    Route::get('/travel/theme', [TravelController::class, 'userProfileTheme'])->name('travel.theme');
    Route::post('/travel/themeUpdate', [TravelController::class, 'userProfileThemeUpdate'])->name('travel.themeUpdate');
});

// User Profile Area End

// User Operator Area Start
Route::group(['middleware' => 'travel'], function() {
    // User Operator Home Page
    Route::get('/travel/operator', [TraveluserController::class, 'index'])->name('travel.operator');

     // User Operator Create
    Route::get('/travel/operator/create', [TraveluserController::class, 'create'])->name('travel.operator.create');
    Route::post('/travel/operator/store', [TraveluserController::class, 'store'])->name('travel.operator.store');

    Route::get('/travel/operator/show/{id}', [TraveluserController::class, 'show'])->name('travel.operator.show');

    // User Operator Info Update
    Route::get('/travel/operator/edit/{id}', [TraveluserController::class, 'edit'])->name('travel.operator.edit');
    Route::post('/travel/operator/update/{id}', [TraveluserController::class, 'update'])->name('travel.operator.update');

    // User Operator Delete
    Route::get('/travel/operator/destroy/{id}', [TraveluserController::class, 'destroy'])->name('travel.operator.destroy');

    // User Operator Inactive
    Route::post('/travel/operator/inactive/{id}', [TraveluserController::class, 'inactive'])->name('travel.operator.inactive');

    // User Operator Active
    Route::post('/travel/operator/active/{id}', [TraveluserController::class, 'active'])->name('travel.operator.active');
});
// User Operator Area End

// Travel Admin Area End