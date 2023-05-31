<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
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
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
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

// Admin Area Start
// User Area Start

Route::middleware(['guest'])->group(function () {
	Route::match(['get', 'post'], 'login/store', [AdminController::class, 'userStore'])->name('admin.users.login');
	Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
	Route::post('/store', [AuthenticatedSessionController::class, 'store'])->name('admin.home.store');
});

Route::middleware(['auth'])->group(function () {
	Route::get('/', [AdminController::class, 'index'])->name('admin.home.index');

	// Logout Option
    Route::get('/logout', [AdminController::class, 'destroy'])->name('admin.logout');

    // User Profile
    Route::get('/profile', [AdminController::class, 'userProfile'])->name('admin.profile');

    // Theme Update
    Route::get('/theme', [AdminController::class, 'userProfileTheme'])->name('admin.theme');
    Route::post('/themeUpdate', [AdminController::class, 'userProfileThemeUpdate'])->name('admin.themeUpdate');
});

// User Area End

// Location Page Area Start
// Country Area Start
Route::middleware(['auth'])->group(function () {
    // Country Home Page
    Route::get('/country', [CountryController::class, 'index'])->name('admin.country');
    Route::post('/country/store', [CountryController::class, 'store'])->name('admin.country.store');

    Route::get('/country/show/{id}', [CountryController::class, 'show'])->name('admin.country.show');

    // Country Name Update
    Route::get('/country/edit/{id}', [CountryController::class, 'edit'])->name('admin.country.edit');
    Route::post('/country/update/{id}', [CountryController::class, 'update'])->name('admin.country.update');

    // Country Nationality Update
    Route::get('/country/editnative/{id}', [CountryController::class, 'editNationality'])->name('admin.country.editnative');
    Route::post('/country/updateNationality/{id}', [CountryController::class, 'updateNationality'])->name('admin.country.updateNationality');

    // Country Delete
    Route::get('/country/destroy/{id}', [CountryController::class, 'destroy'])->name('admin.country.destroy');
});
// Country Area End

// Division Area Start
Route::middleware(['auth'])->group(function () {
    // Division Home Page
    Route::get('/division', [DivisionController::class, 'index'])->name('admin.division');

    // Division Create
    Route::get('/division/create', [DivisionController::class, 'create'])->name('admin.division.create');
    Route::post('/division/store', [DivisionController::class, 'store'])->name('admin.division.store');

    Route::get('/division/show/{id}', [DivisionController::class, 'show'])->name('admin.division.show');

    // Division Name Update
    Route::get('/division/edit/{id}', [DivisionController::class, 'edit'])->name('admin.division.edit');
    Route::post('/division/update/{id}', [DivisionController::class, 'update'])->name('admin.division.update');

    // Division Info Update
    Route::get('/division/editInfo/{id}', [DivisionController::class, 'editInfo'])->name('admin.division.editInfo');
    Route::post('/division/updateInfo/{id}', [DivisionController::class, 'updateInfo'])->name('admin.division.updateInfo');

    // Division Delete
    Route::get('/division/destroy/{id}', [DivisionController::class, 'destroy'])->name('admin.division.destroy');
});
// Division Area End

// District Area Start
Route::middleware(['auth'])->group(function () {
    // District Home Page
    Route::get('/district', [DistrictController::class, 'index'])->name('admin.district');

    // District Create
    Route::get('/district/create', [DistrictController::class, 'create'])->name('admin.district.create');
    Route::post('/district/store', [DistrictController::class, 'store'])->name('admin.district.store');

    Route::get('/district/get', [DistrictController::class, 'getDivision'])->name('admin.district.get');

    Route::get('/district/show/{id}', [DistrictController::class, 'show'])->name('admin.district.show');

    // District Name Update
    Route::get('/district/edit/{id}', [DistrictController::class, 'edit'])->name('admin.district.edit');
    Route::post('/district/update/{id}', [DistrictController::class, 'update'])->name('admin.district.update');

    // District Info Update
    Route::get('/district/editInfo/{id}', [DistrictController::class, 'editInfo'])->name('admin.district.editInfo');
    Route::post('/district/updateInfo/{id}', [DistrictController::class, 'updateInfo'])->name('admin.district.updateInfo');

    // District Delete
    Route::get('/district/destroy/{id}', [DistrictController::class, 'destroy'])->name('admin.district.destroy');
});
// District Area End

// Police Station Area Start
Route::middleware(['auth'])->group(function () {
    // Police Station Home Page
    Route::get('/upzila', [PolicestationController::class, 'index'])->name('admin.policestation');

    // Police Station Create
    Route::get('/upzila/create', [PolicestationController::class, 'create'])->name('admin.policestation.create');
    Route::post('/upzila/store', [PolicestationController::class, 'store'])->name('admin.policestation.store');

    Route::get('/upzila/get', [PolicestationController::class, 'getDivision'])->name('admin.policestation.get');
    Route::get('/upzila/getDistrict', [PolicestationController::class, 'getDistrict'])->name('admin.policestation.getDistrict');

    Route::get('/upzila/show/{id}', [PolicestationController::class, 'show'])->name('admin.policestation.show');

    // Police Station Name Update
    Route::get('/upzila/edit/{id}', [PolicestationController::class, 'edit'])->name('admin.policestation.edit');
    Route::post('/upzila/update/{id}', [PolicestationController::class, 'update'])->name('admin.policestation.update');

    // Police Station Info Update
    Route::get('/upzila/editInfo/{id}', [PolicestationController::class, 'editInfo'])->name('admin.policestation.editInfo');
    Route::post('/upzila/updateInfo/{id}', [PolicestationController::class, 'updateInfo'])->name('admin.policestation.updateInfo');

    // Police Station Delete
    Route::get('/upzila/destroy/{id}', [PolicestationController::class, 'destroy'])->name('admin.policestation.destroy');
});
// Police Station Area End

// Issue Place Area Start
Route::middleware(['auth'])->group(function () {
    // Issue Place Home Page
    Route::get('/issue', [IssueController::class, 'index'])->name('admin.issue');

    // Issue Place Create
    Route::get('/issue/create', [IssueController::class, 'create'])->name('admin.issue.create');
    Route::post('/issue/store', [IssueController::class, 'store'])->name('admin.issue.store');

    Route::get('/issue/show/{id}', [IssueController::class, 'show'])->name('admin.issue.show');

    // Issue Place Name Update
    Route::get('/issue/edit/{id}', [IssueController::class, 'edit'])->name('admin.issue.edit');
    Route::post('/issue/update/{id}', [IssueController::class, 'update'])->name('admin.issue.update');

    // Issue Place Info Update
    Route::get('/issue/editInfo/{id}', [IssueController::class, 'editInfo'])->name('admin.issue.editInfo');
    Route::post('/issue/updateInfo/{id}', [IssueController::class, 'updateInfo'])->name('admin.issue.updateInfo');

    // Issue Place Delete
    Route::get('/issue/destroy/{id}', [IssueController::class, 'destroy'])->name('admin.issue.destroy');
});
// Issue Place Area End
// Location Page Area End


// Admin Area End

