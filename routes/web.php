<?php

use App\Http\Controllers\Dashboard\Home;
use App\Http\Controllers\Upload\FileUpload;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Dashboard/Home
Route::get('/dashboard', [Home::class, 'index'])->name('home');

// Upload
Route::get('/upload', [FileUpload::class, 'index'])->name('upload');
Route::post('/postUpload', [FileUpload::class, 'store'])->name('UploadCSV.store');
Route::get('/upload-history', [FileUpload::class, 'uploadFileHistory'])->name('upload-history');
