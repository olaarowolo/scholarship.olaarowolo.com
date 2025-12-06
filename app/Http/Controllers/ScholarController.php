<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ScholarController extends Controller
{
    /**
     * Display the scholar dashboard.
     */
    public function dashboard(): View
    {
        return view('scholar-dashboard');
    }

    /**
     * Display the form to create a new request.
     */
    public function createRequest(): View
    {
        return view('scholar.requests.create');
    }

    /**
     * Display the academic standing form.
     */
    public function academicStanding(): View
    {
        return view('scholar.academic-standing');
    }

    /**
     * Display the challenges documentation form.
     */
    public function challenges(): View
    {
        return view('scholar.challenges');
    }

    /**
     * Display the mentorship booking page.
     */
    public function mentorship(): View
    {
        return view('scholar.mentorship');
    }

    /**
     * Display the academic advice request form.
     */
    public function advice(): View
    {
        return view('scholar.advice');
    }
}
