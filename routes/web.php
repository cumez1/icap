<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadosController;

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

Route::middleware(['auth:sanctum', 'verified','checkstatus'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified','checkstatus'])->group(function () {
    Route::get('/empleados', [EmpleadosController::class, 'index'])->name('empleados.index');
    Route::get('/empleados/crear', [EmpleadosController::class, 'crear'])->name('empleados.crear');
    Route::post('/empleados/save', [EmpleadosController::class, 'save'])->name('empleados.save');

});