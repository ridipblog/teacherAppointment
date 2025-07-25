@php
    $data = null;
    $isError = null;
    $form = null;
    try {
        $data = $viewData['data'] ?? null;
        $isError = $viewData['isError'] ?? true;
        $form = $viewData['form'] ?? null;
    } catch (Exception $err) {
        $isError = true;
    }
@endphp

@extends('layouts.admin_layout')

@section('title', 'School Vacancy Form')

{{-- *** Main Content *** --}}
@section('content')

    @if ($isError)
        <div class="p-6 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-lg shadow-lg text-center mb-6">
            <p class="">{{ $viewData['message'] ?? 'Some issue execute.' }}</p>
        </div>
    @else
        <!-- Header Design -->
        <div class="p-6 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-lg shadow-lg text-center mb-6">
            <h1 class="text-3xl font-bold">Add School Vacancy</h1>
            <p class="mt-2">Please fill out all the information below</p>
        </div>

        <!-- Full Form Start -->
        <form id="{{ $form == 'add' ? 'add' : ($form == 'update' ? 'update' : 'none') }}-school-vacency-form"
            class="space-y-10 bg-white p-6 rounded-xl shadow-lg max-w-4xl mx-auto">

            <!-- Form 1: School Vacancy Info -->
            <div class="space-y-6">
                <h2 class="text-2xl font-semibold text-gray-800 border-b pb-2">🏫 School Vacancy Information</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- School Code -->
                    <div>
                        <label for="schoolCode" class="block text-sm font-medium text-gray-700 mb-1">School Code</label>
                        <input type="text" id="schoolCode" name="schoolCode" placeholder="Enter school code"
                            {{ $form == 'view' || $form == 'delete' ? 'readonly' : '' }}
                            value="{{ $data->schoolCode ?? null }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- School Name -->
                    <div>
                        <label for="schoolName" class="block text-sm font-medium text-gray-700 mb-1">School Name</label>
                        <input type="text" id="schoolName" name="schoolName" placeholder="Enter school name"
                            {{ $form == 'view' || $form == 'delete' ? 'readonly' : '' }}
                            value="{{ $data->schoolName ?? null }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Post Name -->
                    <div>
                        <label for="postName" class="block text-sm font-medium text-gray-700 mb-1">Post Name</label>
                        <select id="postName" name="postName" {{ $form == 'view' || $form == 'delete' ? 'disabled' : '' }}
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="" selected>Select Post</option>
                            <option value="1" {{ ($data->postID ?? null) == 1 ? 'selected' : null }}>UGT</option>
                            <option value="2" {{ ($data->postID ?? null) == 2 ? 'selected' : null }}>PGT</option>
                        </select>
                    </div>

                    <!-- District -->
                    <div>
                        <label for="district" class="block text-sm font-medium text-gray-700 mb-1">District</label>
                        <input type="text" id="district" name="district" placeholder="Enter district"
                            {{ $form == 'view' || $form == 'delete' ? 'readonly' : '' }}
                            value="{{ $data->district ?? null }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Medium -->
                    <div>
                        <label for="medium" class="block text-sm font-medium text-gray-700 mb-1">Medium</label>
                        <input type="text" id="medium" name="medium" placeholder="Enter medium"
                            {{ $form == 'view' || $form == 'delete' ? 'readonly' : '' }}
                            value="{{ $data->medium ?? null }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Subject -->
                    <div>
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input type="text" id="subject" name="subject" placeholder="Enter subject"
                            {{ $form == 'view' || $form == 'delete' ? 'readonly' : '' }}
                            value="{{ $data->vacencyCategory ?? null }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <!-- Actual Vacancy -->
                    <div>
                        <label for="actualVacancy" class="block text-sm font-medium text-gray-700 mb-1">Actual
                            Vacancy</label>
                        <input type="number" id="actualVacancy" name="actualVacancy" placeholder="0" min="0"
                            value="{{ $data->actualVacency ?? null }}"
                            {{ $form == 'view' || $form == 'delete' ? 'readonly' : '' }}
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>


            <!-- Form 2: Vacancy Details (Dynamic Rows) -->
            <div class="space-y-6">
                <h2 class="text-2xl font-semibold text-gray-800 border-b pb-2">📋 Vacancy Details</h2>

                <div id="vacancyRows" class="space-y-4">
                    <!-- Vacancy Row -->
                    @if ($data)
                        <input type="hidden" name="schoolCodeId" id="school-code-id" value="{{ $data->id ?? null }}">
                        @foreach ($data->vacency_details ?? [] as $rows)
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 vacancy-row">
                                <!-- Vacancy Code -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Vacancy Code</label>
                                    <input type="text" name="vacancyCode[]" placeholder="Vacancy Code"
                                        {{ $form == 'view' || $form == 'delete' ? 'readonly' : '' }}
                                        value="{{ $rows->vacencyCode ?? null }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Replace Person Name + Remove Button -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Replace Person Name</label>
                                    <div class="flex gap-2">
                                        <input type="text" name="replacePerson[]" placeholder="Replace Person Name"
                                            value="{{ $rows->replcedPersion ?? null }}"
                                            {{ $form == 'view' || $form == 'delete' ? 'readonly' : '' }}
                                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                        @if ($form == 'add')
                                            <button type="button" class="text-red-600 hover:underline font-medium"
                                                id="remove-form">Remove</button>
                                        @elseif ($form == 'delete')
                                            <button type="button" value="{{ $rows->id ?? null }}"
                                                id="delete-vacency-details"
                                                class="flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white font-medium px-4 py-2 rounded-lg shadow transition duration-200">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7L5 7M6 7L6 19a2 2 0 002 2h8a2 2 0 002-2V7M10 11v6m4-6v6M9 7V4h6v3" />
                                                </svg>
                                                Delete
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                @if ($data ?? null)
                                    <input type="hidden" name="vacencyId[]" value="{{ $rows->id ?? null }}">
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 vacancy-row">
                            <!-- Vacancy Code -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Vacancy Code</label>
                                <input type="text" name="vacancyCode[]" placeholder="Vacancy Code"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            </div>

                            <!-- Replace Person Name + Remove Button -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Replace Person Name</label>
                                <div class="flex gap-2">
                                    <input type="text" name="replacePerson[]" placeholder="Replace Person Name"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                                    @if ($form == 'add' || $form == 'update')
                                        <button type="button" class="text-red-600 hover:underline font-medium"
                                            id="remove-form">Remove</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Add Row Button -->
                @if ($form == 'add' || $form == 'update')
                    <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                        id="append-form">
                        + Add Vacancy Row
                    </button>
                @endif
            </div>


            <!-- Submit Button -->
            @if ($form != 'view')
                <div class="text-center">
                    <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700"
                        id="{{ $form }}-school-vacency-btn">
                        {{ ucfirst($form) }} School Information
                    </button>
                </div>
            @endif

        </form>
    @endif
@endsection

@section('extraJs')

    {{-- *** All Admin Js Code Here *** --}}
    <script type="module" src="{{ asset('js/Admin/admin.js') }}"></script>

@endsection
