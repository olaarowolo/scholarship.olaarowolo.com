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

// Debug consent popup
Route::get('/popup-debug', function () {
    return view('popup-debug');
})->name('popup.debug');

Route::middleware(['track.visitors'])->group(function () {
    Route::get('/', function () {
        return view('home');
    })->name('home');
    // Message tray route for logged-in users
    Route::middleware(['auth'])->get('/messages/tray', [MessageController::class, 'tray'])->name('messages.tray');

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
    if ($user->role === 'scholar') {
        return app(\App\Http\Controllers\ScholarController::class)->dashboard();
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

    // Scholar Submissions Routes
    Route::get('/scholar-requests', [App\Http\Controllers\AdminController::class, 'scholarRequests'])->name('scholar-requests');
    Route::get('/scholar-requests/{id}', [App\Http\Controllers\AdminController::class, 'showScholarRequest'])->name('scholar-requests.show');
    Route::put('/scholar-requests/{id}/status', [App\Http\Controllers\AdminController::class, 'updateScholarRequestStatus'])->name('scholar-requests.update-status');

    Route::get('/academic-reports', [App\Http\Controllers\AdminController::class, 'academicReports'])->name('academic-reports');
    Route::get('/academic-reports/{id}', [App\Http\Controllers\AdminController::class, 'showAcademicReport'])->name('academic-reports.show');
    Route::put('/academic-reports/{id}/status', [App\Http\Controllers\AdminController::class, 'updateAcademicReportStatus'])->name('academic-reports.update-status');

    Route::get('/challenge-reports', [App\Http\Controllers\AdminController::class, 'challengeReports'])->name('challenge-reports');
    Route::get('/challenge-reports/{id}', [App\Http\Controllers\AdminController::class, 'showChallengeReport'])->name('challenge-reports.show');
    Route::put('/challenge-reports/{id}/status', [App\Http\Controllers\AdminController::class, 'updateChallengeReportStatus'])->name('challenge-reports.update-status');

    Route::get('/mentorship-bookings', [App\Http\Controllers\AdminController::class, 'mentorshipBookings'])->name('mentorship-bookings');
    Route::get('/mentorship-bookings/{id}', [App\Http\Controllers\AdminController::class, 'showMentorshipBooking'])->name('mentorship-bookings.show');
    Route::put('/mentorship-bookings/{id}/status', [App\Http\Controllers\AdminController::class, 'updateMentorshipBookingStatus'])->name('mentorship-bookings.update-status');

    Route::get('/advice-requests', [App\Http\Controllers\AdminController::class, 'adviceRequests'])->name('advice-requests');
    Route::get('/advice-requests/{id}', [App\Http\Controllers\AdminController::class, 'showAdviceRequest'])->name('advice-requests.show');
    Route::put('/advice-requests/{id}/status', [App\Http\Controllers\AdminController::class, 'updateAdviceRequestStatus'])->name('advice-requests.update-status');
});

// Scholar Routes
Route::middleware(['auth', 'two-factor', 'role:scholar'])->prefix('scholar')->name('scholar.')->group(function () {
    Route::get('/requests/create', [App\Http\Controllers\ScholarController::class, 'createRequest'])->name('requests.create');
    Route::post('/requests/create', [App\Http\Controllers\ScholarController::class, 'storeRequest'])->name('requests.store.create');
    Route::post('/requests', [App\Http\Controllers\ScholarController::class, 'storeRequest'])->name('requests.store');
    Route::get('/requests/my-requests', [App\Http\Controllers\ScholarController::class, 'myRequests'])->name('my-requests');

    Route::get('/academic-standing', [App\Http\Controllers\ScholarController::class, 'academicStanding'])->name('academic-standing');
    Route::post('/academic-reports', [App\Http\Controllers\ScholarController::class, 'storeAcademicReport'])->name('academic-reports.store');
    Route::get('/academic-reports/my-reports', [App\Http\Controllers\ScholarController::class, 'myAcademicReports'])->name('my-academic-reports');

    Route::get('/challenges', [App\Http\Controllers\ScholarController::class, 'challenges'])->name('challenges');
    Route::post('/challenges', [App\Http\Controllers\ScholarController::class, 'storeChallenge'])->name('challenges.store');
    Route::get('/challenges/my-challenges', [App\Http\Controllers\ScholarController::class, 'myChallenges'])->name('my-challenges');

    Route::get('/mentorship', [App\Http\Controllers\ScholarController::class, 'mentorship'])->name('mentorship');
    Route::post('/mentorship', [App\Http\Controllers\ScholarController::class, 'storeMentorshipBooking'])->name('mentorship.store');
    Route::get('/mentorship/my-bookings', [App\Http\Controllers\ScholarController::class, 'myMentorshipBookings'])->name('my-mentorship-bookings');

    Route::get('/advice', [App\Http\Controllers\ScholarController::class, 'advice'])->name('advice');
    Route::post('/advice', [App\Http\Controllers\ScholarController::class, 'storeAdviceRequest'])->name('advice.store');
    Route::get('/advice/my-requests', [App\Http\Controllers\ScholarController::class, 'myAdviceRequests'])->name('my-advice-requests');
});
