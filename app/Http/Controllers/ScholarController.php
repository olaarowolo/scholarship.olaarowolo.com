<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\ScholarRequest;
use App\Models\AcademicReport;
use App\Models\ChallengeReport;
use App\Models\MentorshipBooking;
use App\Models\AdviceRequest;
use App\Mail\ScholarRequestSubmitted;
use App\Mail\AcademicReportSubmitted;
use App\Mail\ChallengeReportSubmitted;
use App\Mail\MentorshipBookingSubmitted;
use App\Mail\AdviceRequestSubmitted;
use App\Mail\AdminScholarRequestNotification;
use App\Mail\AdminAcademicReportNotification;
use App\Mail\AdminChallengeReportNotification;
use App\Mail\AdminMentorshipBookingNotification;
use App\Mail\AdminAdviceRequestNotification;

class ScholarController extends Controller
{
    /**
     * Display the scholar dashboard.
     */
    public function dashboard(): View
    {
        $user = Auth::user();

        // Get all submissions for the current scholar
        $requests = ScholarRequest::where('user_id', $user->id)->latest()->take(5)->get();
        $academicReports = AcademicReport::where('user_id', $user->id)->latest()->take(5)->get();
        $challengeReports = ChallengeReport::where('user_id', $user->id)->latest()->take(5)->get();
        $mentorshipBookings = MentorshipBooking::where('user_id', $user->id)->latest()->take(5)->get();
        $adviceRequests = AdviceRequest::where('user_id', $user->id)->latest()->take(5)->get();

        return view('scholar-dashboard', compact(
            'requests',
            'academicReports',
            'challengeReports',
            'mentorshipBookings',
            'adviceRequests'
        ));
    }

    /**
     * Display the form to create a new request.
     */
    public function createRequest(): View
    {
        return view('scholar.requests.create');
    }

    /**
     * Store a new scholar request.
     */
    public function storeRequest(Request $request)
    {
        $validated = $request->validate([
            'request_type' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        $scholarRequest = ScholarRequest::create($validated);

        // Send email to scholar
        Mail::to(Auth::user()->email)->send(new ScholarRequestSubmitted($scholarRequest));
        // Log message to tray for scholar
        \App\Models\Message::create([
            'sender_id' => 1, // system/admin
            'receiver_id' => Auth::id(),
            'content' => 'Your scholar request has been submitted.',
        ]);

        // Send email to admin
        $adminEmail = config('mail.admin.address', 'admin@olaarowolo.com');
        Mail::to($adminEmail)->send(new AdminScholarRequestNotification($scholarRequest));
        // Log message to tray for admin
        $adminUser = \App\Models\User::where('email', $adminEmail)->first();
        if ($adminUser) {
            \App\Models\Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $adminUser->id,
                'content' => 'A new scholar request has been submitted.',
            ]);
        }

        return redirect()->route('dashboard')
            ->with('success', 'Your request has been submitted successfully! We will get back to you soon.');
    }

    /**
     * Display the academic standing form.
     */
    public function academicStanding(): View
    {
        return view('scholar.academic-standing');
    }

    /**
     * Store academic report.
     */
    public function storeAcademicReport(Request $request)
    {
        $validated = $request->validate([
            'semester' => 'required|string|max:255',
            'level' => 'required|string|max:50',
            'cgpa' => 'nullable|numeric|between:0,5.00',
            'gpa' => 'nullable|numeric|between:0,5.00',
            'courses_and_grades' => 'nullable|string',
            'total_credits' => 'nullable|integer|min:0',
            'remarks' => 'nullable|string',
            'transcript_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'submitted';

        // Handle file upload if present
        if ($request->hasFile('transcript_file')) {
            $path = $request->file('transcript_file')->store('transcripts', 'public');
            $validated['transcript_file'] = $path;
        }

        $report = AcademicReport::create($validated);

        // Send email to scholar
        Mail::to(Auth::user()->email)->send(new AcademicReportSubmitted($report));
        \App\Models\Message::create([
            'sender_id' => 1,
            'receiver_id' => Auth::id(),
            'content' => 'Your academic report has been submitted.',
        ]);

        // Send email to admin
        $adminEmail = config('mail.admin.address', 'admin@olaarowolo.com');
        Mail::to($adminEmail)->send(new AdminAcademicReportNotification($report));
        $adminUser = \App\Models\User::where('email', $adminEmail)->first();
        if ($adminUser) {
            \App\Models\Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $adminUser->id,
                'content' => 'A new academic report has been submitted.',
            ]);
        }

        return redirect()->route('scholar.academic-standing')
            ->with('success', 'Your academic report has been submitted successfully!');
    }

    /**
     * Display the challenges documentation form.
     */
    public function challenges(): View
    {
        return view('scholar.challenges');
    }

    /**
     * Store challenge report.
     */
    public function storeChallenge(Request $request)
    {
        $validated = $request->validate([
            'challenge_type' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'severity' => 'required|in:low,medium,high,critical',
            'support_needed' => 'nullable|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'submitted';

        $challengeReport = ChallengeReport::create($validated);

        // Send email to scholar
        Mail::to(Auth::user()->email)->send(new ChallengeReportSubmitted($challengeReport));
        \App\Models\Message::create([
            'sender_id' => 1,
            'receiver_id' => Auth::id(),
            'content' => 'Your challenge report has been submitted.',
        ]);

        // Send email to admin
        $adminEmail = config('mail.admin.address', 'admin@olaarowolo.com');
        Mail::to($adminEmail)->send(new AdminChallengeReportNotification($challengeReport));
        $adminUser = \App\Models\User::where('email', $adminEmail)->first();
        if ($adminUser) {
            \App\Models\Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $adminUser->id,
                'content' => 'A new challenge report has been submitted.',
            ]);
        }

        return redirect()->route('scholar.challenges')
            ->with('success', 'Your challenge report has been submitted. We will reach out to provide support.');
    }

    /**
     * Display the mentorship booking page.
     */
    public function mentorship(): View
    {
        return view('scholar.mentorship');
    }

    /**
     * Store mentorship booking.
     */
    public function storeMentorshipBooking(Request $request)
    {
        $validated = $request->validate([
            'mentor_preference' => 'nullable|string|max:255',
            'preferred_date' => 'required|date|after:today',
            'preferred_time' => 'required|string|max:50',
            'session_type' => 'required|string|max:100',
            'topic' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        $booking = MentorshipBooking::create($validated);

        // Send email to scholar
        Mail::to(Auth::user()->email)->send(new MentorshipBookingSubmitted($booking));
        \App\Models\Message::create([
            'sender_id' => 1,
            'receiver_id' => Auth::id(),
            'content' => 'Your mentorship session has been booked.',
        ]);

        // Send email to admin
        $adminEmail = config('mail.admin.address', 'admin@olaarowolo.com');
        Mail::to($adminEmail)->send(new AdminMentorshipBookingNotification($booking));
        $adminUser = \App\Models\User::where('email', $adminEmail)->first();
        if ($adminUser) {
            \App\Models\Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $adminUser->id,
                'content' => 'A new mentorship session has been booked.',
            ]);
        }

        return redirect()->route('scholar.mentorship')
            ->with('success', 'Your mentorship session has been booked! You will receive a confirmation email shortly.');
    }

    /**
     * Display the academic advice request form.
     */
    public function advice(): View
    {
        return view('scholar.advice');
    }

    /**
     * Store advice request.
     */
    public function storeAdviceRequest(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'question' => 'required|string',
            'category' => 'required|string|max:255',
            'urgency' => 'required|in:low,medium,high',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'pending';

        $adviceRequest = AdviceRequest::create($validated);

        // Send email to scholar
        Mail::to(Auth::user()->email)->send(new AdviceRequestSubmitted($adviceRequest));
        \App\Models\Message::create([
            'sender_id' => 1,
            'receiver_id' => Auth::id(),
            'content' => 'Your academic advice request has been submitted.',
        ]);

        // Send email to admin
        $adminEmail = config('mail.admin.address', 'admin@olaarowolo.com');
        Mail::to($adminEmail)->send(new AdminAdviceRequestNotification($adviceRequest));
        $adminUser = \App\Models\User::where('email', $adminEmail)->first();
        if ($adminUser) {
            \App\Models\Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $adminUser->id,
                'content' => 'A new academic advice request has been submitted.',
            ]);
        }

        return redirect()->route('scholar.advice')
            ->with('success', 'Your academic advice request has been submitted. We will respond soon!');
    }

    /**
     * Display all scholar requests.
     */
    public function myRequests()
    {
        $requests = ScholarRequest::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('scholar.requests.my-requests', compact('requests'));
    }

    /**
     * Display all academic reports.
     */
    public function myAcademicReports()
    {
        $reports = AcademicReport::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('scholar.my-academic-reports', compact('reports'));
    }

    /**
     * Display all challenge reports.
     */
    public function myChallenges()
    {
        $challenges = ChallengeReport::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('scholar.my-challenges', compact('challenges'));
    }

    /**
     * Display all mentorship bookings.
     */
    public function myMentorshipBookings()
    {
        $bookings = MentorshipBooking::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('scholar.my-mentorship-bookings', compact('bookings'));
    }

    /**
     * Display all advice requests.
     */
    public function myAdviceRequests()
    {
        $adviceRequests = AdviceRequest::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('scholar.my-advice-requests', compact('adviceRequests'));
    }
}
