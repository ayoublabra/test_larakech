<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\VerificationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('layouts.master');
});
Route::resource('organisations',OrganisationController::class);
Route::get('getAllContacts', [ContactController::class, 'getAllContacts'])->name('getAllContacts');
Route::get('getAllOrganisations', [OrganisationController::class, 'getAllOrganisations'])->name('getAllOrganisations');
Route::post('verification', [VerificationController::class, 'verification'])->name('verification');
// Route::post('verificationContact', [VerificationController::class, 'verificationContact'])->name('verificationContact');

Route::resource('contacts',ContactController::class);

