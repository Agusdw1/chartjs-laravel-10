<?php

use App\Events\addedDataEvent;
use App\Http\Controllers\CovidController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chartjs', function () {
    return view('chartjs');
});

// Route::get('/test', function () {
//     Broadcast(new addedDataEvent());
// });

Route::view('real-time-chart', 'realTime-Chart');
Route::get('real-time-chart-data', [CovidController::class, 'realTimeChart'])->name('real-time-chart-data');

Route::get('aa', [CovidController::class,  'addData']);
