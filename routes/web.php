<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandLordController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\TenantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/login',[AuthController::class, 'login'])->name('login');

Route::middleware(['auth'])->group(function (){
    Route::middleware(['role:Admin'])->group(function (){
        Route::get('/admin', [AdminController::class, 'dashboard'])->name('adminDashboard');
    });

    Route::middleware(['role:LandLord'])->group(function (){
        Route::get('/landlord', [LandLordController::class, 'dashboard'])->name('landlord');

    });

    Route::middleware(['role:Tenant'])-> group(function (){
        Route::get('/tenant', [TenantController::class, 'dashboard'])->name('tenant');
    });

    Route::middleware(['role:Admin|Landlord'])->group(function (){
        Route::resource('property', PropertyController::class);
    });
});



