<?php

use App\Http\Controllers\CostController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\TenantserviceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;


Route::get('', function () {
    return view('login');
})->name('login');

Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});

Route::get('/performance-test', function () {
    // Simulate some processing
    sleep(2); // Sleep for 2 seconds
    return 'Performance test completed!';
});



Route::post('/user-login', [LoginController::class, 'userLogin'])->name('userLogin');
Route::get('/reset-password', [LoginController::class, 'resetPassord'])->name('resetPassord');
Route::post('/send-otp', [LoginController::class, 'sendOTP'])->name('sendOTP');

Route::get('/invoices/{tenant}', [InvoiceController::class, 'show'])->name('invoices.show');
Route::get('/tenant/{tenant}/invoice/pdf', [InvoiceController::class, 'downloadPdf'])->name('tenant.invoice.pdf');


Route::middleware(['auth', 'preventBackAfterLogout'])->group(function () {
    // Protected routes
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');


    // For assigning roles to users
    Route::post('/assign-role', [RoleController::class, 'assignRole'])->name('assign.role');
    Route::post('/store-user', [UserController::class, 'store'])->name('store.user');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/user-create', [UserController::class, 'create'])->name('users.create');
    Route::get('/user-edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/user-destroy/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::put('/user-update/{id}', [UserController::class, 'update'])->name('users.update');

    Route::get('/user-logout', [LoginController::class, 'userLogout'])->name('userLogout');
    Route::get('/user-profile', [UserController::class, 'viewProfile'])->name('viewProfie');
    Route::post('updateProfile', [UserController::class, 'updateProfile'])->name('updateProfile');

    Route::get('/clear-all', [UserController::class, 'clearAll'])->name('clearAll');


    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles-create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles-store', [UserController::class, 'store'])->name('roles.store');
    Route::get('/roles-edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::get('/roles-destroy/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
    Route::put('/roles-update/{id}', [RoleController::class, 'update'])->name('roles.update');

    Route::get('/permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::get('/permissions-create', [PermissionController::class, 'create'])->name('permissions.create');
    Route::post('/permissions-store', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('/permissions-edit/{id}', [PermissionController::class, 'edit'])->name('permissions.edit');
    Route::post('/permissions-destroy/{id}', [PermissionController::class, 'destroy'])->name('permissions.destroy');
    Route::put('/permissions-update/{id}', [PermissionController::class, 'update'])->name('permissions.update');

    Route::get('/logo-view', [UserController::class, 'logoChangeView'])->name('logoChangeView');
    Route::post('/logo-update', [UserController::class, 'logoUpdate'])->name('updateLogo');
    Route::get('/color-view', [UserController::class, 'colorChangeView'])->name('colorChangeView');
    Route::post('/color-update', [UserController::class, 'updateColors'])->name('updateColors');

    Route::prefix('services')->name('services.')->group(function () {
        Route::resource('/', ServiceController::class)->parameters(['' => 'service']);
    });

    Route::prefix('positions')->name('positions.')->group(function () {
        Route::resource('/', PositionController::class)->parameters(['' => 'position']);
    });

    Route::prefix('properties')->name('properties.')->group(function () {
        Route::resource('/', PropertyController::class)->parameters(['' => 'property']);
    });

    Route::prefix('tenants')->name('tenants.')->group(function () {
        Route::resource('/', TenantController::class)->parameters(['' => 'tenant']);
    });

    Route::get('/tenants/services/{id?}', [TenantserviceController::class, 'services'])->name('tenants.services');

    Route::prefix('tenantServices')->name('tenantServices.')->group(function () {
        Route::resource('/', TenantserviceController::class)->parameters(['' => 'tenantService']);
    });

    Route::get('/invoice', [TenantserviceController::class, 'invoice'])->name('sendInvoice');
    Route::get('/invoice/change/{id?}', [InvoiceController::class, 'invoiceChange'])->name('invoice.change');
    Route::get('/invoice/send/{id?}', [InvoiceController::class, 'sendInvoice'])->name('invoice.send');


    Route::get('/month/change/{id?}', [TenantController::class, 'monthChange'])->name('month.change');


    Route::prefix('costs')->name('costs.')->group(function () {
        Route::resource('/', CostController::class)->parameters(['' => 'cost']);
    });

    Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('/costs', [ReportController::class, 'costs'])->name('costs');
            Route::post('/costs/filter', [ReportController::class, 'filterCosts'])->name('filterCosts');
            Route::get('/costs/reset', [ReportController::class, 'resetCosts'])->name('resetCosts');


    });

});
