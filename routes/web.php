<?php

namespace App\Http\Controllers;

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

Route::get('/', [PublicController::class, 'homepage']);
Route::get('about', [PublicController::class, 'about']);
Route::get('portfolio', [PublicController::class, 'portfolio']);
Route::get('process', [PublicController::class, 'process']);
Route::get('contact', [PublicController::class, 'contact']);
