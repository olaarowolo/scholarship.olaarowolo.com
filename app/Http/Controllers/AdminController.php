<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use App\Models\FormSetting;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display admin dashboard
     */
    public function dashboard()
    {
        $totalApplications = Application::count();
        $pendingApplications = Application::where('status', 'pending')->count();
        $approvedApplications = Application::where('status', 'approved')->count();
        $rejectedApplications = Application::where('status', 'rejected')->count();
        $totalUsers = User::count();
        $recentApplications = Application::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalApplications',
            'pendingApplications',
            'approvedApplications',
            'rejectedApplications',
            'totalUsers',
            'recentApplications'
        ));
    }

    /**
     * Display all applications
     */
    public function applications(Request $request)
    {
        $query = Application::with('user')->latest();

        // Filter by status
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('application_id', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('jamb_reg_number', 'like', "%{$search}%");
            });
        }

        $applications = $query->paginate(20);

        return view('admin.applications', compact('applications'));
    }

    /**
     * Show single application
     */
    public function showApplication($id)
    {
        $application = Application::with('user')->findOrFail($id);
        return view('admin.application-detail', compact('application'));
    }

    /**
     * Update application status
     */
    public function updateApplicationStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
            'notes' => 'nullable|string|max:1000',
        ]);

        $application = Application::findOrFail($id);
        $application->status = $request->status;

        if ($request->notes) {
            $application->notes = $request->notes;
        }

        $application->save();

        return redirect()->back()->with('success', 'Application status updated successfully!');
    }

    /**
     * Display all users
     */
    public function users(Request $request)
    {
        $query = User::latest();

        // Filter by role
        if ($request->has('role') && $request->role != 'all') {
            $query->where('role', $request->role);
        }

        // Search functionality
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(20);
        
        // Get user counts by role
        $userStats = [
            'total' => User::count(),
            'admin' => User::where('role', 'admin')->count(),
            'applicant' => User::where('role', 'applicant')->count(),
            'scholar' => User::where('role', 'scholar')->count(),
            'review_team' => User::where('role', 'review_team')->count(),
        ];

        return view('admin.users', compact('users', 'userStats'));
    }

    /**
     * Update user role
     */
    public function updateUserRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:user,admin',
        ]);

        $user = User::findOrFail($id);
        $user->role = $request->role;
        $user->save();

        return redirect()->back()->with('success', 'User role updated successfully!');
    }

    /**
     * Display analytics
     */
    public function analytics()
    {
        $totalApplications = Application::count();
        $pendingApplications = Application::where('status', 'pending')->count();
        $approvedApplications = Application::where('status', 'approved')->count();
        $rejectedApplications = Application::where('status', 'rejected')->count();

        // Applications by month (last 6 months)
        $applicationsByMonth = Application::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Top courses
        $topCourses = Application::selectRaw('course, COUNT(*) as count')
            ->groupBy('course')
            ->orderByDesc('count')
            ->take(10)
            ->get();

        // Average JAMB score by status
        $avgScoreByStatus = Application::selectRaw('status, AVG(jamb_score) as avg_score')
            ->groupBy('status')
            ->get();

        return view('admin.analytics', compact(
            'totalApplications',
            'pendingApplications',
            'approvedApplications',
            'rejectedApplications',
            'applicationsByMonth',
            'topCourses',
            'avgScoreByStatus'
        ));
    }

    /**
     * Delete application
     */
    public function deleteApplication($id)
    {
        $application = Application::findOrFail($id);
        $application->delete();

        return redirect()->route('admin.applications')->with('success', 'Application deleted successfully!');
    }

    /**
     * Display export page
     */
    public function export()
    {
        $totalApplications = Application::count();
        $totalUsers = User::count();
        $statusCounts = [
            'pending' => Application::where('status', 'pending')->count(),
            'approved' => Application::where('status', 'approved')->count(),
            'rejected' => Application::where('status', 'rejected')->count(),
        ];

        return view('admin.export', compact('totalApplications', 'totalUsers', 'statusCounts'));
    }

    /**
     * Export applications to CSV
     */
    public function exportApplications(Request $request)
    {
        $query = Application::with('user');

        // Filter by status if provided
        if ($request->has('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }

        // Filter by date range if provided
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $applications = $query->get();

        $filename = 'applications_export_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($applications) {
            $file = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($file, [
                'Application ID',
                'First Name',
                'Last Name',
                'Middle Name',
                'Email',
                'Phone',
                'Date of Birth',
                'Gender',
                'State of Origin',
                'LGA of Origin',
                'Ondo Indigene',
                'Home Address',
                'Institution',
                'Course',
                'Level',
                'JAMB Reg Number',
                'JAMB Score',
                'JAMB Year',
                'Status',
                'Submitted At',
                'User ID',
                'User Name',
                'User Email',
            ]);

            // Add data rows
            foreach ($applications as $application) {
                fputcsv($file, [
                    $application->application_id,
                    $application->first_name,
                    $application->last_name,
                    $application->middle_name ?? '',
                    $application->email,
                    $application->phone,
                    $application->date_of_birth,
                    $application->gender,
                    $application->state_of_origin,
                    $application->lga_of_origin,
                    $application->is_ondo_indigene ? 'Yes' : 'No',
                    $application->home_address,
                    $application->institution,
                    $application->course,
                    $application->level,
                    $application->jamb_reg_number,
                    $application->jamb_score,
                    $application->jamb_year,
                    ucfirst($application->status),
                    $application->created_at->format('Y-m-d H:i:s'),
                    $application->user_id ?? '',
                    $application->user->name ?? '',
                    $application->user->email ?? '',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Export users to CSV
     */
    public function exportUsers(Request $request)
    {
        $query = User::query();

        // Filter by role if provided
        if ($request->has('role') && $request->role != 'all') {
            $query->where('role', $request->role);
        }

        $users = $query->get();

        $filename = 'users_export_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($users) {
            $file = fopen('php://output', 'w');

            // Add CSV headers
            fputcsv($file, [
                'User ID',
                'Name',
                'Email',
                'Role',
                'Email Verified',
                'Terms Accepted',
                'Registered At',
            ]);

            // Add data rows
            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->name,
                    $user->email,
                    ucfirst($user->role),
                    $user->email_verified_at ? 'Yes' : 'No',
                    $user->terms_accepted ? 'Yes' : 'No',
                    $user->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Generate summary report
     */
    public function exportSummaryReport()
    {
        $filename = 'summary_report_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() {
            $file = fopen('php://output', 'w');

            // Report Header
            fputcsv($file, ['SCHOLARSHIP APPLICATION SUMMARY REPORT']);
            fputcsv($file, ['Generated: ' . date('Y-m-d H:i:s')]);
            fputcsv($file, []); // Empty row

            // Overall Statistics
            fputcsv($file, ['OVERALL STATISTICS']);
            fputcsv($file, ['Metric', 'Count']);
            fputcsv($file, ['Total Applications', Application::count()]);
            fputcsv($file, ['Pending Applications', Application::where('status', 'pending')->count()]);
            fputcsv($file, ['Approved Applications', Application::where('status', 'approved')->count()]);
            fputcsv($file, ['Rejected Applications', Application::where('status', 'rejected')->count()]);
            fputcsv($file, ['Total Users', User::count()]);
            fputcsv($file, ['Admin Users', User::where('role', 'admin')->count()]);
            fputcsv($file, []); // Empty row

            // Applications by Institution
            fputcsv($file, ['APPLICATIONS BY INSTITUTION']);
            fputcsv($file, ['Institution', 'Count']);
            $institutionStats = Application::selectRaw('institution, COUNT(*) as count')
                ->groupBy('institution')
                ->orderByDesc('count')
                ->get();
            foreach ($institutionStats as $stat) {
                fputcsv($file, [$stat->institution, $stat->count]);
            }
            fputcsv($file, []); // Empty row

            // Applications by Course
            fputcsv($file, ['TOP 10 COURSES']);
            fputcsv($file, ['Course', 'Count']);
            $courseStats = Application::selectRaw('course, COUNT(*) as count')
                ->groupBy('course')
                ->orderByDesc('count')
                ->take(10)
                ->get();
            foreach ($courseStats as $stat) {
                fputcsv($file, [$stat->course, $stat->count]);
            }
            fputcsv($file, []); // Empty row

            // JAMB Score Statistics
            fputcsv($file, ['JAMB SCORE STATISTICS']);
            fputcsv($file, ['Metric', 'Score']);
            fputcsv($file, ['Average Score (All)', round(Application::avg('jamb_score'), 2)]);
            fputcsv($file, ['Average Score (Approved)', round(Application::where('status', 'approved')->avg('jamb_score'), 2)]);
            fputcsv($file, ['Highest Score', Application::max('jamb_score')]);
            fputcsv($file, ['Lowest Score', Application::min('jamb_score')]);
            fputcsv($file, []); // Empty row

            // Gender Distribution
            fputcsv($file, ['GENDER DISTRIBUTION']);
            fputcsv($file, ['Gender', 'Count']);
            $genderStats = Application::selectRaw('gender, COUNT(*) as count')
                ->groupBy('gender')
                ->get();
            foreach ($genderStats as $stat) {
                fputcsv($file, [ucfirst($stat->gender), $stat->count]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Display form settings page
     */
    public function formSettings()
    {
        $forms = FormSetting::all();

        // Ensure default forms exist
        $defaultForms = [
            'application_form' => 'Scholarship Application Form',
            'scholar_requests' => 'Scholar Request Form',
            'academic_standing' => 'Academic Standing Report',
            'challenges' => 'Challenge Documentation Form',
            'mentorship' => 'Mentorship Booking',
            'advice' => 'Academic Advice Request',
        ];

        foreach ($defaultForms as $formName => $formLabel) {
            if (!$forms->where('form_name', $formName)->first()) {
                FormSetting::create([
                    'form_name' => $formName,
                    'is_open' => false,
                    'closed_message' => "The {$formLabel} is currently closed.",
                ]);
            }
        }

        $forms = FormSetting::all();

        return view('admin.form-settings', compact('forms'));
    }

    /**
     * Update form setting
     */
    public function updateFormSetting(Request $request, $id)
    {
        $request->validate([
            'is_open' => 'required|boolean',
            'opens_at' => 'nullable|date',
            'closes_at' => 'nullable|date|after:opens_at',
            'closed_message' => 'nullable|string',
        ]);

        $formSetting = FormSetting::findOrFail($id);
        $formSetting->update($request->all());

        return redirect()->route('admin.form-settings')
            ->with('success', 'Form setting updated successfully!');
    }
}
