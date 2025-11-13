<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Pages\Auth\Login as LoginPage;
use App\Livewire\Pages\Auth\Register as RegisterPage;
use App\Livewire\Pages\Admin\Home as HomePage;
use App\Livewire\Pages\User\Home as UserPage;

// public routes
Route::get('/', LoginPage::class);
Route::get('/login', LoginPage::class)->name('login');
Route::get('/register', RegisterPage::class)->name('register');


// User-only routes
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/home', UserPage::class)->name('user.dashboard');
});

// Admin-only routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/home', HomePage::class)->name('admin.dashboard');
});

// Logout
Route::post('/logout', function () {
    Auth::logout();  

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('login');
})->name('logout');