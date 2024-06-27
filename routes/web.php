<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

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

// Route::get('/users', function () {
//     $path = storage_path('users.json');

//     // Check if the file exists
//     if (!File::exists($path)) {
//         abort(404, 'File not found');
//     }

//     // Get the file content
//     $file = File::get($path);

//     // Decode the JSON data
//     $data = json_decode($file, true);

//     // Return JSON response
//     return response()->json($data);
// });

Route::get('/users', [UserController::class, 'userdetails'])->name('userdetails');
Route::get('/fetchusers', [UserController::class, 'fetchUsers'])->name('fetchuser');
