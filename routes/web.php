<?php

use App\Http\Controllers\UsuarioController;
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
    return view('principal');
});

Route::resource('usuarios', UsuarioController::class);

Route::get('/login', [UsuarioController::class, 'showLoginForm'])->name('login');

Route::post('/login', [UsuarioController::class, 'login']);

Route::get('/logout', [UsuarioController::class, 'logout']);


Route::middleware(['auth'])->group(function () {
    Route::get('/principal', function () {
        $user = Auth::user();

        return view('principal', compact('user'));
    });

});








