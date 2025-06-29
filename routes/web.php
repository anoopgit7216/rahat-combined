<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ManageUserController;
use App\Http\Controllers\Lekhpal\LekhpalDashboardController;
use App\Http\Controllers\Lekhpal\DeathDashboardController;
use App\Http\Controllers\Lekhpal\AhaitukDashboardController;
use App\Http\Controllers\RevenueInspector\RevenueInspectorController;
use App\Http\Controllers\NaibTahsildar\NaibTahsildarController;
use App\Http\Controllers\Tahsildar\TahsildarController;
use App\Http\Controllers\SDM\SDMcontroller;
use App\Http\Controllers\ADM\ADMcontroller;

use App\Http\Controllers\Auth\LoginController;


Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.perform');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/', function () {
//     return view('welcome');
// });s

Route::middleware(['auth', 'checkRole:Admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/manage-users', [ManageUserController::class, 'index'])->name('admin.manage_users.index');
    Route::get('/user-create', [ManageUserController::class, 'create'])->name('admin.users.create');
    Route::post('/users-store', [ManageUserController::class, 'store'])->name('admin.users.store');
    Route::get('/admin/users/{id}/edit', [ManageUserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/admin/users/{id}', [ManageUserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [ManageUserController::class, 'destroy'])->name('admin.users.destroy');
});
Route::get('/get-tehsils/{district_code}', [ManageUserController::class, 'getTehsilsByDistrictCode']);
Route::get('/get-blocks/{tehsil_code}', [ManageUserController::class, 'getBlockByTehsilCode']);


Route::middleware(['auth', 'checkRole:Lekhpal'])->prefix('lekhpal')->group(function () {
    Route::get('/dashboard', [LekhpalDashboardController::class, 'index'])->name('lekhpal.dashboard');
    Route::get('/ahaituk/dashboard', [AhaitukDashboardController::class, 'index'])->name('lekhpal.ahaituk.dashboard');
    Route::get('/death/dashboard', [DeathDashboardController::class, 'index'])->name('lekhpal.death.dashboard');
    Route::get('/death/form', [DeathDashboardController::class, 'deathForm'])->name('lekhpal.death.form');
    Route::POST('/lekhpal/death/form/store', [DeathDashboardController::class, 'deathForm_store'])->name('lekhpal.deathform.store');
    Route::get('/lekhpal/death/benificiary/form/{id}', [DeathDashboardController::class, 'benificiaryForm'])->name('lekhpal.death.form.benificiary');
    Route::POST('lekhpal/death/benificiary/form/store', [DeathDashboardController::class, 'storeBenificiaryDetails'])->name('lekhpal.death.form.benificiary.store');

    Route::get('/lekhpal/death/applications', [DeathDashboardController::class, 'allDeathApplications'])->name('lekhpal.death.applications');
    Route::get('/lekhpal/death/applications/pending', [DeathDashboardController::class, 'pendingDeathApplications'])->name('lekhpal.death.applications.pending');
    Route::get('/lekhpal/death/applications/approved', [DeathDashboardController::class, 'approvedDeathApplications'])->name('lekhpal.death.applications.approved');
    Route::get('/lekhpal/death/applications/delayed', [DeathDashboardController::class, 'delayedDeathApplications'])->name('lekhpal.death.applications.delayed');
    Route::get('/lekhpal/death/applications/reject', [DeathDashboardController::class, 'rejectDeathApplications'])->name('lekhpal.death.applications.reject');
    Route::get('/dashboard/stage-performance', [DeathDashboardController::class, 'stagePerformanceChart'])->name('lekhpal.dashboard.stage-performance');
    Route::get('/dashboard/daily-delay', [DeathDashboardController::class, 'dailyDelayBreakdown'])->name('lekhpal.dashboard.daily-delay');
    Route::get('/dashboard/stage-performance-metrics', [DeathDashboardController::class, 'stagePerformanceMetrics'])->name('lekhpal.dashboard.stage-performance-metric');
    Route::get('/dashboard/weekly-delay-trend', [DeathDashboardController::class, 'weeklyDelayTrend'])->name('lekhpal.dashboard.weekly-delay-trend');
    Route::get('/dashboard/delay-summary', [DeathDashboardController::class, 'delaySummary'])->name('lekhpal.dashboard.delay-summary');;


});


Route::middleware(['auth', 'checkRole:Revenue Inspector'])->prefix('rinspactor')->group(function () {
    Route::get('/dashboard', [RevenueInspectorController::class, 'index'])->name('rinspactor.dashboard');
    Route::get('/ahaituk/dashboard', [RevenueInspectorController::class, 'ahaitukDashboard'])->name('rinspactor.ahaituk.dashboard');
    Route::get('/death/dashboard', [RevenueInspectorController::class, 'revanueInspectorDashboard'])->name('rinspactor.death.dashboard');
    Route::get('/death/applications', [RevenueInspectorController::class, 'allDeathApplications'])->name('rinspactor.death.applications');
    Route::post('/application/update-status', [RevenueInspectorController::class, 'updateStatusByRI'])->name('rinspactor.update.application.status');
});

Route::middleware(['auth', 'checkRole:Naib Tahsildar'])->prefix('ntahsildar')->group(function () {
    Route::get('/dashboard', [NaibTahsildarController::class, 'index'])->name('ntahsildar.dashboard');
    Route::get('/ahaituk/dashboard', [NaibTahsildarController::class, 'ahaitukDashboard'])->name('ntahsildar.ahaituk.dashboard');
    Route::get('/death/dashboard', [NaibTahsildarController::class, 'revanueInspectorDashboard'])->name('ntahsildar.death.dashboard');
    Route::get('/death/applications', [NaibTahsildarController::class, 'allDeathApplications'])->name('ntahsildar.death.applications');
    Route::post('/application/update-status', [NaibTahsildarController::class, 'updateStatusByNtahsildar'])->name('ntahsildar.update.application.status');
});


Route::middleware(['auth', 'checkRole:Tahsildar'])->prefix('tahsildar')->group(function () {
    Route::get('/dashboard', [TahsildarController::class, 'index'])->name('tahsildar.dashboard');
    Route::get('/ahaituk/dashboard', [TahsildarController::class, 'ahaitukDashboard'])->name('tahsildar.ahaituk.dashboard');
    Route::get('/death/dashboard', [TahsildarController::class, 'revanueInspectorDashboard'])->name('tahsildar.death.dashboard');
    Route::get('/death/applications', [TahsildarController::class, 'allDeathApplications'])->name('tahsildar.death.applications');
    Route::post('/application/update-status', [TahsildarController::class, 'updateStatusByTahsildar'])->name('tahsildar.update.application.status');
});


Route::middleware(['auth', 'checkRole:Sub Divisional Magistrate'])->prefix('smagistrate')->group(function () {
    Route::get('/dashboard', [SDMcontroller::class, 'index'])->name('smagistrate.dashboard');
    Route::get('/ahaituk/dashboard', [SDMcontroller::class, 'ahaitukDashboard'])->name('smagistrate.ahaituk.dashboard');
    Route::get('/death/dashboard', [SDMcontroller::class, 'revanueInspectorDashboard'])->name('smagistrate.death.dashboard');
    Route::get('/death/applications', [SDMcontroller::class, 'allDeathApplications'])->name('smagistrate.death.applications');
    Route::post('/application/update-status', [SDMcontroller::class, 'updateStatusBysmagistrate'])->name('smagistrate.update.application.status');
});

Route::middleware(['auth', 'checkRole:Additional District Magistrate'])->prefix('dmagistrate')->group(function () {
    Route::get('/dashboard', [ADMcontroller::class, 'index'])->name('dmagistrate.dashboard');
    Route::get('/ahaituk/dashboard', [ADMcontroller::class, 'ahaitukDashboard'])->name('dmagistrate.ahaituk.dashboard');
    Route::get('/death/dashboard', [ADMcontroller::class, 'revanueInspectorDashboard'])->name('dmagistrate.death.dashboard');
    Route::get('/death/applications', [ADMcontroller::class, 'allDeathApplications'])->name('dmagistrate.death.applications');
    Route::post('/application/update-status', [ADMcontroller::class, 'updateStatusBydmagistrate'])->name('dmagistrate.update.application.status');

});
