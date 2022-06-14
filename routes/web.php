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

/*Route::get('/', function () {
    return view('welcome');
})->name('welcome');*/
Route::get('/', [App\Http\Controllers\HomeController::class, 'welcome'])->name('welcome');

Route::get('/test1', function () {
    return view('auth.test1');
})->name('test');

Route::get('/welcome_default2', function () {
    return view('welcome_default2');
})->name('welcome_default2');

Route::get('/registration', function () {
    return view('/registration/registration');
})->name('registration');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/start', [App\Http\Controllers\HomeController::class, 'start'])->name('start');

Route::post('/mail/sendmail', [App\Http\Controllers\HomeController::class, 'sendmail'])->name('send.mail');


//Route::resource('users', 'UserController')->middleware('auth');
Route::resource('users', App\Http\Controllers\UserController::class);


Route::resource('profiles', App\Http\Controllers\ProfileController::class);

Route::get('/profiles/user/data', [App\Http\Controllers\ProfileController::class, 'edit2'])->name('profiles.user');
Route::post('/profiles/user/data/{id}', [App\Http\Controllers\ProfileController::class, 'update2'])->name('profiles.update2');
Route::get('/profiles/user/verified',[App\Http\Controllers\ProfileController::class,'verified'])->name('profiles.verified');


Route::resource('payments', App\Http\Controllers\PaymentController::class);
Route::get('/payments/user/data', [App\Http\Controllers\PaymentController::class, 'index2'])->name('payments.index2');
Route::get('/payments/user/pay', [App\Http\Controllers\PaymentController::class, 'pay'])->name('payments.pay');
Route::get('/payments/client/data', [App\Http\Controllers\PaymentController::class, 'client_index'])->name('clients.index');
Route::post('/payments/client/data', [App\Http\Controllers\PaymentController::class, 'client_index'])->name('clients.filter');
Route::get('/payments/select/plan',[App\Http\Controllers\PaymentController::class,'select_plan'])->name('payment.plan');
Route::get('/payments/client/pay/{id}',[App\Http\Controllers\PaymentController::class,'plan_detail'])->name('payment.detail');
Route::post('/payments/client/payment',[App\Http\Controllers\PaymentController::class,'client_pay'])->name('client.payment');
Route::get('/payments/client/{id}',[App\Http\Controllers\PaymentController::class,'client_detail'])->name('payment.client.detail');

Route::get('/invite/user/link', [App\Http\Controllers\UserController::class, 'invite'])->name('invite.user');

Route::post('/invite/link/store', [App\Http\Controllers\UserController::class, 'link'])->name('users.link');

Route::post('/send_invitation',[App\Http\Controllers\UserController::class,'send_invitation'])->name('invitation');

Route::get('/suscriptor/{invite_link}', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationSuscriptor'])->name('users.register.susp');
Route::get('/cliente/{invite_link}', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationClient'])->name('users.register.client');

Route::get('/confirmation-email/{token}', [App\Http\Controllers\UserController::class, 'confirmationEmail'])->name('user.confirmationEmail');




Route::resource('notifications', App\Http\Controllers\NotificationController::class);




Route::resource('events', App\Http\Controllers\EventController::class);
Route::get('/rejection-history/{user_id}',[App\Http\Controllers\RejectionHistoryController::class,'rejectionHistory'])->name('rejectionHistory');
Route::get('/rejection-history-show/{id}',[App\Http\Controllers\RejectionHistoryController::class,'show'])->name('rejectionHistory.show');
Route::get('/dashboard',[App\Http\Controllers\EventController::class,'allEvents'])->name('dashboard');
Route::get('/enroll-event/{id}',[App\Http\Controllers\EventController::class,'enroll'])->name('enroll');
Route::post('/upload-file',[App\Http\Controllers\ProfileController::class, 'upload_file'])->name('upload_file');

Route::get('bells/bells',        [App\Http\Controllers\BellsController::class, 'bells'])->name('bells.bells');

Route::get('images/{filename}', function ($filename)
{
    $path = storage_path() . '/images/' . $filename;
    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});

Route::get('images/{filename}', function ($filename)
{
    $path = storage_path() . '/images/' . $filename;
    if(!File::exists($path)) abort(404);

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});


Route::resource('contracts', App\Http\Controllers\ContractController::class);

Route::get('/contract_pdf/{id}',[App\Http\Controllers\ContractController::class,'contract_pdf'])->name('contracts.pdf');

Route::resource('plans', App\Http\Controllers\PlanController::class);


Route::resource('clientPayments', App\Http\Controllers\ClientPaymentController::class);
