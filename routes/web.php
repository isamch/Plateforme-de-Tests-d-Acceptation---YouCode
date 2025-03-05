<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\QuizController as AdminQuizController;
use App\Http\Controllers\Admin\QuestionController as AdminQuestionController;

use App\Http\Controllers\Candidat\QuizController as CandidatQuizController;



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




// for test :
Route::get('adm', function () {

    // dd(Auth::user()->getRoleNames());
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

Route::get('email/message', [VerificationController::class, 'ShowMessage'])->name('verification.message');


// admin :
Route::middleware('auth', 'CheckeRole:admin')->prefix('admin')->group(function () {

    // quizzes:
    Route::resource('quizzes', AdminQuizController::class);
    Route::post('/quizzes/toggle-status/{quiz}', [AdminQuizController::class, 'toggleStatus'])->name('quizzes.toggleStatus');
    Route::patch('/quizzes/restore/{id}', [AdminQuizController::class, 'restore'])->name('quizzes.restore');

    // questions:
    Route::resource('questions', AdminQuestionController::class);
});


// candidat pass quiz :
Route::middleware('auth', 'CheckeRole:candidat', 'CheckQuizAttempt')->prefix('candidat')->group(function () {

    Route::get('quiz', [CandidatQuizController::class, 'index'])->name('candidat.quiz.index');
    Route::get('quiz/take', [CandidatQuizController::class, 'start'])->name('candidat.quiz.start');
    Route::post('quiz/submit', [CandidatQuizController::class, 'submit'])->name('candidat.quiz.submit');

});
