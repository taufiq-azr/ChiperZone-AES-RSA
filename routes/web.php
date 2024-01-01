<?php

use App\Http\Controllers\CryptoControllers;
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
    return view('home');
});

Route::get('/aes', function () {
    return view('aes');
});
Route::get('/rsa_en', function () {
    return view('rsa_en');
});
Route::get('/rsa_de', function () {
    return view('rsa_de');
});
Route::post('/process', [CryptoControllers::class, 'process'])->name('crypto.process');
