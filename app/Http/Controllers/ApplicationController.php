<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    public function create()
    {
        return view('apply', ['applyButtonDisabled' => true]);
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
            'user_id' => auth()->id(),
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
                                 ->where('user_id', auth()->id())
                                 ->firstOrFail();

        return view('application.show', compact('application'))->with('applyButtonDisabled', true);
    }

    public function submit(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'isIndigene' => 'required|in:Yes,Pending',
            'jambScore' => 'required|numeric|min:180|max:400',
            'waecGceYear' => 'required|string|max:4',
            'institution' => 'required|string|max:255',
            'course' => 'required|string|max:255',
            'admissionStatus' => 'required|string',
            'jambResult' => 'required|file|mimes:pdf,jpg,png|max:5120',
            'waecResult' => 'required|file|mimes:pdf,jpg,png|max:5120',
            'indigeneCert' => 'required|file|mimes:pdf,jpg,png|max:5120',
        ]);

        // Handle file uploads
        $jambResultPath = $request->file('jambResult')->store('applications/jamb_results', 'public');
        $waecResultPath = $request->file('waecResult')->store('applications/waec_results', 'public');
        $indigeneCertPath = $request->file('indigeneCert')->store('applications/indigene_certs', 'public');

        // Create application
        $application = Application::create([
            'user_id' => auth()->id(),
            'first_name' => $request->fullName,
            'last_name' => '',
            'date_of_birth' => null,
            'address' => $request->address,
            'lga' => '',
            'town' => '',
            'phone' => $request->phone,
            'jamb_reg_number' => '',
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
    }

    public function applyForm()
    {
        return view('apply-form', ['applyButtonDisabled' => true]);
    }
}
