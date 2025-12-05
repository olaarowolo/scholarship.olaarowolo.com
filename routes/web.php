<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\ApplicationController;
// use App\Http\Controllers\NewsletterController;

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

Route::get('/apply-form', function () {
    return view('apply-form');
})->name('apply-form');

Route::get('/apply-utme-jamb-form', function () {
    return view('apply-utme-jamb-form');
})->name('apply-utme-jamb-form');

Route::post('/apply-form', [ApplicationController::class, 'submit'])->name('apply-form.submit');

// Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

Route::get('/resources', function () {
    return view('resources');
})->name('resources');

Route::get('/testimonials', function () {
    return view('testimonials');
})->name('testimonials');

require __DIR__.'/auth.php';

// Admin Routes (Commented out until AdminController is created)
/*
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/applications', [App\Http\Controllers\AdminController::class, 'applications'])->name('applications');
    Route::get('/applications/{id}', [App\Http\Controllers\AdminController::class, 'showApplication'])->name('applications.show');
    Route::put('/applications/{id}/status', [App\Http\Controllers\AdminController::class, 'updateApplicationStatus'])->name('applications.update-status');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::put('/users/{id}/role', [App\Http\Controllers\AdminController::class, 'updateUserRole'])->name('users.update-role');
    Route::get('/analytics', [App\Http\Controllers\AdminController::class, 'analytics'])->name('analytics');
});
*/
