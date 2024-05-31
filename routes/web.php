<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\userController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\skillController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\greatingController;
use App\Http\Controllers\authguestController;
use App\Http\Controllers\contactusController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\experienceController;
use Spatie\Sitemap\SitemapGenerator;

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

Route::get('/', [homeController::class, "index"]);
Route::get('/home/index', [homeController::class, "home"]);
Route::get('/profile', [homeController::class, "index"]);


Route::get('/auth', [authController::class, "index"])->name('login')->middleware('guest');
Route::get('/auth/redirect', [authController::class, "redirect"])->middleware('guest');
Route::get('/auth/callback', [authController::class, "callback"])->middleware('guest');
Route::get('/auth/logout', [authController::class, "logout"]);




Route::prefix('dashboard')->middleware('auth')->group(
    function(){
        Route::get('/', Function(){
            return view('dashboard.layout');
        });
        Route::resource('greating', greatingController::class);
        Route::resource('profiles', profileController::class);
        Route::resource('skill', skillController::class);
        Route::resource('experience', experienceController::class);
        Route::resource('contactus', contactusController::class);
        Route::resource('user', userController::class);
    }
);

$path = public_path('sitemap.xml');
SitemapGenerator::create('https://example.com')->writeToFile($path);