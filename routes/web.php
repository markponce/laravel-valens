<?php

use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PaintJobController;


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
//     $colors = DB::table('colors')->get();
//     return view('add');
// });

Route::get('/', [PaintJobController::class, 'create']);
Route::post('/', [PaintJobController::class, 'store']);
Route::get('/paint-jobs', [PaintJobController::class, 'index']);
Route::get('/paint-jobs/{id}', [PaintJobController::class, 'update']);




