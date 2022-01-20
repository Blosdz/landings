<?php

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

Route::get('/welcome_default', function () {
    return view('welcome_default');
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/welcome_default2', function () {
    return view('welcome_default2');
})->name('welcome_default2');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/mail/sendmail', [App\Http\Controllers\HomeController::class, 'sendmail'])->name('send.mail');


//Route::resource('users', 'UserController')->middleware('auth');
Route::resource('users', App\Http\Controllers\UserController::class);


Route::resource('profiles', App\Http\Controllers\ProfileController::class);

Route::get('/profiles/user/data', [App\Http\Controllers\ProfileController::class, 'edit2'])->name('profiles.user');
Route::post('/profiles/user/data/{id}', [App\Http\Controllers\ProfileController::class, 'update2'])->name('profiles.update2');

Route::resource('payments', App\Http\Controllers\PaymentController::class);
Route::get('/payments/user/data', [App\Http\Controllers\PaymentController::class, 'index2'])->name('payments.index2');
Route::get('/payments/user/pay', [App\Http\Controllers\PaymentController::class, 'pay'])->name('payments.pay');

Route::get('/invite/user/link', [App\Http\Controllers\UserController::class, 'invite'])->name('invite.user');

Route::post('/invite/link/store', [App\Http\Controllers\UserController::class, 'link'])->name('users.link');

Route::get('/suscriptor/{invite_link}', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('users.register.susp');


