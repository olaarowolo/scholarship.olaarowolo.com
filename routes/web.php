<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\ScholarAuthController;
use App\Http\Controllers\TwoFactorController;
use App\Http\Controllers\ConsentController;
// use App\Http\Controllers\NewsletterController;

// Consent routes (outside visitor tracking to avoid circular dependency)
Route::post('/consent', [ConsentController::class, 'store'])->name('consent.store');
Route::get('/consent/check', [ConsentController::class, 'check'])->name('consent.check');

// Test consent popup (remove in production)
Route::get('/test-consent', function () {
    return view('test-consent');
})->name('test.consent');

Route::middleware(['track.visitors'])->group(function () {
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
    Route::get('/contact/send', function () {
        return redirect()->route('contact');
    });

    Route::get('/press', function () {
        return view('press');
    })->name('press');

    Route::get('/our-story', function () {
        return view('our-story');
    })->name('our-story');

    Route::get('/application-steps', function () {
        return view('application-steps');
    })->name('application-steps');

    Route::get('/view-impact', function () {
        return view('view-impact');
    })->name('view-impact');

    Route::get('/scholar-login', [ScholarAuthController::class, 'create'])->name('scholar-login');
    Route::post('/scholar-login', [ScholarAuthController::class, 'store'])->name('scholar.login');

    Route::get('/scholar-register', [ScholarAuthController::class, 'createRegistration'])->name('scholar-register');
    Route::post('/scholar-register', [ScholarAuthController::class, 'storeRegistration'])->name('scholar.register');

    Route::get('/sponsor-information', function () {
        return view('sponsor-information');
    })->name('sponsor-information');

    Route::get('/terms', function () {
        return view('terms');
    })->name('terms');

    Route::get('/privacy', function () {
        return view('privacy');
    })->name('privacy');

    // Route for terms acceptance page
    Route::get('/terms-acceptance', [TermsController::class, 'showAcceptancePage'])->name('terms.acceptance');
    Route::post('/terms-acceptance', [TermsController::class, 'acceptTerms'])->name('terms.accept');

    // API endpoint for form settings
    Route::get('/api/form-settings/{formName}', [ApplicationController::class, 'getFormSettings'])->name('api.form-settings');

    Route::get('/resources', function () {
        return view('resources');
    })->name('resources');

    Route::get('/testimonials', function () {
        return view('testimonials');
    })->name('testimonials');
});

Route::get('/apply-form', function () {
    return view('apply-form');
})->middleware(['auth', 'two-factor', 'role:applicant,user', 'form.open:application_form'])->name('apply-form');

Route::get('/apply-utme-jamb-form', function () {
    return view('apply-utme-jamb-form');
})->middleware(['auth', 'two-factor', 'role:applicant,user', 'form.open:application_form'])->name('apply-utme-jamb-form');

Route::post('/apply-form', [ApplicationController::class, 'submit'])->middleware(['auth', 'two-factor', 'role:applicant,user', 'form.open:application_form'])->name('apply-form.submit');

// Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

Route::get('/dashboard', function () {
    $user = Auth::user();

    // Redirect scholars to their specific dashboard
    if ($user->role === 'scholar') {
        return view('scholar-dashboard');
    }

    // Default dashboard for other users
    return view('dashboard');
})->middleware(['auth', 'two-factor'])->name('dashboard');

Route::get('/resources', function () {
    return view('resources');
})->name('resources');

Route::get('/testimonials', function () {
    return view('testimonials');
})->name('testimonials');

// Two-Factor Authentication Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/two-factor/verify', [TwoFactorController::class, 'show'])->name('two-factor.verify');
    Route::post('/two-factor/verify', [TwoFactorController::class, 'verify'])->name('two-factor.verify.post');
    Route::post('/two-factor/resend', [TwoFactorController::class, 'resend'])->name('two-factor.resend');
    Route::get('/two-factor/settings', [TwoFactorController::class, 'settings'])->name('two-factor.settings');
    Route::post('/two-factor/toggle', [TwoFactorController::class, 'toggle'])->name('two-factor.toggle');
});

require __DIR__.'/auth.php';

// Admin Routes
Route::middleware(['auth', 'two-factor', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/applications', [App\Http\Controllers\AdminController::class, 'applications'])->name('applications');
    Route::get('/applications/{id}', [App\Http\Controllers\AdminController::class, 'showApplication'])->name('applications.show');
    Route::put('/applications/{id}/status', [App\Http\Controllers\AdminController::class, 'updateApplicationStatus'])->name('applications.update-status');
    Route::delete('/applications/{id}', [App\Http\Controllers\AdminController::class, 'deleteApplication'])->name('applications.delete');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::put('/users/{id}/role', [App\Http\Controllers\AdminController::class, 'updateUserRole'])->name('users.update-role');
    Route::get('/analytics', [App\Http\Controllers\AdminController::class, 'analytics'])->name('analytics');

    // Export Routes
    Route::get('/export', [App\Http\Controllers\AdminController::class, 'export'])->name('export');
    Route::post('/export/applications', [App\Http\Controllers\AdminController::class, 'exportApplications'])->name('export.applications');
    Route::post('/export/users', [App\Http\Controllers\AdminController::class, 'exportUsers'])->name('export.users');
    Route::get('/export/summary', [App\Http\Controllers\AdminController::class, 'exportSummaryReport'])->name('export.summary');

    // Form Settings Routes
    Route::get('/form-settings', [App\Http\Controllers\AdminController::class, 'formSettings'])->name('form-settings');
    Route::put('/form-settings/{id}', [App\Http\Controllers\AdminController::class, 'updateFormSetting'])->name('form-settings.update');
});

// Scholar Routes
Route::middleware(['auth', 'two-factor', 'role:scholar'])->prefix('scholar')->name('scholar.')->group(function () {
    Route::get('/requests/create', [App\Http\Controllers\ScholarController::class, 'createRequest'])->name('requests.create');
    Route::get('/academic-standing', [App\Http\Controllers\ScholarController::class, 'academicStanding'])->name('academic-standing');
    Route::get('/challenges', [App\Http\Controllers\ScholarController::class, 'challenges'])->name('challenges');
    Route::get('/mentorship', [App\Http\Controllers\ScholarController::class, 'mentorship'])->name('mentorship');
    Route::get('/advice', [App\Http\Controllers\ScholarController::class, 'advice'])->name('advice');
});
