<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Admin;

use App\Http\Controllers\AuthLogout;
use App\Http\Middleware\SuperAdmin;
use App\Http\Middleware\User;
use Illuminate\Support\Facades\Auth;
Route::view('/', 'welcome');




Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
      if(Auth::user()->is_admin == 1){
    return redirect()->route('admindashboard');
        } else {
    return redirect()->route('userdashboard');
        }


    })->name('dashboard');
});


Route::post('/logout', [AuthLogout::class, 'logout'])->name('logouts');

Route::prefix('admin')->middleware(['auth', admin::class])->group(function () {
    Route::get('/Admindashboard', function () {
        return view('admin.index');
    })->name('admindashboard');


    Route::get('/admin.services', function () {
        return view('admin.services');
    })->name('admin.services');

      Route::get('/admin.bookings', function () {
        return view('admin.bookings');
    })->name('admin.bookings');

    Route::get('/admin.approved', function () {
        return view('admin.approved');
    })->name('admin.approved');
});





Route::prefix('User')->middleware(['auth', User::class])->group(function () {
    Route::get('/userdashboard', function () {
        return view('user.index');
    })->name('userdashboard');

        Route::get('/user.packages', function () {
        return view('user.packages');
    })->name('user.packages');

           Route::get('/user.mybook', function () {
        return view('user.mybook');
    })->name('user.mybook');

});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
