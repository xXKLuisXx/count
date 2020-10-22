<?php

use App\Http\Controllers\ConfigurationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CounterController;
use App\Models\Configuration;

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

Route::get('/config', function () {
    $conf = Configuration::where('id',1)->first();
    return view('config')->with(['conf' => $conf]);
});

Route::resource('counter', CounterController::class);
Route::post('contadores', [CounterController::class, 'contadores']);
Route::post('saveData', [ConfigurationController::class, 'saveData']);
Route::post('newDia', [ConfigurationController::class, 'newDia']);
