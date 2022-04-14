<?php

use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MontecarloImport;

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

Route::get('/home', [App\Http\Controllers\MontecarloController::class, 'home'])->name('home');
Route::get('/random_number', [App\Http\Controllers\MontecarloController::class, 'random_number'])->name('random');
Route::get('/interval', [App\Http\Controllers\MontecarloController::class, 'store'])->name('interval');
Route::get('/proses', [App\Http\Controllers\MontecarloController::class, 'index'])->name('proses');
Route::get('/delete', [App\Http\Controllers\MontecarloController::class, 'destroy'])->name('delete');

Route::post('import', function () {
    Excel::import(new MontecarloImport, request()->file('file'));
    return redirect()->back()->with('success', 'Data Imported Successfully');
});
