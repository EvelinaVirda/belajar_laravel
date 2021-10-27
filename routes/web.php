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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/list_village', [villageController::class, 'listVillage'])->name('list_village');
Route::get('/hello_world', 'App\Http\Controllers\TesController@hello_world')->name('hello_world');

Route::get('/list_village', 'App\Http\Controllers\villageController@listVillage')->name('hello_world');

// Route::get('/hello_world', [TesController::class, 'hello_world']);

// Route::get('/hello_world', [TesController::class, 'hello_world'])->name('hello_world');
