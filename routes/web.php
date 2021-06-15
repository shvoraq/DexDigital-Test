<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [\App\Http\Controllers\HomeController::class,'index'])->name('home');

Route::middleware('CheckRequestRequiredParams')->group(function (){
    Route::get('/validation-error',function (\Illuminate\Http\Request $request) {
        return view('pages.main', compact('request'));
    })->name('validation-error');

    Route::get('/sorry',function (\Illuminate\Http\Request $request) {
        return view('pages.main', compact('request'));
    })->name('sorry');


    Route::get('/thank-you',function (\Illuminate\Http\Request $request) {
        return view('pages.main', compact('request'));
    })->name('thank-you');
});
