<?php
use Illuminate\Support\Facades\Route;
Route::get('/', function () {
    return view('index');
});
Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [loginController::class, 'authenticate']);
Route::get('/signup', function () {
    return view('signup');
});
Route::middleware('auth')->group(function () {
    Route::get('/resume/form/{id?}', [resumeController::class, 'showForm']);
    Route::post('/resume/save', [resumeController::class, 'save']);
});
?>