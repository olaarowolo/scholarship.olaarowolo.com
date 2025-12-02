<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TermsController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/how-it-works', function () {
    return view('how-it-works');
})->name('how-it-works');

Route::get('/apply', function () {
    return view('apply');
})->name('apply');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

Route::get('/our-story', function () {
    return view('our-story');
})->name('our-story');

Route::get('/application-steps', function () {
    return view('application-steps');
})->name('application-steps');

Route::get('/view-impact', function () {
    return view('view-impact');
})->name('view-impact');

Route::get('/scholar-login', function () {
    return view('scholar-login');
})->name('scholar-login');

Route::get('/sponsor-information', function () {
    return view('sponsor-information');
})->name('sponsor-information');

Route::get('/terms', function () {
    return view('terms');
})->name('terms');

// Route for terms acceptance page
Route::get('/terms-acceptance', [TermsController::class, 'showAcceptancePage'])->name('terms.acceptance');
Route::post('/terms-acceptance', [TermsController::class, 'acceptTerms'])->name('terms.accept');

