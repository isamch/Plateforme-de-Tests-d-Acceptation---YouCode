<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuestionController;
use App\Http\Controllers\HomeController;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Auth\VerificationController;


use Illuminate\Support\Str;

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


Route::get('home', function () {
    return view('index');
})->middleware('auth', 'verify-email');



// auth :
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');





// email verification :
Route::middleware('CheckIfVerifyEmail')->group(function () {
    Route::get('email/verifier', [VerificationController::class, 'index'])->name('verification.notice');
    Route::get('email/verifier/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');
    Route::post('email/renvoyer', [VerificationController::class, 'send'])->name('verification.send');
});


// admin :
Route::middleware('auth')->prefix('admin')->group(function () {

    Route::resource('quizzes', QuizController::class);
    Route::resource('questions', QuizController::class);

});
