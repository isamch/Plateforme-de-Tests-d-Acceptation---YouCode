<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\QuizController;


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
})->middleware('auth');




// auth :
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.post');
});
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth', 'hasRole:admin'])->prefix('admin')->group(function () {

    Route::resource('quizzes', QuizController::class);

    // ->names([
    //     'index' => 'quizzes.list',
    //     'create' => 'quizzes.new',
    //     'store' => 'quizzes.save',
    //     'show' => 'quizzes.view',
    //     'edit' => 'quizzes.modify',
    //     'update' => 'quizzes.update',
    //     'destroy' => 'quizzes.remove',

    // ]);
    Route::resource('questions', QuizController::class);

});
