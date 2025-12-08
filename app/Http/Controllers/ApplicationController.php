<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\User;
use App\Models\FormSetting;
use App\Mail\ApplicationSubmitted;
use App\Mail\ApplicationSubmittedAdmin;
use App\Mail\WelcomeCredentials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    public function create()
    {
        return view('apply', ['applyButtonDisabled' => false]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'address' => 'required|string|max:500',
            'lga' => 'required|string|max:255',
            'town' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'jamb_reg_number' => 'required|string|max:255|unique:applications',
            'jamb_score' => 'required|numeric|min:0|max:400',
            'institution' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'passport_photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'id_card' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'jamb_result' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Generate unique application ID
        $applicationId = 'OA-' . date('Y') . '-' . strtoupper(Str::random(8));

        // Handle file uploads
        $passportPhotoPath = $request->file('passport_photo')->store('applications/passport_photos', 'public');
        $idCardPath = $request->file('id_card')->store('applications/id_cards', 'public');
        $jambResultPath = $request->file('jamb_result')->store('applications/jamb_results', 'public');

        // Create application
        $application = Application::create([
            'application_id' => $applicationId,
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'date_of_birth' => $request->date_of_birth,
            'address' => $request->address,
            'lga' => $request->lga,
            'town' => $request->town,
            'phone' => $request->phone,
            'jamb_reg_number' => $request->jamb_reg_number,
            'jamb_score' => $request->jamb_score,
            'institution' => $request->institution,
            'course' => $request->course,
            'passport_photo' => $passportPhotoPath,
            'id_card' => $idCardPath,
            'jamb_result' => $jambResultPath,
            'status' => 'submitted',
        ]);

        return redirect()->route('application.show', $application->id)
                        ->with('success', 'Your application has been submitted successfully! Application ID: ' . $applicationId);
    }

    public function show($id)
    {
        $application = Application::where('id', $id)
                                 ->where('user_id', Auth::id())
                                 ->firstOrFail();

        return view('application.show', compact('application'))->with('applyButtonDisabled', false);
    }

    public function submit(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'hasTakenJamb' => 'required|in:Yes,No',
                'needsJambSupport' => 'nullable|in:Yes,No',
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'dateOfBirth' => 'required|date|before:today',
                'email' => 'required|email',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:500',
                'lga' => 'required|string|max:255',
                'town' => 'required|string|max:255',
                'isIndigene' => 'required|in:Yes,Pending,No',
                'jambRegNumber' => 'nullable|string|max:255', // Now optional
                'jambScore' => 'nullable|numeric|min:180|max:400', // Now optional
                'waecGceYear' => 'required|string|max:4',
                'institution' => 'required|string|max:255',
                'course' => 'required|string|max:255',
                'admissionStatus' => 'required|string',
                'jambResult' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120', // Can be academic record
                'waecResult' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'indigeneCert' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        }

        try {
            // Handle file uploads
            $jambResultPath = $request->file('jambResult')->store('applications/jamb_results', 'public');
            $waecResultPath = $request->file('waecResult')->store('applications/waec_results', 'public');
            $indigeneCertPath = $request->file('indigeneCert')->store('applications/indigene_certs', 'public');

            // Generate unique application ID
            $applicationId = 'OA-' . date('Y') . '-' . strtoupper(Str::random(8));

            // Check if user is already logged in
            $userId = Auth::check() ? Auth::id() : null;

            // If not logged in, automatically create an account for the applicant
            if (!$userId) {
                // Check if user with this email already exists
                $existingUser = User::where('email', $request->email)->first();

                if ($existingUser) {
                    // User exists, use their ID
                    $userId = $existingUser->id;
                } else {
                    // Create new user account
                    $password = Str::random(12); // Generate random password
                    $user = User::create([
                        'name' => $request->firstName . ' ' . $request->lastName,
                        'email' => $request->email,
                        'password' => Hash::make($password),
                        'role' => 'applicant',
                        'terms_accepted' => true,
                    ]);
                    $userId = $user->id;

                    // Send welcome email with login credentials
                    Mail::to($user->email)->send(new WelcomeCredentials($user, $password, $applicationId));
                    Log::info("New applicant account created: Email: {$request->email}, Password: {$password}, Application ID: {$applicationId}");
                }
            }

            // Prepare notes with JAMB status and admission status
            $notesArray = [
                'admission_status' => $request->admissionStatus,
                'has_taken_jamb' => $request->hasTakenJamb,
            ];
            if ($request->hasTakenJamb === 'No') {
                $notesArray['needs_jamb_support'] = $request->needsJambSupport;
            }
            $notes = json_encode($notesArray);

            // Create application
            $application = Application::create([
                'application_id' => $applicationId,
                'user_id' => $userId,
                'first_name' => $request->firstName,
                'last_name' => $request->lastName,
                'date_of_birth' => $request->dateOfBirth,
                'address' => $request->address,
                'lga' => $request->lga,
                'town' => $request->town,
                'phone' => $request->phone,
                'jamb_reg_number' => $request->jambRegNumber,
                'jamb_score' => $request->jambScore,
                'institution' => $request->institution,
                'course' => $request->course,
                'passport_photo' => $indigeneCertPath,
                'id_card' => $waecResultPath,
                'jamb_result' => $jambResultPath,
                'status' => 'submitted',
                'notes' => $notes,
            ]);

            // Send confirmation email to applicant
            $applicantUser = User::find($application->user_id);
            if ($applicantUser) {
                Mail::to($applicantUser->email)->send(new ApplicationSubmitted($application));
                // Log message to tray
                \App\Models\Message::create([
                    'sender_id' => auth()->id() ?? 1, // 1 = system/admin
                    'receiver_id' => $applicantUser->id,
                    'content' => 'Your application was submitted successfully. Application ID: ' . $application->application_id,
                ]);
            }

            // Send notification email to admin
            Mail::to(config('mail.admin.address'))->send(new ApplicationSubmittedAdmin($application, $applicantUser));
            // Log message to tray for admin
            $adminUser = \App\Models\User::where('email', config('mail.admin.address'))->first();
            if ($adminUser) {
                \App\Models\Message::create([
                    'sender_id' => $applicantUser ? $applicantUser->id : 1,
                    'receiver_id' => $adminUser->id,
                    'content' => 'A new application was submitted. Application ID: ' . $application->application_id,
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Application submitted successfully!',
                'application_id' => $application->application_id
            ]);
        } catch (\Exception $e) {
            Log::error('Application submission error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your application: ' . $e->getMessage()
            ], 500);
        }
    }

    public function applyForm()
    {
        return view('apply-form', ['applyButtonDisabled' => false]);
    }

    /**
     * Get form settings for API consumption
     */
    public function getFormSettings($formName)
    {
        $formSetting = FormSetting::getByName($formName);

        return response()->json([
            'form_name' => $formSetting->form_name,
            'is_open' => $formSetting->is_open,
            'is_currently_open' => $formSetting->isCurrentlyOpen(),
            'opens_at' => $formSetting->opens_at ? $formSetting->opens_at->toIso8601String() : null,
            'closes_at' => $formSetting->closes_at ? $formSetting->closes_at->toIso8601String() : null,
            'closed_message' => $formSetting->closed_message,
        ]);
    }
}
