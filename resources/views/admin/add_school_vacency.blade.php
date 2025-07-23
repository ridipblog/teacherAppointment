@extends('layouts.admin_layout')

@section('title', 'School Vacancy Form')

{{-- *** Main Content *** --}}
@section('content')

    <!-- Header Design -->
    <div class="p-6 bg-gradient-to-r from-blue-600 to-indigo-700 text-white rounded-lg shadow-lg text-center mb-6">
        <h1 class="text-3xl font-bold">Add School Vacancy</h1>
        <p class="mt-2">Please fill out all the information below</p>
    </div>

    <!-- Full Form Start -->
    <form id="add-school-vacency-form" class="space-y-10 bg-white p-6 rounded-xl shadow-lg max-w-4xl mx-auto">

        <!-- Form 1: School Vacancy Info -->
        <div class="space-y-6">
            <h2 class="text-2xl font-semibold text-gray-800 border-b pb-2">🏫 School Vacancy Information</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- School Code -->
                <div>
                    <label for="schoolCode" class="block text-sm font-medium text-gray-700 mb-1">School Code</label>
                    <input type="text" id="schoolCode" name="schoolCode" placeholder="Enter school code"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                </div>

                <!-- School Name -->
                <div>
                    <label for="schoolName" class="block text-sm font-medium text-gray-700 mb-1">School Name</label>
                    <input type="text" id="schoolName" name="schoolName" placeholder="Enter school name"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                </div>

                <!-- Post Name -->
                <div>
                    <label for="postName" class="block text-sm font-medium text-gray-700 mb-1">Post Name</label>
                    <select id="postName" name="postName"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                        <option value="">Select Post</option>
                        <option value="1">UGT</option>
                        <option value="2">PGT</option>
                    </select>
                </div>

                <!-- District -->
                <div>
                    <label for="district" class="block text-sm font-medium text-gray-700 mb-1">District</label>
                    <input type="text" id="district" name="district" placeholder="Enter district"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                </div>

                <!-- Medium -->
                <div>
                    <label for="medium" class="block text-sm font-medium text-gray-700 mb-1">Medium</label>
                    <input type="text" id="medium" name="medium" placeholder="Enter medium"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                </div>

                <!-- Subject -->
                <div>
                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                    <input type="text" id="subject" name="subject" placeholder="Enter subject"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                </div>

                <!-- Actual Vacancy -->
                <div>
                    <label for="actualVacancy" class="block text-sm font-medium text-gray-700 mb-1">Actual
                        Vacancy</label>
                    <input type="number" id="actualVacancy" name="actualVacancy" placeholder="0" min="0"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                </div>
            </div>
        </div>


        <!-- Form 2: Vacancy Details (Dynamic Rows) -->
        <div class="space-y-6">
            <h2 class="text-2xl font-semibold text-gray-800 border-b pb-2">📋 Vacancy Details</h2>

            <div id="vacancyRows" class="space-y-4">
                <!-- Vacancy Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 vacancy-row">
                    <!-- Vacancy Code -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Vacancy Code</label>
                        <input type="text" name="vacancyCode[]" placeholder="Vacancy Code"
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >
                    </div>

                    <!-- Replace Person Name + Remove Button -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Replace Person Name</label>
                        <div class="flex gap-2">
                            <input type="text" name="replacePerson[]" placeholder="Replace Person Name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                >
                            <button type="button" class="text-red-600 hover:underline font-medium"
                                id="remove-form">Remove</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Add Row Button -->
            <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                id="append-form">
                + Add Vacancy Row
            </button>
        </div>


        <!-- Submit Button -->
        <div class="text-center">
            <button type="submit" class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700"
                id="subject-school-vacency">
                Submit Vacancy Information
            </button>
        </div>
    </form>

@endsection

@section('extraJs')

    {{-- *** All Admin Js Code Here *** --}}
    <script type="module" src="{{ asset('js/Admin/admin.js') }}"></script>

@endsection
