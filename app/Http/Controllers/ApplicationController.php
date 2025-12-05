<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
                'firstName' => 'required|string|max:255',
                'lastName' => 'required|string|max:255',
                'dateOfBirth' => 'required|date|before:today',
                'email' => 'required|email',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:500',
                'lga' => 'required|string|max:255',
                'town' => 'required|string|max:255',
                'isIndigene' => 'required|in:Yes,Pending,No',
                'jambRegNumber' => 'required|string|max:255',
                'jambScore' => 'required|numeric|min:200|max:400',
                'waecGceYear' => 'required|string|max:4',
                'institution' => 'required|string|max:255',
                'course' => 'required|string|max:255',
                'admissionStatus' => 'required|string',
                'jambResult' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120',
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

            // Create application
            $application = Application::create([
                'application_id' => $applicationId,
                'user_id' => Auth::check() ? Auth::id() : null,
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
                'notes' => $request->admissionStatus,
            ]);

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
}
