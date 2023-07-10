<?php

use App\Models\seesions;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/test/{lang}', function($lang) {
    if (! in_array($lang, ['vi', 'en'])) {
        dd(1);
    } 
    session()->put('locate', $lang);
    return view('test');
})->name('lang')->middleware('lang');

Route::get('test', function() {
    return GUARD_DRIVER;
});

