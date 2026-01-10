@extends('layouts.admin')

@section('content')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Application Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <a href="{{ route('admin.applications') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Back to Applications
                        </a>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Personal Information</h3>
                            <p><strong>Application ID:</strong> {{ $application->application_id }}</p>
                            <p><strong>Name:</strong> {{ $application->first_name }} {{ $application->last_name }}</p>
                            <p><strong>Date of Birth:</strong>
                                {{ $application->date_of_birth ? $application->date_of_birth->format('Y-m-d') : 'N/A' }}
                            </p>
                            <p><strong>Phone:</strong> {{ $application->phone }}</p>
                            <p><strong>Address:</strong> {{ $application->address }}</p>
                            <p><strong>LGA:</strong> {{ $application->lga }}</p>
                            <p><strong>Town:</strong> {{ $application->town }}</p>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-4">Academic Information</h3>
                            <p><strong>JAMB Reg Number:</strong> {{ $application->jamb_reg_number }}</p>
                            <p><strong>JAMB Score:</strong> {{ $application->jamb_score }}</p>
                            <p><strong>Institution:</strong> {{ $application->institution }}</p>
                            <p><strong>Course:</strong> {{ $application->course }}</p>
                            <p><strong>Status:</strong> <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if ($application->status == 'submitted') bg-yellow-100 text-yellow-800
                                @elseif($application->status == 'approved') bg-green-100 text-green-800
                                @elseif($application->status == 'rejected') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">{{ ucfirst($application->status) }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="mt-6">
                        <h3 class="text-lg font-semibold mb-4">Uploaded Documents</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @if ($application->passport_photo)
                                <div>
                                    <p><strong>Passport</strong></p>
                                    <img src="{{ Storage::url($application->passport_photo) }}" alt="Passport"
                                        class="w-32 h-32 object-cover rounded">
                                </div>
                            @endif
                            @if ($application->id_card)
                                <div>
                                    <p><strong>ID card</strong></p>
                                    <img src="{{ Storage::url($application->id_card) }}" alt="ID card"
                                        class="w-32 h-32 object-cover rounded">
                                </div>
                            @endif
                            @if ($application->jamb_result)
                                <div>
                                    <p><strong>JAMB result</strong></p>
                                    <img src="{{ Storage::url($application->jamb_result) }}" alt="JAMB result"
                                        class="w-32 h-32 object-cover rounded">
                                </div>
                            @endif
                        </div>
                    </div>

                    @if ($application->notes)
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold mb-4">Notes</h3>
                            <p>{{ $application->notes }}</p>
                        </div>
                    @endif

                    @if ($application->status == 'submitted')
                        <div class="mt-6">
                            <h3 class="text-lg font-semibold mb-4">Actions</h3>
                            <form method="POST"
                                action="{{ route('admin.applications.update-status', $application->id) }}"
                                class="inline mr-4">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="approved">
                                <button type="submit"
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Approve</button>
                            </form>
                            <form method="POST"
                                action="{{ route('admin.applications.update-status', $application->id) }}"
                                class="inline">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="rejected">
                                <button type="submit"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Reject</button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
